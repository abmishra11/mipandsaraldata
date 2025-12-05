<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$CI = & get_instance();
if($CI->sess_language && $CI->sess_language != 'English'){
	$table = 'kt_website_subheading';
		$CI->db->select('kt_website_heading.kt_heading_keys as kt_heading_keys
					, kt_website_subheading.kt_name_hindi as kt_name');
			$CI->db->join($table,'kt_website_heading.kt_website_heading_id = kt_website_subheading.kt_website_heading_id');
}
$all_data = $CI->db->get("kt_website_heading")->result_array();
if($all_data){
	foreach ($all_data as $key => $items) {
		$lang[$items["kt_heading_keys"]] = $items["kt_name"];
	}			
}

