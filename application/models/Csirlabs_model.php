<?php

class Csirlabs_model extends CI_model{

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

    public function getheadquarterposts() {
			// Using Query Builder to join tables
			$this->db->select('
				hp.id,
					hp.posts,
					d.designation AS designation,
					pl.paylevel AS paylevel,
					c.name AS category,
					sc.name AS subcategory,
					g.name AS gender,
					hp.added_date,
					hp.added_by,
					hp.updated_date,
					hp.updated_by,
					hp.status
			');
			
			$this->db->from('headquarterposts hp');
			$this->db->join('paylevel pl', 'hp.paylevel = pl.id', 'left');
			$this->db->join('categories c', 'hp.category = c.category_key', 'left');
			$this->db->join('subcategories sc', 'hp.subcategory = sc.category_key', 'left');
			$this->db->join('genders g', 'hp.gender = g.id', 'left');

			$query = $this->db->get();
			$results = $query->result_array();
			return $results;
    }
}
