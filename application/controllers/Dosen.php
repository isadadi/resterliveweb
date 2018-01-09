<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
		cek_user();
		cek_admin2();
	}

	public function index()
	{	
		$data['title'] = "Data Dosen";
		$data['dosen'] = $this->general_model->select_by_id("rl_dosen",'prodi_id',$this->session->userdata('rl_prodi'),'dosen_name')->result_array();		
		$this->load->view('templates/header', $data);
		$this->load->view('dosen');		
		$this->load->view('templates/footer');
		$this->load->view('dosen_script');
	}

	function get_dosen($id){
		$fak = $this->general_model->select_by_id('rl_dosen','dosen_id',$id)->row_array();
		header("Content-type:application/json");
		echo json_encode($fak);
	}

	function ajax_dosen(){
			$data['dosen'] = $this->general_model->select_by_id("rl_dosen",'prodi_id',$this->session->userdata('rl_prodi'),'dosen_name')->result_array();		
		$this->load->view('dosen_ajax',$data);
		$this->load->view('dosen_script');

	}


function edit(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$nip = $this->input->post('dosen_nip');
			$name = $this->input->post('dosen_name');
			$kode = $this->input->post('dosen_kode');
			$data = array(
				'dosen_nip' => $nip,
				'dosen_name' => $name,
				'dosen_kode' => $kode,
				'prodi_id' => $this->session->userdata('rl_prodi')
				);
			if($this->general_model->update('rl_dosen','dosen_id',$id,$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}


function hapus(){
		$id = $this->input->post('id');
		if($this->general_model->delete('rl_dosen','dosen_id',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}

	function tambah(){
		if(isset($_POST['submit'])){
			$nip = $this->input->post('dosen_nip');
			$name = $this->input->post('dosen_name');
			$kode = $this->input->post('dosen_kode');
			$data = array(
				'dosen_nip' => $nip,
				'dosen_name' => $name,
				'dosen_kode' => $kode,
				'prodi_id' => $this->session->userdata('rl_prodi')
				);
			if($this->general_model->insert('rl_dosen',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
}
