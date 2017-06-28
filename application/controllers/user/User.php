<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller{
	function __construct()
	{
        // Construct the parent class
		parent::__construct();

		$this->load->model('user_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['doc_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['doc_post']['limit'] = 500;

    }

    function doc_get() 
    {

        if($this->get('Usuario'))//function get($historia)
        {

        	$user = $this->user_model->get( $this->get('Usuario') );

        	if($user)
        	{
		    	$this->response($user, 200); // 200 being the HTTP response code
			}
        }else if($this->get('id') && $this->get('extension') && $this->get('id')){ //comprobar($nombre,$extension,$id)

        	$user = $this->user_model->comprobar($this->get('nombre'),$this->get('extension'),$this->get('id'));
        	if($ecografia)
        	{
		    	$this->response($user, 200); // 200 being the HTTP response code
			}

		}
		else if($this->get('username') ){ //comprobar($nombre,$extension,$id)

        	$rpta= $this->user_model->delete($this->get('username'));

        	if($rpta){  

        		$message = [
            				'id' => $this->get('username'),
            				'message' => 'borrado'
        		];
        		$this->response($message, 200); // NO_CONTENT (204) being the HTTP response code
		    	//$this->response($user, 200); // 200 being the HTTP response code
			}else{
				$this->response(null, 200); // 200 being the HTTP response code
			}

		}

	} 
	function doc_post()
    {       
    	if($this->post('nombre') && $this->post('$tipo') && $this->post('historiaclinicaid')){ //comprobar($nombre,$extension,$id)

        	
        	$user = array(
			'username'=>$this->post('username'),
			'email'=>$this->('email'),
			'password'=>$this->post('password'),
			'avatar'=>$this->post('avatar'),
			'created_at'=>$this->post('created_at'),
			'update_at'=>$this->post('update_at'),
			'is_admin'=>$this->post('is_admin'),
			'is_confirmed'=>$this->post('is_confirmed'),
			'is_deleted'=>$this->post('is_deleted'));
			
        	$subir=$this->user_model->subir($user);
        	
        	if($subir){  

        		$message = [
            				'username' => $this->post('usernam'),
            				'email' => $this->post('email'),
            				'password' => $this->post('password'),
            				'avatar' => $this->post('avatar'),
							'created_at'=>$this->post('created_at),
							'update_at'=>$this->post('update_at'),
							'is_admin'=>$this->post('is_admin'),
							'is_confirmed'=>$this->post('is_confirmed'),
							'is_deleted'=>$this->post('is_deleted'),
            				'message'=> 'insertado'

        		];
        		$this->response($message, 200); // NO_CONTENT (204) being the HTTP response code
		    	//$this->response($user, 200); // 200 being the HTTP response code
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