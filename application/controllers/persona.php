<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona extends CI_Controller {

	function Persona() {
		parent::__construct();
		$this->load->model('personaModel');
	}

	public function index()
	{
		$data['personas'] = $this->personaModel->listAll();
		$this->load->view('persona/index', $data);
	}

	public function buildForm(){
		
		$req_id = $this->input->post('id');
		$id = isset($req_id) ? $this->input->post('id') : null;
		$data['action'] = "saveAction";

		if( $id == null){
			$data['titulo'] = "Nueva persona";
		}else{
			$data['titulo'] = "Actualizar persona";

			$res = $this->personaModel->get($id);

			if($res){
				$data['id'] = $res->id;
				$data['nombres'] = $res->nombres;
				$data['apellidos'] = $res->apellidos;
				$data['fecha_nacimiento'] = $res->fecha_nacimiento;
				$data['genero'] = $res->genero;
			}else{
				$data['error'] = "Código de persona incorrecto";
			}
		}

		$this->load->view('persona/form', $data);
	}

	public function buildGrid(){
		$data['personas'] = $this->personaModel->listAll();
		$this->load->view('persona/list', $data);
	}

	public function saveAction(){
		
		header("Content-type: text/plain");

		$data = (Object)json_decode($this->input->post('data'), TRUE);
		$persona = (Object)$data->persona;
		
		$result = $this->personaModel->save($persona);

		if($result == TRUE){
			$resp['msj'] = 'Datos almacenados';
			$resp['status'] = 'ok';
		}else{
			$resp['msj'] = $result;
			$resp['status'] = 'no';
		}
		echo json_encode($resp);
	}

	public function deleteAction(){
		header("Content-type: text/plain");

		$req_id = $this->input->post('id');
		$id = isset($req_id) ? $this->input->post('id') : null;

		if($id != null){
			$result = $this->personaModel->delete($id);

			if($result == TRUE){
				$resp['msj'] = 'Persona eliminada';
				$resp['status'] = 'ok';
			}else{
				$resp['msj'] = $result;
				$resp['status'] = 'no';
			}

		}else{
			$resp['msj'] = "Código de persona incorrecto";
			$resp['status'] = 'no';
		}

		echo json_encode($resp);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */