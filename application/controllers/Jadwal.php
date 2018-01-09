<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model(array('general_model','jadwal_model'),'',true);		
		cek_user();
		cek_admin2();
	}

	public function index()
	{
		$data['title'] = "Jadwal";
		$data['ruangan'] = $this->general_model->select_by_id('rl_ruangan','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['matkul']	= $this->general_model->select_by_id('rl_mata_kuliah','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['dosen'] = $this->general_model->select_by_id('rl_dosen','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('jadwal');		
		$this->load->view('templates/footer');
		$this->load->view('jadwal_script');
	}
	


	function show_jadwal($id){
		header("Content-type:application/json");
		echo json_encode($this->general_model->get_show_jadwal($id)->row_array());
	}

	function get_jadwal($id){
		header("Content-type:application/json");
		echo json_encode($this->general_model->select_by_id('rl_jadwal','jad_id',$id)->row_array());
	}

	function ajax_jadwal(){
		$data['ruangan'] = $this->general_model->select_by_id('rl_ruangan','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['matkul']	= $this->general_model->select_by_id('rl_mata_kuliah','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['dosen'] = $this->general_model->select_by_id('rl_dosen','prodi_id',$this->session->userdata('rl_prodi'))->result_array();

		$this->load->view('jadwal_ajax',$data);	
		$this->load->view('jadwal_script');		
	}


	function hapus_semua(){
		if(isset($_POST['submit'])){
			if($this->general_model->delete('rl_jadwal','prodi_id',$this->session->userdata('rl_prodi'))){
				echo "1";
			}
			else
				echo "0";
		}
	}


	function edit(){
		if(isset($_POST['submit'])){
			$matkul = $this->input->post('matkul');
			$dosen = $this->input->post('dosen');
			$kelas = $this->input->post('kelas');

			$jam = $this->input->post('jam');
			$hari = $this->input->post('hari');
			$ruang = $this->input->post('ruangan');		
			
			$mat_seb = $this->input->post('matkul_sebelum');
			$kelas_sebelum = $this->input->post('kelas_sebelum');

			$data = array(
				'mat_kul_id' => $matkul,
				'dosen_id' => $dosen,
				'jad_kom' => $kelas
				);
			$prodi = $this->session->userdata('rl_prodi');
			if($this->general_model->update_jadwal($mat_seb,$kelas_sebelum,$prodi,$data))
				echo"1";
			else
				echo"0";
		}		
	}


	function hapus(){
		if(isset($_POST['submit'])){
			$id_matkul = $this->input->post('id_matkul');
			$id_kelas = $this->input->post('id_kelas');
			$prodi = $this->session->userdata('rl_prodi');

			if($this->general_model->delete_jadwal($id_matkul,$id_kelas,$prodi)){
				echo "1";
			}else{
				echo "0";
			}
		}		
	}

	function tambah(){
		if(isset($_POST['submit'])){
			$matkul = $this->input->post('matkul');
			$jam = $this->input->post('jam');
			$hari = $this->input->post('hari');
			$ruang = $this->input->post('ruangan');
			$dosen = $this->input->post('dosen');
			$kelas = $this->input->post('kelas');

			$mtk = $this->general_model->select_by_id('rl_mata_kuliah','mat_kul_id',$matkul)->row_array();

			for($i=0;$i<$mtk['mat_kul_sks'];$i++){
				$data = array(
					'mat_kul_id' => $matkul,
					'jad_kom' => $kelas,
					'id_ruangan' =>  $ruang,
					'jad_hari' => $hari,
					'dosen_id' => $dosen,
					'jad_jam_mulai' => $jam,
					'prodi_id' => $this->session->userdata('rl_prodi')
					);

				if(!$this->general_model->insert('rl_jadwal',$data)){
					echo"0"; return;
				}

				$jam = strtotime("+50 minutes", strtotime($jam));
				$jam = date('H:i:s', $jam);			
				}

				echo "1";
			}
	}		


}


