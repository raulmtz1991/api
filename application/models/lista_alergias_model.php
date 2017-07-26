<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 

class Lista_alergias_model extends CI_Model
 
{
 
   function getAll(){

    $this->db->select('*');
    $this->db->from('lista_alergias');
    $query = $this->db->get();
    
    return $query->result_array();

  }
 
    function insert($data){
 
       
 
      $this->IdPaciente    = $data['IdPaciente']; // please read the below note
 
      $this->IdAlergias    = $data['IdAlergias'];
  
      $this->Fecha_inicio  = $data['Fecha_inicio'];
 
      $this->Recomendacion = $data['Recomendacion'];
 
       if($this->db->insert('lista_alergias',$this))
 
       {    
 
           return 'Data is inserted successfully';
 
       }
 
         else
 
       {
 
           return "Error has occured";
 
       }
 
   }
 
 
 
    function update($id,$data){
 
   
 
      $this->IdPaciente    = $data['IdPaciente']; // please read the below note
 
      $this->IdAlergias    = $data['IdAlergias'];
  
      $this->Fecha_inicio  = $data['Fecha_inicio'];
 
      $this->Recomendacion = $data['Recomendacion'];
 
       $result = $this->db->update('lista_alergias',$this,array('IdLista_Alergias' => $id));
 
       if($result)
 
       {
 
           return "Data is updated successfully";
 
       }
 
       else
 
       {
 
           return "Error has occurred";
 
       }
 
   }
 
 
 
  
    function delete($id){
      $this->db->where('IdLista_Alergias',$id);
      if($this->db->delete('lista_alergias')){
        return TRUE;
      }
      else{
        return FALSE;
      }
    }
 
 
}
?>