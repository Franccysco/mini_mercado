<?php
class Participantes_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'participantes';
    }


    public function participantes_por_equipe($equipes, $circulo)
    {
        
        if (is_null($equipes)) {
            $query = $this->db->get($this->table);
        } else {
             $this->db->where_in('equipe', $equipes);
             if (!is_null($circulo)) 
                $this->db->where('circulo', $circulo);
            // $this->db->where("imagem_participante is not null");
            $query = $this->db->get($this->table);
        }
        //  echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function participantes_por_equipes($equipes)
    {
        
        if (is_null($equipes)) {
            $query = $this->db->get($this->table);
        } else {
            $this->db->where_in('equipe', $equipes);
    
            $query = $this->db->get($this->table);
        }
        //  echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
}
