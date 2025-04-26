<?php
class Time_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'time';
  }

  function ExcluirTime($id) {
    if(is_null($id))
      return false;

    $this->db->where('idtime', $id);
    return $this->db->delete($this->table);

  }


  public function times_por_modalidade($modalidades)
  {

    $this->db->select("time.idtime, time.nome_grupo as nome_grupo, time.nome as nome_time, time.modalidade, j.nome as capitao");
    if (is_null($modalidades)) {
      $this->db->join('jogadores j','j.id_time = time.idtime');
      $this->db->where('j.tipo', "capitao");
      $query = $this->db->get($this->table);
    } else {
      $this->db->join('jogadores j','j.id_time = time.idtime');
      $this->db->where_in('modalidade', $modalidades);
      $this->db->where('j.tipo', "capitao");
      $query = $this->db->get($this->table);
    }
    
    // echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }

  public function times_por_modalidade2($modalidades)
  {
    $this->db->select("time.idtime, time.nome as nome_time, time.modalidade, j.nome as capitao, SUM(j.valor_pagamento) as total_pagamento");
    $this->db->join('jogadores j','j.id_time = time.idtime');
    $this->db->where('j.tipo', "capitao");
    
    if (!is_null($modalidades)) {
        $this->db->where_in('modalidade', $modalidades);
    }

    // Agrupa por time para somar os valores de pagamento por time
    $this->db->group_by('time.idtime, time.nome, time.modalidade, j.nome');

    $query = $this->db->get($this->table);

    if ($query->num_rows() > 0) {
        $result = $query->result_array();

        // Somar o total geral de pagamentos de todos os times
        $total_geral_pagamento = 0;
        foreach ($result as $time) {
            $total_geral_pagamento += $time['total_pagamento'];
        }

        // Adicionar o total geral ao resultado (opcional)
        $result['total_geral_pagamento'] = $total_geral_pagamento;

        return $result;
    } else {
        return null;
    }
  }

}
