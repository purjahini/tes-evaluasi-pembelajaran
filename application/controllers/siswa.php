<?php

class Siswa extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('siswa_model');
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}
	
    function index(){			
		$cek_log=$this->session->userdata('logged_insis');
        $level=$this->session->userdata('levelsis');
        
		//jika belum login maka akan menampilkan form login
		if(!isset($cek_log) || $cek_log != true || $level!="Siswa"){
			if($this->session->flashdata('error') !== null) {
				$data['error'] = $this->session->flashdata('error');
			}
            $data['main_content']='loginsis';
			$this->load->view('inc/template',$data);
        }
		
		//jika sudah memilih tes akan menampilkan soal tes
		elseif($this->session->userdata('idtes')!==false){
			redirect('siswa/tes');
		
		//halaman home siswa
		}else{
			$idkelas=$this->session->userdata('idkelas');
			$data['content'] = 'siswa';
			$data['query']=$this->siswa_model->ambil_tes($idkelas);
			$this->load->view('siswa/content', $data);
		}
    }
	
	//fungsi mengecek apakah tes yang dipilih sudah ada di database atau belum
    function cektes(){
      $idtes=$this->uri->segment(3);
	  //echo $this->session->userdata('pengguna');
      if(isset($idtes)){
			
			//cek apakah tes pernah dipilih
			$cek=$this->db->query("select * from hasil_jawaban join bank_soal 
								on hasil_jawaban.id_soal=bank_soal.id_soal 
								WHERE hasil_jawaban.nis='".$this->session->userdata('penggunasis')."' and bank_soal.id_tes='$idtes'");
			
			//mengambil semua data tes yang dipilih
			$res=$this->db->query("SELECT t.nama_tes, t.jumlah_soal, t.waktu, j.tgl_tes from tes t 
									JOIN jadwal j on j.id_tes=t.id_tes 
									WHERE t.id_tes='$idtes' and j.id_kelas='".$this->session->userdata('idkelas')."'");
			
			
			//cek apakah tes yang dipilih ada di database
			if($res->num_rows>0){
				//cek apakah tes sudah pernah dipilih sebelumnya
				if($this->session->userdata('idtes') == FALSE){
					
					foreach ($res->result() as $dt)
					{
						$nmtes=$dt->nama_tes;
						$jumso=$dt->jumlah_soal;
						$tgltes=$dt->tgl_tes;
						$waktu=$dt->waktu;
						$soal=$this->db->query("SELECT * FROM bank_soal WHERE id_tes='$idtes' order by rand() LIMIT $jumso");
						$nis=$this->session->userdata('penggunasis');
						//cek apakah data soal pernah dikerjakan sebelumnya
						if($cek->num_rows==0){
							foreach($soal->result() as $data){
								$this->db->query("INSERT into hasil_jawaban VALUES('$nis','$data->id_soal','','Kosong')");
							}
						}
						$sess_tes['idtes']= $idtes;
						$sess_tes['nmtes']= $nmtes;
						$sess_tes['jum']= $jumso;
						$sess_tes['tgltes']=$tgltes;
						$sess_tes['waktu']=$waktu;
						$sess_tes['qn']= 0;
						$this->session->set_userdata($sess_tes);
						
						redirect('siswa/tes');
					}
				}else{
					redirect('siswa/tes');
				}
			}else{
				redirect('siswa');
			}		
      }
    }

	
	//fungsi menampilkan tes, soal dan pilihan jawaban soal tes
    function tes(){
		$keterangan=$this->uri->segment(3);
		if($this->session->userdata('idtes')!==false){
			$jum=$this->session->userdata('jum');
			//mengambil data soal yang sudah disimpan
			$rs="select * from bank_soal join hasil_jawaban on bank_soal.id_soal=hasil_jawaban.id_soal
						where bank_soal.id_tes='".$this->session->userdata('idtes')."' and hasil_jawaban.nis='".$this->session->userdata('penggunasis')."' limit $jum ";
			$hasil=$this->db->query($rs);
			//menampilkan soal tes
			$data['query'] = $hasil;
			$data['content'] = 'tes';
			$this->load->view('siswa/content', $data);

			$hs=$hasil->row($this->session->userdata('qn'));
			//jika siswa menekan tombol
			if(isset($_POST)){
				$submit=$this->input->post('submit');
				$ans=$this->input->post('ans');
				if($ans==$hs->jawaban_benar){
					$ket="Benar";
				}else{
					$ket="Salah";
				}
				
				if($submit=='Selanjutnya'){
					//menyimpan/mengupdate hasil jawaban siswa
					$this->siswa_model->simpan_tes($ans,$ket,$hs->id_soal);
					$qn=$this->session->userdata('qn')+1;
					$sess_qn['qn']= $qn;
					$this->session->set_userdata($sess_qn);
					redirect('siswa/tes');
				}elseif($submit=='Sebelumnya'){
					//menyimpan/mengupdate hasil jawaban siswa
					$this->siswa_model->simpan_tes($ans,$ket,$hs->id_soal);
					$qn=$this->session->userdata('qn')-1;
					$sess_qn['qn']= $qn;
					$this->session->set_userdata($sess_qn);
					redirect('siswa/tes');
				}else if($submit=='Selesai' || $keterangan=="selesai"){
					//menyimpan/mengupdate hasil jawaban siswa
					$this->siswa_model->simpan_tes($ans,$ket,$hs->id_soal);
					$this->session->unset_userdata('qn');
					$this->session->unset_userdata('idtes');
					$this->session->unset_userdata('tgltes');
					$this->session->unset_userdata('nmtes');
					$this->session->unset_userdata('jum');
					$this->session->unset_userdata('waktu');
					redirect('siswa');
				}
			}
		}else{
			redirect('siswa');
		}
    }
	
	  function login_validasi(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->load->model('login_model');

        if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', 'Cek Username dan Password');
			redirect('siswa');
        }else{
            $query=$this->login_model->validasi($this->input->post('username'),$this->input->post('password'));

            if ($query->num_rows() == 1) {
                
				$siswa = $query->row(); 
                $sess_data['levelsis'] = $siswa->level;
				$sess_data['logged_insis'] = true;
                $sess_data['penggunasis'] = $siswa->pengguna;
                
				if($siswa->level==="Siswa"){
                
					$res = $this->db->query('SELECT siswa.nama_siswa,siswa.jenkel, kelas.nama_kelas, kelas.id_kelas FROM siswa join kelas on siswa.id_kelas=kelas.id_kelas WHERE siswa.nis="'.$siswa->pengguna.'"');
					$row_siswa = $res->row();          // get the first row
					$sess_data['namasis']= $row_siswa->nama_siswa;
					$sess_data['kelas']= $row_siswa->nama_kelas;
					$sess_data['idkelas']= $row_siswa->id_kelas;
					$sess_data['jenkel']= $row_siswa->jenkel;	
					$this->session->set_userdata($sess_data);
					redirect('siswa');
				}else{
					echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
				}
            }else{
                echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
            }
       }
    }

}
