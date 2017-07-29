<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Ecografia_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        public function subir($ecografia){
            $this->db->insert('histo_ecografia',$ecografia);
        }
        public function update($ecografia,$ecografiaid){
            $this->db->where('ecografiaid',$ecografiaid);
            $this->db->update('histo_ecografia',$ecografia);
        }
        /*public function get($historia){
            $this->db->where('historiaclinicaid',$historia);
            $query=$this->db->get('histo_ecografia');
            return $query->result();
        }*/
        public function get($historia){
            $this->db->select('ecografiaid,histo_ecografia.nombre,fecha,tipo,histo_ecografia.historiaclinicaid,tb_historiaclinica.pacienteid');
            $this->db->from('histo_ecografia');
            $this->db->join('tb_historiaclinica','tb_historiaclinica.historiaclinicaid=histo_ecografia.historiaclinicaid');
            $this->db->join('tb_paciente','tb_paciente.pacienteid=tb_historiaclinica.pacienteid');
            $this->db->where('histo_ecografia.historiaclinicaid',$historia);
            $query = $this->db->get();
            return $query->result();

        }
        public function delete($ecografiaid){
            $this->db->where('ecografiaid',$ecografiaid);
            if($this->db->delete('histo_ecografia')){
                return true;
            }
            else{
                return false;
            }
        }
        public function comprobar($nombre,$extension,$id){
            $this->db->select('ecografiaid,nombre,tipo');
            $this->db->where('nombre',$nombre);
            $this->db->where('tipo',$extension);
            $this->db->where('historiaclinicaid',$id);
            $query = $this->db->get('histo_ecografia');
            $q2=$query->row();
                $query->free_result();
                return $q2;
            
        }
    }
?>