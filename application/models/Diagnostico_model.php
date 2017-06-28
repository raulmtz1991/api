<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Diagnostico_model extends CI_model{
   function __construct() {
            parent::__construct();
            $this->load->database();
        }
		public function subir($diagnostico){
			$this->db->insert->('histo_diagnostico',$diagnostico);
		}
		public function update ($diagnostico,$diagnosticoid){
			$this->db->Where->('diagnosticoid',$diagnostico);
		}
       public function get($historia){
		   $this->db->select('diagnosticoid,fecha,histo_diagnostico.tiemenferm,histo_diagnostico.sp,histo_diagnostico.relato,histo_diagnostico.fc,histo_diagnostico.');
		   $this->db->from('histo_diagnostico');
		   $this->db->join()
		   
		   
		   
	   }
	   function delete ($diagnosticoid){
		   $this->db->Where('diagnosticoid',$diagnosticoid);
		   if($this->db->delete ('histo_diagnostico')){
			   return true;
			   
		   }
		   else {
			   return false 
		   }
		   
	   }
	   public function comprobar(){
		   
		   
	   }


}



?>