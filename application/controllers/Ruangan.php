<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
		cek_user();
		cek_admin2();
	}

	public function index()
	{
		$data['title'] = "Ruangan";
		$data['ruangan'] = $this->general_model->select_by_id("rl_ruangan",'prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('ruangan');		
		$this->load->view('templates/footer');
		$this->load->view('ruangan_script');
	}

	function ajax_ruangan(){
		$data['ruangan'] = $this->general_model->select_by_id("rl_ruangan",'prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$this->load->view('ruangan_ajax',$data);
		$this->load->view('ruangan_script');	
	}

	function get_ruang($id){		
		$fak = $this->general_model->select_by_id('rl_ruangan','id_ruangan',$id)->row_array();
		header("Content-type:application/json");
		echo json_encode($fak);
	}

	function hapus(){
		$id = $this->input->post('id');
		if($this->general_model->delete('rl_ruangan','id_ruangan',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}


	function tambah(){
		if(isset($_POST['submit'])){
			$data = array(
				'nama_ruangan' => $this->input->post('nama'),
				'prodi_id' => $this->session->userdata('rl_prodi')
			);
			if($this->general_model->insert('rl_ruangan',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}

	function edit(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');			
			$data = array(
				'nama_ruangan' => $this->input->post('nama'),
				'prodi_id' => $this->session->userdata('rl_prodi')
			);
			if($this->general_model->update('rl_ruangan','id_ruangan',$id,$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
}