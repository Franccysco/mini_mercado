<?php
class Crachas_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'cracha';
    }

    public function modelos_por_participante($id)
    {
        if (is_null($id))
            return false;

        $this->db->where('id_participante', $id);
        $query = $this->db->get($this->table);


        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }

    public function crachasPorEquipe($equipes)
    {
        $this->db->select("cracha.nome_cracha, cracha.imagem_cracha, p.equipe");
        //from no get();
        $this->db->join('participantes p','p.id = cracha.id_participante');
        if (is_null($equipes)) {
            $query = $this->db->get($this->table);
        } else {
            $this->db->where_in('p.equipe', $equipes);
            // $this->db->where("imagem_participante is not null");
            $query = $this->db->get($this->table);
        }

        // echo $this->db->last_query(); www

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
