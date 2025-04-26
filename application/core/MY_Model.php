<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

  // Variável que define o nome da tabela
  var $table = "";

  /**
  * Método Construtor
  */
  function __construct() {
    parent::__construct();
  }

  /**
  * Insere um registro na tabela
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  function Inserir($data) {
    if(!isset($data))
      return false;

    return $this->db->insert($this->table, $data);
  }

  /**
  * Insere um registro na tabela e retorna id do inserido
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  function InserirRetornaId($data) {
    if(!isset($data))
      return false;

    $this->db->insert($this->table, $data);

    if ($this->db->affected_rows() > 0) {
      return $this->db->insert_id();
    } else{
      return false;
    }
  }
  /**
  * Recupera um registro a partir de um ID
  *
  * @param integer $id ID do registro a ser recuperado
  *
  * @return array
  */
  function GetById($id) {
    if(is_null($id))
      return false;

    $this->db->where('id', $id);
    $query = $this->db->get($this->table);

    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return null;
    }
  }

  /**
  * Lista todos os registros da tabela
  *
  * @param string $sort Campo para ordenação dos registros
  *
  * @param string $order Tipo de ordenação: ASC ou DESC
  *
  * @return array
  */
  function GetAll($sort = 'id', $order = 'asc') {
    $this->db->order_by($sort, $order);
    $query = $this->db->get($this->table);

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }

  }

  /**
  * Atualiza um registro na tabela
  *
  * @param integer $int ID do registro a ser atualizado
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  function Atualizar($id, $data) {
    if(is_null($id) || !isset($data))
      return false;

    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  /**
  * Remove um registro na tabela
  *
  * @param integer $int ID do registro a ser removido
  *
  *
  * @return boolean
  */
  function Excluir($id) {
    if(is_null($id))
      return false;

    $this->db->where('id', $id);
    return $this->db->delete($this->table);

  }


  //Usar com as datatable
  private function _get_datatables_query()
  {
      $this->db->from($this->table);

      $i = 0;

      foreach ($this->column_search as $item) { //Loop column
          if ($_POST['search']['value']) { //if datatable send Post for search

              if ($i == 0) { //first loop
                  $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                  $this->db->like($item, $_POST['search']['value']);
              } else {
                  $this->db->or_like($item, $_POST['search']['value']);
              }

              if (count($this->column_search) - 1 == $i) //last loop
                  $this->db->group_end(); //close bracket

          }

          $i++;
      }


      if (isset($_POST['order'])) // here order processing
      {
          $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if (isset($this->order)) {
          $order = $this->order;
          $this->db->order_by(key($order), $order[key($order)]);
      }
  }

  public function get_datatables()
  {
      $this->_get_datatables_query();
      if($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      // print $this->db->last_query(); die;
      return $query->result();
  }

  public function count_filtered()
  {
      $this->_get_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
  }


  public function count_all()
  {
      $this->db->from($this->table);
      return $this->db->count_all_results();
  }

}

/* End of file */
