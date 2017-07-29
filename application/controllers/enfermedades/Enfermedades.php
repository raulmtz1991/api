<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class Enfermedades extends REST_Controller {
	function__construct(){

		parent::__construct();
		$this->load('Enfermedades_model');


	}


 function doc_get(){

     if ($this->get('id')){
        
        $enfermedades = $this->Enfermedades_model->get($this->get('id'));

        if($enfermedades){

           $this->response($enfermedades,200);
        } else{

        	if($this->get('letra')){

        		$enfermedades = $this->Enfermedades_model->getLike($this->get('letra'));

        	if($enfermedades){

        		$this->response($enfermedades,200);
        	}

        	}else {
        		$enfermedades = $this->Enfermedades_model->getAll();
        		if($enfermedades){
        			$this->response($enfermedades,200);
        		} else $this->response(NULL,200);

        	}

        }

     }

  }
}

?>