<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class Lista_alergias extends REST_Controller{
	 function __construct()
    {
        // Construct the parent class
        parent::__construct();
		$this->load->model('lista_alergias_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['lista_alergias_model_get']['limit'] = 500; // 500 requests per hour per user/key
	
         }
 function lista_alergias_get(){
           $result = $this->lista_alergias_model->getAll();
           $this->response($result); 
       }
 function lista_alergias_put(){
           $id = $this->uri->segment(4);

           $data = array('IdPaciente' => $this->input->get('IdPaciente'),
           				 'IdAlergias' => $this->input->get('IdAlergias'),
           				 'Fecha_inicio' => $this->input->get('Fecha_inicio'),
						 'Recomendacion' => $this->input->get('Recomendacion')
            );

            $result = $this->lista_alergias_model->update($id,$data);
               $this->response($result); 
       }
 function lista_alergias_post(){
           $data = array('IdPaciente' => $this->input->post('IdPaciente'),
           				 'IdAlergias' => $this->input->post('IdAlergias'),
           				 'Fecha_inicio' => $this->input->post('Fecha_inicio'),
						 'Recomendacion' => $this->input->post('Recomendacion')
           );
           $result = $this->lista_alergias_model->insert($data);
           $this->response($result); 
       }

 function lista_alergias_delete(){
           $id = $this->uri->segment(4);
           $result = $this->lista_alergias_model->delete($id);
           $this->response($result); 
       }
    

}

?>
