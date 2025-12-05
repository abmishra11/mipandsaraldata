<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
    }
	
	public function index(){
		$data['main_content'] = 'home';
		$this->load->view('include/template', $data);
	}

	public function csirlabs(){
		$data['page_title'] = 'CSIR Labs Login';	
		$data['login_form_title'] = 'CSIR Lab Login Panel';
		$data['admin_prefix'] = 'csirlabs';
		$data['main_content'] = 'csirlabs';
		$this->load->view('include/template', $data);
	}

	public function validatecsirlabs(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() === false){
			$data['category'] = 'validation_error';
			$data['message'] = validation_errors();
		}else{
			$this->load->model('csirlabs_model');
			$query = $this->csirlabs_model->validateuser("csirlabs","username","password","username","password");
			if($query){

				$lab_data = $this->login_model->get_table_data('csirlabs', $where=array('username'=>$this->input->post('username'),'password'=>md5($this->input->post('password')),'status'=>'1'), $group_by='', '','', 1);

				$sessiondata = array(
					'csirlabs_id' 			=> $lab_data[0]['id'],
					'username' 				=> $lab_data[0]['username'],
					'csirlabs_name' 		=> $lab_data[0]['lab_name'],
					'is_csirlabs_log_in' 	=> true
				);
				
				$this->session->set_userdata($sessiondata);
				$data['category'] = 'success';
				$data['message'] = "<p>Valid credentials.</p>";
			}else{
				session_destroy();
				$data['message'] = '<p>Invalid user name or password. Please provide valid credentials</p>';
				$data['category'] = 'error';	
			}
		}
		echo json_encode($data);
	}

	public function admin(){
		$data['page_title'] = 'Admin Login';	
		$data['login_form_title'] = 'Admin Panel';
		$data['admin_prefix'] = 'admin';
		$data['main_content'] = 'admin';
		$this->load->view('include/template', $data);
	}

	public function validateadmin(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() === false){
			$data['category'] = 'validation_error';
			$data['message'] = validation_errors();
		}else{
			$query = $this->login_model->validateuser("users","username","password","username","password");
			if($query){
				$value = $query->result_array();
				$sessiondata = array(
					'username' => $this->input->post('username'),
					'is_admin_log_in' => true,
					'user_type' => $value[0]['user_type'],
				);
				$this->session->set_userdata($sessiondata);
				$data['category'] = 'success';
				$data['message'] = "<p>Valid credentials.</p>";
			}else{
				$sessiondata = array(
					'is_admin_log_in' => false,
				);
				$this->session->set_userdata($sessiondata);
				$data['message'] = '<p>Invalid user name or password. Please provide valid credentials</p>';
				$data['category'] = 'error';	
			}
		}
		echo json_encode($data);
	}
}
