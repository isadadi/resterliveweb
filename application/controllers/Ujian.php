<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian extends CI_Controller {

function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);		
		cek_user();
		cek_admin2();
	}


	function index(){
		$data['title'] = "Jadwal Ujian";	
		$data['tanggal']	 = $this->general_model->select_by_id('rl_tanggal_ujian','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['ruangan'] = $this->general_model->select_by_id('rl_ruangan','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['matkul']	= $this->general_model->select_by_id('rl_mata_kuliah','prodi_id',$this->session->userdata('rl_prodi'))->result_array();	
		$this->load->view('templates/header', $data);
		$this->load->view('ujian');
		$this->load->view('templates/footer');
		$this->load->view('ujian_script');
		
	}


	function tambah(){
		if(isset($_POST['submit'])){
			$matkul = $this->input->post('matkul');
			$jam = $this->input->post('jam');
			$hari = $this->input->post('hari');
			$ruang = $this->input->post('ruangan');			
			$kelas = $this->input->post('kelas');
			


				$data = array(
					'mat_kul_id' => $matkul,
					'jad_uj_kom' => $kelas,
					'id_ruangan' =>  $ruang,
					'jad_uj_tanggal' => $hari,					
					'jad_uj_waktu' => $jam,
					'id_tgl_ujian' => $this->input->post('id_tgl'),
					'prodi_id' => $this->session->userdata('rl_prodi')
					);

				if(!$this->general_model->insert('rl_jadwal_ujian',$data)){
					echo"0";							
				}
				echo "1";
			}
	}	


	function get_jadwal($id){
		header("Content-type:application/json");
		echo json_encode($this->general_model->select_by_id('rl_jadwal_ujian','jad_uj_id',$id)->row_array());
	}	


	function edit(){
		if(isset($_POST['submit'])){
			$matkul = $this->input->post('matkul');			
			$kelas = $this->input->post('kelas');
			$id_jadwal = $this->input->post('id_jadwal');			
			
			$data = array(
				'mat_kul_id' => $matkul,					
				'jad_uj_kom' => $kelas
				);
			$prodi = $this->session->userdata('rl_prodi');
			if($this->general_model->update('rl_jadwal_ujian','jad_uj_id',$id_jadwal,$data))
				echo"1";
			else
				echo"0";
		}		
	}


	function ajax_jadwal($id){
		$data['tanggal'] = $this->general_model->select_by_id('rl_tanggal_ujian','id_tgl_ujian',$id)->row_array();
		$data['jadwal'] = $this->general_model->select_by_id2('rl_jadwal_ujian','id_tgl_ujian',$id,'prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['ruangan'] = $this->general_model->select_by_id('rl_ruangan','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$data['id_tgl']	= $id;		
		$this->load->view('ujian_ajax_jadwal',$data);
		$this->load->view('ujian_script');
	}


	function tambah_tgl(){
		if(isset($_POST['submit'])){
			$mulai = $this->input->post('tgl_mulai');
			$selesai = $this->input->post('tgl_selesai');

			$data = array(
				'tgl_mulai_ujian' => $mulai,
				'tgl_selesai_ujian' => $selesai,
				'prodi_id' => $this->session->userdata('rl_prodi')
				);

			if($this->general_model->insert('rl_tanggal_ujian',$data)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}


	function hapus_tgl(){
		if(isset($_POST['submit'])){
			$id = $this->input->post('id');
			if($this->general_model->delete('rl_tanggal_ujian','id_tgl_ujian',$id)){
				$this->general_model->delete('rl_jadwal_ujian','id_tgl_ujian',$id);
			echo "1";
			}else{
				echo "0";
			}
		}
	}


	function hapus_semua(){
		if(isset($_POST['submit'])){
			if($this->general_model->delete('rl_tanggal_ujian','prodi_id',$this->session->userdata('rl_prodi'))){
				$this->general_model->delete('rl_jadwal_ujian','prodi_id',$this->session->userdata('rl_prodi'));
				echo "1";
			}
			else
				echo "0";
		}
	}


	function ajax_tanggal(){
		$data['tanggal']	 = $this->general_model->select_by_id('rl_tanggal_ujian','prodi_id',$this->session->userdata('rl_prodi'))->result_array();
		$this->load->view('ujian_ajax_tanggal',$data);
		$this->load->view('ujian_script');
	}

}