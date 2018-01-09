<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
	}


	function index(){
		$this->session->set_userdata('rl_username');
		$this->session->set_userdata('rl_role');
		$this->session->set_userdata('rl_prodi');
		redirect("login");
	}

}