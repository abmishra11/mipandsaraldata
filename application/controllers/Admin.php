<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->login_check();

        $this->csirlabs = $this->login_model->get_table_data('csirlabs', $where = array('status' => '1'), $group_by = '', 'username', 'asc', '');
        // Load pagination library
        $this->load->library('ajax_pagination');

        // Per page limit
        $this->perPage = 5;
    }

    public function login_check(){
        if (!isset($_SESSION['is_' . strtolower($this->router->fetch_class()) . '_log_in']) || $_SESSION['is_' . strtolower($this->router->fetch_class()) . '_log_in'] === false) {
            redirect(base_url() . 'home/admin', 'refresh');
        }
    }

    public function logout()
    {
        $this->session = session_destroy();
        redirect(base_url() . 'home/index');
    }

    public function gettabledata()
    {
        $data = $this->login_model->get_table_data_by_different_fields($_POST['table'], array('id' => $_POST['id']));
        echo json_encode($data[0]);
    }

    public function updatetable()
    {
        $this->db->where(array('id' => $_POST['id']));
        $this->db->update($_POST['table'], array('status' => $_POST['status']));
        if ($this->db->affected_rows() == 0) {
            $data['message'] = '<p>Something went wrong. Please try again later.</p>';
            $data['category'] = 'error';
        } else {
            $data['category'] = 'success';
            $data['message'] = "<p>Status Changed.</p>";
        }
        echo json_encode($data);
    }

    public function deletetable()
    {
        $this->db->where('id', $_POST['id']);
        $result = $this->db->delete($_POST['table']);
        if ($result) {
            $data['category'] = 'success';
            $data['message'] = "<p>Record Successfully Deleted</p>";
        } else {
            $data['message'] = '<p>Something went wrong. Please try again later.</p>';
            $data['category'] = 'error';
        }
        echo json_encode($data);
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

    public function dashboard()
    {
        $dates = $this->getMonthStartEndDateArray();

        $csirlabs = $this->login_model->get_table_data('csirlabs', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        $forms = $this->login_model->get_table_data('forms', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        $employeetype = $this->login_model->get_table_data('employeetype', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        // Get all formdata in one go
        $formdata_all = $this->login_model->get_table_data('formdata', [
            'status' => '1',
            'start_date' => $dates[2]['start_date'],
            'end_date' => $dates[2]['end_date']
        ]);

        // Group by lab-form-employeetype combination
        $formdata = [];
        foreach ($formdata_all as $fd) {
            $key = $fd['csirlabs_id'].'-'.$fd['form_id'];
            $formdata[$key][] = $fd;
        }
        

        // foreach($csirlabs as $clk=>$clv){
        //     foreach($forms as $fk=>$fv){
        //         foreach ($employeetype as $ek => $ev) {
        //             $formdata[$clv['id'].'-'.$fv['id'].'-'.$ev['id']][] = $this->login_model->get_table_data('formdata', $where = array('csirlabs_id' => $clv['id'], 'form_id' => $fv['id'], 'employeetype'=> $ev['id'], 'start_date' => $dates[1]['start_date'], 'end_date' => $dates[1]['end_date'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        //         }
        //     }
        // }
        
        
        // $employeetype = $this->login_model->get_table_data('employeetype', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        // foreach ($employeetype as $key => $value) {
        //     $data["groups"][$value['id']] = $this->login_model->get_table_data('forms', $where = array('employeetype' => $value['id'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        // }
        // $data['employeetype'] = $employeetype;

        $data['csirlabs'] = $csirlabs;
        $data['forms'] = $forms;
        $data['employeetype'] = $employeetype;
        $data['formdata'] = $formdata;
        $data['method_prefix'] = 'forms';
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/dashboard';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function mipdata()
    {
        $dates = $this->getMonthStartEndDateArray();

        $csirlabs = $this->login_model->get_table_data('csirlabs', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        $forms = $this->login_model->get_table_data('forms', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        $employeetype = $this->login_model->get_table_data('employeetype', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        // Get all formdata in one go
        $formdata_all = $this->login_model->get_table_data('formdata', [
            'status' => '1',
            'start_date' => $dates[2]['start_date'],
            'end_date' => $dates[2]['end_date']
        ]);

        // Group by lab-form-employeetype combination
        $formdata = [];
        foreach ($formdata_all as $fd) {
            $key = $fd['csirlabs_id'].'-'.$fd['form_id'];
            $formdata[$key][] = $fd;
        }
        

        // foreach($csirlabs as $clk=>$clv){
        //     foreach($forms as $fk=>$fv){
        //         foreach ($employeetype as $ek => $ev) {
        //             $formdata[$clv['id'].'-'.$fv['id'].'-'.$ev['id']][] = $this->login_model->get_table_data('formdata', $where = array('csirlabs_id' => $clv['id'], 'form_id' => $fv['id'], 'employeetype'=> $ev['id'], 'start_date' => $dates[1]['start_date'], 'end_date' => $dates[1]['end_date'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        //         }
        //     }
        // }
        
        
        // $employeetype = $this->login_model->get_table_data('employeetype', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        // foreach ($employeetype as $key => $value) {
        //     $data["groups"][$value['id']] = $this->login_model->get_table_data('forms', $where = array('employeetype' => $value['id'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        // }
        // $data['employeetype'] = $employeetype;

        $data['csirlabs'] = $csirlabs;
        $data['forms'] = $forms;
        $data['employeetype'] = $employeetype;
        $data['formdata'] = $formdata;
        $data['method_prefix'] = 'forms';
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/mipdata';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    /* Start Employee Type */

    public function employeetype()
    {
        $data['employeetype'] = $this->login_model->get_table_data('employeetype', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/employeetype';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addemployeetype()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('employee_type', 'Employee Type', 'trim|required');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $employee_type = trim($this->input->post('employee_type'));

            $dataArray = array(
                'employee_type' => $employee_type,
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('employeetype', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Employee Type successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editemployeetype()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('employee_type', 'Employee Type', 'trim|required');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'employee_type' => trim($this->input->post('employee_type')),
                'updated_by' => trim($_SESSION['username']),
            );

            $query = $this->login_model->update_database_table('employeetype', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Employee Type Successfully Updated</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* End Employee Type */

    /* Start Designations */

    public function designations()
    {
        $data['method_prefix'] = 'designations';
        $employeetype = $this->login_model->get_table_data('employeetype', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        foreach ($employeetype as $key => $value) {
            $data["designation"][$value['id']] = $this->login_model->get_table_data('designations', $where = array('employee_type_id' => $value['id'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        }
        $data['employeetype'] = $employeetype;
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/designations';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function adddesignation()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('employee_type_id', 'Employee Type', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $dataArray = array(
                'employee_type_id' => $this->input->post('employee_type_id'),
                'designation' => $this->input->post('designation'),
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('designations', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Designation successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editdesignation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('employee_type_id', 'Employee Type', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'employee_type_id' => trim($this->input->post('employee_type_id')),
                'designation' => trim($this->input->post('designation')),
                'updated_by' => trim($_SESSION['username']),
            );

            $query = $this->login_model->update_database_table('designations', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Designation Successfully Updated</p>";
            } else {
                $data['message'] = '<p>You have not made any change</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* End Designations */

    /* Start Pay Level */

    public function paylevel()
    {
        $data['method_prefix'] = 'paylevel';
        $data['paylevel'] = $this->login_model->get_table_data('paylevel', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/paylevel';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addpaylevel()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('paylevel', 'Pay Level', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $dataArray = array(
                'paylevel' => $this->input->post('paylevel'),
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('paylevel', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Pay level successfully added</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);

    }

    public function editpaylevel()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('paylevel', 'Pay Level', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'paylevel' => trim($this->input->post('paylevel')),
                'updated_by' => trim($_SESSION['username']),
            );

            $query = $this->login_model->update_database_table('paylevel', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "Pay level successfully updated";
            } else {
                $data['message'] = '<p>You have not changed anything</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);

    }

    /* End Pay Level */

    /* Start Categories */

    public function categories()
    {
        $data['categories'] = $this->login_model->get_table_data('categories', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/categories';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addcategory()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Category Name', 'trim|required|is_unique[categories.name]');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $category_key = preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('name'));
            $category_key = strtolower($category_key);

            $dataArray = array(
                'name' => trim($this->input->post('name')),
                'category_key' => $category_key,
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('categories', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Category successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editcategory()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('parent_category', 'Parent Category', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'name' => trim($this->input->post('name')),
                'parent_category' => trim($this->input->post('parent_category')),
                'updated_by' => trim($_SESSION['username']),
            );

            $query = $this->login_model->update_database_table('categories', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Category successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function subcategories()
    {
        $data['subcategories'] = $this->login_model->get_table_data('subcategories', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/subcategories';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addsubcategory()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'trim|required|is_unique[subcategories.name]');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $sub_category_key = preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('name'));
            $sub_category_key = strtolower($sub_category_key);

            $dataArray = array(
                'name' => trim($this->input->post('name')),
                'category_key' => $sub_category_key,
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('subcategories', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Sub Category successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editsubcategory()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Sub Category Name', 'trim|required|is_unique[subcategories.name]');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'name' => trim($this->input->post('name')),
                'updated_by' => trim($_SESSION['username']),
            );

            $query = $this->login_model->update_database_table('subcategories', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Sub Category successfully added.</p>";
            } else {
                $data['message'] = '<p>You have not made any change.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* End Categories */

    /* Start Genders */

    public function genders()
    {
        $data['genders'] = $this->login_model->get_table_data('genders', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/genders';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addgender()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Gender Name', 'trim|required|is_unique[genders.name]');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $gender_key = preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('name'));
            $gender_key = strtolower($gender_key);

            $dataArray = array(
                'name' => trim($this->input->post('name')),
                'gender_key' => $gender_key,
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('genders', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Gender successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editgender()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Gender Name', 'trim|required|is_unique[genders.name]');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'name' => trim($this->input->post('name')),
                'updated_by' => trim($_SESSION['username']),
            );

            $query = $this->login_model->update_database_table('genders', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Gender successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* End Genders */

    /* Start Forms */

    public function forms()
    {
        $data['method_prefix'] = 'forms';
        $employeetype = $this->login_model->get_table_data('employeetype', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        foreach ($employeetype as $key => $value) {
            $data["groups"][$value['id']] = $this->login_model->get_table_data('forms', $where = array('employeetype' => $value['id'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        }
        $data['employeetype'] = $employeetype;
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/forms';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addform()
    {
        $data['method_prefix'] = 'forms';
        $employeetype = $this->login_model->get_table_data('employeetype', $where = array('status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['employeetype'] = $employeetype;

        $data['categories'] = $this->login_model->get_table_data('categories', $where = array('status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['subcategories'] = $this->login_model->get_table_data('subcategories', $where = array('status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['genders'] = $this->login_model->get_table_data('genders', $where = array('status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        $data['default_pay_levels'] = $this->login_model->get_table_data('paylevel', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['default_designations'] = $this->login_model->get_table_data('designations', $where = array('employee_type_id' => $employeetype[0]['id']), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

        $data['main_content'] = strtolower($this->router->fetch_class()) . '/addform';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function submitform()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('employeetype', 'Employee Type', 'trim|required');
        $this->form_validation->set_rules('categories[]', 'Categories', 'trim|required');
        $this->form_validation->set_rules('subcategories[]', 'Sub Categories', 'trim|required');
        $this->form_validation->set_rules('genders[]', 'Genders', 'trim|required');
        $this->form_validation->set_rules('designations[]', 'Designation', 'trim|required');
        $this->form_validation->set_rules('paylevels[]', 'Pay Level', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $dataArray = array(
                'title' => trim($this->input->post('title')),
                'employeetype' => $this->input->post('employeetype'),
                'categories' => json_encode($this->input->post('categories')),
                'subcategories' => json_encode($this->input->post('subcategories')),
                'genders' => json_encode($this->input->post('genders')),
                'designations' => json_encode($this->input->post('designations')),
                'paylevels' => json_encode($this->input->post('paylevels')),
                'added_by' => trim($_SESSION['username']),
                'updated_by' => trim($_SESSION['username']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('forms', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>New form successfully created.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function getemployetypeoptions()
    {
        try {
            $employee_type_id = $this->input->post('employee_type_id');

            // Fetch Designations
            $designations = $this->login_model->get_table_data('designations', array('employee_type_id' => $employee_type_id, 'status' => '1'));
            $designationoptions = "";
            if ($designations) {
                foreach ($designations as $value) {
                    $designationoptions .= '<option value="' . $value["id"] . '">' . $value["designation"] . '</option>';
                }
            }

            $data['category'] = 'success';
            $data['designationoptions'] = $designationoptions;
            echo json_encode($data);
        } catch (Exception $e) {
            $data['category'] = 'error';
            $data['message'] = 'An error occurred: ' . $e->getMessage();
            echo json_encode($data);
        }
    }

    public function viewform($id = "")
    {
        if (isset($id) && is_numeric($id)) {
            $form = $this->login_model->get_table_data('forms', $where = array('id' => $id, 'status' => '1'), $group_by = '', '', '', 1);
            if (empty($form)) {
                redirect('admin/dashboard');
            } else {
                $data['form'] = $form[0];
                $data['main_content'] = strtolower($this->router->fetch_class()) . '/viewform';
                $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
            }
        } else {
            redirect('admin/dashboard');
        }
    }

    /* End Forms */

    /* Sanctioned Strength Start */

    public function sanctionedstrength()
    {
        $employeetype = $this->login_model->get_table_data('employeetype', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        foreach ($employeetype as $key => $value) {
            $data["groups"][$value['id']] = $this->login_model->get_table_data('forms', $where = array('employeetype' => $value['id'], 'status' => '1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        }
        $data['employeetype'] = $employeetype;
        $data['method_prefix'] = 'sanctionedstrength';
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/sanctionedstrength';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function sanctionedstrengthdata($formid = '')
    {
        if (isset($formid) && is_numeric($formid)) {
            $form = $this->login_model->get_table_data('forms', $where = array('id' => $formid, 'status' => '1'), $group_by = '', '', '', 1);
            if (empty($form)) {
                redirect('admin/sanctionedstrength');
            } else {
                $sanctionedstrength = $this->login_model->get_table_data('sanctionedstrength', $where = array('form_id' => $formid), $group_by = '', '', '', '');
                $data['method_prefix'] = 'sanctionedstrengthdata';
                $data['form'] = $form[0];
                $data['sanctionedstrength'] = $sanctionedstrength;
                $data['main_content'] = strtolower($this->router->fetch_class()) . '/sanctionedstrengthdata';
                $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
            }

        } else {
            redirect('admin/sanctionedstrength');
        }
    }

    public function editsanctionedstrength()
    {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('sanctionedstrength', 'Sanctioned Strength', 'trim|required|is_numeric');
		$this->form_validation->set_rules('dgquota', 'DG quota posts', 'trim|required|is_numeric');
		$this->form_validation->set_rules('postsreceived', 'Posts received from sister labs', 'trim|required|is_numeric');
		$this->form_validation->set_rules('poststransferred', 'Posts transferred to sister labs', 'trim|required|is_numeric');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
				'sanctionedstrength' 	=> trim($this->input->post('sanctionedstrength')),
				'dgquota' 	=> trim($this->input->post('dgquota')),
				'postsreceived' 	=> trim($this->input->post('postsreceived')),
				'poststransferred' 	=> trim($this->input->post('poststransferred')),
                'updated_by' => trim($_SESSION['username']),
                'updated_date' => date('Y-m-d h:i:s'),
            );

            $query = $this->login_model->update_database_table('sanctionedstrength', $updateArray, $whereArray);
            if ($query) {
                $data['category'] = 'Success';
                $data['formid'] = $this->input->post('form_id');
                $data['message'] = "Sanctioned Strength Successfully Updated.";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* Sanctioned Strength End */

    /* Headquarter's Post Start */

    public function headquarterposts()
    {
        $data['method_prefix'] = 'headquarterposts';
        $data['headquarterposts'] = $this->login_model->get_table_data('headquarterposts', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/headquarterposts';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addheadquarterpost()
    {
        $data['method_prefix'] = 'addheadquarterpost';
        $data['designations'] = $this->login_model->get_table_data('designations', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['paylevel'] = $this->login_model->get_table_data('paylevel', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['categories'] = $this->login_model->get_table_data('categories', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['subcategories'] = $this->login_model->get_table_data('subcategories', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['genders'] = $this->login_model->get_table_data('genders', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/addheadquarterpost';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function submitheadquarterpost()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('posts', 'No of Posts', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('paylevel', 'Pay Level', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $dataArray = array(
                'posts' => trim($this->input->post('posts')),
                'designation' => trim($this->input->post('designation')),
                'paylevel' => trim($this->input->post('paylevel')),
                'category' => trim($this->input->post('category')),
                'subcategory' => trim($this->input->post('subcategory')),
                'gender' => trim($this->input->post('gender')),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('headquarterposts', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "Post Detail Successfully Added";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editheadquarterpost($id = "")
    {
        if (isset($id) && is_numeric($id)) {
            $headquarterpost = $this->login_model->get_table_data('headquarterposts', $where = array('id' => $id), $group_by = '', '', '', 1);
            if (empty($headquarterpost)) {
                redirect('admin/headquarterposts');
            } else {
                $data['method_prefix'] = 'editheadquarterpost';
                $data['designations'] = $this->login_model->get_table_data('designations', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
                $data['paylevel'] = $this->login_model->get_table_data('paylevel', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
                $data['categories'] = $this->login_model->get_table_data('categories', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
                $data['subcategories'] = $this->login_model->get_table_data('subcategories', $where = array('status'=>'1'), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
                $data['genders'] = $this->login_model->get_table_data('genders', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');

                $data['headquarterpost'] = $headquarterpost[0];
                $data['main_content'] = strtolower($this->router->fetch_class()) . '/editheadquarterpost';
                $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
            }
        } else {
            redirect('admin/headquarterposts');
        }
    }

    public function submiteditheadquarterpost()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('posts', 'No of Posts', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('paylevel', 'Pay Level', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'posts' => trim($this->input->post('posts')),
                'designation' => trim($this->input->post('designation')),
                'paylevel' => trim($this->input->post('paylevel')),
                'category' => trim($this->input->post('category')),
                'subcategory' => trim($this->input->post('subcategory')),
                'gender' => trim($this->input->post('gender')),
                'updated_by' => trim($_SESSION['username']),
                'updated_date' => date('Y-m-d h:i:s'),
            );

            $query = $this->login_model->update_database_table('headquarterposts', $updateArray, $whereArray);
            if ($query) {
                $data['category'] = 'Success';
                $data['headquarterpostsid'] = $this->input->post('id');
                $data['message'] = "Headquarter's Post Details Successfully Updated.";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function deleteheadquarterpost()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('posts', 'No of Posts', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('designation_level', 'Designation Level', 'trim|required');
        $this->form_validation->set_rules('paylevel', 'Pay Level', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'posts' => trim($this->input->post('posts')),
                'designation' => trim($this->input->post('designation')),
                'designation_level' => $this->input->post('designation_level'),
                'paylevel' => trim($this->input->post('paylevel')),
                'category' => trim($this->input->post('category')),
                'gender' => trim($this->input->post('gender')),
                'updated_by' => trim($_SESSION['username']),
                'updated_date' => date('Y-m-d h:i:s'),
            );

            $query = $this->login_model->update_database_table('headquarterposts', $updateArray, $whereArray);
            if ($query) {
                $data['category'] = 'Success';
                $data['headquarterpostsid'] = $this->input->post('id');
                $data['message'] = "Headquarter's Post Details Successfully Updated.";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* Headquarter's Post End */

    public function labs()
    {
        $data['method_prefix'] = 'labs';
        $data['labs'] = $this->login_model->get_table_data('csirlabs', $where = array(), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '');
        $data['main_content'] = strtolower($this->router->fetch_class()) . '/labs';
        $this->load->view(strtolower($this->router->fetch_class()) . '/include/template', $data);
    }

    public function addlab()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Lab User Name', 'trim|required|is_unique[csirlabs.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('lab_name', 'Lab Name', 'trim|required');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $dataArray = array(
                'username' => trim($this->input->post('username')),
                'lab_name' => trim($this->input->post('lab_name')),
                'password' => md5($this->input->post('password')),
                'added_by' => trim($_SESSION['adminusername']),
                'updated_by' => trim($_SESSION['adminusername']),
                'status' => '1',
            );

            $query = $this->login_model->insert_data_in_table('csirlabs', $dataArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Lab successfully added.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function editlab()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Lab User Name', 'trim|required');
        $this->form_validation->set_rules('lab_name', 'Lab Name', 'trim|required');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {
            $whereArray = array(
                'id' => $this->input->post('id'),
            );

            $updateArray = array(
                'username' => trim($this->input->post('username')),
                'lab_name' => trim($this->input->post('lab_name')),
                'email' => trim($this->input->post('email')),
                'mobile' => trim($this->input->post('mobile')),
                'updated_by' => trim($_SESSION['adminusername']),
                'updated_date' => date('yyyy-mm-dd hh:ii:ss'),
            );

            $query = $this->login_model->update_database_table('csirlabs', $updateArray, $whereArray);

            if ($query) {
                $data['category'] = 'success';
                $data['message'] = "<p>Lab successfully edited.</p>";
            } else {
                $data['message'] = '<p>Something went wrong. Please try again later.</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    /* Add Freezing date */
    public function addfreezingdate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('freezing-date', 'Freezing date', 'trim|required|callback_check_freezing_date');
        if ($this->form_validation->run() === false) {
            $data['category'] = 'validation_error';
            $data['message'] = validation_errors();
        } else {

            $whereArray = array(
                'id' => '1',
            );

            $updateArray = array(
                $this->input->post('freezing-type') => date("Y-m-d", strtotime($this->input->post('freezing-date'))),
            );

            $query = $this->login_model->update_database_table('freezingdate', $updateArray, $whereArray);
            
            if ($query) {
                $data['category'] = 'Success';
                $data['message'] = "Freezing date successfully updated";
            } else {
                $data['message'] = '<p>You have not made any change</p>';
                $data['category'] = 'error';
            }
        }
        echo json_encode($data);
    }

    public function check_freezing_date($value)
    {

        $freezing_date = date("Y-m-d", strtotime($this->input->post('freezing-date')));
        $default_freezing_date = $this->input->post('default-freezing-date');
        $max_freezing_date = $this->input->post('max-freezing-date');

        if (strtotime($freezing_date) < strtotime($default_freezing_date)) {
            $this->form_validation->set_message('check_freezing_date', 'Freezing date should not be less than ' . date("d-m-Y", strtotime($default_freezing_date)));
            return false;
        }

        if (strtotime($freezing_date) > strtotime($max_freezing_date)) {
            $this->form_validation->set_message('check_freezing_date', 'Freezing date should not be more than ' . date("d-m-Y", strtotime($max_freezing_date)));
            return false;
        }
        return true;
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

    /* Add Freezing date */

    /* Get Start and End Date */

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

    public function getEndDates($table){
        $this->db->distinct();
        $this->db->select('end_date');
        $this->db->order_by('end_date', 'desc');
        $query = $this->db->get($table);
        return $query->result();
    }

    /* Get Start and End Date */

    /* Backlog Vacancies */

    public function backlogvacancies(){
        $data['categories'] = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', '');

        $vacancies = array();
        $end_dates = $this->getEndDates('vacancies');
        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = $start_dates[0]."-".$start_dates[1]."-01";

            foreach($this->csirlabs as $ck=>$cv){
                $vacancies[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('vacancies', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', 'csirlabs_id','asc', '');
            }
            
        }
        
        $startEndDate = $this->getStartEndDate('backlogvacancies');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('backlogvacancies', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'backlogvacancies';

        $data['vacancies'] = $vacancies;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'backlogvacancies';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/backlogvacancies';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addbacklogvacancies($labid=''){
        if(isset($labid) && is_numeric($labid)){
            $categories = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', 1000);
            $lab_data = $this->login_model->get_table_data('csirlabs', $where=array('id'=>$labid,'status'=>'1'), $group_by='', '','', 1);
            $data['start_date'] = date('Y-m-01', strtotime('last month'));
            $data['end_date'] = date('Y-m-t', strtotime('last month'));
            $data['labid'] = $labid;
            $data['lab_name'] = $lab_data[0]['username'];
            $data['categories'] = $categories;
            $data['method_prefix'] = 'addbacklogvacancies';
            $data['main_content'] = strtolower($this->router->fetch_class()).'/addbacklogvacancies';
            $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
        }else{
            redirect('admin/backlogvacancies');
        }
    }

    public function submitbacklogvacancies(){
        $categories = $this->login_model->get_table_data('saraldatacategories', $where=array('status'=>'1'), $group_by='', '','', 1000);

        $this->load->library('form_validation');
        foreach($categories as $key=>$value){
            $this->form_validation->set_rules("total-category-".$value['id'], 'Total number of vacancies for '.$value['category_name'], 'trim|required|callback_validate_vacancies_total['.$value['id'].','.$value['category_name'].']');
            $this->form_validation->set_rules("filled-category-".$value['id'], 'Filled up vacancies for '.$value['category_name'], 'trim|required');
            $this->form_validation->set_rules("unfilled-category-".$value['id'], 'Unfilled vacancies for '.$value['category_name'], 'trim|required');
        }
        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End Date', 'trim|required|callback_validate_old_vacancies_entry');
        $this->form_validation->set_rules('document', 'Document', 'callback_file_check');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 
            $config['upload_path'] = './includes/images/documents/backlogvacancies/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000000; // 10MB max size
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {

                $upload_data = $this->upload->data();
                $document = 'document-backlogvacancies-'.$this->input->post('csirlabs_id').'-'.time(). substr($upload_data['file_ext'], 0);
                $new_path = './includes/images/documents/backlogvacancies/' . $document;
                
                // Rename the uploaded file
                rename($upload_data['full_path'], $new_path);

                $vacancies = array();
                foreach($categories as $key=>$value){
                    $vacancies[$value['id']]['total'] = trim($this->input->post("total-category-".$value['id']));
                    $vacancies[$value['id']]['filled'] = trim($this->input->post("filled-category-".$value['id']));
                    $vacancies[$value['id']]['unfilled'] = trim($this->input->post("unfilled-category-".$value['id']));
                }

                $insertdata = array(
                    'csirlabs_id'       => trim($this->input->post('csirlabs_id')),
                    'start_date'        => trim(date('Y-m-d', strtotime($this->input->post('start_date')))),
                    'end_date'          => trim(date('Y-m-d', strtotime($this->input->post('end_date')))),
                    'vacancies'         => json_encode($vacancies),
                    'remarks'           => trim($this->input->post('remarks')),
                    'document'          => $document,
                    'status'            => '1',
                );
                
                $insert = $this->db->insert('vacancies', $insertdata);

                if($insert){
                    $data['message'] = "Vacancies has successfully submitted.";
                    $data['category'] = "Success";
                }else{
                    $data['message'] = "Something went wrong. Please try again later.";
                    $data['category'] = "error";
                }
            }else{
                $data['message'] = "Something went wrong. Please try again later.";
                $data['category'] = "error";
            }

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

    public function file_check($str){
        if(empty($_FILES['document']['name'])){
            $this->form_validation->set_message('file_check', 'Please upload document');
            return false;
        }else{
            $allowed_mime_type_arr = array('application/pdf');
            $mime = get_mime_by_extension($_FILES['document']['name']);
            $size = $_FILES['document']['size'];

            if($size>10000000){
                $this->form_validation->set_message('file_check', 'Document file size should be less than 10 MB');
                return false;
            }
            if(!in_array($mime, $allowed_mime_type_arr)){
                $this->form_validation->set_message('file_check', 'Only pdf file is allowed for document');
                return false;
            }
        }
        return true;
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

    /* Backlog Vacancies */

    /* Probity Portal Data */

    public function probityportal(){
        $probityportaldata = array();
        $end_dates = $this->getEndDates('probityportal');
        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = $start_dates[0]."-".$start_dates[1]."-01";

            foreach($this->csirlabs as $ck=>$cv){
                $probityportaldata[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('probityportal', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', $order_by_field='csirlabs_id', $order_by_sort='asc', $limit='');
            }
        }

        $startEndDate = $this->getStartEndDate('probityportal');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('probityportal', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'probityportal';

        $data['probityportaldata'] = $probityportaldata;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'probityportal';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/probityportal';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addprobitydata($labid=''){
        if(isset($labid) && is_numeric($labid)){
            $lab_data = $this->login_model->get_table_data('csirlabs', $where=array('id'=>$labid,'status'=>'1'), $group_by='', '','', 1);
            $data['start_date'] = date('Y-m-01', strtotime('last month'));
            $data['end_date'] = date('Y-m-t', strtotime('last month'));
            $data['labid'] = $labid;
            $data['lab_name'] = $lab_data[0]['username'];
            $data['method_prefix'] = 'addprobitydata';
            $data['main_content'] = strtolower($this->router->fetch_class()).'/addprobitydata';
            $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
        }else{
            redirect('admin/probityportal');
        }
    }

    public function submitprobitydata(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
        $this->form_validation->set_rules('organisation_name', 'Name of the Organisation', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_probityportal_entry');
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
        $this->form_validation->set_rules('document', 'Document', 'callback_file_check');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 

            $config['upload_path'] = './includes/images/documents/probityportal/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000000; // 10MB max size
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {

                $upload_data = $this->upload->data();
                $document = 'document-probityportal-'.$this->input->post('csirlabs_id').'-'.time(). substr($upload_data['file_ext'], 0);
                $new_path = './includes/images/documents/probityportal/' . $document;
                
                // Rename the uploaded file
                rename($upload_data['full_path'], $new_path);

                $insertdata = array(
                    'csirlabs_id'                       => html_escape($this->input->post('csirlabs_id')),
                    'organisation_name'                 => html_escape($this->input->post('organisation_name')),
                    'start_date'                        => date('Y-m-d', strtotime($this->input->post('start_date'))),
                    'end_date'                          => date('Y-m-d', strtotime($this->input->post('end_date'))),
                    'sensitive_posts'                   => html_escape($this->input->post('sensitive_posts')),
                    'number_of_persons'                 => html_escape($this->input->post('number_of_persons')),
                    'rotation_policy_implemented'       => html_escape($this->input->post('rotation_policy_implemented')),
                    'interview_for_group_b'             => html_escape($this->input->post('interview_for_group_b')),
                    'interview_for_group_c_d'           => html_escape($this->input->post('interview_for_group_c_d')),
                    'number_of_officers_due_group_a'    => html_escape($this->input->post('number_of_officers_due_group_a')),
                    'number_of_officers_due_group_b'    => html_escape($this->input->post('number_of_officers_due_group_b')),
                    'number_of_officers_reviewed_a'     => html_escape($this->input->post('number_of_officers_reviewed_a')),
                    'number_of_officers_reviewed_b'     => html_escape($this->input->post('number_of_officers_reviewed_b')),
                    'number_of_officers_invoked_a'      => html_escape($this->input->post('number_of_officers_invoked_a')),
                    'number_of_officers_invoked_b'      => html_escape($this->input->post('number_of_officers_invoked_b')),
                    'remarks'                           => html_escape($this->input->post('remarks')),
                    'document'                          => $document,
                    'added_by'                          => 'admin',
                    'updated_by'                        => 'admin',
                    'status'                            => '1'
                );
                
                $insert = $this->db->insert('probityportal', $insertdata);

                if($insert){
                    $data['message'] = "Probity Portal Data has successfully submitted";
                    $data['category'] = "Success";
                }else{
                    $data['message'] = "Something went wrong. Please try again later";
                    $data['category'] = "error";
                }
            }else{
                $data['message'] = "Something went wrong. Please try again later";
                $data['category'] = "error";
            }
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

    /* Probity Portal Data */

    /* 15 Point Programme data */

    public function proforma(){
        $proforma = array();
        $end_dates = $this->getEndDates('proforma');
        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = ($start_dates[0]-1)."-04-01";
            foreach($this->csirlabs as $ck=>$cv){
                $proforma[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('proforma', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', $order_by_field='csirlabs_id', $order_by_sort='asc', $limit='');
            }
        }

        $startEndDate = $this->getStartEndDate('proforma');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('proforma', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'proforma';

        $data['proforma'] = $proforma;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'proforma';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/proforma';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addproforma($labid=''){
        if(isset($labid) && is_numeric($labid)){
            $lab_data = $this->login_model->get_table_data('csirlabs', $where=array('id'=>$labid,'status'=>'1'), $group_by='', '','', 1);
            $currentYear = date('Y');
            $data['start_date'] = date(($currentYear-1).'-04-01');
            $data['end_date'] = date($currentYear.'-03-31');
            $data['labid'] = $labid;
            $data['lab_name'] = $lab_data[0]['username'];
            $data['method_prefix'] = 'addproforma';
            $data['main_content'] = strtolower($this->router->fetch_class()).'/addproforma';
            $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
        }else{
            redirect('admin/proforma');
        }
    }

    public function submitproforma(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_proforma_entry');

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
        $this->form_validation->set_rules('document', 'Document', 'callback_file_check');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 

            $config['upload_path'] = './includes/images/documents/proforma/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000000; // 10MB max size
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {

                $upload_data = $this->upload->data();
                $document = 'document-proforma-'.$this->input->post('csirlabs_id').'-'.time(). substr($upload_data['file_ext'], 0);
                $new_path = './includes/images/documents/proforma/' . $document;
                
                // Rename the uploaded file
                rename($upload_data['full_path'], $new_path);

                $insertdata = array(
                    'csirlabs_id'                       => trim($this->input->post('csirlabs_id')),
                    'start_date'                        => date('Y-m-d', strtotime($this->input->post('start_date'))),
                    'end_date'                          => date('Y-m-d', strtotime($this->input->post('end_date'))),
                    'total_employees_group_a'           => html_escape($this->input->post('total_employees_group_a')),
                    'total_employed_group_a'            => html_escape($this->input->post('total_employed_group_a')),
                    'total_minority_employed_group_a'   => html_escape($this->input->post('total_minority_employed_group_a')),
                    'total_employees_group_b'           => html_escape($this->input->post('total_employees_group_b')),
                    'total_employed_group_b'            => html_escape($this->input->post('total_employed_group_b')),
                    'total_minority_employed_group_b'   => html_escape($this->input->post('total_minority_employed_group_b')),
                    'total_employees_group_c'           => html_escape($this->input->post('total_employees_group_c')),
                    'total_employed_group_c'            => html_escape($this->input->post('total_employed_group_c')),
                    'total_minority_employed_group_c'   => html_escape($this->input->post('total_minority_employed_group_c')),
                    'total_employees_group_d'           => html_escape($this->input->post('total_employees_group_d')),
                    'total_employed_group_d'            => html_escape($this->input->post('total_employed_group_d')),
                    'total_minority_employed_group_d'   => html_escape($this->input->post('total_minority_employed_group_d')),
                    'total_employees'                   => html_escape($this->input->post('total_employees')),
                    'total_employed'                    => html_escape($this->input->post('total_employed')),
                    'total_minority_employed'           => html_escape($this->input->post('total_minority_employed')),
                    'remarks'                           => html_escape($this->input->post('remarks')),
                    'document'                          => $document,
                    'added_by'                          => 'admin',
                    'updated_by'                        => 'admin',
                    'status'                            => '1'
                );
                
                $insert = $this->db->insert('proforma', $insertdata);

                if($insert){
                    $data['message'] = "15 point programme successfully submitted";
                    $data['category'] = "Success";
                }else{
                    $data['message'] = "Something went wrong. Please try again later";
                    $data['category'] = "error";
                }
            }else{
                $data['message'] = "Something went wrong. Please try again later";
                $data['category'] = "error";
            }
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

    /* 15 Point Programme data */

    /* Qualifying service */
    public function qualifyingservice(){
        $qualifyingservice = array();
        $end_dates = $this->getEndDates('qualifyingservice');
        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = ($start_dates[0])."-01-01";
            foreach($this->csirlabs as $ck=>$cv){
                $qualifyingservice[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('qualifyingservice', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', $order_by_field='csirlabs_id', $order_by_sort='asc', $limit='');
            }
        }

        $startEndDate = $this->getStartEndDate('qualifyingservice');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('qualifyingservice', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'qualifyingservice';

        $data['qualifyingservice'] = $qualifyingservice;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'qualifyingservice';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/qualifyingservice';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addqualifyingservice($labid=''){
        if(isset($labid) && is_numeric($labid)){
            $lab_data = $this->login_model->get_table_data('csirlabs', $where=array('id'=>$labid,'status'=>'1'), $group_by='', '','', 1);
            $previousYear = date('Y')-1;
            $data['start_date'] = $previousYear.'-01-01';
            $data['end_date'] = $previousYear.'-12-31';
            $data['labid'] = $labid;
            $data['lab_name'] = $lab_data[0]['username'];
            $data['method_prefix'] = 'addqualifyingservice';
            $data['main_content'] = strtolower($this->router->fetch_class()).'/addqualifyingservice';
            $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
        }else{
            redirect('admin/qualifyingservice');
        }
    }

    public function submitqualifyingservice(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_qualifyingservice_entry');
        $this->form_validation->set_rules('sanctioned_manpower', 'Sanctioned strength of manpower', 'trim|required');
        $this->form_validation->set_rules('manpower_in_position', 'Manpower in position', 'trim|required|callback_validate_manpower_in_position');
        $this->form_validation->set_rules('verified_employees', 'Number of employees whose service has been verified as per rules up to '.$this->input->post('end_date'), 'trim|required');
        $this->form_validation->set_rules('not_verified_employees', 'Number of employees whose service has not been verified up to '.$this->input->post('end_date'), 'trim|required');
        $this->form_validation->set_rules('non_verification_reason', 'Reason for non-verification of service', 'trim|callback_validate_non_verified_reason');
        $this->form_validation->set_rules('certification', 'Certified term', 'trim|required');
        $this->form_validation->set_rules('document', 'Document', 'callback_file_check');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 

            $config['upload_path'] = './includes/images/documents/qualifyingservice/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000000; // 10MB max size
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {

                $upload_data = $this->upload->data();
                $document = 'document-qualifyingservice-'.$this->input->post('csirlabs_id').'-'.time(). substr($upload_data['file_ext'], 0);
                $new_path = './includes/images/documents/qualifyingservice/' . $document;
                
                // Rename the uploaded file
                rename($upload_data['full_path'], $new_path);

                $insertdata = array(
                    'csirlabs_id'                       => trim($this->input->post('csirlabs_id')),
                    'start_date'                        => date('Y-m-d', strtotime($this->input->post('start_date'))),
                    'end_date'                          => date('Y-m-d', strtotime($this->input->post('end_date'))),
                    'sanctioned_manpower'               => html_escape($this->input->post('sanctioned_manpower')),
                    'manpower_in_position'              => html_escape($this->input->post('manpower_in_position')),
                    'verified_employees'                => html_escape($this->input->post('verified_employees')),
                    'not_verified_employees'            => html_escape($this->input->post('not_verified_employees')),
                    'non_verification_reason'           => html_escape($this->input->post('non_verification_reason')),
                    'remarks'                           => html_escape($this->input->post('remarks')),
                    'document'                          => $document,
                    'certification'                     => 'It is certified that entries related to verification of services in respect of all employees have been made in Part-V of their respective service books.',
                    'added_by'                          => 'admin',
                    'updated_by'                        => 'admin',
                    'status'                            => '1'
                );
                
                $insert = $this->db->insert('qualifyingservice', $insertdata);

                if($insert){
                    $data['message'] = "Qualifying service under the CCS (Pension) Rules, 2021 successfully submitted.";
                    $data['category'] = "Success";
                }else{
                    $data['message'] = "Something went wrong. Please try again later";
                    $data['category'] = "error";
                }
            }else{
                $data['message'] = "Something went wrong. Please try again later";
                $data['category'] = "error";
            }
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
    /* Qualifying service */

    /* Half Yearly Report */
    public function halfyearlyreport(){
        $halfyearlyreport = array();
        $end_dates = $this->getEndDates('halfyearlyreport');
        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = ($start_dates[0])."-0".($start_dates[1]-5)."-01";
            foreach($this->csirlabs as $ck=>$cv){
                $halfyearlyreport[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('halfyearlyreport', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', $order_by_field='csirlabs_id', $order_by_sort='asc', $limit='');
            }
        }

        $startEndDate = $this->getStartEndDate('halfyearlyreport');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('halfyearlyreport', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'halfyearlyreport';
        
        $data['halfyearlyreport'] = $halfyearlyreport;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'halfyearlyreport';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/halfyearlyreport';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addhalfyearlyreport($labid=''){
        if(isset($labid) && is_numeric($labid)){
            $lab_data = $this->login_model->get_table_data('csirlabs', $where=array('id'=>$labid,'status'=>'1'), $group_by='', '','', 1);
            $currentMonth = date('m');
            if($currentMonth>6){
                $data['start_date'] = date('Y').'-01-01';
                $data['end_date'] = date('Y').'-06-30';
            }else{
                $previousYear = date('Y') - 1;
                $data['start_date'] = $previousYear.'-07-01';
                $data['end_date'] = $previousYear.'-12-31';
            }
            $data['labid'] = $labid;
            $data['lab_name'] = $lab_data[0]['username'];
            $data['method_prefix'] = 'addhalfyearlyreport';
            $data['main_content'] = strtolower($this->router->fetch_class()).'/addhalfyearlyreport';
            $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
        }else{
            redirect('admin/halfyearlyreport');
        }
    }

    public function submithalfyearlyreport(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_halfyearlyreport_entry');

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
        $this->form_validation->set_rules('document', 'Document', 'callback_file_check');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 

            $classification_of_post = ['A','B','C (Including erstwhile Group D)'];

            $remarks = $this->input->post('remarks');

            $config['upload_path'] = './includes/images/documents/halfyearlyreport/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000000; // 10MB max size
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {

                $upload_data = $this->upload->data();
                $document = 'document-halfyearlyreport-'.$this->input->post('csirlabs_id').'-'.time(). substr($upload_data['file_ext'], 0);
                $new_path = './includes/images/documents/halfyearlyreport/' . $document;
                
                // Rename the uploaded file
                rename($upload_data['full_path'], $new_path);

                $insertdata = array(
                    'csirlabs_id'                                               => trim($this->input->post('csirlabs_id')),
                    'start_date'                                                => date('Y-m-d', strtotime($this->input->post('start_date'))),
                    'end_date'                                                  => date('Y-m-d', strtotime($this->input->post('end_date'))),
                    'classification_of_post'                                    => json_encode($classification_of_post),
                    'strength_of_personnel_total'                               => json_encode($this->input->post('strength_of_personnel_total')),
                    'strength_of_personnel_esm'                                 => json_encode($this->input->post('strength_of_personnel_esm')),
                    'total_number_of_direct_recruitment_vacancies_occurred_during_the'  => json_encode($this->input->post('total_number_of_direct_recruitment_vacancies_occurred_during_the')),
                    'total_direct_recruitment'                                  => json_encode($this->input->post('total_direct_recruitment')),
                    'direct_recruitment_vacancies_reserved_for_esm'             => json_encode($this->input->post('direct_recruitment_vacancies_reserved_for_esm')),
                    'no_of_direct_recruitment_vacancies_filled_total'           => json_encode($this->input->post('no_of_direct_recruitment_vacancies_filled_total')),
                    'no_of_direct_recruitment_vacancies_filled_esm'             => json_encode($this->input->post('no_of_direct_recruitment_vacancies_filled_esm')),
                    'shortfall_in_filling_the_vacancies'                        => json_encode($this->input->post('shortfall_in_filling_the_vacancies')),
                    'overall_strength_total'                                    => json_encode($this->input->post('overall_strength_total')),
                    'overall_strength_esm'                                      => json_encode($this->input->post('overall_strength_esm')),
                    'percentage_of_esm'                                         => json_encode($this->input->post('percentage_of_esm')),
                    'reason_for_shortfall'                                      => json_encode($this->input->post('reason_for_shortfall')),
                    'remarks'                                                   => $remarks,
                    'document'                                                  => $document,
                    'added_by'                                                  => 'admin',
                    'updated_by'                                                => 'admin',
                    'status'                                                    => '1'
                );
                
                $insert = $this->db->insert('halfyearlyreport', $insertdata);

                if($insert){
                    $data['message'] = "Half yearly report successfully submitted.";
                    $data['category'] = "Success";
                }else{
                    $data['message'] = "<p>Something went wrong. Please try again later.</p>";
                    $data['category'] = "error";
                }
            }else{
                $data['message'] = "Something went wrong. Please try again later";
                $data['category'] = "error";
            }
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
    /* Half Yearly Report */

    /* Mission Mode Recruitment */
    public function mmr(){
        $mmr = array();
        $end_dates = $this->getEndDates('mmr');
        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = $start_dates[0]."-".$start_dates[1]."-01";
            foreach($this->csirlabs as $ck=>$cv){
                $mmr[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('mmr', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', $order_by_field='csirlabs_id', $order_by_sort='asc', $limit='');
            }
        }

        $startEndDate = $this->getStartEndDate('mmr');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('mmr', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'mmr';
        
        $data['mmr'] = $mmr;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'mmr';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/mmr';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addmmr($labid=''){
        if(isset($labid) && is_numeric($labid)){
            $lab_data = $this->login_model->get_table_data('csirlabs', $where=array('id'=>$labid,'status'=>'1'), $group_by='', '','', 1);
            $data['labid'] = $labid;
            $data['lab_name'] = $lab_data[0]['username'];

            $today = new DateTime();
            $firstDayOfCurrentMonth = new DateTime('first day of ' . $today->format('F Y'));
            $firstDayOfPreviousMonth = $firstDayOfCurrentMonth->modify('-1 month');
            $lastDayOfPreviousMonth = new DateTime('last day of ' . $firstDayOfPreviousMonth->format('F Y'));
            $data['start_date'] = $firstDayOfPreviousMonth->format('Y-m-d');
            $data['end_date'] = $lastDayOfPreviousMonth->format('Y-m-d');

            $data['method_prefix'] = 'addmmr';
            $data['main_content'] = strtolower($this->router->fetch_class()).'/addmmr';
            $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
        }else{
            redirect('admin/mmr');
        }
    }

    public function submitmmrform(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('csirlabs_id', 'CSIR Lab ID', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|required|callback_validate_old_mmr_entry');

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
        $this->form_validation->set_rules('document', 'Document', 'callback_file_check');
        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 
            
            $config['upload_path'] = './includes/images/documents/mmr/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 10000000; // 10MB max size
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('document')) {

                $upload_data = $this->upload->data();
                $document = 'document-mmr-'.$this->input->post('csirlabs_id').'-'.time(). substr($upload_data['file_ext'], 0);
                $new_path = './includes/images/documents/mmr/' . $document;
                
                // Rename the uploaded file
                rename($upload_data['full_path'], $new_path);

                $appointdate = array();
                foreach($this->input->post('appointdate') as $key=>$value){
                    $appointdate[] = date('Y-m-d', strtotime($value));
                }
                
                $insertdata = array(
                    'csirlabs_id'           => trim($this->input->post('csirlabs_id')),
                    'start_date'            => date('Y-m-d', strtotime($this->input->post('start_date'))),
                    'end_date'              => date('Y-m-d', strtotime($this->input->post('end_date'))),
                    'taskcode'              => json_encode($this->input->post('taskcode')),
                    'name'                  => json_encode($this->input->post('name')),
                    'gender'                => json_encode($this->input->post('gender')),
                    'email'                 => json_encode($this->input->post('email')),
                    'mobile_number'         => json_encode($this->input->post('mobile_number')),
                    'designation'           => json_encode($this->input->post('designation')),
                    'paylevel'              => json_encode($this->input->post('paylevel')),
                    'groupcode'             => json_encode($this->input->post('groupcode')),
                    'categorycode'          => json_encode($this->input->post('categorycode')),
                    'appointorderno'        => json_encode($this->input->post('appointorderno')),
                    'appointdate'           => json_encode($appointdate),
                    'remarks'               => json_encode($this->input->post('remarks')),
                    'document'              => $document,
                    'added_by'              => 'admin',
                    'updated_by'            => 'admin',
                    'status'                => '1'
                );
                
                $insert = $this->db->insert('mmr', $insertdata);

                if($insert){
                    $data['message'] = "Mission Mode Recruitment successfully submitted.";
                    $data['category'] = "Success";
                }else{
                    $data['message'] = "Something went wrong. Please try again later";
                    $data['category'] = "error";
                }
            }else{
                $data['message'] = "Something went wrong. Please try again later";
                $data['category'] = "error";
            }
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
    /* Mission Mode Recruitment */

    /* Annexure-III Start */
    public function annexure3(){
        $annexure3 = array();
        $end_dates = $this->getEndDates('annexure3');

        foreach($end_dates as $key=>$value){
            $start_dates = explode('-', $value->end_date);
            $start_date = $start_dates[0]."-01-01";
            foreach($this->csirlabs as $ck=>$cv){
                $annexure3[$start_date."@@".$value->end_date][$cv['id']] = $this->login_model->get_table_data('annexure3', $where=array('status'=>'1', 'start_date'=>$start_date, 'end_date'=>$value->end_date, 'csirlabs_id'=>$cv['id']), $group_by='', $order_by_field='csirlabs_id', $order_by_sort='asc', $limit='');
            }
        }

        $startEndDate = $this->getStartEndDate('annexure3');
        $submission_start_date = $startEndDate['start_date'];
        $submission_end_date = $startEndDate['end_date'];

        $freezingdates = $this->getFreezingDate('annexure3', $submission_end_date);

        $data['submission_start_date'] = $submission_start_date;
        $data['submission_end_date'] = $submission_end_date;
        $data['default_freezing_date'] = $freezingdates['default_freezing_date'];
        $data['freezing_date'] = date('d-m-Y', strtotime($freezingdates['freezing_date']));
        $data['max_freezing_date'] = $freezingdates['max_freezing_date'];
        $data['freezing_type'] = 'annexure3';
        
        $data['annexure3'] = $annexure3;
        $data['end_dates'] = $end_dates;
        $data['method_prefix'] = 'annexure3';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/annexure3';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }
    /* Annexure-III End */

    /* Custom form section */

    public function customforms(){
        $data['customforms'] = $this->login_model->get_all_table_data_row('customforms');
        $data['csirlabs'] = $this->csirlabs;
        $data['main_content'] = strtolower($this->router->fetch_class()).'/customforms';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function addcustomform(){
        $data['method_prefix'] = 'addcustomform';
        $data['main_content'] = strtolower($this->router->fetch_class()).'/addcustomform';
        $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
    }

    public function submitcustomform(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('customform-entry-start-date', 'Form entry start date', 'trim|required|callback_validate_customform_entry_start_date');
        $this->form_validation->set_rules('customform-entry-end-date', 'Form entry end date', 'trim|required|callback_validate_customform_entry_end_date');
        $this->form_validation->set_rules('fieldlabel[]', 'Field Label', 'trim|required');
        $this->form_validation->set_rules('fieldtype[]', 'Field Type', 'trim|required');
        $this->form_validation->set_rules('required[]', 'Field Type', 'trim|required');
        $this->form_validation->set_rules('fieldwidth[]', 'Field Width', 'trim|required');
        $this->form_validation->set_rules('options[]', 'Options', 'callback_validate_options');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 
            
            $fields = array();

            for($i=0;$i<count($this->input->post('fieldlabel'));$i++){
                $field = array();
                $field['fieldtitle'] = 'field_'.$i;
                $field['fieldlabel'] = $this->input->post('fieldlabel')[$i];
                $field['fieldtype'] = $this->input->post('fieldtype')[$i];
                $field['minlength'] = $this->input->post('minlength')[$i];
                $field['maxlength'] = $this->input->post('maxlength')[$i];
                $field['required'] = $this->input->post('required')[$i];
                $field['fieldwidth'] = $this->input->post('fieldwidth')[$i];
                if($this->input->post('fieldtype')[$i] == 'Dropdown' || $this->input->post('fieldtype')[$i] == 'Radio Button' || $this->input->post('fieldtype')[$i] == 'Checkbox'){
                    $field['options'] = $this->input->post('options')[$i];
                }else{
                    $field['options'] = array();
                }
                
                $fields[] = $field;
            }

            $insertdata = array(
                'title'                         => html_escape($this->input->post('title')),
                'description'                   => html_escape($this->input->post('description')),
                'form-entry-start-date'         => date('Y-m-d', strtotime($this->input->post('customform-entry-start-date'))),
                'form-entry-end-date'           => date('Y-m-d', strtotime($this->input->post('customform-entry-end-date'))),
                'fields'                        => json_encode($fields),
                'added_by'                      => 'admin',
                'updated_by'                    => 'admin',
                'status'                        => '1'
            );
            
            $insert = $this->db->insert('customforms', $insertdata);

            if($insert){
                $data['message'] = "You have successfully added a new custom form";
                $data['category'] = "Success";
            }else{
                $data['message'] = "Something went wrong. Please try again later";
                $data['category'] = "error";
            }
        }
        echo json_encode($data);
    }

    public function validate_customform_entry_start_date($value){
        $givenDate = date('Y-m-d', strtotime($this->input->post('customform-entry-start-date')));

        $currentDate = date('Y-m-d');

        if($givenDate >= $currentDate){
            return true;
        } else {
            $this->form_validation->set_message('validate_customform_entry_start_date', 'Start date should be from today onwards');
            return false;
        }
    }

    public function validate_customform_entry_end_date($value){
        $givenDate = date('Y-m-d', strtotime($this->input->post('customform-entry-end-date')));

        $currentDate = date('Y-m-d');

        if($givenDate > $currentDate){
            return true;
        } else {
            $this->form_validation->set_message('validate_customform_entry_end_date', 'End date should be from tomorrow onwards');
            return false;
        }
    }

    public function validate_options($value){

        $fieldtype = $this->input->post('fieldtype');

        foreach($fieldtype as $key=>$value){

            if($value == 'Dropdown' || $value == 'Radio Button' || $value == 'Checkbox'){
                if(isset($this->input->post('options')[$key])){
                    $options = $this->input->post('options')[$key];
                    if(count($options)<2){
                        $this->form_validation->set_message('validate_options', 'Each '.$value.' should have at least two options');
                        return false;
                    }else{
                        foreach($options as $k=>$v){
                            if($v == ''){
                                $this->form_validation->set_message('validate_options', 'Each option should have a value');
                                return false;
                            }
                        }
                    }
                }else{
                    $this->form_validation->set_message('validate_options', 'Each '.$value.' should have at least two options');
                    return false;
                }
            }
        }

        return true;
    }

    public function editcustomform($id=''){
        if(isset($id) && is_numeric($id)){
            $form = $this->login_model->get_table_data('customforms', $where=array('id'=>$id), $group_by='', '','', 1);
            if(empty($form)){
                redirect('admin/customforms');
            }else{
                $start_date = date('Y-m-d', strtotime($form[0]['customform-entry-start-date']));

                $currentDate = new DateTime();
                $givenDate = new DateTime($start_date);

                if($givenDate > $currentDate){
                    $data['method_prefix'] = 'editcustomform';
                    $data['forms'] = $form;
                    $data['main_content'] = strtolower($this->router->fetch_class()).'/editcustomform';
                    $this->load->view(strtolower($this->router->fetch_class()).'/include/template', $data);
                } else {
                    redirect('admin/customforms');
                }
            }
        }else{
            redirect('admin/customforms');
        }
    }

    public function submiteditcustomform(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|html_escape');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean|html_escape');
        $this->form_validation->set_rules('customform-entry-start-date', 'Form entry start date', 'trim|required|callback_validate_customform_entry_start_date|xss_clean|html_escape');
        $this->form_validation->set_rules('customform-entry-end-date', 'Form entry end date', 'trim|required|callback_validate_customform_entry_end_date|xss_clean|html_escape');
        $this->form_validation->set_rules('fieldlabel[]', 'Field Label', 'trim|required|xss_clean|html_escape');
        $this->form_validation->set_rules('fieldtype[]', 'Field Type', 'trim|required|xss_clean|html_escape');
        $this->form_validation->set_rules('required[]', 'Field Type', 'trim|required|xss_clean|html_escape');
        $this->form_validation->set_rules('fieldwidth[]', 'Field Width', 'trim|required|xss_clean|html_escape');
        $this->form_validation->set_rules('options[]', 'Options', 'callback_validate_options|xss_clean|html_escape');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 
            
            $fields = array();

            for($i=0;$i<count($this->input->post('fieldlabel'));$i++){
                $field = array();
                $field['fieldtitle'] = 'field_'.$i;
                $field['fieldlabel'] = $this->input->post('fieldlabel')[$i];
                $field['fieldtype'] = $this->input->post('fieldtype')[$i];
                $field['minlength'] = $this->input->post('minlength')[$i];
                $field['maxlength'] = $this->input->post('maxlength')[$i];
                $field['required'] = $this->input->post('required')[$i];
                $field['fieldwidth'] = $this->input->post('fieldwidth')[$i];
                if($this->input->post('fieldtype')[$i] == 'Dropdown' || $this->input->post('fieldtype')[$i] == 'Radio Button' || $this->input->post('fieldtype')[$i] == 'Checkbox'){
                    $field['options'] = $this->input->post('options')[$i];
                }else{
                    $field['options'] = array();
                }
                
                $fields[] = $field;
            }

            $whereArray = array(
                                    'id' =>  $this->input->post('form-id')
                                );

            $updateArray = array(
                'title'                         => html_escape($this->input->post('title')),
                'description'                   => html_escape($this->input->post('description')),
                'form-entry-start-date'         => date('Y-m-d', strtotime($this->input->post('customform-entry-start-date'))),
                'form-entry-end-date'           => date('Y-m-d', strtotime($this->input->post('customform-entry-end-date'))),
                'fields'                        => json_encode($fields),
                'added_by'                      => 'admin',
                'updated_by'                    => 'admin',
                'status'                        => '1'
            );

            $query = $this->login_model->update_database_table('customforms', $updateArray, $whereArray);

            if($query){
                $data['category'] = 'Success';
                $data['message'] = "Form successfully updated";
                $data['formid'] = $this->input->post('form-id');
            }else{
                $data['message'] = '<p>You have not made any change</p>';
                $data['category'] = 'error';    
            }
        }
        echo json_encode($data);
    }

    public function changecustomformenddate(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('date', 'Form entry end date', 'trim|required|xss_clean');

        if($this->form_validation->run() === false){
            $data['message'] = validation_errors();
            $data['category'] = "validation error";
        }else{ 
            

            $whereArray = array(
                                    'id' =>  $this->input->post('id')
                                );

            $updateArray = array(
                                    'form-entry-end-date' =>  date('Y-m-d', strtotime($this->input->post('date')))
                                );

            $query = $this->login_model->update_database_table('forms', $updateArray, $whereArray);

            if($query){
                $data['category'] = 'Success';
                $data['message'] = "Form entry data successfully updated";
            }else{
                $data['message'] = '<p>You have not made any change</p>';
                $data['category'] = 'error';    
            }
        }
        echo json_encode($data);
    }

    /* Custom form section */
}
