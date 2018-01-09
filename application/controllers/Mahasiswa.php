<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('akses'),'',true);
		$this->load->model('general_model','',true);
	}

	public function index()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
	

		 $curl = curl_init();
                    $url["login"] = "https://portal.usu.ac.id/login/proses_login.php";
                    $url["profil"] = "https://portal.usu.ac.id/profil/tampil.php";
                    $url["khs"] = "https://portal.usu.ac.id/informasi_hasil_studi/tampil.php";
                    $cookie = base_url("assets/cookie.txt");

                    $data1 = [
                      'username' => $username,
                      'password' => $password
                    ];

                    $data1 = http_build_query($data1);

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
                    curl_setopt($curl, CURLOPT_URL, $url["login"] );
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_COOKIEJAR, realpath($cookie));

                    $html = curl_exec($curl);
                    $pattern = '/<div.+?id="member-info">.+<h3>([\S\s]+)<\/h3>.+<h4>([\d]+)<\/h4>.+<h4>([\S\s]+)<\/h4>.+/s';
                    preg_match($pattern, $html, $login);
                    if(count($login)<=0){
                    	$error = new \stdClass();
                  
                    		$error->error = true;
                    		$error->nim= '-';
                    		$error->nama = '-';
                    		$error->jurusan= '-';
                    		$error->error_msg = "Username atau password Salah";
                    	 header("Content-type:application/json");
	                    echo json_encode($error);
	                    die;
                    }

                    curl_setopt($curl, CURLOPT_URL, $url['khs']);
				    $html = curl_exec($curl);

				    preg_match_all('/\<option.+?\"(.+)\".+?\<\/option\>/', $html, $semester);
				    $data = http_build_query(['semester' => $semester[1][count($semester[1]) - 2]]);

				    curl_setopt($curl, CURLOPT_POST, 1);
				    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				    $html = curl_exec($curl);

				    preg_match_all('/\<td.+width="10%".?(.+)?<\/td>/', $html, $matkul);
				    preg_match_all('/\<td.+width="22%".?(.+)?<\/td>/', $html, $kom);

				    $login[0] = $login[1];
				    $login[1] = $login[2];
				     $login[2] = $login[3];

                    $id_prodi = substr($login[1], 2,4);



                    $mahasiswa = array(
                    	'mahasiswa_nim' => $login[1],
                    	'mahasiswa_name' => $login[0],
                    	'mahasiswa_password' => $password,
                    	'prodi_id' => $id_prodi
                    );

                    if($this->general_model->select_by_id('rl_mahasiswa','mahasiswa_nim',$login[1])->num_rows() <= 0)
                    	$this->general_model->insert('rl_mahasiswa',$mahasiswa);

                    $this->general_model->delete('rl_krs','mahasiswa_nim',$login[1]);
                    for($i=0; $i< count($matkul[1]); $i++){

                    	if($this->general_model->select_by_id('rl_mata_kuliah','mat_kul_id',$matkul[1][$i])->num_rows()>0){
                    		$nih_krs = array(
                    			'mahasiswa_nim' => $login[1],
                    			'mat_kul_id' => $matkul[1][$i],
                    			'krs_kom' => $kom[1][$i]
                    		);
                    		$this->general_model->insert('rl_krs',$nih_krs);
                    	}
                    }

                    $error = new \stdClass();
                  
                    		$error->error = false;
                    		$error->nim= $login[1];
                    		$error->nama = $login[0];
                    		$error->jurusan= $login[2];
                    		$error->error_msg = "";
                  
                    header("Content-type:application/json");
                    echo json_encode($error);

	}


	function mingguan(){

		 header("Content-type:application/json");
		$username = $this->input->post('nim');
		$username = "141402118";
		$mahasiswa = $this->general_model->select_by_id('rl_mahasiswa','mahasiswa_nim',$username)->row_array();
		if(count($mahasiswa)<=0){
			$all_data = new \stdClass();
			$all_data->error = true;
			$all_data->error_msg = 'Mahasiswa Tidak Ditemukan';
			
			echo json_encode($all_data, JSON_PRETTY_PRINT);
			die;
		}
		$ujian = $this->general_model->select_by_id('rl_tanggal_ujian','prodi_id',$mahasiswa['prodi_id'])->result_array();

		$hari['Mon'] = 'Senin';
        $hari['Tue'] = 'Selasa';
        $hari['Wed'] = 'Rabu';
        $hari['Thu'] = 'Kamis';
        $hari['Fri'] = 'Jumat';
        $hari['Sat'] = 'Sabtu';
        $hari['Sun'] = 'Minggu';
        $enhari = array("Mon","Tue","Wed","Thu","Fri");

        $all_data = array();
    
        foreach($hari as $nn){
        	 $all_data2['hari'] = $nn;
        		$matkul = $this->general_model->get_jadwal_mahasiswa($username,$nn)->result_array();
        		$matkul2 = $this->general_model->get_jadwal_mahasiswa($username,$nn)->num_rows();
        		if($matkul2>0){
					foreach($matkul as $mtk){

							$data  = new \stdClass();
							$jam = $mtk['jad_jam_mulai'];
						for($j=0; $j<$mtk['mat_kul_sks']; $j++){
							$jam = strtotime("+50 minutes", strtotime($jam));
							$jam = date('H:i:s', $jam);
						}
							$data->status = "kuliah";
							$data->matkul_id = $mtk['mat_kul_id'];
							$data->mata_kuliah = $mtk['mat_kul_name'];
							$data->kom = $mtk['jad_kom'];
							$data->jam = $mtk['jad_jam_mulai'].' - '.$jam;
							$data->nama_dosen = $mtk['dosen_name'];
							$data->kode_dosen = $mtk['dosen_kode'];
							$data->ruangan = $mtk['nama_ruangan'];
							$data->hari =  $nn;
							$data->sks = $mtk['mat_kul_sks'];
						array_push($all_data, $data);

					}
	
			}else{
				$data  = new \stdClass();
				$data->status = "tidak masuk";
				$data->matkul_id = '-';
				$data->mata_kuliah = '-';
				$data->kom = '-';
				$data->jam = '-';
				$data->nama_dosen = '-';
				$data->kode_dosen = '-';
				$data->ruangan = '-';
				$data->hari =  $nn;
				$data->sks = '-';
				array_push($all_data, $data);

			}
        }

			echo json_encode($all_data, JSON_PRETTY_PRINT);
	}


	

	function harian(){
		header("Content-type:application/json");
		$username = "141402039";
		$password = "11101996";

		$mahasiswa = $this->general_model->select_by_id('rl_mahasiswa','mahasiswa_nim',$username)->row_array();
		$ujian = $this->general_model->select_by_id('rl_tanggal_ujian','prodi_id',$mahasiswa['prodi_id'])->result_array();

		$hari['Mon'] = 'Senin';
        $hari['Tue'] = 'Selasa';
        $hari['Wed'] = 'Rabu';
        $hari['Thu'] = 'Kamis';
        $hari['Fri'] = 'Jumat';
        $hari['Sat'] = 'Sabtu';
        $hari['Sun'] = 'Minggu';
        $enhari = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");


        //ujian
        $tanggal_ujian = array();
			foreach($ujian as $ujn){
			 $tgl1 = new DateTime($ujn['tgl_mulai_ujian']);
             $tgl2 = new DateTime($ujn['tgl_selesai_ujian']);
             $diff = $tgl2->diff($tgl1)->format("%a");

             for($i=0;$i<=$diff;$i++){
             	$date = date('Y-m-d', strtotime($ujn['tgl_mulai_ujian'] . "+$i days"));
             	$tanggal_ujian[$i] = $date;
             }

			}
		

		//libur
		$libur = $this->general_model->select_by_id('rl_tanggal_libur','prodi_id',$mahasiswa['prodi_id'])->result_array();		
		$tgl_libur = array();

		foreach($libur as $lbr){
			$tgl1 = new DateTime($lbr['libur_tgl_mulai']);
			$tgl2 = new DateTime($lbr['libur_tgl_selesai']);
			$diff = $tgl2->diff($tgl1)->format("%a");

             for($i=0;$i<=$diff;$i++){
             	$date = date('Y-m-d', strtotime($lbr['libur_tgl_mulai'] . "+$i days"));
             	$tgl_libur[$i] = $date;
             }
		}		
	

		$tanggal = date('Y-m-d');
		$all_data = array();

		for($i=-7;$i<=7;$i++){

			$date = date('Y-m-d', strtotime($tanggal . "+$i days"));
			$tgl_aja = explode("-", $date);
			$nhari = date('D', strtotime($date));
			if(in_array($date, $tgl_libur)){
				$data  = new \stdClass();
				$data->status = "libur";
				$data->tanggal = $tgl_aja[2];
				$data->date = $date;
				$data->jadwal = '-';
				$data->matkul_id = '-';
				$data->matkul_name = '-';
				$data->sks = '-';
				$data->kelas = '-';
				$data->jam_matkul = '-';
				$data->nama_dosen = '-';
				$data->kode_dosen = '-';
				$data->ruangan = '-';
				$data->hari = $hari[$nhari];
				array_push($all_data, $data);

			}
			else if(in_array($date, $tanggal_ujian)){
				$matkul = $this->general_model->get_jadwal_ujian($date)->result_array();
				$matkul2 = $this->general_model->get_jadwal_ujian($date)->row_array();
				
				if($matkul2>0){

					foreach($matkul as $mtk){
						$cek_matkul = $this->general_model->select_by_id3('rl_krs','mahasiswa_nim',$username,'mat_kul_id',$mtk['mat_kul_id'],'krs_kom',$mtk['jad_uj_kom'])->row_array();

						if($cek_matkul>0){	
												
							$jam = strtotime("+90 minutes", strtotime($mtk['jad_uj_waktu']));
							$jam = date('H:i:s', $jam);
							$data  = new \stdClass();
							$data->status = "ujian";
							$data->tanggal = $tgl_aja[2];
							$data->date = $date;
							$data->jadwal = '-';
							$data->matkul_id = $mtk['mat_kul_id'];
							$data->matkul_name = $mtk['mat_kul_name'];
							$data->sks = '-';
							$data->kelas = $mtk['jad_uj_kom'];
							$data->jam_matkul = $mtk['jad_uj_waktu'].' - '.$jam;
							$data->nama_dosen = '-';
							$data->kode_dosen = '-';
							$data->ruangan = $mtk['nama_ruangan'];
							$data->hari = $hari[$nhari];	
							array_push($all_data, $data);					
						}else{
							$data  = new \stdClass();
							$data->status = "tidak masuk";
							$data->tanggal = $tgl_aja[2];
							$data->date = $date;
							$data->matkul_id = '-';
							$data->matkul_name = '-';
							$data->sks = '-';
							$data->kelas = '-';
							$data->jam_matkul = '-';
							$data->nama_dosen = '-';
							$data->kode_dosen = '-';
							$data->ruangan = '-';
							$data->hari = $hari[$nhari];
							array_push($all_data, $data);
						}
					}
				}else{
					$data  = new \stdClass();
					$data->status = "tidak masuk";
					$data->tanggal = $tgl_aja[2];
					$data->date = $date;
					$data->matkul_id = '-';
					$data->matkul_name = '-';
					$data->sks = '-';
					$data->kelas = '-';
					$data->jam_matkul = '-';
					$data->nama_dosen = '-';
					$data->kode_dosen = '-';
					$data->ruangan = '-';
					$data->hari = $hari[$nhari];
					array_push($all_data, $data);
				}				

			}else{
				
				$temp_data = array();
				$matkul = $this->general_model->get_jadwal_mahasiswa($username, $hari[$nhari])->result_array();
				$matkul2 = $this->general_model->get_jadwal_mahasiswa($username, $hari[$nhari])->num_rows();

				$matkul_pengganti = $this->general_model->get_jadwal_pengganti($username,$date)->result_array();
				$matkul_pengganti2 = $this->general_model->get_jadwal_pengganti($username,$date)->num_rows();

				if($matkul_pengganti2>0){
					foreach($matkul_pengganti as $mtk_pengganti){
						$data  = new \stdClass();
						$data->status = "kuliah";
						$data->tanggal = $tgl_aja[2];
						$data->date = $date;
						$data->jadwal = 'pengganti';
						$data->matkul_id = $mtk_pengganti['mat_kul_id'];
						$data->matkul_name = $mtk_pengganti['mat_kul_name'];
						$data->sks = $mtk_pengganti['mat_kul_sks'];
						$data->kelas = $mtk_pengganti['jad_gan_kom'];
						$data->jam_matkul = $mtk_pengganti['jad_gan_jam_mulai'];
						$data->nama_dosen = $mtk_pengganti['dosen_name'];
						$data->kode_dosen = $mtk_pengganti['dosen_kode'];
						$data->ruangan = $mtk_pengganti['nama_ruangan'];
						$data->hari = $hari[$nhari];
						array_push($temp_data, $data);
					}
				}
				

        		if($matkul2>0){

					foreach($matkul as $mtk){
						$cek_matkul = $this->general_model->select_by_id3('rl_krs','mahasiswa_nim',$username,'mat_kul_id',$mtk['mat_kul_id'],'krs_kom',$mtk['jad_kom'])->row_array();
						if($cek_matkul>0){

							$data  = new \stdClass();
							$data->status = "kuliah";
							$data->tanggal = $tgl_aja[2];
							$data->date = $date;

							$jad_ganti1 = $this->general_model->select_by_id3('rl_jadwal_ganti','jad_gan_tanggal_sebelum_ganti',$date,'mat_kul_id',$mtk['mat_kul_id'],'jad_gan_kom',$mtk['jad_kom'])->num_rows();
							if($jad_ganti1>0)
								$data->jadwal = 'diganti';
							else
								$data->jadwal = 'tetap';
							$data->matkul_id = $mtk['mat_kul_id'];
							$data->matkul_name = $mtk['mat_kul_name'];
							$data->sks = $mtk['mat_kul_sks'];
							$data->kelas = $mtk['jad_kom'];
							$data->jam_matkul = $mtk['jad_jam_mulai'];
							$data->nama_dosen = $mtk['dosen_name'];
							$data->kode_dosen = $mtk['dosen_kode'];
							$data->ruangan = $mtk['nama_ruangan'];
							$data->hari = $hari[$nhari];
							
						
							array_push($all_data, $data);
						}else if($matkul2<=0 and $matkul_pengganti2<=0){
							$data  = new \stdClass();
							$data->status = "tidak masuk";
							$data->tanggal = $tgl_aja[2];
							$data->date = $date;
							$data->matkul_id = '-';
							$data->matkul_name = '-';
							$data->sks = '-';
							$data->kelas = '-';
							$data->jam_matkul = '-';
							$data->nama_dosen = '-';
							$data->kode_dosen = '-';
							$data->ruangan = '-';
							$data->hari = $hari[$nhari];
							array_push($temp_data, $data);
						}						
						
					}
				}else if($matkul2<=0 and $matkul_pengganti2<=0){
						$data  = new \stdClass();
						$data->status = "tidak masuk";
						$data->tanggal = $tgl_aja[2];
						$data->date = $date;
						$data->matkul_id = '-';
						$data->matkul_name = '-';
						$data->sks = '-';
						$data->kelas = '-';
						$data->jam_matkul = '-';
						$data->nama_dosen = '-';
						$data->kode_dosen = '-';
						$data->ruangan = '-';
						$data->hari = $hari[$nhari];
						array_push($temp_data, $data);
				}
				usort($temp_data, 'sort_by_order');

				foreach($temp_data as $dat){
					array_push($all_data, $dat);
				}
				
			}	
		}



			echo json_encode($all_data, JSON_PRETTY_PRINT);

	}

	function jadwal_ganti(){
		$matkul = $this->input->post('matkul_id');
		$kom = $this->input->post('kom');
		$ruangan = $this->input->post('ruangan_id');
		$tgl_sebelum = $this->input->post('tgl_sebelum');
		$tgl_setelah = $this->input->post('tgl_setelah');
		$jam = $this->input->post('jam');

		$dosen = $this->general_model->select_by_id2('rl_jadwal','mat_kul_id',$matkul,'jad_kom',$kom)->row_array();

		$data = array(
			'mat_kul_id' => $matkul,
			'jad_gan_kom' => $kom,
			'jad_gan_ruangan' => $ruangan,
			'jad_gan_tanggal_setelah_ganti' => $tgl_sebelum,
			'jad_gan_tanggal_setelah_ganti' => $tgl_setelah,
			'jad_gan_jam_mulai' => $jam,
			'jad_gun_dosen'
		);
		
		if($this->general_model->insert('rl_jadwal_ganti',$data)){
			$notif = $this->general_model->select_by_id('rl_mata_kuliah','mat_kul_id',$matkul)->row_array();
			$data = new \stdClass();
			$data->error = false;
			$data->message ="Jadwal Berhasil Diganti";
			send_notification();
		}else{
			$data = new \stdClass();
			$data->error = true;
			$data->message ="Jadwal Gagal Diganti";
			
		}
		header("Content-type:application/json");
		echo json_encode($data, JSON_PRETTY_PRINT);
	}


	function send_ruangan(){
		$jurusan = $this->input->post('jurusan');
		$jurusan = 'Teknologi Informasi';
		$ruangan = $this->general_model->get_ruangan($jurusan)->result_array();
		header("Content-type:application/json");
		echo json_encode($ruangan);
	}


	function update_token(){
		$token = $this->input->post('token');
		$nim = $this->input->post('nim');

		$data = array(
			'token' => $token
		);

		$this->general_model->update('rl_mahasiswa','mahasiswa_nim',$nim,$token);	
	}



	

}
