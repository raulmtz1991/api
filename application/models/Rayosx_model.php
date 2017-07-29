<?php 
   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   class Rayosx_model extends CI_model{
	   function __construct() {
            parent::__construct();
            $this->load->database();
        }
       public function subir($rayosx){
		   $this->db->insert('histo_rayosx',$rayosx);
	   }
	   public function update($rayosx,$rayosxid){
		   $this->db->where('rayosxid',$rayosxid);
           $this->db->update('histo_rayosx',$rayosx);
	   }
	   public function get($historia){
            $this->db->select('rayosxid,histo_rayosx.nombre,fecha,tipo,histo_rayosx.historiaclinicaid,tb_historiaclinica.pacienteid');
            $this->db->from('histo_rayosx');
            $this->db->join('tb_historiaclinica','tb_historiaclinica.historiaclinicaid=histo_rayosx.historiaclinicaid');
            $this->db->join('tb_paciente','tb_paciente.pacienteid=tb_historiaclinica.pacienteid');
            $this->db->where('histo_rayosx.historiaclinicaid',$historia);
            $query = $this->db->get();
            return $query->result();

        }
		public function delete($rayosxid){
            $this->db->where('rayosxid',$rayosxid);
            if($this->db->delete('histo_rayosx')){
                return true;
            }
            else{
                return false;
            }
        }
		 public function comprobar($nombre,$extension,$id){
            $this->db->select('rayosxid,nombre,tipo');
            $this->db->where('nombre',$nombre);
            $this->db->where('tipo',$extension);
            $this->db->where('historiaclinicaid',$id);
            $query = $this->db->get('histo_rayosx');
            $q2=$query->row();
                $query->free_result();
                return $q2;
            
        }
   }
?>