<?php if(!defined('BASEPATH')) exit('No direct access allowed');

function cek_login($pass,$pass2){
		for($i=0;$i<73;$i++){
			$pass = md5($pass);	
			$pass = base64_encode($pass);		
			$pass = md5($pass);
		}
		$hased_pass = password_verify($pass, $pass2);
		if($hased_pass == $pass)
			return 1;
		else
			return 0;
	}

	function sort_by_order ($a, $b)
	{
	    return $a->jam_matkul - $b->jam_matkul;
	}


function cek_user2(){
	$CI =& get_instance();
	if($CI->session->userdata('rl_role')==1)
		redirect("fakultas");
	else if($CI->session->userdata('rl_role')==2)
		redirect("dosen");

	echo $CI->session->userdata('rl_role');
}

function set_pass($pass){
	for($i=0;$i<73;$i++){
		$pass = md5($pass);
		$pass = base64_encode($pass);		
		$pass = md5($pass);
		}
		$hased_pass = password_hash($pass, PASSWORD_BCRYPT);
		return $hased_pass;
	}


	function cek_user(){
		$CI =& get_instance();

		if($CI->session->userdata('rl_username')=='')
			echo "<script>window.location.replace('".base_url('login')."')</script>";
	}

	function cek_admin2(){
		$CI =& get_instance();
		if($CI->session->userdata('rl_role')!=2)
			echo "<script>window.location.replace('".base_url('login')."')</script>";
	}

	function cek_admin1(){
		$CI =& get_instance();
		if($CI->session->userdata('rl_role')!=1)
			echo "<script>window.location.replace('".base_url('login')."')</script>";
	}


	function send_notification(){
		$CI =& get_instance();
		$CI->load->model('General_model');
		$nim = $CI->general_model->get_mahasiswa_notif($matkul,$kom)->result_array();
		
	}
