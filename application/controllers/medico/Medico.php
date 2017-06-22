<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

 class Medico extends REST_Controller{
	 function __construct()
    {
        // Construct the parent class
        parent::__construct();
		$this->load->model('medico_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['medico_get']['limit'] = 500; // 500 requests per hour per user/key
	
         }

 function doc_get()
    {

   
        if($this->get('id'))//function get($medicoid)
        {
            
 		$medicos = $this->medico_model->get( $this->get('id') );
         
		if($medicos)
		{
		    $this->response($medicos, 200); // 200 being the HTTP response code
		}
        }else if($this->get('letra')){ //getLike($letra)

			$medicos = $this->medico_model->getLike($this->get('letra'));
			if($medicos)
		{
		    $this->response($medicos, 200); // 200 being the HTTP response code
		}

	}
	else
        {

           $medicos =$this->medico_model->getAll();
      
		if($medicos)
		{
		    $this->response($medicos, 200); // 200 being the HTTP response code
		} else $this->response(NULL, 400);
        }
    }        

  }

?>
