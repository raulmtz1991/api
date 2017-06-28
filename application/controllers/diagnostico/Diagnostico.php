<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');    
require APPPATH . '/libraries/REST_Controller.php';
class Diagnostico extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Diagnostico_model');
		$this->methods['doc_get']['limit'] = 500;
		$this->methods['doc_post']['limit'] = 500;
		}
		
		
		
		
	 function doc_get()
	 {
		 if($this->get('diagnostico'))
		 {
		 $diagnostico = $this->Diagnostico_model->get($this->get('diagnostico'));
		 
		 if($diagnostico){
			 $this->response($diagnostico,200);
		 }
		 }else if($this->get('id')&& $this->get('extension')&&$this->get('id')){
				 
				 $diagnostico = $this->Diagnostico_model->comprobar($this->get('nombre'),$this->get('extension'),$this->get('id'));
        	if($diagnostico)
        	{
		    	$this->response($diagnostico, 200);
			}
			 } 
			 else if($this->get('diagnosticoid')){
				 $rpta = $this->Diagnostico_model->delete($this->get('diagnosticoid'));
				 
				 if($rpta){

				 $message = [
            				'id' => $this->get('diagnosticoid'),
            				'message' => 'borrado'
        		];
					 $this->response($message,200);
						 
					 
				 } else{
					 $this->response(null,200);
					 
				 }
			 
		 
	 }
	
	
}
function doc_post(){
	if($this->post('tiemenferm') && $this->post('relato') && $this->post('historiaclinicaid')){
		$diagnostico = array('diagnosticoid'=>$this->post('diagnosticoid'),'fecha'=>date('Y-m-d'),'tiemenferm'=>$this->post('tiemenferm'),'sp'=>$this->post('sp'));
		//=>$this->post('nombre'),'fecha'=>date('Y-m-d'),'tipo'=>$this->post('$tipo'),'historiaclinicaid'=>$this->post('historiaclinicaid'));
		
		
		$subir=$this->Diagnostico_model->subir($diagnostico);
		
		if($subir){
			$message = [
			      'diagnosticoid' => $this->post('diagnosticoid');
				  'fecha'=> $this->post('fecha');
				  'tiemenferm'=>$this->post('tiemenferm');
				  ''
			];
		}
	}
		
}



}

?>