<?php

class General_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function insert($table, $data)
    {
        return $this->db->insert($table,$data);
        
    }

    function get_show_jadwal($id){
        $this->db->select("*")->from("rl_jadwal");
        $this->db->join("rl_dosen","rl_dosen.dosen_id = rl_jadwal.dosen_id");
        $this->db->join("rl_mata_kuliah","rl_mata_kuliah.mat_kul_id = rl_jadwal.mat_kul_id");
        $this->db->where("jad_id",$id);
        return $this->db->get();
    }

    function delete_jadwal($id_matkul,$id_kelas,$prodi){
        $this->db->where('mat_kul_id',$id_matkul)->where('jad_kom',$id_kelas)->where('prodi_id',$prodi);
        return $this->db->delete('rl_jadwal');        
    }
	
	function update($table,$pk,$id,$data)
    {
        $this->db->where($pk,$id);
        return $this->db->update($table,$data);
    }

    function update_jadwal($matkul,$kom,$prodi,$data){
        $this->db->where('mat_kul_id',$matkul)->where('jad_kom',$kom)->where('prodi_id',$prodi);
        return $this->db->update('rl_jadwal', $data);
    }

    function delete($table,$pk,$id)
    {
        $this->db->where($pk,$id);
        return $this->db->delete($table);
    }

    function delete_all($table){
        return $this->db->delete($table);
    }
    
    function count_all($table)
    {
        return $this->db->count_all($table);
    }
    
    function select_by_id($table,$pk,$id, $order='')
    {
        $this->db->where($pk,$id);
        $order!=''? $this->db->order_by($order) : '';
        return $this->db->get($table);
    }

    function select_by_id2($table,$pk,$id,$pk2,$id2, $order='')
    {
        $this->db->where($pk,$id);
        $this->db->where($pk2,$id2);
        $order!=''? $this->db->order_by($order) : '';
        return $this->db->get($table);
    }

     function select_by_id3($table,$pk,$id,$pk2,$id2,$pk3,$id3)
    {
        $this->db->where($pk,$id);
        $this->db->where($pk2,$id2);
        $this->db->where($pk3,$id3);
        return $this->db->get($table);
    }


    function select_order($table,$id)
    {
        $this->db->order_by($id);
        return $this->db->get($table);
    }
	
	function select($table)
    {
		return $this->db->get($table);
	}

    function select_not_in($table,$pk,$id)
    {
        $this->db->where_not_in($pk,$id);
        return $this->db->get($table);
    }

    function select_maxid($table, $id)
    {
        $this->db->select("max(".$id.") id");
        return $this->db->get($table);
    }

    function get_join($table, $join, $pk){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $table.".".$pk."=".$join.".".$pk);
        return $this->db->get();
    }

    function get_join_like($table, $join, $pk, $col, $val){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $table.".".$pk."=".$join.".".$pk);
        $this->db->like($col, $val);
        return $this->db->get();
    }


    function get_jadwal_mahasiswa($nim='',$hari){
        return $this->db->query("select b.mat_kul_id,b.mat_kul_name,a.jad_kom,a.jad_jam_mulai,b.mat_kul_sks,e.nama_ruangan, jad_hari, d.dosen_name, d.dosen_kode from rl_jadwal a join rl_mata_kuliah b on a.mat_kul_id=b.mat_kul_id join rl_krs c on c.mat_kul_id=a.mat_kul_id and c.krs_kom=a.jad_kom join rl_dosen d on d.dosen_id=a.dosen_id join rl_ruangan e on e.id_ruangan = a.id_ruangan where jad_hari='$hari' group by a.mat_kul_id order by jad_jam_mulai");
    }


    function get_jadwal_mahasiswa2($nim){
        return $this->db->query("select b.mat_kul_id,b.mat_kul_name,a.jad_kom,a.jad_jam_mulai,b.mat_kul_sks,e.nama_ruangan, d.dosen_name, d.dosen_kode from rl_jadwal a join rl_mata_kuliah b on a.mat_kul_id=b.mat_kul_id join rl_krs c on c.mat_kul_id=a.mat_kul_id and c.krs_kom=a.jad_kom join rl_dosen d on d.dosen_id=a.dosen_id join rl_ruangan e on e.id_ruangan = a.id_ruangan where c.mahasiswa_nim='$nim' and group by a.mat_kul_id order by jad_jam_mulai");
    }

    function get_join_where($table, $join, $pk, $col, $val){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $table.".".$pk."=".$join.".".$pk);
        $this->db->where($col, $val);
        return $this->db->get();
    }

    function get_join2($table, $join, $pk, $join2, $pk2){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $table.".".$pk."=".$join.".".$pk);
        $this->db->join($join2, $table.".".$pk2."=".$join2.".".$pk2);
        return $this->db->get();
    }

    function get_join2_where($table, $join, $pk, $join2, $pk2){
        $CI = & get_instance();
        $session = $CI->session->userdata('id_user');
        $this->db->select("*");
        $this->db->from($table);
        $this->db->join($join, $table.".".$pk."=".$join.".".$pk);
        $this->db->join($join2, $table.".".$pk2."=".$join2.".".$pk2);
        $this->db->where($table.".".$pk, $session);
        return $this->db->get();
    }


    function get_jadwal_ujian($tanggal){
        return $this->db->query("SELECT * FROM rl_jadwal_ujian a join rl_mata_kuliah b on a.mat_kul_id = b.mat_kul_id join rl_ruangan c on a.id_ruangan=c.id_ruangan where a.jad_uj_tanggal='$tanggal'");
    }


    function get_jadwal_pengganti($nim,$date){
        return $this->db->query("SELECT * FROM `rl_jadwal_ganti` join rl_mata_kuliah on rl_jadwal_ganti.mat_kul_id=rl_mata_kuliah.mat_kul_id join rl_krs on rl_krs.mat_kul_id=rl_mata_kuliah.mat_kul_id join rl_ruangan on rl_ruangan.id_ruangan= rl_jadwal_ganti.jad_gan_ruangan join rl_dosen on rl_dosen.dosen_id= rl_jadwal_ganti.jad_gan_dosen where jad_gan_tanggal_setelah_ganti='$date' and rl_krs.mahasiswa_nim='$nim' order by jad_gan_jam_mulai");
    }


    function get_ruangan($jurusan){
        return $this->db->query("select id_ruangan,nama_ruangan from rl_ruangan join rl_prodi on rl_ruangan.prodi_id=rl_prodi.prodi_id where prodi_name like '%$jurusan%'");
    }
    
}