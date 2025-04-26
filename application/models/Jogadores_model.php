<?php
class Jogadores_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = 'jogadores';
  }


  public function jogadores_por_time($idTime)
  {

    $this->db->where('id_time', $idTime);

    $query = $this->db->get($this->table);

    // echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }

  public function valores_por_time($idTime)
{
    // Seleciona o ID do time e a soma dos valores de pagamento dos jogadores
    $this->db->select('id_time, SUM(valor_pagamento) as total_pagamento');
    $this->db->where('id_time', $idTime);

    // Agrupa por ID do time para garantir que a soma seja calculada corretamente
    $this->db->group_by('id_time');

    $query = $this->db->get($this->table);

    if ($query->num_rows() > 0) {
        return $query->row_array();  // Usando row_array() para retornar apenas o primeiro resultado (o total)
    } else {
        return null;
    }
}

  public function findByCell($celular){

    $this->db->where('telefone', $celular);

    $query = $this->db->get($this->table);

    // echo $this->db->last_query();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }

}
