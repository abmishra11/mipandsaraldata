<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drc extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->login_check();

        // Load pagination library 
        $this->load->library('ajax_pagination'); 
         
        // Per page limit 
        $this->perPage = 15;
    }

	public function login_check(){
		if(!isset($_SESSION['is_'.strtolower($this->router->fetch_class()).'_log_in']) || $_SESSION['is_'.strtolower($this->router->fetch_class()).'_log_in'] === false){
			redirect(base_url().'home/drc','refresh');
		}
	}

	public function logout(){
		$this->session = session_destroy();
		redirect(base_url().'home/index');
	}
	
	public function changepassword(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|min_length[6]|max_length[20]|callback_check_old_password');
		$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('confirmnewpassword', 'Confirm New Password', 'trim|required|min_length[6]|max_length[20]|matches[newpassword]');
		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 
			$updateArray = array(
				'password' 			=> md5($this->input->post('newpassword')),
			);
			$update = $this->login_model->update_database_table('csirlabs', $updateArray, array('username'=>$_SESSION['username']));
			if($update){
				$data['message'] = "<h3 class='text-center'>Password successfully changed.</h3><br>";
				$data['category'] = "Success";
			}else{
				$data['message'] = "<p>Something went wrong. Please try again later.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

    public function check_old_password($str){
		$old_data = $this->login_model->get_table_data('csirlabs', $where=array('username'=>$_SESSION['username'],'password'=>md5($this->input->post('oldpassword')),'status'=>'1'), $group_by='', '','', '1');

        if(empty($old_data)){
			$this->form_validation->set_message('check_old_password', 'Old password is not correct.');
            return false;
        }else{
			return true;
        }
    }

	public function gettabledata(){
		$data = $this->login_model->get_table_data_by_different_fields($_POST['table'], array('id'=>$_POST['id']));
		echo json_encode($data[0]);
	}

	public function updatetable(){
		$this->db->where(array('id'=>$_POST['id']));
		$this->db->update($_POST['table'], array('status'=>$_POST['status']));
		if($this->db->affected_rows() == 0){
			$data['message'] = '<p>Something went wrong. Please try again later.</p>';
			$data['category'] = 'error';
		}else{
			$data['category'] = 'success';
			$data['message'] = "<p>Status Changed.</p>";
		}
		echo json_encode($data);
	}

	public function dashboard(){
		$employeetype = $this->login_model->get_table_data('employeetype', $where=array('status'=>1), $group_by='', $order_by_field='', $order_by_sort='', $limit='');
		foreach($employeetype as $key=>$value){
			$data["groups"][$value['id']] = $this->login_model->get_table_data('forms', $where=array('employeetype'=>$value['id'], 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');
		}
		$data['employeetype'] = $employeetype;
		$data['main_content'] = strtolower($this->router->fetch_class()).'/dashboard';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

}
