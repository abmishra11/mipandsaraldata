<?php

class Login_model extends CI_model{

	public function validate(){
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',$this->input->post('password'));
		$query = $this->db->get_where('user', array('is_active' => '1'));

		if($query->num_rows() == 1){
			return $query;
		}else{
			return false;
		}
	}
	
	public function validate_admin(){
		$this->db->where('Username',$this->input->post('Username'));
		$this->db->where('Password',$this->input->post('Password'));
		$query = $this->db->get('admin');

		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function validateisaadmin(){
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get_where('isauser', array('status' => '1'));
		if($query->num_rows() == 1){
			return $query;
		}else{
			return false;
		}
	}

	public function validateuser($table,$username_field,$password_field,$username_column,$password_column){
		$this->db->where($username_column,$this->input->post($username_field));
		$this->db->where($password_column,md5($this->input->post($password_field)));
		$query = $this->db->get_where($table, array('status' => '1'));
		if($query->num_rows() == 1){
			return $query;
		}else{
			return false;
		}
	}
	
	public function get_table_data($table, $where=array(), $group_by='', $order_by_field='', $order_by_sort='', $limit=''){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		if($order_by_field != ''){
			$this->db->order_by($order_by_field,$order_by_sort);
		}
		if($group_by != ''){
			$this->db->group_by($group_by);
		}
		if($limit != ''){
				$this->db->limit($limit);
		}
		$query = $this->db->get();
		$results = $query->result_array();
		return $results;
	}

	public function get_table_data_limit_start_end($table, $where=array(), $group_by='', $order_by_field='', $order_by_sort='', $limit='',$start=''){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		if($order_by_field != ''){
			$this->db->order_by($order_by_field,$order_by_sort);
		}
		if($group_by != ''){
			$this->db->group_by($group_by);
		}

		$this->db->limit($limit, $start);
		
		$query = $this->db->get();
		$results = $query->result_array();
		return $results;
	}

	public function get_id_by_text($table,$where){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$results = $query->result_array();
		return $results[0]['id'];
	}

	public function get_text_by_id($table,$where,$column){
		$this->db->select($column);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		$results = $query->result_array();
		return $results[0][$column];
	}

	public function get_data_by_full_like_text($table,$like_array){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where(array('status'=>'1'));
		$this->db->like($like_array);
		$query = $this->db->get();
		$results = $query->result_array();
		return $results;
	}

	public function get_search_result($where, $table, $order_by_field, $sort){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$this->db->where(array('status'=>'1'));
		$this->db->order_by($order_by_field, $sort);
		$query = $this->db->get();
		$results = $query->result_array();
		return $results;
	}

	public function get_table_data_by_different_fields($table_name, $associative_fields_array){
		$query = $this->db->get_where($table_name, $associative_fields_array);
		return $query->result_array();
	}

	public function get_report_by_different_fields($table_name, $associative_fields_array){
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get_where($table_name, $associative_fields_array);
		return $query;
	}

	public function get_all_table_data_row($table_name){
		$this->db->select("*");
		$this->db->from($table_name);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_table_data_row_by_limit($table_name, $limit){
		$this->db->select("*");
		$this->db->from($table_name);
		$this->db->limit($limit); 
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_database_table($tableName, $updateArray, $whereArray){
		$this->db->where($whereArray);
		$this->db->update($tableName, $updateArray);
		if($this->db->affected_rows() == 0){
		  return false;
		}else{
		  return true;
		}
	}

	public function insert_data_in_table($tableName, $dataArray){
		$this->db->insert($tableName, $dataArray);

		if($this->db->affected_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function insert_data_with_inserted_id($tableName, $dataArray){
		$this->db->insert($tableName, $dataArray);

		if($this->db->affected_rows() == 1){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function delete_data_from_table($tableName, $whereArray){
		$this->db->delete($tableName, $whereArray);
	}
	
	public function get_single_column_record_from_table($columnName, $tableName){
		$this->db->select($columnName);
		$this->db->from($tableName);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_single_column_record_from_table_with_where($columnName, $tableName,$whereArray){
		$this->db->select($columnName);
		$this->db->from($tableName);
		$this->db->where($whereArray);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getData($table, $rowno,$rowperpage) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($rowperpage, $rowno);  
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getcount($table,$usertype) {
		$this->db->select('count(*) as allcount');
		$this->db->from($table);
		$this->db->where(array('admin_type'=>$usertype));
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}

	public function get_table_count($table,$wherearray=array()) {
		$this->db->select('count(*) as allcount');
		$this->db->from($table);
		$this->db->where($wherearray);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}

	public function getrows($table, $rowno,$rowperpage) {

	}

	public function get_articles_pagination_data($rowperpage,$offset) {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->where(array('status'=>'1','category'=>'1'));
		$this->db->limit($rowperpage, $offset);  
		$this->db->order_by('updated_date','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_authors_id() {
		$this->db->select('id');
		$this->db->from("authors");
		$this->db->where(array('status'=>'1'));
		$this->db->like('author_name',trim($_POST['advance-search-author']));
		$query = $this->db->get();
		$results = $query->result_array();
		$author_id_array = array();
		foreach($results as $key=>$value){
			$author_id_array[] = $value['id'];
		}
		return $author_id_array;
	}
}
