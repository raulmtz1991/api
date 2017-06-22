<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Ecografia extends REST_Controller{
	function __construct()
	{
        // Construct the parent class
		parent::__construct();

		$this->load->model('Ecografia_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['doc_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['doc_post']['limit'] = 500;

    }

    function doc_get() 
    {

        if($this->get('historia'))//function get($historia)
        {

        	$ecografia = $this->Ecografia_model->get( $this->get('historia') );

        	if($ecografia)
        	{
		    	$this->response($ecografia, 200); // 200 being the HTTP response code
			}
        }else if($this->get('id') && $this->get('extension') && $this->get('id')){ //comprobar($nombre,$extension,$id)

        	$ecografia = $this->Ecografia_model->comprobar($this->get('nombre'),$this->get('extension'),$this->get('id'));
        	if($ecografia)
        	{
		    	$this->response($ecografia, 200); // 200 being the HTTP response code
			}

		}
		else if($this->get('ecografiaid') ){ //comprobar($nombre,$extension,$id)

        	$rpta= $this->Ecografia_model->delete($this->get('ecografiaid'));

        	if($rpta){  

        		$message = [
            				'id' => $this->get('ecografiaid'),
            				'message' => 'borrado'
        		];
        		$this->response($message, 200); // NO_CONTENT (204) being the HTTP response code
		    	//$this->response($ecografia, 200); // 200 being the HTTP response code
			}else{
				$this->response(null, 200); // 200 being the HTTP response code
			}

		}

	} 
	function doc_post()
    {       
    	if($this->post('nombre') && $this->post('$tipo') && $this->post('historiaclinicaid')){ //comprobar($nombre,$extension,$id)

        	
        	$ecografia = array('nombre'=>$this->post('nombre'),'fecha'=>date('Y-m-d'),'tipo'=>$this->post('$tipo'),'historiaclinicaid'=>$this->post('historiaclinicaid'));
        	$subir=$this->Ecografia_model->subir($ecografia);
        	
        	if($subir){  

        		$message = [
            				'nombre' => $this->post('nombre'),
            				'fecha' => $this->post('fecha'),
            				'tipo' => $this->post('tipo'),
            				'historiaclinicaid' => $this->post('historiaclinicaid'),
            				'message'=> 'insertado'

        		];
        		$this->response($message, 200); // NO_CONTENT (204) being the HTTP response code
		    	//$this->response($ecografia, 200); // 200 being the HTTP response code
			}else{
				$message = [
            				'message'=> 'no insertado'

        		];
				$this->response($message, 200); // 200 being the HTTP response code
			}

		}

    }
}

?>
