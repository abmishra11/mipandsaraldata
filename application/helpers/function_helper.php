<?php
/**
 * @package	CodeIgniter
 * @author	Abhay Kumar Mishra
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('p'))
{
	function p($id){
		echo "<pre>";
		print_r($id);
		echo "</pre>";exit;
	}
}

if ( ! function_exists('redirect_with_alert'))
{
	function redirect_with_alert($message, $location){
?>
		<script type = "text/javascript">
			alert("<?php echo $message;?>");
			window.location.href="<?php echo $location;?>";
		</script>
<?php

	exit();

	}
}

if ( ! function_exists('alert'))
{
	function alert($message){
?>
	<script type = "text/javascript">
		alert("<?php echo $message;?>");
	</script>
<?php

	exit();

	}
}

function array_to_csv_download($array, $filename = "ctoreport.csv", $delimiter=",") {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    $f = fopen('php://output', 'w');

    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
} 

if ( ! function_exists('getipaddress')){
	function getipaddress(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			//ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//ip pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

if ( ! function_exists('getlabdata')){
	function getlabdata($csirlabs_id){
	    $ci = &get_instance(); 
	    $ci->load->database(); 
		$ci->db->select('*');
		$ci->db->from('csirlabs');
		$ci->db->where(array('id'=>$csirlabs_id));
		$query = $ci->db->get();
		$lab = $query->result_array();
		return $lab;
	}
}