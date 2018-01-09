<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
		cek_user();
		cek_admin1();
	}

	public function index()
	{
		$data['title'] = "Data Prodi";
		$data['prodi'] = $this->general_model->get_join('rl_prodi','rl_fakultas','fakultas_id')->result_array();
		$data['fakultas'] = $this->general_model->select('rl_fakultas')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('prodi');	
		$this->load->view('templates/footer');
		$this->load->view('prodi_script');
	}

	function get_prodi($id){
		$fak = $this->general_model->select_by_id('rl_prodi','prodi_id',$id)->row_array();
		header("Content-type:application/json");
		echo json_encode($fak);
	}

	function tambah(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$id_fak = $this->input->post('id_fak');
			$data = array(
				'prodi_id' => $id,
				'prodi_name' => $name,
				'fakultas_id' => $id_fak				
				);
			if($this->general_model->insert('rl_prodi',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}

	function edit(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$id_fak = $this->input->post('id_fak');
			$data = array(
				'prodi_id' => $id,
				'prodi_name' => $name,
				'fakultas_id' => $id_fak
				);
			if($this->general_model->update('rl_prodi','prodi_id',$id,$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}


	function ajax_prodi(){
		$data['prodi'] = $this->general_model->get_join('rl_prodi','rl_fakultas','fakultas_id')->result_array();
		$data['fakultas'] = $this->general_model->select('rl_fakultas')->result_array();		
		$this->load->view('prodi_ajax',$data);
		$this->load->view('prodi_script');
	}


	function hapus(){
		$id = $this->input->post('id');
		if($this->general_model->delete('rl_prodi','prodi_id',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}

}
