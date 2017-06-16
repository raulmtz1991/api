<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

 class Medico extends REST_Controller{
	
 function medico_get()
    {
        if($this->get('id'))//function get($medicoid)
        {
            $this->response(NULL, 400);
 		$medicos = $medico_model->get( $this->get('id') );
         
		if($medicos)
		{
		    $this->response($medicos, 200); // 200 being the HTTP response code
		}
        }else if(($this->get('letra'){ //getLike($letra)

			$medicos = $medico_model->getLike($letra);
			if($medicos)
		{
		    $this->response($medicos, 200); // 200 being the HTTP response code
		}

	}
	else
        {
           $medicos = $medico_model->getAll();
         
		if($medicos)
		{
		    $this->response($medicos, 200); // 200 being the HTTP response code
		}
        }
    }        

  }

?>