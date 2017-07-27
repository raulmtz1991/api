<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Lista_alergias_model extends CI_Model{
// Read Query
	public function read($id=null){
		if($id===NULL){
			$replace = "" ;

		}
		else{
			$this->db->where('IdLista_Alergias', $id);
		}
		
        return $this->db->get($this->table)->result_array();
	}
	// Insert/Create Query
	public function insert($data){
		$this->db->insert('lista_alergias', $data);
		return TRUE;
	}
	// Delete Query
	public function delete($id){
		$query = $this->db->query("delete from lista_alergias where IdLista_Alergias=$id");
		return TRUE;
	}
	// Update Query
	public function update($data){
		$id= $data['id'];
		$this->db->where('IdLista_Alergias',$id);
		$this->db->update('lista_alergias',$data);
	}
}

 ?>