<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model(array('general_model'),'',true);		
		cek_user();
		cek_admin2();
	}


	function index(){
		$data['title'] = "Jadwal Libur";
		$data['libur'] = $this->general_model->select_by_id('rl_tanggal_libur','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('libur');		
		$this->load->view('templates/footer');
		$this->load->view('libur_script');
	}


	function ajax_libur(){
		$data['libur'] = $this->general_model->select_by_id('rl_tanggal_libur','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$this->load->view('libur_ajax',$data);
		$this->load->view('libur_script');

	}


	function tambah(){
		if(isset($_POST['submit'])){
			$tgl1 = $this->input->post('tgl_mulai');
			$tgl2 = $this->input->post('tgl_selesai');
			$ket = $this->input->post('keterangan');
			$data = array(
				'libur_tgl_mulai' => $tgl1,
				'libur_tgl_selesai' => $tgl2,
				'libur_keterangan' => $ket,
				'prodi_id' => $this->session->userdata('rl_prodi')
				);
			if($this->general_model->insert('rl_tanggal_libur',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}

	function get_libur($id){
		$fak = $this->general_model->select_by_id('rl_tanggal_libur','libur_id',$id)->row_array();
		header("Content-type:application/json");
		echo json_encode($fak);
	}

	function edit(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('libur_id');
			$tgl1 = $this->input->post('tgl_mulai');
			$tgl2 = $this->input->post('tgl_selesai');
			$ket = $this->input->post('keterangan');
			$data = array(
				'libur_tgl_mulai' => $tgl1,
				'libur_tgl_selesai' => $tgl2,
				'libur_keterangan' => $ket,				
				);
			if($this->general_model->update('rl_tanggal_libur','libur_id',$id,$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}


	function delete(){
		$id = $this->input->post('id');
		if($this->general_model->delete('rl_tanggal_libur','libur_id',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}

}