<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Process_model','model');
	}

	public function index(){

		if (!$this->input->post()) {
			$response = array(
			  "data" => "You need post some parameter",
			  "status" => 404,
			);

	    	echo json_encode($response);
	    	exit();
		}

		if (!$this->input->post('ref')) {
			$response = array(
			  "data" => "You need post ref parameter",
			  "status" => 404,
			);

	    	echo json_encode($response);
	    	exit();
		}

		if ($this->input->post('ref')) {
			$ref = $this->input->post('ref');
			$data = $this->model->get_data($ref);

			//if owner not found
			if (!$data) {
				$response = array(
				  "data" => 'owner not found, try another refferal',
				  "status" => 403,
				);

		    	echo json_encode($response);
		    	exit();
			}

			$response = array(
			  "data" => $data,
			  "status" => 200,
			);

	    	echo json_encode($response);
	    	exit();
		}


	}
}
