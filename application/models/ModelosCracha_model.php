<?php
class ModelosCracha_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'modelos';
    }

    public function modelos_por_equipe($equipe)
    {
        if (is_null($equipe))
            return false;

        $this->db->where('equipe', $equipe);
        $query = $this->db->get($this->table);

        // echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }
    public function modelos_por_cor($cor)
    {
        if (is_null($cor))
            return false;

        $this->db->where('circulo_modelo', $cor);
        $query = $this->db->get($this->table);


        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }
}
