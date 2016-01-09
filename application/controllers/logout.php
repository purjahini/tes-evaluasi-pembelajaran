<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller{

    function index()
    {
		redirect('/');
    }
	
	function siswa(){
		//siswa
		$this->session->unset_userdata('logged_insis');
		$this->session->unset_userdata('penggunasis');
		$this->session->unset_userdata('levelsis');
		$this->session->unset_userdata('namasis');
		$this->session->unset_userdata('kelas');
		$this->session->unset_userdata('idkelas');
		$this->session->unset_userdata('jenkel');
		$this->session->unset_userdata('qn');
		$this->session->unset_userdata('idtes');
		$this->session->unset_userdata('tgltes');
		$this->session->unset_userdata('nmtes');
		$this->session->unset_userdata('jum');
		$this->session->unset_userdata('waktu');
		redirect('siswa');
	}
	
	function admin(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('pengguna');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('nama');		
		redirect('/');
	}
}
