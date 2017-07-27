<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Lista_alergias extends REST_Controller{
	// Load model in constructor
	public function __construct() {
		parent::__construct();
		$this->load->model('Lista_alergias_model');
	}
	// Server's Get Method
	public function data_get($id_param = NULL){
		$id = $this->input->get('id');
		if($id===NULL){
			$id = $id_param;
		}
		if ($id === NULL)
		{
			$data = $this->Lista_alergias_model->read($id);
			if ($data)
			{
				$this->response($data, REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response([
				'status' => FALSE,
				'error' => 'No se encontro la alergia'
				], REST_Controller::HTTP_NOT_FOUND);
			}
		}
		$data = $this->Lista_alergias_model->read($id);
		if ($data)
		{
			$this->set_response($data, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response([
			'status' => FALSE,
			'error' => 'Record could not be found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
	// Server's Post Method
	public function data_post(){
		$data = array('	IdPaciente' => $this->input->post('IdPaciente'),
		'IdAlergias' => $this->input->post('IdAlergias'),
		'Fecha_inicio' => $this->input->post('Fecha_inicio'),
		'Recomendacion' => $this->input->post('Recomendacion'),
		);
		$this->Lista_alergias_model->insert($data);
		$message = [
					'Id Paciente' => $data['IdPaciente'],
					'Id Alergias' => $data['IdAlergias'],
					'Fecha inicio' => $data['Fecha_inicio'],
					'Recomendacion' => $data['Recomendacion'],
					'message' => 'se añadieron con exito'
					];
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	// Server's Put Method
	public function data_put(){
		$data = $this->input->input_stream();
		$this->Lista_alergias_model->update($data);
		$message = [
					'Id Lista Alergias' => $data['IdLista_Alergias'],
					'Id Paciente' => $data['IdPaciente'],
					'Id Alergias' => $data['IdAlergias'],
					'Fecha inicio' => $data['Fecha_inicio'],
					'Recomendacion' => $data['Recomendacion'],
					'message' => 'Added a resource'
					];
		$this->set_response($message, REST_Controller::HTTP_CREATED);
	}
	// Server's Delete Method
	public function data_delete(){
		$id = $this->uri->segment(3);
		if($id===NULL){
			$this->set_response([
								'status' => FALSE,
								'error' => 'el id no se encuentra'
								], REST_Controller::HTTP_NOT_FOUND);
		}
		$data = $this->Lista_alergias_model->delete($id);
		if ($data)
		{
			$this->set_response($data, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->set_response([
								'status' => FALSE,
								'error' => 'Record could not be found'
								], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}

?>
