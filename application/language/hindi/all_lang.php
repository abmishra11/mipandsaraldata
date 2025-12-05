<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$CI = & get_instance();

if($CI->sess_language && $CI->sess_language != 'english'){
	$table = 'kt_lang_sub_label';
		$CI->db->select('kt_label.kt_label_name
						,kt_lang_sub_label.kt_sub_lang_name as kt_label_value');
		$CI->db->join($table,'kt_lang_sub_label.kt_label_id = kt_label.kt_label_id');
}
$result = $CI->db->get_where('kt_label')->result_array();

if($result){
	foreach($result as $line){
		$lang[$line['kt_label_name']] = $line['kt_label_value'];
	}
}
