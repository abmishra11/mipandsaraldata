<?php

class Niscairadmin_model extends CI_model{

	public function validateuser($table,$username_field,$password_field,$username_column,$password_column){
		$this->db->select('username');
		$this->db->where($username_column,$this->input->post($username_field));
		$this->db->where($password_column,md5($this->input->post($password_field)));
		$query = $this->db->get_where($table, array('status' => '1'));
		if($query->num_rows() == 1){
			return $query;
		}else{
			return false;
		}
	}

	public function get_table_count($table,$wherearray=array()) {
		$this->db->select('count(*) as allcount');
		$this->db->from($table);
		$this->db->where($wherearray);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
}
