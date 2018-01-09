<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
		cek_user();
		cek_admin1();
	}

	public function index()
	{
		$data['title'] = "Data Fakultas";
		$data['fakultas'] = $this->general_model->select('rl_fakultas')->result_array();			
		$this->load->view('templates/header', $data);
		$this->load->view('fakultas');		
		$this->load->view('templates/footer');
		$this->load->view('fakultas_script');
	}


	function tambah(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$data = array(
				'fakultas_id' => $id,
				'fakultas_name' => $name
				);
			if($this->general_model->insert('rl_fakultas',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}

	function hapus(){
		$id = $this->input->post('id');
		if($this->general_model->delete('rl_fakultas','fakultas_id',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}

	function get_fakultas($id){
		$fak = $this->general_model->select_by_id('rl_fakultas','fakultas_id',$id)->row_array();
		header("Content-type:application/json");
		echo json_encode($fak);
	}

	function ajax_fakultas(){
		$data['fakultas'] = $this->general_model->select('rl_fakultas')->result_array();	
		$this->load->view('fakultas_ajax',$data);
		$this->load->view('fakultas_script');

	}

	function edit(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$data = array(
				'fakultas_id' => $id,
				'fakultas_name' => $name
				);
			if($this->general_model->update('rl_fakultas','fakultas_id',$id,$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}


	function delete($id){
		if($this->general_model->delete('rl_fakultas','fakultas_id',$id)){
			echo "1";
		}else{
			echo "0";
		}
	}
}
