<?php

class Jadwal_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }

    function get_jadwal($prodi, $ruang, $hari){
    	$this->db->select("*");
        $this->db->from("rl_jadwal");
        $this->db->join("rl_mata_kuliah","rl_jadwal.mat_kul_id=rl_mata_kuliah.mat_kul_id");      
        $this->db->join("rl_dosen","rl_dosen.dosen_id=rl_jadwal.dosen_id");  
        $this->db->where("rl_jadwal.prodi_id",$prodi);
        $this->db->where("rl_jadwal.id_ruangan",$ruang);
        $this->db->where("rl_jadwal.jad_hari",$hari);
        return $this->db->get();
    }

}