<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);
		cek_user2();
	}

	public function index()
	{
	
		if(isset($_POST['submit'])){
			$us = $this->input->post('username');
			$ps = $this->input->post('password');
			$user = $this->general_model->select_by_id('rl_user','user_uname',$us);
			if($user->num_rows()>0){
				$userr = $user->row_array();
				if(cek_login($ps, $userr['user_password'])){
					$this->session->set_userdata('rl_username',$us);
					$this->session->set_userdata('rl_role',$userr['user_role_id']);
					$this->session->set_userdata('rl_prodi',$userr['id_prodi']);
					if($this->session->userdata('rl_role')==1)
						echo "1";
					else if($this->session->userdata('rl_role')==2)
						echo "2";
				}else{
					echo "0";
				}

			}else{
				echo "0";
			}
		}
		else{
			$this->load->view('login');
		}

	}
}
