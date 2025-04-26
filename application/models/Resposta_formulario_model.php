<?php
class Resposta_formulario_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'resposta_formulario';
    }

    public function respostasTotaisPorEquipe($equipe)
    {
        if (is_null($equipe))
            return false;

        if ($equipe != "todas") {
            $this->db->where('equipe', $equipe);
        }
        
        $query = $this->db->get($this->table);

        // echo $this->db->last_query(); 

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return null;
        }
    }

    public function respostasTotaisPorEquipeParticipante($equipe, $tipo)
    {
        if (is_null($equipe) || is_null($tipo))
            return false;

        $this->db->join('participantes p','p.id = resposta_formulario.id_participante');

        if ($equipe != "todas") {
            $this->db->where('equipe', $equipe);
        }
        $this->db->where('p.tipo_participante', $tipo);
        $query = $this->db->get($this->table);

        // echo $this->db->last_query(); 

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return null;
        }
    }

    public function respostasRecentes()
    {

        $this->db->select("resposta_formulario.equipe, p.nome_cracha, p.imagem_participante, resposta_formulario.created_at");
        //from no get();
        $this->db->join('participantes p','p.id = resposta_formulario.id_participante');
        $this->db->order_by('resposta_formulario.id', 'desc');
        $this->db->limit(4);
        $query = $this->db->get($this->table);

        // echo $this->db->last_query(); 

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}