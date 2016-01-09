<?php

class Siswa_model extends CI_Model{

    function ambil_tes($kelas){
      $query=$this->db->query("SELECT tes.id_tes, tes.nama_tes, tes.waktu, tes.jumlah_soal, jadwal.tgl_tes 
								FROM tes join mengajar on tes.nip=mengajar.nip join jadwal on tes.id_tes=jadwal.id_tes 
								WHERE mengajar.id_kelas='$kelas' and jadwal.id_kelas='$kelas' and tes.status_tes=1");
      return $query->result();
    }

    function simpan_tes($jawaban, $keterangan, $idsoal){
      $this->db->query("update hasil_jawaban set jawaban='$jawaban', keterangan='$keterangan' where id_soal='$idsoal' and nis='".$this->session->userdata('penggunasis')."'");
    }
}
