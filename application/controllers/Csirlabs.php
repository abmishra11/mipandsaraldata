<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csirlabs extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('csirlabs_model');

		$this->login_check();

        // Load pagination library 
        $this->load->library('ajax_pagination'); 
         
        // Per page limit 
        $this->perPage = 15;
    }

	public function login_check(){
		if(!isset($_SESSION['is_'.strtolower($this->router->fetch_class()).'_log_in']) || $_SESSION['is_'.strtolower($this->router->fetch_class()).'_log_in'] === false){
			redirect(base_url().'home/csirlabs','refresh');
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
			$update = $this->login_model->update_database_table('csirlabs', $updateArray, array('username'=>$_SESSION['csirlabs_username']));
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
		$old_data = $this->login_model->get_table_data('csirlabs', $where=array('username'=>$_SESSION['csirlabs_username'],'password'=>md5($this->input->post('oldpassword')),'status'=>'1'), $group_by='', '','', '1');

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

	public function getDates(){
		$data['start_date'] = date('Y-m-01', strtotime('last month'));
		$data['end_date'] = date('Y-m-t', strtotime('last month'));
		$data['firstDate'] = date('Y-m-01');
		return $data;
	}

	public function getMonthStartEndDateArray() {
		$month = STARTMONTH;
		$year = STARTYEAR;
		$startDateArray = [];
		
		// Get the current year and month
		$currentYear = date('Y');
		$currentMonth = date('m');
		
		// Create a DateTime object starting from the provided year and month
		$start = new DateTime("$year-$month-01");
		
		// Create a DateTime object for the current month
		$end = new DateTime("$currentYear-$currentMonth-01");
	
		// Loop through each month from the start date to the current date
		while ($start <= $end) {
			// Get the start date of the month
			$startOfMonth = $start->format('Y-m-01');
			
			// Get the end date of the month
			$endOfMonth = $start->format('Y-m-t');
			
			// Add the start and end date to the result array
			$startDateArray[] = [
				'start_date' => $startOfMonth,
				'end_date' => $endOfMonth
			];

			array_unshift($startDateArray, [
				'start_date' => $startOfMonth,
				'end_date' => $endOfMonth
			]);
			
			// Move to the next month
			$start->modify('+1 month');
		}

		return $startDateArray;
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

	/** Form Data Start **/
	
	public function updateformdata($id=""){

    	if(isset($id) && is_numeric($id)){
			
    		$formvalues = $this->login_model->get_table_data('forms', $where=array('id'=>$id, 'status'=>'1'), $group_by='', '','', 1);
    		$form = $formvalues[0];
    		if(empty($form)){
    			redirect('csirlabs/dashboard');
    		}else{

    			$sanctionedstrength = $this->login_model->get_table_data('sanctionedstrength', $where=array('form_id'=>$form['id'], 'csirlabs_id'=>$_SESSION['csirlabs_id'], 'status'=>'1'), $group_by='', '','', 1);
    			$data['sanctionedstrength'] = $sanctionedstrength;

					$employeetype = $form['employeetype'];
					$employeetype_value = $this->login_model->get_table_data('employeetype', $where=array('id'=>$employeetype, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

					$designations = json_decode($form['designations']);
					$designations_value = array();
					foreach ($designations as $key => $value) {
						$designation_value = $this->login_model->get_table_data('designations', $where=array('id'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
						$designations_value[] = $value."@@123@@".$designation_value[0]['designation'];
					}
					
					$paylevels = json_decode($form['paylevels']);
					$paylevels_value = array();
					foreach ($paylevels as $key => $value) {
						$paylevel_value = $this->login_model->get_table_data('paylevel', $where=array('id'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
						$paylevels_value[] = $value."@@123@@".$paylevel_value[0]['paylevel'];
					}

					$categories = json_decode($form['categories']);
					$categories_value = array();
					foreach($categories as $key=>$value){
						$category_value = $this->login_model->get_table_data('categories', $where=array('category_key'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
						$categories_value[$value] = $category_value[0]['name'];
					}

					$subcategories = json_decode($form['subcategories']);
					$subcategories_value = array();
					foreach($subcategories as $key=>$value){
						$subcategory_value = $this->login_model->get_table_data('subcategories', $where=array('category_key'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
						$subcategories_value[$value] = $subcategory_value[0]['name'];
					}

					$genders = json_decode($form['genders']);
					$genders_value = array();
					foreach ($genders as $key => $value) {
						$gender_value = $this->login_model->get_table_data('genders', $where=array('id'=>$value, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
						$genders_value[$value] = $gender_value[0]['name'];
					}

					$dates = $this->getDates();
					$start_date = $dates['start_date'];
					$end_date = $dates['end_date'];
					$firstDate = $dates['firstDate'];

					$updateData = array();
					foreach ($designations as $key => $value) {
						$retrievedUpdateData = $this->login_model->get_table_data('formdata', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'form_id' => $form['id'], 'employeetype' => $form['employeetype'], 'designation' => $value, 'paylevel' => $paylevels[$key], 'start_date' => $start_date, 'end_date' => $end_date, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='1');
						if(!empty($retrievedUpdateData)){
							$updateData[$value."-".$paylevels[$key]] = $retrievedUpdateData[0];
						}else{
							$updateData[$value."-".$paylevels[$key]] = array();
						}
					}
					
					$startEndDateArray = $this->getMonthStartEndDateArray();
					$previous_entries = array();
					foreach($startEndDateArray as $key => $dates) {
						$entries = $this->login_model->get_table_data('formdata', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'form_id' => $form['id'], 'employeetype' => $form['employeetype'], 'start_date' => $dates['start_date'], 'end_date' => $dates['end_date'], 'firstDate' => $firstDate, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');
						if(!empty($entries)){
							$previous_entries[$dates['start_date']." to ".$dates['end_date']." to ".$firstDate] = $entries;
						}
					}
					// $previous_entries = $this->login_model->get_table_data('formdata', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'form_id' => $form['id'], 'employeetype' => $form['employeetype'], 'start_date !=' => $start_date, 'end_date !=' => $end_date, 'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');
					
					$data['form'] = $form;
					$data['employeetype_value'] = $employeetype_value;
					$data['categories_value'] = $categories_value;
					$data['subcategories_value'] = $subcategories_value;
					$data['genders_value'] = $genders_value;
					$data['designations_value'] = $designations_value;
					$data['paylevels_value'] = $paylevels_value;
					$data['updatedata'] = $updateData;
					$data['previous_entries'] = $previous_entries;
					$data['start_date'] = $start_date;
					$data['end_date'] = $end_date;
					$data['firstDate'] = $firstDate;
					$data['main_content'] = strtolower($this->router->fetch_class()).'/updateformdata';
					$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    		}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
	}

	public function submitupdateformdata(){
		$formid = $this->input->post('formid');
		$employeetype = $this->input->post('employeetype');
		$designation = $this->input->post('designation');
		$paylevel = $this->input->post('paylevel');
		$maninposition = $this->input->post('maninposition-'.$formid.'-'.$employeetype.'-'.$designation.'-'.$paylevel);
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$firstDate = $this->input->post('firstDate');

		$formvalues = $this->login_model->get_table_data('forms', $where=array('id'=>$formid, 'status'=>'1'), $group_by='', '','', 1);
		$form = $formvalues[0];

		$formcategories = json_decode($form['categories']);
		$formsubcategories = json_decode($form['subcategories']);
		$formgenders = json_decode($form['genders']);
		
		$categories_data = $subcategories_data = $gender_data = array();
		foreach($formcategories as $fk=>$fv){
			foreach($formsubcategories as $sck=>$scv){
				foreach ($formgenders as $gk => $gv) {
					$category_key = "postinput-".$formid."-".$form['employeetype']."-".$designation."-".$paylevel."-".$fv."-".$scv."-".$gv;
					$categories_data[$fv][] = $this->input->post($category_key);
					$subcategories_data[$scv][] = $this->input->post($category_key);
					$gender_data[$gv][] = $this->input->post($category_key);
				}
			}

			foreach ($formgenders as $gk => $gv) {
				$category_key = "postinput-".$formid."-".$form['employeetype']."-".$designation."-".$paylevel."-".$fv."-other-".$gv;
				$categories_data[$fv][] = $this->input->post($category_key);
				$subcategories_data['other'][] = $this->input->post($category_key);
				$gender_data[$gv][] = $this->input->post($category_key);
			}
		}

		$category_sum_data = array();
		foreach($formcategories as $ck=>$cv){
			$category_sum_data[$cv] = array_sum($categories_data[$cv]);
		}
		//print_r($category_sum_data);
		$subcategory_sum_data = array();
		foreach($formsubcategories as $ck=>$cv){
			$subcategory_sum_data[$cv] = array_sum($subcategories_data[$cv]);
		}
		$subcategory_sum_data['other'] = array_sum($subcategories_data['other']);
		//print_r($subcategory_sum_data);
		$gender_sum_data = array();
		foreach($gender_data as $gk=>$gv){
			$gender_sum_data[$gk] = array_sum($gender_data[$gk]);
		}
		//p($gender_sum_data);
		$total = array_sum($gender_sum_data);

		if($maninposition == $total){

			$previous_form_data = $this->login_model->get_table_data('formdata', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'form_id'=>$formid, 'employeetype'=>$employeetype, 'designation'=>$designation, 'paylevel'=>$paylevel, 'start_date'=>$start_date, 'end_date'=>$end_date, 'status'=>'1'), $group_by='', '','', 1);
			
			if(empty($previous_form_data)){
		    	$inserdata = array(
															'csirlabs_id' 		=> $_SESSION['csirlabs_id'],
															'form_id'     		=> $formid,
															'employeetype' 		=> $employeetype,
															'designation'   	=> $designation,
															'paylevel'   		=> $paylevel,
															'maninposition'   	=> $maninposition,
															'category_data'		=> json_encode($category_sum_data),
															'subcategory_data' => json_encode($subcategory_sum_data),
															'gender_data'		=> json_encode($gender_sum_data),
															'total'				=> $total,
															'postdata'			=> json_encode($_POST),
															'start_date'		=> $start_date,
															'end_date'			=> $end_date,
															'firstDate'			=> $firstDate,
															'added_by' 			=> $_SESSION['username'],
															'updated_by' 		=> $_SESSION['username'],
															'status' 			=> '1'
														);
				$insert = $this->db->insert('formdata', $inserdata);

				if($insert){
					$data['message'] = "Data Successfully Updated.";
					$data['formid'] = $this->input->post('formid');
					$data['category'] = "Success";
				}else{
					$data['message'] = "Something went wrong. Please try again later";
					$data['category'] = "error";
				}
			}else{
				$whereArray = array(
															'csirlabs_id' 		=> $_SESSION['csirlabs_id'],
															'form_id'     		=> $formid,
															'employeetype' 		=> $employeetype,
															'designation'   	=> $designation,
															'paylevel'   		=> $paylevel,
															'start_date'		=> $start_date,
															'end_date'			=> $end_date,
															'firstDate'			=> $firstDate,
														);

				$updateArray = array(
															'csirlabs_id' 		=> $_SESSION['csirlabs_id'],
															'form_id'     		=> $formid,
															'employeetype' 		=> $employeetype,
															'designation'   	=> $designation,
															'paylevel'   		=> $paylevel,
															'maninposition'   	=> $maninposition,
															'category_data'		=> json_encode($category_sum_data),
															'subcategory_data' => json_encode($subcategory_sum_data),
															'gender_data'		=> json_encode($gender_sum_data),
															'total'				=> $total,
															'postdata'			=> json_encode($_POST),
															'start_date'		=> $start_date,
															'end_date'			=> $end_date,
															'firstDate'			=> $firstDate,
															'added_by' 			=> $_SESSION['username'],
															'updated_by' 		=> $_SESSION['username'],
															'status' 			=> '1'
														);

				$updatequery = $this->login_model->update_database_table('formdata', $updateArray, $whereArray);

				if($updatequery){
					$data['message'] = "Data Updated again Successfully";
					$data['formid'] = $this->input->post('formid');
					$data['category'] = "Success";
				}else{
					$data['message'] = "Something went wrong. Please try again later";
					$data['category'] = "error";	
				}
			}
		}else{
			$data['message'] = "Man in position data should be equal to sum of all categories and geders data.";
			$data['category'] = "error";
		}

		echo json_encode($data); 
	}

	/** Form Data End **/

	/** Sanctioned Strength Start **/

	public function sanctionedstrengthdata(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sanctionedstrength', 'Sanctioned Strength', 'trim|required|is_numeric');
		$this->form_validation->set_rules('dgquota', 'DG quota posts', 'trim|required|is_numeric');
		$this->form_validation->set_rules('postsreceived', 'Posts received from sister labs', 'trim|required|is_numeric');
		$this->form_validation->set_rules('poststransferred', 'Posts transferred to sister labs', 'trim|required|is_numeric');
		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 
			$insertdata = array(
				'csirlabs_id'			=> trim($this->input->post('csirlabs_id')),
				'form_id' 				=> trim($this->input->post('form_id')),
				'sanctionedstrength' 	=> trim($this->input->post('sanctionedstrength')),
				'dgquota' 	=> trim($this->input->post('dgquota')),
				'postsreceived' 	=> trim($this->input->post('postsreceived')),
				'poststransferred' 	=> trim($this->input->post('poststransferred')),
				'added_by' 				=> $_SESSION['username'],
				'updated_by' 			=> $_SESSION['username'],
				'status' 				=> '1'
			);
			
			$insert = $this->db->insert('sanctionedstrength', $insertdata);

			if($insert){
				$data['message'] = "Sanctioned Strength Data Successfully Updated.";
				$data['formid'] = $this->input->post('form_id');
				$data['category'] = "Success";
			}else{
				$data['message'] = "Something went wrong. Please try again later";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

	/** Sanctioned Strength End **/

	public function getcombinationkey($categories = array(), $genders = array()){

		$kkey = array();

		foreach($categories as $key=>$value){
			$subcategories = $this->login_model->get_table_data('subcategories', $where=array('category_id'=>$value['id'],'status'=>'1'), $group_by='', '','', '');
			if(empty($subcategories)){
				foreach($genders as $gkey=>$gvalue){
					$kkey[$value['category_key']][] = $gvalue['gender_key'];
				}
			}else{
				foreach($subcategories as $skey=>$svalue){
					foreach($genders as $gkey=>$gvalue){
						$kkey[$svalue['category_key']][] = $gvalue['gender_key'];
					}
				}
			}
		}

		return $kkey;
	}

	/* Group IV start */

	public function groupfour(){
		$data['main_content'] = strtolower($this->router->fetch_class()).'/groupfour';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function addgroupfour(){
		$data['categories'] = $this->login_model->get_table_data('categories', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['genders'] = $this->login_model->get_table_data('genders', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['combinationkey'] = $this->getcombinationkey($data['categories'], $data['genders']);
		$data['start_date'] = date('Y-m-01', strtotime('last month'));
		$data['end_date'] = date('Y-m-t', strtotime('last month'));
		$data['entrydata'] = $this->login_model->get_table_data('groupfour', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'start_date'=>$data['start_date'], 'end_date'=>$data['end_date']), $group_by='', '','', '1');
		
		$data['method_prefix'] = 'addgroupfour';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/addgroupfour';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function groupfourjuniorscientist(){

		$categories = $this->login_model->get_table_data('categories', $where=array('status'=>'1'), $group_by='', '','', '');
		$genders = $this->login_model->get_table_data('genders', $where=array('status'=>'1'), $group_by='', '','', '');

		$checkentry = $this->login_model->get_table_data('groupfour', $where=array('start_date'=>date('Y-m-d', strtotime($this->input->post('start_date'))), 'end_date'=>date('Y-m-d', strtotime($this->input->post('end_date'))), 'csirlabs_id'=>$this->input->post('csirlabs_id')), $group_by='', '','', '1');

		if(empty($checkentry)){
			$combinationkey = $this->getcombinationkey($categories, $genders);
		}else{
			$combinationkey = json_decode($checkentry[0]['combination_key']);
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required');

		foreach($combinationkey as $key=>$value){

			$category = $this->login_model->get_table_data('categories', $where=array('category_key'=>$key,'status'=>'1'), $group_by='', '','', '1');

			if(!empty($category)){
				foreach($value as $gkey=>$gvalue){
					$this->form_validation->set_rules(strtolower($key).'['.$gvalue.']', 'Number of '.$gvalue.' employees for '.$category[0]['name'].' category', 'trim|required');
				}
			}

			$subcategories = $this->login_model->get_table_data('subcategories', $where=array('category_key'=>$key,'status'=>'1'), $group_by='', '','', '1');

			if(!empty($subcategories)){
				foreach($value as $gkey=>$gvalue){
					$this->form_validation->set_rules(strtolower($key).'['.$gvalue.']', 'Number of '.$gvalue.' employees for '.$subcategories[0]['name'].' category', 'trim|required');
				}
			}
		}

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			if(empty($entry)){

				$data = array();

				foreach($combinationkey as $key=>$value){
					$data[$key] = $this->input->post($key);
				}
				
				$insertdata = array(
					'csirlabs_id'						=> trim($this->input->post('csirlabs_id')),
					'start_date' 						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'combination_key'					=> json_encode($combinationkey),
					'junior_scientist' 					=> json_encode($data),
					'scientist' 						=> json_encode(array()),
					'senior_scientist' 					=> json_encode(array()),
					'principal_scientist' 				=> json_encode(array()),
					'senior_principal_scientist' 		=> json_encode(array()),
					'chief_scientist' 					=> json_encode(array()),
					'added_by' 							=> $_SESSION['username'],
					'updated_by' 						=> $_SESSION['username'],
					'status' 							=> '1'
				);
				
				$insert = $this->db->insert('groupfour', $insertdata);

				if($insert){
					$data['message'] = "Data successfully updated.";
					$data['category'] = "Success";
				}else{
					$data['message'] = "Something went wrong. Please try again later";
					$data['category'] = "error";
				}
			}else{

			}

		}

		echo json_encode($data); 
	}

	/* Group IV End */

	public function groupthree(){
		$data['main_content'] = strtolower($this->router->fetch_class()).'/groupthree';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function addgroupthree(){
		$data['categories'] = $this->login_model->get_table_data('categories', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['genders'] = $this->login_model->get_table_data('genders', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['method_prefix'] = 'addgroupthree';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/addgroupthree';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function grouptwo(){
		$data['main_content'] = strtolower($this->router->fetch_class()).'/grouptwo';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function addgrouptwo(){
		$data['categories'] = $this->login_model->get_table_data('categories', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['genders'] = $this->login_model->get_table_data('genders', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['method_prefix'] = 'addgrouptwo';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/addgrouptwo';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function groupone(){
		$data['main_content'] = strtolower($this->router->fetch_class()).'/groupone';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function addgroupone(){
		$data['categories'] = $this->login_model->get_table_data('categories', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['genders'] = $this->login_model->get_table_data('genders', $where=array('status'=>'1'), $group_by='', '','', '');
		$data['method_prefix'] = 'addgroupone';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/addgroupone';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function getStartEndDate($formtype){
		if($formtype == 'backlogvacancies'){
			$data['start_date'] = date('Y-m-01', strtotime('last month'));
			$data['end_date'] = date('Y-m-t', strtotime('last month'));
		}
		
		if($formtype == 'probityportal'){
			$data['start_date'] = date('Y-m-01', strtotime('last month'));
			$data['end_date'] = date('Y-m-t', strtotime('last month'));
		}
		
		if($formtype == 'proforma'){
			$currentYear = date('Y');
			$data['start_date'] = date(($currentYear-1).'-04-01');
			$data['end_date'] = date($currentYear.'-03-31');
		}
		
		if($formtype == 'qualifyingservice'){
			$previousYear = date('Y')-1;
			$data['start_date'] = $previousYear.'-01-01';
			$data['end_date'] = $previousYear.'-12-31';
		}
		
		if($formtype == 'halfyearlyreport'){
			$currentMonth = date('m');
			if($currentMonth>6){
				$data['start_date'] = date('Y').'-01-01';
				$data['end_date'] = date('Y').'-06-30';
			}else{
				$previousYear = date('Y') - 1;
				$data['start_date'] = $previousYear.'-07-01';
				$data['end_date'] = $previousYear.'-12-31';
			}
		}
		
		if($formtype == 'mmr'){
			$today = new DateTime();
			$firstDayOfCurrentMonth = new DateTime('first day of ' . $today->format('F Y'));
			$firstDayOfPreviousMonth = $firstDayOfCurrentMonth->modify('-1 month');
			$lastDayOfPreviousMonth = new DateTime('last day of ' . $firstDayOfPreviousMonth->format('F Y'));
			$data['start_date'] = $firstDayOfPreviousMonth->format('Y-m-d');
			$data['end_date'] = $lastDayOfPreviousMonth->format('Y-m-d');
		}

		if($formtype == 'annexure3'){
			$currentYear = date('Y');
			$data['start_date'] = date(($currentYear-1).'-01-01');
			$data['end_date'] = date(($currentYear-1).'-12-31');
		}

		return $data;
	}

	public function getFreezingDate($freezing_type, $end_date){
		$freezingdates = $this->login_model->get_table_data('freezingdate', $where=array(), $group_by='', '','', '');
		$freezingdate = $freezingdates[0][$freezing_type];
		$default_freezing_date = date("Y-m-d", strtotime($end_date . " +4 days"));
		$max_freezing_date = date("Y-m-d", strtotime($end_date . " +25 days"));

		if(strtotime($freezingdate)>strtotime($default_freezing_date)){
			$freezing_date = $freezingdate;
		}else{
			$freezing_date = $default_freezing_date;
		}
		
		$data['default_freezing_date'] = $default_freezing_date;
		$data['freezing_date'] = date('d-m-Y', strtotime($freezing_date));
		$data['max_freezing_date'] = $max_freezing_date;
		return $data;
	}

    public function check_freezing_date($freezing_type){
    	$start_end_date = $this->getStartEndDate($freezing_type);
    	$freezing = $this->getFreezingDate($freezing_type, $start_end_date['end_date']);
    	
    	$default_freezing_date = $freezing['default_freezing_date'];
    	$freezing_date = $freezing['freezing_date'];
    	$max_freezing_date = $freezing['max_freezing_date'];

    	$todayDate = date('Y-m-d');

    	$date1 = new DateTime($todayDate);
		$date2 = new DateTime($freezing_date);
		
    	if($date1>$date2){
    		return false;
    	}else{
    		return true;
    	}
    }

    public function validate_freezing_date($value, $freezing_type){

    	$result = $this->check_freezing_date($freezing_type);

        if($result) {
            return true;
        } else {
            $this->form_validation->set_message('validate_freezing_date', 'You have missed the freezing date');
            return false;
        }
    }

	public function getLastThreeMonths(){
		$today = new DateTime();
		$lastThreeMonths = array();
		for ($i = 1; $i < 4; $i++) {
		    $date = clone $today;
		    $date->modify("-$i months");

		    $month = $date->format('F');
		    $year = $date->format('Y');

		    $lastThreeMonths[$date->format('01-m-Y').'@@'.$date->format('t-m-Y')] = "$month $year";
		}

		return $lastThreeMonths;
	}

	/* Start lab detail */

	public function checklabdetail(){
		$labdetail = $this->login_model->get_table_data('csirlabs', $where=array('status'=>'1', 'id'=>$_SESSION['csirlabs_id']), $group_by='', '','', 1);
		if($labdetail[0]['name'] == '' || $labdetail[0]['designation'] == '' || $labdetail[0]['email'] == '' || $labdetail[0]['mobile'] == '' || $labdetail[0]['landline'] == ''){
			return false;
		}else{
			return true;
		}
	}

	public function updatedetail(){
		$labdetail = $this->login_model->get_table_data('csirlabs', $where=array('status'=>'1', 'id'=>$_SESSION['csirlabs_id']), $group_by='', '','', 1);
		$data['labdetail'] = $labdetail[0];
		$data['method_prefix'] = 'updatedetail';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/updatedetail';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitupdatedetail(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', "Employee's Name", 'trim|required|xss_clean|html_escape');
		$this->form_validation->set_rules('designation', "Employee's Designation", 'trim|required|xss_clean|html_escape');
		$this->form_validation->set_rules('email', "Employee's Email", 'trim|required|xss_clean|html_escape');
		$this->form_validation->set_rules('mobile', "Employee's Mobile Number", 'trim|required|xss_clean|html_escape');
		$this->form_validation->set_rules('landline', "Employee's Landline Number", 'trim|required|xss_clean|html_escape');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$updateArray = array(
				'name' 				=> html_escape($this->input->post('name')),
				'designation' 		=> html_escape($this->input->post('designation')),
				'email' 			=> html_escape($this->input->post('email')),
				'mobile' 			=> html_escape($this->input->post('mobile')),
				'landline' 			=> html_escape($this->input->post('landline'))
			);

			$update = $this->login_model->update_database_table('csirlabs', $updateArray, array('id'=>$_SESSION['csirlabs_id']));

			if($update){
				$data['message'] = "Contact person's detail successfully updated";
				$data['category'] = "Success";
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

	/* End lab detail */
    
	/**************************Vacancy Section Start************************************/

	public function backlogvacancies(){
		$data['form_type'] = 'backlogvacancies';
		$data['form_name'] = 'Backlog Vacancies';

		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

        $labdata = $this->login_model->get_table_data('csirlabs', $where=array('username'=>$_SESSION['username']), $group_by='', 'updated_date','desc', 1);
        $data['categories'] = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', 1000);
		$data['vacancies'] = $this->login_model->get_table_data('vacancies', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id']), $group_by='', 'end_date','desc', 1000);
		$data['method_prefix'] = 'backlogvacancies';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/backlogvacancies';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function addvacancies(){
		$data['form_type'] = 'backlogvacancies';
		$data['form_name'] = 'Backlog Vacancies';

		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['months'] = $this->getLastThreeMonths();
		$lab_data = $this->login_model->get_table_data('labs', $where=array('abbreviation'=>$_SESSION['username'],'status'=>'1'), $group_by='', '','', 1);
		$categories = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', 1000);

		$data['method_prefix'] = 'addvacancies';
		$data['lab_name'] = $lab_data[0]['name'];
		$data['categories'] = $categories;
		$data['main_content'] = strtolower($this->router->fetch_class()).'/addvacancies';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitvacancies(){
		$checklabdetail = $this->checklabdetail();
		if($checklabdetail){
			$lab_data = $this->login_model->get_table_data('labs', $where=array('abbreviation'=>$_SESSION['username'],'status'=>'1'), $group_by='', '','', 1);
			$categories = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', 1000);

			$this->load->library('form_validation');
			foreach($categories as $key=>$value){
				$this->form_validation->set_rules("total-category-".$value['id'], 'Total number of vacancies for '.$value['category_name'], 'trim|required|callback_validate_vacancies_total['.$value['id'].','.$value['category_name'].']');
				$this->form_validation->set_rules("filled-category-".$value['id'], 'Filled up vacancies for '.$value['category_name'], 'trim|required');
				$this->form_validation->set_rules("unfilled-category-".$value['id'], 'Unfilled vacancies for '.$value['category_name'], 'trim|required');
			}
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|callback_validate_old_vacancies_entry|callback_validate_freezing_date[backlogvacancies]');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 
				$vacancies = array();
				foreach($categories as $key=>$value){
					$vacancies[$value['id']]['total'] = html_escape($this->input->post("total-category-".$value['id']));
					$vacancies[$value['id']]['filled'] = html_escape($this->input->post("filled-category-".$value['id']));
					$vacancies[$value['id']]['unfilled'] = html_escape($this->input->post("unfilled-category-".$value['id']));
				}

				$insertdata = array(
					'csirlabs_id' 		=> html_escape($this->input->post('csirlabs_id')),
					'start_date' 		=> html_escape(date('Y-m-d', strtotime($this->input->post('start_date')))),
					'end_date' 			=> html_escape(date('Y-m-d', strtotime($this->input->post('end_date')))),
					'vacancies' 		=> json_encode($vacancies),
					'remarks' 			=> html_escape($this->input->post('remarks')),
					'status' 			=> '1',
				);
				
				$insert = $this->db->insert('vacancies', $insertdata);

				if($insert){
					$data['message'] = "<h3 class='text-center'>Vacancies has successfully submitted.</h3><br>";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}
		echo json_encode($data); 
	}

    public function validate_old_vacancies_entry($value){

    	$data = $this->login_model->get_table_data('vacancies', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

        if(empty($data)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_old_vacancies_entry', 'You have already added vacancies for the date from '.date("d-m-Y", strtotime($this->input->post('start_date')))." to ".date("d-m-Y", strtotime($this->input->post('end_date'))));
            return false;
        }
    }

	public function editvacanciesform($id=''){
    	if(isset($id) && is_numeric($id)){
			$lab_data = $this->login_model->get_table_data('labs', $where=array('abbreviation'=>$_SESSION['username'],'status'=>'1'), $group_by='', '','', 1);
			$vacancies = $this->login_model->get_table_data('vacancies', $where=array('id'=>$id, 'status'=>'1', 'csirlabs_id'=>$_SESSION['csirlabs_id']), $group_by='', '','', 1);
			if(empty($vacancies)){
				redirect('csirlabs/dashboard');
			}else{
				$data['vacancies'] = $vacancies;
				$data['lab_name'] = $lab_data[0]['name'];
				$data['method_prefix'] = 'editvacancies';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/editvacanciesform';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
	}

	public function editvacancies(){

		$this->load->library('form_validation');

		$lab_data = $this->login_model->get_table_data('labs', $where=array('abbreviation'=>$_SESSION['username'],'status'=>'1'), $group_by='', '','', 1);
		$categories = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', 1000);
		$vacancies = $this->login_model->get_table_data('vacancies', $where=array('id'=>$this->input->post('vacancies_id'), 'status'=>'1', 'csirlabs_id'=>$this->input->post('csirlabs_id')), $group_by='', '','', 1);

		$newvacancies = (array)json_decode($vacancies[0]['vacancies']);

		foreach($newvacancies as $key=> $value){
			$category = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1','id'=>$key), $group_by='', '','', 1);
			$this->form_validation->set_rules("total-category-".$key, 'Total number of vacancies for '.$category[0]['category_name'], 'trim|required|callback_validate_vacancies_total['.$key.','.$category[0]['category_name'].']');
			$this->form_validation->set_rules("filled-category-".$key, 'Filled up vacancies for '.$category[0]['category_name'], 'trim|required');
			$this->form_validation->set_rules("unfilled-category-".$key, 'Unfilled vacancies for '.$category[0]['category_name'], 'trim|required');
		}

		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required|callback_validate_freezing_date[backlogvacancies]');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$updatevacancies = array();
			foreach($newvacancies as $key=> $value){
				$updatevacancies[$key]['total'] = html_escape($this->input->post("total-category-".$key));
				$updatevacancies[$key]['filled'] = html_escape($this->input->post("filled-category-".$key));
				$updatevacancies[$key]['unfilled'] = html_escape($this->input->post("unfilled-category-".$key));
			}

			$updateArray = array(
				'csirlabs_id' 		=> html_escape($this->input->post('csirlabs_id')),
				'start_date' 		=> trim(date('Y-m-d', strtotime($this->input->post('start_date')))),
				'end_date' 			=> trim(date('Y-m-d', strtotime($this->input->post('end_date')))),
				'vacancies' 		=> json_encode($updatevacancies),
				'remarks' 			=> html_escape($this->input->post('remarks')),
				'status' 			=> '1',
			);

			$update = $this->login_model->update_database_table('vacancies', $updateArray, array('id'=>$this->input->post('vacancies_id')));

			if($update){
				$data['message'] = "Vacancies has successfully updated";
				$data['category'] = "Success";
				$data['vacancy_id'] = $this->input->post('vacancies_id');
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

    public function validate_vacancies_total($value, $category_name){
    	$category = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1','id'=>$category_name[0]), $group_by='', '','', 1);
		$vacancies_total = trim($this->input->post("total-category-".$category_name[0]));
		$vacancies_filled = trim($this->input->post("filled-category-".$category_name[0]));
		$vacancies_unfilled = trim($this->input->post("unfilled-category-".$category_name[0]));
		if($vacancies_total != ($vacancies_filled+$vacancies_unfilled)){
			$this->form_validation->set_message('validate_vacancies_total', 'Total number of vacancies are not equal to sum of filled vacancies and unfilled vacancies for '.$category[0]['category_name']);
    		return false;
		}

		return true;
    }

	/**************************Vacancy Section End************************************/


	/**************************Probity Portal Data Start************************************/
	public function probityportal(){
		$data['form_type'] = 'probityportal';
		$data['form_name'] = 'Probity Portal Data';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

		$data['probityportaldata'] = $this->login_model->get_table_data('probityportal', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'],'status'=>'1'), $group_by='', $order_by_field='end_date', $order_by_sort='desc', $limit='');
		$data['method_prefix'] = 'probityportal';

		$data['main_content'] = strtolower($this->router->fetch_class()).'/probityportal';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function probityportalform(){
		$data['form_type'] = 'probityportal';
		$data['form_name'] = 'Probity Portal Data';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['months'] = $this->getLastThreeMonths();
		$data['method_prefix'] = 'probityportalform';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/probityportalform';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitprobityportal(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){
			$this->load->library('form_validation');

			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('organisation_name', 'Name of the Organisation', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_probityportal_entry|callback_validate_freezing_date[probityportal]');
			$this->form_validation->set_rules('sensitive_posts', 'Posts declares as sensitive', 'trim|required');
			$this->form_validation->set_rules('number_of_persons', 'Number of persons occupying sensitive posts beyond 3 years', 'trim|required');
			$this->form_validation->set_rules('rotation_policy_implemented', 'Whether rotation policy implemented (Yes/No)', 'trim|required');
			$this->form_validation->set_rules('interview_for_group_b', 'Whether interview for group B done away with (Yes/No)', 'trim|required');
			$this->form_validation->set_rules('interview_for_group_c_d', 'Whether interview for group C & D done away with (Yes/No)', 'trim|required');
			$this->form_validation->set_rules('number_of_officers_due_group_a', 'Total number of officers due for review/required to be reviewed under FR 56(j) Group A till 30.06.2023', 'trim|required');
			$this->form_validation->set_rules('number_of_officers_due_group_b', 'Total number of officers due for review/required to be reviewed under FR 56(j) Group B till 30.06.2023', 'trim|required');
			$this->form_validation->set_rules('number_of_officers_reviewed_a', 'Total number of officers reviewed under FR 56(j) group A', 'trim|required');
			$this->form_validation->set_rules('number_of_officers_reviewed_b', 'Total number of officers reviewed under FR 56(j) group B', 'trim|required');
			$this->form_validation->set_rules('number_of_officers_invoked_a', 'Number of officers against whom FR 56(j) invoked group A', 'trim|required');
			$this->form_validation->set_rules('number_of_officers_invoked_b', 'Number of officers against whom FR 56(j) invoked group B', 'trim|required');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 

				$insertdata = array(
					'csirlabs_id'						=> html_escape($this->input->post('csirlabs_id')),
					'organisation_name' 				=> html_escape($this->input->post('organisation_name')),
					'start_date' 						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'sensitive_posts' 					=> html_escape($this->input->post('sensitive_posts')),
					'number_of_persons' 				=> html_escape($this->input->post('number_of_persons')),
					'rotation_policy_implemented' 		=> html_escape($this->input->post('rotation_policy_implemented')),
					'interview_for_group_b' 			=> html_escape($this->input->post('interview_for_group_b')),
					'interview_for_group_c_d' 			=> html_escape($this->input->post('interview_for_group_c_d')),
					'number_of_officers_due_group_a' 	=> html_escape($this->input->post('number_of_officers_due_group_a')),
					'number_of_officers_due_group_b' 	=> html_escape($this->input->post('number_of_officers_due_group_b')),
					'number_of_officers_reviewed_a' 	=> html_escape($this->input->post('number_of_officers_reviewed_a')),
					'number_of_officers_reviewed_b' 	=> html_escape($this->input->post('number_of_officers_reviewed_b')),
					'number_of_officers_invoked_a' 		=> html_escape($this->input->post('number_of_officers_invoked_a')),
					'number_of_officers_invoked_b' 		=> html_escape($this->input->post('number_of_officers_invoked_b')),
					'remarks' 							=> html_escape($this->input->post('remarks')),
					'added_by' 							=> $_SESSION['csirlabs_id'],
					'updated_by' 						=> $_SESSION['csirlabs_id'],
					'status' 							=> '1'
				);
				
				$insert = $this->db->insert('probityportal', $insertdata);

				if($insert){
					$data['message'] = "<h3 class='text-center'>Probity Portal Data has successfully submitted.</h3><br>";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}
		echo json_encode($data); 
	}

    public function validate_old_probityportal_entry($value){

    	$data = $this->login_model->get_table_data('probityportal', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

        if(empty($data)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_old_probityportal_entry', 'You have already added data for the date till '.date("d-m-Y", strtotime($this->input->post('end_date'))));
            return false;
        }
    }

    public function editprobityportal($id=''){
    	if(isset($id) && is_numeric($id)){
			$data['probityportaldata'] = $this->login_model->get_table_data('probityportal', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'id'=>$id,'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

			if(empty($data['probityportaldata'])){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'editprobityportalform';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/editprobityportal';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
    }

	public function submiteditprobityportal(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('organisation_name', 'Name of the Organisation', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_freezing_date[probityportal]');
		$this->form_validation->set_rules('sensitive_posts', 'Posts declares as sensitive', 'trim|required');
		$this->form_validation->set_rules('number_of_persons', 'Number of persons occupying sensitive posts beyond 3 years', 'trim|required');
		$this->form_validation->set_rules('rotation_policy_implemented', 'Whether rotation policy implemented (Yes/No)', 'trim|required');
		$this->form_validation->set_rules('interview_for_group_b', 'Whether interview for group B done away with (Yes/No)', 'trim|required');
		$this->form_validation->set_rules('interview_for_group_c_d', 'Whether interview for group C & D done away with (Yes/No)', 'trim|required');
		$this->form_validation->set_rules('number_of_officers_due_group_a', 'Total number of officers due for review/required to be reviewed under FR 56(j) Group A till 30.06.2023', 'trim|required');
		$this->form_validation->set_rules('number_of_officers_due_group_b', 'Total number of officers due for review/required to be reviewed under FR 56(j) Group B till 30.06.2023', 'trim|required');
		$this->form_validation->set_rules('number_of_officers_reviewed_a', 'Total number of officers reviewed under FR 56(j) group A', 'trim|required');
		$this->form_validation->set_rules('number_of_officers_reviewed_b', 'Total number of officers reviewed under FR 56(j) group B', 'trim|required');
		$this->form_validation->set_rules('number_of_officers_invoked_a', 'Number of officers against whom FR 56(j) invoked group A', 'trim|required');
		$this->form_validation->set_rules('number_of_officers_invoked_b', 'Number of officers against whom FR 56(j) invoked group B', 'trim|required');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$updateArray = array(
				'start_date'						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
				'organisation_name' 				=> html_escape($this->input->post('organisation_name')),
				'sensitive_posts' 					=> html_escape($this->input->post('sensitive_posts')),
				'number_of_persons' 				=> html_escape($this->input->post('number_of_persons')),
				'rotation_policy_implemented' 		=> html_escape($this->input->post('rotation_policy_implemented')),
				'interview_for_group_b' 			=> html_escape($this->input->post('interview_for_group_b')),
				'interview_for_group_c_d' 			=> html_escape($this->input->post('interview_for_group_c_d')),
				'number_of_officers_due_group_a' 	=> html_escape($this->input->post('number_of_officers_due_group_a')),
				'number_of_officers_due_group_b' 	=> html_escape($this->input->post('number_of_officers_due_group_b')),
				'number_of_officers_reviewed_a' 	=> html_escape($this->input->post('number_of_officers_reviewed_a')),
				'number_of_officers_reviewed_b' 	=> html_escape($this->input->post('number_of_officers_reviewed_b')),
				'number_of_officers_invoked_a' 		=> html_escape($this->input->post('number_of_officers_invoked_a')),
				'number_of_officers_invoked_b' 		=> html_escape($this->input->post('number_of_officers_invoked_b')),
				'remarks' 							=> html_escape($this->input->post('remarks')),
				'updated_by' 						=> $_SESSION['csirlabs_id']
			);
			
			$update = $this->login_model->update_database_table('probityportal', $updateArray, array('id'=>$this->input->post('probityportal_id')));

			if($update){
				$data['message'] = "Probity Portal Data has successfully updated";
				$data['category'] = "Success";
				$data['probityportal_id'] = $this->input->post('probityportal_id');
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

	/**************************Probity Portal Data End************************************/

	/**************************Proforma start************************************/

	function getFinancialYearRange(){

		$financialYears = array();
		$currentYear = date('Y');

		for($i=1;$i<4;$i++){
			$year = $currentYear - $i;
		    $start_date = new DateTime($year."-04-01");
		    $end_date = new DateTime(($year + 1) . "-03-31");
		    $financialYears[$start_date->format('d-m-Y').'@@'.$end_date->format('d-m-Y')] = $start_date->format('d-m-Y')." to ".$end_date->format('d-m-Y');
		}

		return $financialYears;

	}

	public function proforma(){
		$data['form_type'] = 'proforma';
		$data['form_name'] = '15 Point Programme';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

		$data['proforma'] = $this->login_model->get_table_data('proforma', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'],'status'=>'1'), $group_by='', $order_by_field='end_date', $order_by_sort='desc', $limit='');
		$data['method_prefix'] = 'proforma';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/proforma';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function proformaform(){
		$data['form_type'] = 'proforma';
		$data['form_name'] = '15 Point Programme';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['financialyears'] = $this->getFinancialYearRange();
		$data['method_prefix'] = 'proformaform';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/proformaform';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitproforma(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){
			$this->load->library('form_validation');

			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_proforma_entry|callback_validate_freezing_date[proforma]');

			$this->form_validation->set_rules('total_employees_group_a', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-A', 'trim|required');
			$this->form_validation->set_rules('total_employed_group_a', 'Total number of persons employed during the year for Group-A', 'trim|required');
			$this->form_validation->set_rules('total_minority_employed_group_a', 'Minority persons employed during the year for Group-A', 'trim|required');
			$this->form_validation->set_rules('total_employees_group_b', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-B', 'trim|required');
			$this->form_validation->set_rules('total_employed_group_b', 'Total number of persons employed during the year for Group-B', 'trim|required');
			$this->form_validation->set_rules('total_minority_employed_group_b', 'Minority persons employed during the year for Group-B', 'trim|required');
			$this->form_validation->set_rules('total_employees_group_c', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-C', 'trim|required');
			$this->form_validation->set_rules('total_employed_group_c', 'Total number of persons employed during the year for Group-C', 'trim|required');
			$this->form_validation->set_rules('total_minority_employed_group_c', 'Minority persons employed during the year for Group-C', 'trim|required');
			$this->form_validation->set_rules('total_employees_group_d', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-D', 'trim|required');
			$this->form_validation->set_rules('total_employed_group_d', 'Total number of persons employed during the year for Group-D', 'trim|required');
			$this->form_validation->set_rules('total_minority_employed_group_d', 'Minority persons employed during the year for Group-D', 'trim|required');
			$this->form_validation->set_rules('total_employees', 'Total Number of employees as on '.$this->input->post('end_date'), 'trim|required');
			$this->form_validation->set_rules('total_employed', 'Total number of persons employed during the year', 'trim|required');
			$this->form_validation->set_rules('total_minority_employed', 'Total minority persons employed during the year', 'trim|required');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 

				$insertdata = array(
					'csirlabs_id'						=> html_escape($this->input->post('csirlabs_id')),
					'start_date' 						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'total_employees_group_a' 			=> html_escape($this->input->post('total_employees_group_a')),
					'total_employed_group_a' 			=> html_escape($this->input->post('total_employed_group_a')),
					'total_minority_employed_group_a' 	=> html_escape($this->input->post('total_minority_employed_group_a')),
					'total_employees_group_b' 			=> html_escape($this->input->post('total_employees_group_b')),
					'total_employed_group_b' 			=> html_escape($this->input->post('total_employed_group_b')),
					'total_minority_employed_group_b' 	=> html_escape($this->input->post('total_minority_employed_group_b')),
					'total_employees_group_c' 			=> html_escape($this->input->post('total_employees_group_c')),
					'total_employed_group_c' 			=> html_escape($this->input->post('total_employed_group_c')),
					'total_minority_employed_group_c' 	=> html_escape($this->input->post('total_minority_employed_group_c')),
					'total_employees_group_d' 			=> html_escape($this->input->post('total_employees_group_d')),
					'total_employed_group_d' 			=> html_escape($this->input->post('total_employed_group_d')),
					'total_minority_employed_group_d' 	=> html_escape($this->input->post('total_minority_employed_group_d')),
					'total_employees' 					=> html_escape($this->input->post('total_employees')),
					'total_employed' 					=> html_escape($this->input->post('total_employed')),
					'total_minority_employed' 			=> html_escape($this->input->post('total_minority_employed')),
					'remarks' 							=> html_escape($this->input->post('remarks')),
					'added_by' 							=> $_SESSION['csirlabs_id'],
					'updated_by' 						=> $_SESSION['csirlabs_id'],
					'status' 							=> '1'
				);
				
				$insert = $this->db->insert('proforma', $insertdata);

				if($insert){
					$data['message'] = "<h3 class='text-center'>15 point programme successfully submitted.</h3><br>";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}
		echo json_encode($data); 
	}

    public function validate_old_proforma_entry($value){

    	$data = $this->login_model->get_table_data('proforma', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

        if(empty($data)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_old_proforma_entry', 'You have already added data for the financial year '.date("d-m-Y", strtotime($this->input->post('start_date')))." to ".date("d-m-Y", strtotime($this->input->post('end_date'))));
            return false;
        }
    }

    public function editproforma($id=''){
    	if(isset($id) && is_numeric($id)){
			$data['proforma'] = $this->login_model->get_table_data('proforma', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'id'=>$id,'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

			if(empty($data['proforma'])){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'editproformaform';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/editproforma';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
    }

	public function submiteditproforma(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_freezing_date[proforma]');

		$this->form_validation->set_rules('total_employees_group_a', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-A', 'trim|required');
		$this->form_validation->set_rules('total_employed_group_a', 'Total number of persons employed during the year for Group-A', 'trim|required');
		$this->form_validation->set_rules('total_minority_employed_group_a', 'Minority persons employed during the year for Group-A', 'trim|required');

		$this->form_validation->set_rules('total_employees_group_b', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-B', 'trim|required');
		$this->form_validation->set_rules('total_employed_group_b', 'Total number of persons employed during the year for Group-B', 'trim|required');
		$this->form_validation->set_rules('total_minority_employed_group_b', 'Minority persons employed during the year for Group-B', 'trim|required');

		$this->form_validation->set_rules('total_employees_group_c', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-C', 'trim|required');
		$this->form_validation->set_rules('total_employed_group_c', 'Total number of persons employed during the year for Group-C', 'trim|required');
		$this->form_validation->set_rules('total_minority_employed_group_c', 'Minority persons employed during the year for Group-C', 'trim|required');

		$this->form_validation->set_rules('total_employees_group_d', 'Total Number of employees as on '.$this->input->post('end_date').' for Group-D', 'trim|required');
		$this->form_validation->set_rules('total_employed_group_d', 'Total number of persons employed during the year for Group-D', 'trim|required');
		$this->form_validation->set_rules('total_minority_employed_group_d', 'Minority persons employed during the year for Group-D', 'trim|required');

		$this->form_validation->set_rules('total_employees', 'Total Number of employees as on '.$this->input->post('end_date'), 'trim|required');
		$this->form_validation->set_rules('total_employed', 'Total number of persons employed during the year', 'trim|required');
		$this->form_validation->set_rules('total_minority_employed', 'Total minority persons employed during the year', 'trim|required');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$updateArray = array(
				'start_date'						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
				'total_employees_group_a' 			=> html_escape($this->input->post('total_employees_group_a')),
				'total_employed_group_a' 			=> html_escape($this->input->post('total_employed_group_a')),
				'total_minority_employed_group_a' 	=> html_escape($this->input->post('total_minority_employed_group_a')),
				'total_employees_group_b' 			=> html_escape($this->input->post('total_employees_group_b')),
				'total_employed_group_b' 			=> html_escape($this->input->post('total_employed_group_b')),
				'total_minority_employed_group_b' 	=> html_escape($this->input->post('total_minority_employed_group_b')),
				'total_employees_group_c' 			=> html_escape($this->input->post('total_employees_group_c')),
				'total_employed_group_c' 			=> html_escape($this->input->post('total_employed_group_c')),
				'total_minority_employed_group_c' 	=> html_escape($this->input->post('total_minority_employed_group_c')),
				'total_employees_group_d' 			=> html_escape($this->input->post('total_employees_group_d')),
				'total_employed_group_d' 			=> html_escape($this->input->post('total_employed_group_d')),
				'total_minority_employed_group_d' 	=> html_escape($this->input->post('total_minority_employed_group_d')),
				'total_employees' 					=> html_escape($this->input->post('total_employees')),
				'total_employed' 					=> html_escape($this->input->post('total_employed')),
				'total_minority_employed' 			=> html_escape($this->input->post('total_minority_employed')),
				'remarks' 							=> html_escape($this->input->post('remarks')),
				'updated_by' 						=> $_SESSION['csirlabs_id']
			);
			
			$update = $this->login_model->update_database_table('proforma', $updateArray, array('id'=>$this->input->post('proforma_id')));

			if($update){
				$data['message'] = "15 Point Programme has successfully updated";
				$data['category'] = "Success";
				$data['proforma_id'] = $this->input->post('proforma_id');
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

	/**************************Proforma end************************************/

	/**************************Qualifying service start************************************/

	function getCalenderYearRange(){

		$calenderYears = array();
		$currentYear = date('Y');

		for($i=1;$i<4;$i++){
			$year = $currentYear - $i;
		    $start_date = new DateTime($year."-01-01");
		    $end_date = new DateTime($year ."-12-31");
		    $calenderYears[$start_date->format('d-m-Y').'@@'.$end_date->format('d-m-Y')] = $start_date->format('d-m-Y')." to ".$end_date->format('d-m-Y');
		}

		return $calenderYears;

	}

	public function qualifyingservice(){
		$data['form_type'] = 'qualifyingservice';
		$data['form_name'] = 'Qualifying service under the CCS (Pension) Rules, 2021';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

		$data['qualifyingservice'] = $this->login_model->get_table_data('qualifyingservice', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id']), $group_by='', $order_by_field='end_date', $order_by_sort='desc', $limit='');
		$data['method_prefix'] = 'qualifyingservice';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/qualifyingservice';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function qualifyingserviceform(){
		$data['form_type'] = 'qualifyingservice';
		$data['form_name'] = 'Qualifying service under the CCS (Pension) Rules, 2021';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['daterange'] = $this->getCalenderYearRange();
		$data['method_prefix'] = 'qualifyingserviceform';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/qualifyingserviceform';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitqualifyingservice(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_qualifyingservice_entry|callback_validate_freezing_date[qualifyingservice]');
			$this->form_validation->set_rules('sanctioned_manpower', 'Sanctioned strength of manpower', 'trim|required');
			$this->form_validation->set_rules('manpower_in_position', 'Manpower in position', 'trim|required|callback_validate_manpower_in_position');
			$this->form_validation->set_rules('verified_employees', 'Number of employees whose service has been verified as per rules up to '.$this->input->post('end_date'), 'trim|required');
			$this->form_validation->set_rules('not_verified_employees', 'Number of employees whose service has not been verified up to '.$this->input->post('end_date'), 'trim|required');
			$this->form_validation->set_rules('non_verification_reason', 'Reason for non-verification of service', 'trim|callback_validate_non_verified_reason');
			$this->form_validation->set_rules('certification', 'Certified term', 'trim|required');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 

				$insertdata = array(
					'csirlabs_id'						=> html_escape($this->input->post('csirlabs_id')),
					'start_date' 						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'sanctioned_manpower' 				=> html_escape($this->input->post('sanctioned_manpower')),
					'manpower_in_position' 				=> html_escape($this->input->post('manpower_in_position')),
					'verified_employees' 				=> html_escape($this->input->post('verified_employees')),
					'not_verified_employees' 			=> html_escape($this->input->post('not_verified_employees')),
					'non_verification_reason' 			=> html_escape($this->input->post('non_verification_reason')),
					'remarks' 							=> html_escape($this->input->post('remarks')),
					'certification' 					=> 'It is certified that entries related to verification of services in respect of all employees have been made in Part-V of their respective service books.',
					'added_by' 							=> $_SESSION['csirlabs_id'],
					'updated_by' 						=> $_SESSION['csirlabs_id'],
					'status' 							=> '1'
				);
				
				$insert = $this->db->insert('qualifyingservice', $insertdata);

				if($insert){
					$data['message'] = "Qualifying service under the CCS (Pension) Rules, 2021 successfully submitted.";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}		
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}
		echo json_encode($data); 
	}

    public function validate_old_qualifyingservice_entry($value){

    	$data = $this->login_model->get_table_data('qualifyingservice', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

        if(empty($data)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_old_qualifyingservice_entry', 'You have already added data for the calendar year '.date("d-m-Y", strtotime($this->input->post('start_date')))." to ".date("d-m-Y", strtotime($this->input->post('end_date'))));
            return false;
        }
    }

    public function validate_manpower_in_position($value){

    	$manpower_in_position = $this->input->post('manpower_in_position');
    	$verified_employees = $this->input->post('verified_employees');
    	$not_verified_employees = $this->input->post('not_verified_employees');

        if($manpower_in_position == ($verified_employees+$not_verified_employees)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_manpower_in_position', 'Manpower in position should be equal to sum of Number of employees whose service has been verified and Number of employees whose service has not been verified');
            return false;
        }
    }

    public function validate_non_verified_reason($value){

    	$number_of_verified = $this->input->post('not_verified_employees');

        if($number_of_verified>0 && trim($this->input->post('non_verification_reason')) == '') {
            $this->form_validation->set_message('validate_non_verified_reason', 'Reason for non-verification of service is required');
            return false;
        } else {
        	return true;
        }
    }
    

    public function editqualifyingservice($id=''){
    	if(isset($id) && is_numeric($id)){
			$data['editqualifyingservice'] = $this->login_model->get_table_data('qualifyingservice', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'id'=>$id,'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

			if(empty($data['editqualifyingservice'])){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'editqualifyingservice';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/editqualifyingservice';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
    }

	public function submiteditqualifyingservice(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_freezing_date[qualifyingservice]');
		$this->form_validation->set_rules('sanctioned_manpower', 'Sanctioned strength of manpower', 'trim|required');
		$this->form_validation->set_rules('manpower_in_position', 'Manpower in position', 'trim|required|callback_validate_manpower_in_position');
		$this->form_validation->set_rules('verified_employees', 'Number of employees whose service has been verified as per rules up to '.$this->input->post('end_date'), 'trim|required');
		$this->form_validation->set_rules('not_verified_employees', 'Number of employees whose service has not been verified up to '.$this->input->post('end_date'), 'trim|required');
		$this->form_validation->set_rules('non_verification_reason', 'Reason for non-verification of service', 'trim|callback_validate_non_verified_reason');
		$this->form_validation->set_rules('certification', 'Certified term', 'trim|required');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$updateArray = array(
				'start_date'						=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'							=> date('Y-m-d', strtotime($this->input->post('end_date'))),
				'sanctioned_manpower' 				=> html_escape($this->input->post('sanctioned_manpower')),
				'manpower_in_position' 				=> html_escape($this->input->post('manpower_in_position')),
				'verified_employees' 				=> html_escape($this->input->post('verified_employees')),
				'not_verified_employees' 			=> html_escape($this->input->post('not_verified_employees')),
				'non_verification_reason' 			=> html_escape($this->input->post('non_verification_reason')),
				'remarks' 							=> html_escape($this->input->post('remarks')),
				'certification' 					=> 'It is certified that entries related to verification of services in respect of all employees have been made in Part-V of their respective service books.',
				'updated_by' 						=> $_SESSION['csirlabs_id']
			);
			
			$update = $this->login_model->update_database_table('qualifyingservice', $updateArray, array('id'=>$this->input->post('qualifyingservice_id')));

			if($update){
				$data['message'] = "Qualifying service under the CCS (Pension) Rules, 2021 has successfully updated";
				$data['category'] = "Success";
				$data['qualifyingservice_id'] = $this->input->post('qualifyingservice_id');
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}
	/**************************Qualifying service end************************************/

	/**************************Half-yearly report start************************************/

	function getHalfYearlyRange(){

		$halfyearlydates = array();
		$currentYear = date('Y');
		$currentMonth = date('m');

		if($currentMonth>6){
			$halfyearlydates['01-01-'.$currentYear."@@".'30-06-'.$currentYear] = '01-01-'.$currentYear." to ".'30-06-'.$currentYear;
			$halfyearlydates['01-07-'.($currentYear-1)."@@".'31-12-'.($currentYear-1)] = '01-07-'.($currentYear-1)." to ".'31-12-'.($currentYear-1);
			$halfyearlydates['01-01-'.($currentYear-1)."@@".'30-06-'.($currentYear-1)] = '01-01-'.($currentYear-1)." to ".'30-06-'.($currentYear-1);
		}else{
			$halfyearlydates['01-07-'.($currentYear-1)."@@".'31-12-'.($currentYear-1)] = '01-07-'.($currentYear-1)." to ".'31-12-'.($currentYear-1);
			$halfyearlydates['01-01-'.($currentYear-1)."@@".'30-06-'.($currentYear-1)] = '01-01-'.($currentYear-1)." to ".'30-06-'.($currentYear-1);
			$halfyearlydates['01-07-'.($currentYear-2)."@@".'31-12-'.($currentYear-2)] = '01-07-'.($currentYear-2)." to ".'31-12-'.($currentYear-2);
			
			
		}

		return $halfyearlydates;

	}

	public function halfyearlyreport(){
		$data['form_type'] = 'halfyearlyreport';
		$data['form_name'] = 'Half-Yearly report';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

		$data['halfyearlyreport'] = $this->login_model->get_table_data('halfyearlyreport', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id']), $group_by='', $order_by_field='end_date', $order_by_sort='desc', $limit='');
		$data['method_prefix'] = 'halfyearlyreport';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/halfyearlyreport';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function halfyearlyreportform(){
		$data['form_type'] = 'halfyearlyreport';
		$data['form_name'] = 'Half-Yearly report';
		
		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['halfyears'] = $this->getHalfYearlyRange();
		$data['method_prefix'] = 'halfyearlyreportform';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/halfyearlyreportform';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submithalfyearlyreport(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_halfyearlyreport_entry|callback_validate_freezing_date[halfyearlyreport]');

			$this->form_validation->set_rules('strength_of_personnel_total[]', 'Strength of personnel in the Estt. as on '.date('d-m-Y', strtotime($this->input->post('start_date'))).' (Total)', 'trim|required');
			$this->form_validation->set_rules('strength_of_personnel_esm[]', 'Strength of personnel in the Estt. as on '.date('d-m-Y', strtotime($this->input->post('start_date'))).' (ESM)', 'trim|required');
			$this->form_validation->set_rules('total_number_of_direct_recruitment_vacancies_occurred_during_the[]', 'Total number of direct recruitment vacancies occurred during the period', 'trim|required');
			$this->form_validation->set_rules('total_direct_recruitment[]', 'Total number of direct recruitment vacancies authorised for ESM (Out of column 4) in terms of DoPT notification dated 04-10-2012', 'trim|required');
			$this->form_validation->set_rules('direct_recruitment_vacancies_reserved_for_esm[]', 'Direct recruitment vacancies reserved for ESM (Out of Column 4)', 'trim|required');
			$this->form_validation->set_rules('no_of_direct_recruitment_vacancies_filled_total[]', 'Number of direct recruitment vacancies filled during the period out of column 4 and 5 (Total)', 'trim|required');
			$this->form_validation->set_rules('no_of_direct_recruitment_vacancies_filled_esm[]', 'Number of direct recruitment vacancies filled during the period out of column 4 and 5 (ESM)', 'trim|required');
			$this->form_validation->set_rules('shortfall_in_filling_the_vacancies[]', 'Shortfall in filling the vacancies of ESM out of 5 and 8 for', 'trim|required');
			$this->form_validation->set_rules('overall_strength_total[]', 'Overall strength and percentage as on '.date('d-m-Y', strtotime($this->input->post('end_date'))).' (Total)', 'trim|required');
			$this->form_validation->set_rules('overall_strength_esm[]', 'Overall strength and percentage as on '.date('d-m-Y', strtotime($this->input->post('end_date'))).' (ESM)', 'trim|required');
			$this->form_validation->set_rules('percentage_of_esm[]', 'Percentage of ESM', 'trim|required');
			$this->form_validation->set_rules('reason_for_shortfall[]', 'Reason for shortfall in the filling the vacancies of ESM', 'trim|required');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 

				$classification_of_post = ['A','B','C (Including erstwhile Group D)'];

				$remarks = $this->input->post('remarks');

				$insertdata = array(
					'csirlabs_id'												=> trim($this->input->post('csirlabs_id')),
					'start_date' 												=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 													=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'classification_of_post' 									=> json_encode($classification_of_post),
					'strength_of_personnel_total' 								=> json_encode($this->input->post('strength_of_personnel_total')),
					'strength_of_personnel_esm' 								=> json_encode($this->input->post('strength_of_personnel_esm')),
					'total_number_of_direct_recruitment_vacancies_occurred_during_the' 	=> json_encode($this->input->post('total_number_of_direct_recruitment_vacancies_occurred_during_the')),
					'total_direct_recruitment' 									=> json_encode($this->input->post('total_direct_recruitment')),
					'direct_recruitment_vacancies_reserved_for_esm' 			=> json_encode($this->input->post('direct_recruitment_vacancies_reserved_for_esm')),
					'no_of_direct_recruitment_vacancies_filled_total' 			=> json_encode($this->input->post('no_of_direct_recruitment_vacancies_filled_total')),
					'no_of_direct_recruitment_vacancies_filled_esm' 			=> json_encode($this->input->post('no_of_direct_recruitment_vacancies_filled_esm')),
					'shortfall_in_filling_the_vacancies' 						=> json_encode($this->input->post('shortfall_in_filling_the_vacancies')),
					'overall_strength_total' 									=> json_encode($this->input->post('overall_strength_total')),
					'overall_strength_esm' 										=> json_encode($this->input->post('overall_strength_esm')),
					'percentage_of_esm' 										=> json_encode($this->input->post('percentage_of_esm')),
					'reason_for_shortfall' 										=> json_encode($this->input->post('reason_for_shortfall')),
					'remarks' 													=> $remarks,
					'added_by' 													=> $_SESSION['csirlabs_id'],
					'updated_by' 												=> $_SESSION['csirlabs_id'],
					'status' 													=> '1'
				);
				
				$insert = $this->db->insert('halfyearlyreport', $insertdata);

				if($insert){
					$data['message'] = "Half yearly report successfully submitted.";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}

		echo json_encode($data); 
	}

    public function validate_old_halfyearlyreport_entry($value){

    	$data = $this->login_model->get_table_data('halfyearlyreport', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

        if(empty($data)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_old_halfyearlyreport_entry', 'You have already added data for the period from '.date("d-m-Y", strtotime($this->input->post('start_date')))." to ".date("d-m-Y", strtotime($this->input->post('end_date'))));
            return false;
        }
    }

    public function edithalfyearlyreport($id=''){
    	if(isset($id) && is_numeric($id)){
			$data['editqualifyingservice'] = $this->login_model->get_table_data('halfyearlyreport', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'id'=>$id,'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

			if(empty($data['editqualifyingservice'])){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'edithalfyearlyreport';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/edithalfyearlyreport';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
    }

	public function submitedithalfyearlyreport(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_freezing_date[halfyearlyreport]');
		$this->form_validation->set_rules('strength_of_personnel_total[]', 'Strength of personnel in the Estt. as on '.date('d-m-Y', strtotime($this->input->post('start_date'))).' (Total)', 'trim');
		$this->form_validation->set_rules('strength_of_personnel_esm[]', 'Strength of personnel in the Estt. as on '.date('d-m-Y', strtotime($this->input->post('start_date'))).' (ESM)', 'trim|required');
		$this->form_validation->set_rules('total_number_of_direct_recruitment_vacancies_occurred_during_the[]', 'Total number of direct recruitment vacancies occurred during the period', 'trim|required');
		$this->form_validation->set_rules('total_direct_recruitment[]', 'Total number of direct recruitment vacancies authorised for ESM (Out of column 4) in terms of DoPT notification dated 04-10-2012', 'trim|required');
		$this->form_validation->set_rules('direct_recruitment_vacancies_reserved_for_esm[]', 'Direct recruitment vacancies reserved for ESM (Out of Column 4)', 'trim|required');
		$this->form_validation->set_rules('no_of_direct_recruitment_vacancies_filled_total[]', 'Number of direct recruitment vacancies filled during the period out of column 4 and 5 (Total)', 'trim|required');
		$this->form_validation->set_rules('no_of_direct_recruitment_vacancies_filled_esm[]', 'Number of direct recruitment vacancies filled during the period out of column 4 and 5 (ESM)', 'trim|required');
		$this->form_validation->set_rules('shortfall_in_filling_the_vacancies[]', 'Shortfall in filling the vacancies of ESM out of 5 and 8 for', 'trim|required');
		$this->form_validation->set_rules('overall_strength_total[]', 'Overall strength and percentage as on '.date('d-m-Y', strtotime($this->input->post('end_date'))).' (Total)', 'trim|required');
		$this->form_validation->set_rules('overall_strength_esm[]', 'Overall strength and percentage as on '.date('d-m-Y', strtotime($this->input->post('end_date'))).' (ESM)', 'trim|required');
		$this->form_validation->set_rules('percentage_of_esm[]', 'Percentage of ESM', 'trim|required');
		$this->form_validation->set_rules('reason_for_shortfall[]', 'Reason for shortfall in the filling the vacancies of ESM', 'trim|required');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$remarks = $this->input->post('remarks');
			
			$updateArray = array(
				'start_date'												=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'													=> date('Y-m-d', strtotime($this->input->post('end_date'))),
				'strength_of_personnel_total' 								=> json_encode($this->input->post('strength_of_personnel_total')),
				'strength_of_personnel_esm' 								=> json_encode($this->input->post('strength_of_personnel_esm')),
				'total_number_of_direct_recruitment_vacancies_occurred_during_the' 	=> json_encode($this->input->post('total_number_of_direct_recruitment_vacancies_occurred_during_the')),
				'total_direct_recruitment' 									=> json_encode($this->input->post('total_direct_recruitment')),
				'direct_recruitment_vacancies_reserved_for_esm' 			=> json_encode($this->input->post('direct_recruitment_vacancies_reserved_for_esm')),
				'no_of_direct_recruitment_vacancies_filled_total' 			=> json_encode($this->input->post('no_of_direct_recruitment_vacancies_filled_total')),
				'no_of_direct_recruitment_vacancies_filled_esm' 			=> json_encode($this->input->post('no_of_direct_recruitment_vacancies_filled_esm')),
				'shortfall_in_filling_the_vacancies' 						=> json_encode($this->input->post('shortfall_in_filling_the_vacancies')),
				'overall_strength_total' 									=> json_encode($this->input->post('overall_strength_total')),
				'overall_strength_esm' 										=> json_encode($this->input->post('overall_strength_esm')),
				'percentage_of_esm' 										=> json_encode($this->input->post('percentage_of_esm')),
				'reason_for_shortfall' 										=> json_encode($this->input->post('reason_for_shortfall')),
				'remarks' 													=> $remarks,
				'updated_by' 												=> $_SESSION['csirlabs_id'],
				'status' 													=> '1'
			);
			
			$update = $this->login_model->update_database_table('halfyearlyreport', $updateArray, array('id'=>$this->input->post('halfyearlyreport_id')));

			if($update){
				$data['message'] = "Half yearly report has successfully updated";
				$data['category'] = "Success";
				$data['halfyearlyreport_id'] = $this->input->post('halfyearlyreport_id');
			}else{
				$data['message'] = "<p>You have not changed anything</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}
	/**************************Half-yearly report end************************************/

	/**************************MMR start************************************/
	public function mmr(){
		$data['form_type'] = 'mmr';
		$data['form_name'] = 'Mission Mode Recruitment';

		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

		$data['mmr'] = $this->login_model->get_table_data('mmr', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id']), $group_by='', $order_by_field='end_date', $order_by_sort='desc', $limit='');
		$data['method_prefix'] = 'mmr';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/mmr';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function mmrform(){
		$data['form_type'] = 'mmr';
		$data['form_name'] = 'Mission Mode Recruitment';

		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['months'] = $this->getLastThreeMonths();
		$data['method_prefix'] = 'mmrform';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/mmrform';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitmmrform(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_mmr_entry|callback_validate_freezing_date[mmr]');

			$this->form_validation->set_rules('taskcode[]', 'Task Code', 'trim|required');
			$this->form_validation->set_rules('name[]', 'Name', 'trim|required');
			$this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
			$this->form_validation->set_rules('email[]', 'Email ID', 'trim|required');
			$this->form_validation->set_rules('mobile_number[]', 'Mobile Number', 'trim|required|max_length[10]|min_length[10]|numeric');
			$this->form_validation->set_rules('designation[]', 'Designation', 'trim|required');
			$this->form_validation->set_rules('paylevel[]', 'Pay Level', 'trim|required');
			$this->form_validation->set_rules('groupcode[]', 'Group Code', 'trim|required');
			$this->form_validation->set_rules('categorycode[]', 'Category Code', 'trim|required');
			$this->form_validation->set_rules('appointorderno[]', 'Appoint Order No', 'trim|required');
			$this->form_validation->set_rules('appointdate[]', 'Appoint Date', 'trim|required');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 
				
				$appointdate = array();
				foreach($this->input->post('appointdate') as $key=>$value){
					$appointdate[] = date('Y-m-d', strtotime($value));
				}
				
				$insertdata = array(
					'csirlabs_id'			=> trim($this->input->post('csirlabs_id')),
					'start_date' 			=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 				=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'taskcode' 				=> json_encode($this->input->post('taskcode')),
					'name' 					=> json_encode($this->input->post('name')),
					'gender' 				=> json_encode($this->input->post('gender')),
					'email' 				=> json_encode($this->input->post('email')),
					'mobile_number' 		=> json_encode($this->input->post('mobile_number')),
					'designation' 			=> json_encode($this->input->post('designation')),
					'paylevel' 				=> json_encode($this->input->post('paylevel')),
					'groupcode' 			=> json_encode($this->input->post('groupcode')),
					'categorycode' 			=> json_encode($this->input->post('categorycode')),
					'appointorderno' 		=> json_encode($this->input->post('appointorderno')),
					'appointdate' 			=> json_encode($appointdate),
					'remarks' 				=> json_encode($this->input->post('remarks')),
					'added_by' 				=> $_SESSION['csirlabs_id'],
					'updated_by' 			=> $_SESSION['csirlabs_id'],
					'status' 				=> '1'
				);
				
				$insert = $this->db->insert('mmr', $insertdata);

				if($insert){
					$data['message'] = "Mission Mode Recruitment successfully submitted.";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}

		echo json_encode($data); 
	}

	public function submitmmrnilform(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_mmr_entry|callback_validate_freezing_date[mmr]');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 

				$insertdata = array(
					'csirlabs_id'			=> trim($this->input->post('csirlabs_id')),
					'start_date' 			=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 				=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'taskcode' 				=> json_encode([]),
					'name' 					=> json_encode([]),
					'gender' 				=> json_encode([]),
					'email' 				=> json_encode([]),
					'mobile_number' 		=> json_encode([]),
					'designation' 			=> json_encode([]),
					'paylevel' 				=> json_encode([]),
					'groupcode' 			=> json_encode([]),
					'categorycode' 			=> json_encode([]),
					'appointorderno' 		=> json_encode([]),
					'appointdate' 			=> json_encode([]),
					'remarks' 				=> json_encode([]),
					'added_by' 				=> $_SESSION['csirlabs_id'],
					'updated_by' 			=> $_SESSION['csirlabs_id'],
					'status' 				=> '1'
				);
				
				$insert = $this->db->insert('mmr', $insertdata);

				if($insert){
					$data['message'] = "Mission Mode Recruitment successfully submitted.";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}
		echo json_encode($data); 
	}

    public function validate_old_mmr_entry($value){

    	$data = $this->login_model->get_table_data('mmr', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

        if(empty($data)) {
            return true;
        } else {
            $this->form_validation->set_message('validate_old_mmr_entry', 'You have already added data for Mission Mode Recruitment for the period from '.date("d-m-Y", strtotime($this->input->post('start_date')))." to ".date("d-m-Y", strtotime($this->input->post('end_date'))));
            return false;
        }
    }

    public function editmmr($id=''){
    	if(isset($id) && is_numeric($id)){
			$data['mmr'] = $this->login_model->get_table_data('mmr', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'id'=>$id,'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

			if(empty($data['mmr'])){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'editmmr';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/editmmr';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
    }

	public function submiteditmmr(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_freezing_date[mmr]');

		$this->form_validation->set_rules('taskcode[]', 'Task Code', 'trim|required');
		$this->form_validation->set_rules('name[]', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
		$this->form_validation->set_rules('email[]', 'Email ID', 'trim|required');
		$this->form_validation->set_rules('mobile_number[]', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('designation[]', 'Designation', 'trim|required');
		$this->form_validation->set_rules('paylevel[]', 'Pay Level', 'trim|required');
		$this->form_validation->set_rules('groupcode[]', 'Group Code', 'trim|required');
		$this->form_validation->set_rules('categorycode[]', 'Category Code', 'trim|required');
		$this->form_validation->set_rules('appointorderno[]', 'Appoint Order No', 'trim|required');
		$this->form_validation->set_rules('appointdate[]', 'Appoint Date', 'trim|required');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$appointdate = array();
			foreach($this->input->post('appointdate') as $key=>$value){
				$appointdate[] = date('Y-m-d', strtotime($value));
			}

			$updateArray = array(
				'start_date'			=> date('Y-m-d', strtotime($this->input->post('start_date'))),
				'end_date'				=> date('Y-m-d', strtotime($this->input->post('end_date'))),
				'taskcode' 				=> json_encode($this->input->post('taskcode')),
				'name' 					=> json_encode($this->input->post('name')),
				'gender' 				=> json_encode($this->input->post('gender')),
				'email' 				=> json_encode($this->input->post('email')),
				'mobile_number' 		=> json_encode($this->input->post('mobile_number')),
				'designation' 			=> json_encode($this->input->post('designation')),
				'paylevel' 				=> json_encode($this->input->post('paylevel')),
				'groupcode' 			=> json_encode($this->input->post('groupcode')),
				'categorycode' 			=> json_encode($this->input->post('categorycode')),
				'appointorderno' 		=> json_encode($this->input->post('appointorderno')),
				'appointdate' 			=> json_encode($appointdate),
				'remarks' 				=> json_encode($this->input->post('remarks')),
				'updated_by' 			=> trim($this->input->post('csirlabs_id')),
				'status' 				=> '1'
			);
			
			$update = $this->login_model->update_database_table('mmr', $updateArray, array('id'=>$this->input->post('mmr_id')));

			if($update){
				$data['message'] = "Mission Mode Recruitment has successfully updated";
				$data['category'] = "Success";
				$data['mmr_id'] = $this->input->post('mmr_id');
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}
	/**************************MMR end************************************/

	/**************************Annexure III Start************************************/

	public function annexure3(){
		$data['form_type'] = 'annexure3';
		$data['form_name'] = 'Annexure-III';

		$start_end_date = $this->getStartEndDate($data['form_type']);
		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$freezing = $this->getFreezingDate($data['form_type'], $data['end_date']);
		$data['default_freezing_date'] = $freezing['default_freezing_date'];
		$data['freezing_date'] = $freezing['freezing_date'];
		$data['max_freezing_date'] = $freezing['max_freezing_date'];

		$data['annexure3'] = $this->login_model->get_table_data('annexure3', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id']), $group_by='', $order_by_field='end_date', $order_by_sort='desc', $limit='');

		$data['method_prefix'] = 'annexure3';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/annexure3';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function annexure3form(){

		$data['form_type'] = 'annexure3';
		$data['form_name'] = 'Annexure-III';

		$start_end_date = $this->getStartEndDate($data['form_type']);

		$data['start_date'] = $start_end_date['start_date'];
		$data['end_date'] = $start_end_date['end_date'];

		$data['method_prefix'] = 'annexure3form';
		$data['main_content'] = strtolower($this->router->fetch_class()).'/annexure3form';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitannexure3(){

		$checklabdetail = $this->checklabdetail();

		if($checklabdetail){		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_annexure3_entry');
			$this->form_validation->set_rules('sanctioned_strength[]', 'Sanctioned Strength (SS)', 'trim|required');
			$this->form_validation->set_rules('person_in_position[]', 'PIP (Person in position)', 'trim|required');
			$this->form_validation->set_rules('direct_recruitement[]', 'DR', 'trim|required');
			$this->form_validation->set_rules('promotion[]', 'Promotion + other mode of recruitement', 'trim|required');
			$this->form_validation->set_rules('total[]', 'Total', 'trim|required');
			$this->form_validation->set_rules('upsc[]', 'UPSC', 'trim|required');
			$this->form_validation->set_rules('ssc[]', 'SSC', 'trim|required');
			$this->form_validation->set_rules('other_recruiting_agencies_of_ministry[]', 'Other recruiting agencies of Ministry', 'trim|required');
			$this->form_validation->set_rules('by_lab[]', 'By Lab/Institute', 'trim|required');
			$this->form_validation->set_rules('calendar_of_dpc_with_number_of_vacancies[]', 'Calendar of DPC with number of Vacancies', 'trim|required');
			$this->form_validation->set_rules('remarks[]', 'Remarks', 'trim');

			if($this->form_validation->run() === false){
				$data['message'] = validation_errors();
				$data['category'] = "error";
			}else{ 
				
				$insertdata = array(
					'csirlabs_id'			=> trim($this->input->post('csirlabs_id')),
					'start_date' 			=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date' 				=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'groups' 				=> json_encode($this->input->post('groups')),
					'sanctioned_strength' 	=> json_encode($this->input->post('sanctioned_strength')),
					'person_in_position' 	=> json_encode($this->input->post('person_in_position')),
					'direct_recruitement' 	=> json_encode($this->input->post('direct_recruitement')),
					'promotion' 			=> json_encode($this->input->post('promotion')),
					'total' 				=> json_encode($this->input->post('total')),
					'upsc' 					=> json_encode($this->input->post('upsc')),
					'ssc' 					=> json_encode($this->input->post('ssc')),
					'other_recruiting_agencies_of_ministry' => json_encode($this->input->post('other_recruiting_agencies_of_ministry')),
					'by_lab' 				=> json_encode($this->input->post('by_lab')),
					'calendar_of_dpc_with_number_of_vacancies' 		=> json_encode($this->input->post('calendar_of_dpc_with_number_of_vacancies')),
					'remarks' 				=> json_encode($this->input->post('remarks')),
					'added_by' 				=> $_SESSION['csirlabs_id'],
					'updated_by' 			=> $_SESSION['csirlabs_id'],
					'status' 				=> '1'
				);
				
				$insert = $this->db->insert('annexure3', $insertdata);

				if($insert){
					$data['message'] = "Annexure-III successfully submitted.";
					$data['category'] = "Success";
				}else{
					$data['message'] = "<p>Something went wrong. Please try again later.</p>";
					$data['category'] = "error";
				}
			}
		}else{
			$data['message'] = "Please update your detail first";
			$data['category'] = "detailerror";
		}

		echo json_encode($data); 
	}

	public function validate_old_annexure3_entry($value){

		$data = $this->login_model->get_table_data('annexure3', $where=array('csirlabs_id'=>$this->input->post('csirlabs_id'), 'end_date'=>date("Y-m-d", strtotime($this->input->post('end_date'))),'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

		if(empty($data)) {
			return true;
		} else {
			$this->form_validation->set_message('validate_old_annexure3_entry', 'You have already added data for the period from '.date("d-m-Y", strtotime($this->input->post('start_date')))." to ".date("d-m-Y", strtotime($this->input->post('end_date'))));
			return false;
		}
	}

    public function annexure3editform($id=''){
    	if(isset($id) && is_numeric($id)){
			$data['annexure3'] = $this->login_model->get_table_data('annexure3', $where=array('csirlabs_id'=>$_SESSION['csirlabs_id'], 'id'=>$id,'status'=>'1'), $group_by='', $order_by_field='', $order_by_sort='', $limit='');

			if(empty($data['annexure3'])){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'annexure3editform';
				$data['main_content'] = strtolower($this->router->fetch_class()).'/annexure3editform';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
    }

	public function submiteditannexure3(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End date', 'trim|required');
		$this->form_validation->set_rules('sanctioned_strength[]', 'Sanctioned Strength (SS)', 'trim|required');
		$this->form_validation->set_rules('person_in_position[]', 'PIP (Person in position)', 'trim|required');
		$this->form_validation->set_rules('direct_recruitement[]', 'DR', 'trim|required');
		$this->form_validation->set_rules('promotion[]', 'Promotion + other mode of recruitement', 'trim|required');
		$this->form_validation->set_rules('total[]', 'Total', 'trim|required');
		$this->form_validation->set_rules('upsc[]', 'UPSC', 'trim|required');
		$this->form_validation->set_rules('ssc[]', 'SSC', 'trim|required');
		$this->form_validation->set_rules('other_recruiting_agencies_of_ministry[]', 'Other recruiting agencies of Ministry', 'trim|required');
		$this->form_validation->set_rules('by_lab[]', 'By Lab/Institute', 'trim|required');
		$this->form_validation->set_rules('calendar_of_dpc_with_number_of_vacancies[]', 'Calendar of DPC with number of Vacancies', 'trim|required');
		$this->form_validation->set_rules('remarks[]', 'Remarks', 'trim');

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$updateArray = array(
				'groups' 				=> json_encode($this->input->post('groups')),
				'sanctioned_strength' 	=> json_encode($this->input->post('sanctioned_strength')),
				'person_in_position' 	=> json_encode($this->input->post('person_in_position')),
				'direct_recruitement' 	=> json_encode($this->input->post('direct_recruitement')),
				'promotion' 			=> json_encode($this->input->post('promotion')),
				'total' 				=> json_encode($this->input->post('total')),
				'upsc' 					=> json_encode($this->input->post('upsc')),
				'ssc' 					=> json_encode($this->input->post('ssc')),
				'other_recruiting_agencies_of_ministry' => json_encode($this->input->post('other_recruiting_agencies_of_ministry')),
				'by_lab' 				=> json_encode($this->input->post('by_lab')),
				'calendar_of_dpc_with_number_of_vacancies' 		=> json_encode($this->input->post('calendar_of_dpc_with_number_of_vacancies')),
				'remarks' 				=> json_encode($this->input->post('remarks')),
				'updated_by' 			=> trim($this->input->post('csirlabs_id')),
			);
			
			$update = $this->login_model->update_database_table('annexure3', $updateArray, array('id'=>$this->input->post('annexure3_id')));

			if($update){
				$data['message'] = "Annexure-III has successfully updated";
				$data['category'] = "Success";
				$data['annexure3_id'] = $this->input->post('annexure3_id');
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

	/**************************Annexure III End************************************/

	/**************************Custom Form Start************************************/

	public function customforms(){
		$forms = $this->login_model->get_table_data('customforms', $where=array(), $group_by='', $order_by_field='id', $order_by_sort='desc', $limit='');
		$data['forms'] = $forms;
		$data['main_content'] = strtolower($this->router->fetch_class()).'/customforms';
		$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
	}

	public function submitcustomform(){

		$formid = $this->input->post('formid');
		$forms = $this->login_model->get_table_data('customforms', $where=array('id'=>$formid), $group_by='', $order_by_field='id', $order_by_sort='desc', $limit='1');
		$fields = json_decode($forms[0]['fields']);

		$this->load->library('form_validation');
		foreach($fields as $key=>$value){

			$validationrules = 'trim';

			if($value->required == 'Yes'){
				$validationrules = $validationrules."|required";
			}

			if($value->minlength != '' && $value->minlength != '0'){
				$validationrules = $validationrules."|min_length[".$value->minlength."]";
			}

			if($value->maxlength != '' && $value->maxlength != '0'){
				$validationrules = $validationrules."|max_length[".$value->maxlength."]";
			}

			if($value->fieldtype == 'Checkbox'){
				$this->form_validation->set_rules($value->fieldtitle.'[]', $value->fieldlabel, $validationrules);
			}else{
				$this->form_validation->set_rules($value->fieldtitle, $value->fieldlabel, $validationrules);
			}
		}

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$fieldsdata = array();

			foreach($fields as $key=>$value){
				if($value->fieldtype == 'Checkbox'){
					$fieldsdata[$value->fieldtitle] = $this->input->post($value->fieldtitle);
				}else if($value->fieldtype == 'Date'){
					$fieldsdata[$value->fieldtitle] = date('Y-m-d', strtotime($this->input->post($value->fieldtitle)));
				}else{
					$fieldsdata[$value->fieldtitle] = trim($this->input->post($value->fieldtitle));	
				}
			}

			$insertdata = array(
				'formid'			=> $formid,
				'lab_id' 			=> $_SESSION['csirlabs_id'],
				'form_data' 		=> json_encode($fieldsdata)
			);
			
			$insert = $this->db->insert('customformsdata', $insertdata);

			if($insert){
				$data['message'] = "You have successfully submitted the form data";
				$data['category'] = "Success";
			}else{
				$data['message'] = "<p>Something went wrong. Please try again later.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}

	public function editcustomform($entry_id=''){
    	if(isset($entry_id) && is_numeric($entry_id)){
    		
			$formentry = $this->login_model->get_table_data('customformsdata', $where=array('id'=>$entry_id), $group_by='', $order_by_field='id', $order_by_sort='desc', $limit='1');

			$form = $this->login_model->get_table_data('customforms', $where=array('id'=>$formentry[0]['formid']), $group_by='', $order_by_field='id', $order_by_sort='desc', $limit='1');

			if(empty($formentry)){
				redirect('csirlabs/dashboard');
			}else{
				$data['method_prefix'] = 'editcustomform';
				$data['form'] = $form[0];
				$data['formentry'] = $formentry;
				$data['formdata'] = json_decode($formentry[0]['form_data']);
				$data['main_content'] = strtolower($this->router->fetch_class()).'/editcustomform';
				$this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
			}
    	}else{
    		redirect('csirlabs/dashboard');
    	}
	}

	public function submiteditcustomform(){
		
		$formid = $this->input->post('formid');
		$forms = $this->login_model->get_table_data('forms', $where=array('id'=>$formid), $group_by='', $order_by_field='id', $order_by_sort='desc', $limit='1');
		$fields = json_decode($forms[0]['fields']);

		$this->load->library('form_validation');
		foreach($fields as $key=>$value){

			$validationrules = 'trim';

			if($value->required == 'Yes'){
				$validationrules = $validationrules."|required|xss_clean|html_escape";
			}

			if($value->minlength != '' && $value->minlength != '0'){
				$validationrules = $validationrules."|min_length[".$value->minlength."]|xss_clean|html_escape";
			}

			if($value->maxlength != '' && $value->maxlength != '0'){
				$validationrules = $validationrules."|max_length[".$value->maxlength."]|xss_clean|html_escape";
			}

			if($value->fieldtype == 'Checkbox'){
				$this->form_validation->set_rules($value->fieldtitle.'[]', $value->fieldlabel, $validationrules);
			}else{
				$this->form_validation->set_rules($value->fieldtitle, $value->fieldlabel, $validationrules);
			}
		}

		if($this->form_validation->run() === false){
			$data['message'] = validation_errors();
			$data['category'] = "validation error";
		}else{ 

			$fieldsdata = array();

			foreach($fields as $key=>$value){
				if($value->fieldtype == 'Checkbox'){
					$fieldsdata[$value->fieldtitle] = $this->input->post($value->fieldtitle);
				}else if($value->fieldtype == 'Date'){
					$fieldsdata[$value->fieldtitle] = date('Y-m-d', strtotime($this->input->post($value->fieldtitle)));
				}else{
					$fieldsdata[$value->fieldtitle] = trim($this->input->post($value->fieldtitle));	
				}
			}

			$whereArray = array(
									'formid'			=> $formid,
									'lab_id' 			=> $_SESSION['csirlabs_id']
								);

			$updateArray = array(
									'form_data' 		=> json_encode($fieldsdata)
								);

			$update = $this->login_model->update_database_table('formsdata', $updateArray, $whereArray);

			if($update){
				$data['message'] = "Your form has successfully updated";
				$data['category'] = "Success";
				$data['formid'] = $formid;
			}else{
				$data['message'] = "<p>You have not changed anything.</p>";
				$data['category'] = "error";
			}
		}
		echo json_encode($data); 
	}
	/**************************Custom Form End************************************/

}
