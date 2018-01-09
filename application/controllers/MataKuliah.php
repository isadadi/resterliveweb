<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataKuliah extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
		cek_user();
		cek_admin2();
	}

	public function index()
	{
		$data['title'] = "Mata Kuliah";
		$data['matkul'] = $this->general_model->select_by_id("rl_mata_kuliah",'prodi_id',$this->session->userdata('rl_prodi'),'mat_kul_name')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('mata_kuliah');		
		$this->load->view('templates/footer');
		$this->load->view('mata_kuliah_script');
	}

	function ajax_matkul(){
			$data['matkul'] = $this->general_model->select_by_id("rl_mata_kuliah",'prodi_id',$this->session->userdata('rl_prodi'),'mat_kul_name')->result_array();
		$this->load->view('mata_kuliah_ajax',$data);
		$this->load->view('mata_kuliah_script');

	}

	function edit(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('matkul_id');
			$data = array(
				'mat_kul_id' => $this->input->post('matkul_id'),
				'mat_kul_name' => $this->input->post('matkul_name'),
				'mat_kul_type' => $this->input->post('matkul_type2'),
				'mat_kul_sks' => $this->input->post('matkul_sks'),
				'prodi_id' => $this->session->userdata('rl_prodi'),
				'mat_semester' => $this->input->post('matkul_semester')
			);
			if($this->general_model->update('rl_mata_kuliah','mat_kul_id',$id,$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}

	function hapus(){
		$id = $this->input->post('id');
		if($this->general_model->delete('rl_mata_kuliah','mat_kul_id',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}


	function get_matkul($id){		
		$fak = $this->general_model->select_by_id('rl_mata_kuliah','mat_kul_id',$id)->row_array();
		header("Content-type:application/json");
		echo json_encode($fak);
	}

	function tambah(){
		if(isset($_POST['submit'])){
			$data = array(
				'mat_kul_id' => $this->input->post('matkul_id'),
				'mat_kul_name' => $this->input->post('matkul_name'),
				'mat_kul_type' => $this->input->post('matkul_type'),
				'mat_kul_sks' => $this->input->post('matkul_sks'),
				'prodi_id' => $this->session->userdata('rl_prodi'),
				'mat_semester' => $this->input->post('matkul_semester')
			);
			if($this->general_model->insert('rl_mata_kuliah',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
}
