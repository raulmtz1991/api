<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');    
require APPPATH . '/libraries/REST_Controller.php';
class Rayosx extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->model('Rayosx_model');
        $this->methods['doc_get']['limit'] = 500; 
        $this->methods['doc_post']['limit'] = 500;

    }
	 function doc_get() 
    {

        if($this->get('historia'))
        {

        	$rayosx = $this->Rayosx_model->get( $this->get('historia') );

        	if($rayosx)
        	{
		    	$this->response($rayosx, 200);
			}
        }else if($this->get('id') && $this->get('extension') && $this->get('id')){ 

        	$rayosx = $this->Rayosx_model->comprobar($this->get('nombre'),$this->get('extension'),$this->get('id'));
        	if($rayosx)
        	{
		    	$this->response($rayosx, 200);
			}

		}
		else if($this->get('rayosxid') ){

        	$rpta= $this->Rayosx_model->delete($this->get('rayosxid'));

        	if($rpta){  

        		$message = [
            				'id' => $this->get('rayosxid'),
            				'message' => 'borrado'
        		];
        		$this->response($message, 200);
		    	
			}else{
				$this->response(null, 200);
			}

		}

	} 
	function doc_post()
    {       
    	if($this->post('nombre') && $this->post('$tipo') && $this->post('historiaclinicaid')){ 

        	
        	$rayosx = array('nombre'=>$this->post('nombre'),'fecha'=>date('Y-m-d'),'tipo'=>$this->post('$tipo'),'historiaclinicaid'=>$this->post('historiaclinicaid'));
        	$subir=$this->Rayosx_model->subir($rayosx);
        	
        	if($subir){  

        		$message = [
            				'nombre' => $this->post('nombre'),
            				'fecha' => $this->post('fecha'),
            				'tipo' => $this->post('tipo'),
            				'historiaclinicaid' => $this->post('historiaclinicaid'),
            				'message'=> 'insertado'

        		];
        		$this->response($message, 200); 
			}else{
				$message = [
            				'message'=> 'no insertado'

        		];
				$this->response($message, 200); 
			}

		}

    }
	
}

?>