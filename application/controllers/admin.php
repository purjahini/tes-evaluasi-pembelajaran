<?php

class Admin extends CI_Controller
{
    function __construct(){
        parent::__construct();
        //$this->cek_log();
		$this->load->model('tes_model');
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
    }

    function index(){
		$cek_log2=$this->session->userdata('logged_in');
        $level=$this->session->userdata('level');
        if($cek_log2 == true && ($level==="Admin" || $level==="Guru" || $level==="Super Admin")){
            $data['content'] = 'welcome';
			$this->load->view('dashboard/content', $data);
        }else{
			if($this->session->flashdata('error') !== null) {
				$data['error'] = $this->session->flashdata('error');
			}
            $data['main_content']='login';
			$this->load->view('inc/template',$data);
		}        
    }
	
	function login_validasi(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->load->model('login_model');

        if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', 'Gagal login, Cek Username dan Password');
			redirect('/');
        }else{
            $query=$this->login_model->validasi($this->input->post('username'),$this->input->post('password'));

            if ($query->num_rows() == 1) {
				$admin = $query->row(); 
                $sess_data['level'] = $admin->level;
				if($admin->level==="Admin" || $admin->level==="Super Admin" || $admin->level==="Guru"){
					$sess_data['logged_in'] = true;
					$sess_data['pengguna'] = $admin->pengguna;
					
					if($admin->level==="Guru"){
						$query = $this->db->query('SELECT g.nama_guru, m.kkm  FROM guru g join matpel m on g.id_matpel=m.id_matpel WHERE g.nip="'.$admin->pengguna.'"');
						$res = $query->result();  // this returns an object of all results
						$row = $res[0];           // get the first row
						$sess_data['nama']= $row->nama_guru;
						$sess_data['kkm']= $row->kkm;
					}else{
						$sess_data['nama'] = $admin->pengguna;
					}	
					$this->session->set_userdata($sess_data);
					redirect('admin'); 
				}else{
					echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
				}
            }else{
                echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
            }
       }
    }

    //fungsi penomoran diambil dari model
    public function pagination() {
        $this->tes_model->search_document();
    }
	
    //fungsi untuk menampilkan halaman yang diminta
    function tampil($page){
		$level=$this->session->userdata('level');
        $hal=FCPATH.'application\views\admin\input_'.$page.'.php';
        if(!empty($page) and is_file($hal)){
            if($level==="Guru"){
				$pg=array("laporan","tes", "soal", "jadwal");
			}else{
				$pg=array("laporan","tes", "soal", "jadwal", "guru", "siswa", "kelas", "matpel", "ajar",  "admin");
			}
			
			if(str_ireplace($pg, "", $page) != $page ){
				$data['content'] ='input_'.$page;
				$this->load->view('dashboard/content', $data);
			}else{
				redirect('/admin');
			}
        }else{
            redirect('/admin');
        }
    }

    //fungsi memasukkan data ke dalam database
    public function create($form){
      if(!empty($form)){
            $res['error']="";
            $res['success']="";

            if($form==="kelas"){
                $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'trim|required|is_unique[kelas.nama_kelas]');
				$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
            }elseif($form==="matpel"){
				
                $this->form_validation->set_rules('nama_matpel', 'Nama Mata Pelajaran', 'trim|required|is_unique[matpel.nama_matpel]');
                $this->form_validation->set_rules('kkm', 'KKM', 'required|numeric');
            }elseif($form==="siswa"){
                $this->form_validation->set_rules('nis', 'NIS', 'required|is_unique[siswa.nis]');
                $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'trim|required');
                $this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'required');
                $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required');
                $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
            }elseif($form==="guru"){
                $this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[guru.nip]');
                $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'trim|required');
                $this->form_validation->set_rules('nuptk', 'NUPTK', 'required|numeric');
                $this->form_validation->set_rules('tmp_lahir', 'trim|Tempat Lahir', 'required');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
                $this->form_validation->set_rules('pend_guru', 'Pendidikan Guru', 'required');
                $this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required');
                $this->form_validation->set_rules('golongan', 'Golongan', 'required');
            }elseif($form==="pengguna"){
                $this->form_validation->set_rules('pengguna', 'Username', 'trim|required|is_unique[admin.username]');
                //$this->form_validation->set_rules('nama_lengkap', 'Nama Admin', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'required|md5');

            }elseif($form==="tes"){
                $this->form_validation->set_rules('nama_tes', 'Nama Tes', 'trim|required');
                $this->form_validation->set_rules('waktu', 'Lama Tes', 'required|numeric');

                $this->form_validation->set_rules('jumlah_soal', 'Banyak Soal', 'required|numeric');
                $this->form_validation->set_rules('status_tes', 'Banyak Soal', 'numeric');

            }elseif($form==="bank_soal"){
                $this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required');
                $this->form_validation->set_rules('soal', 'Soal Pertanyan', 'trim|required');
                $this->form_validation->set_rules('a', 'Pilihan Jawaban A', 'trim|required');
                $this->form_validation->set_rules('b', 'Pilihan Jawaban B', 'trim|required');
                $this->form_validation->set_rules('c', 'Pilihan Jawaban C', 'trim|required');
                $this->form_validation->set_rules('d', 'Pilihan Jawaban D', 'trim|required');
                $this->form_validation->set_rules('jawaban_benar', 'Jawaban Benar', 'required');
            }elseif($form==="mengajar"){
                $id_m = $this->input->post('nip');
				$this->form_validation->set_rules('nip', 'Guru', 'required');
                //$this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
				
				$this->form_validation->set_rules('id_kelas', 'Mengajar Kelas', 'required|is_unique[mengajar.id_kelas.nip.nip.'.$id_m.']'); 
            }elseif($form==="jadwal"){
				$id_j = $this->input->post('id_tes');
				$this->form_validation->set_rules('id_tes', 'Tes', 'required');
				$this->form_validation->set_rules('tgl_tes', 'Tanggal Tes', 'required');
				$this->form_validation->set_rules('id_kelas', 'Jadwal Tes', 'required|is_unique[jadwal.id_kelas.id_tes.id_tes.'.$id_j.']');
            }

            if ($this->form_validation->run() == FALSE){
               $res['error']='<div class="alert alert-danger">'.validation_errors().'</div>';
            }else{
                if($form==="siswa" || $form==="guru" || $form==="admin"){
                  $this->tes_model->createuser($form);
                }

                $this->tes_model->create($form);

                $res['success']='<div class="alert alert-success">Satu Data Berhasil Disimpan</div>';
            }

            header('Content-Type: application/json');
            echo json_encode($res);
            exit;
          }else {
            redirect('/admin');
          }
    }

    //FUNGSI EDIT DATA
    public function edit(){
            $tab =  $this->uri->segment(3);
            $pri =  $this->uri->segment(4);
            $id =  $this->uri->segment(5);
            $this->db->select('*');
            $this->db->from($tab);
            $this->db->where($pri,$id);
            $data['query'] = $this->db->get();
            $data['id'] = $id;
            $this->load->view('admin/edit_'.$tab, $data);
    }
	
	//edit password guru dan admin
	public function editpass(){
		$data['id'] = $this->uri->segment(3);
		$this->load->view('admin/edit_pass',$data);
    }
	
	public function updatepass(){
		$res['error']="";
		$res['success']="";
		$this->form_validation->set_rules('pass', 'Password Lama', 'required|trim|xss_clean|callback_change');
		$this->form_validation->set_rules('newpass', 'Password Baru', 'required|trim');
		$this->form_validation->set_rules('confpass', 'Konfirmasi Password', 'required|trim|matches[newpass]');
		if ($this->form_validation->run() == FALSE){
		   $res['error']='<div class="alert alert-danger">'.validation_errors().'</div>';
		}else{
			$this->db->where('pengguna', $this->session->userdata('pengguna'));
			$this->db->where('password', md5($this->input->post('pass')));
			$query = $this->db->get('pengguna');
			if($query->num_rows() > 0){
				$this->tes_model->updatepass();
				$res['success'] = '<div class="alert alert-success">Password berhasil diupate</div>';
			}else{
				$res['error']='<div class="alert alert-danger">Password Lama Salah</div>';
			}
		}

		header('Content-Type: application/json');
		echo json_encode($res);
		exit;
    }

    //fungsi hapus data
    public function delete($tab,$pri){
            $id =  $this->input->POST('id');
            $this->db->where($pri, $id);
            $this->db->delete($tab);
            echo'<div class="alert alert-success">Satu Data Berhasil Dihapus</div>';
            exit;
    }
	
	public function getkel(){
		 $id =  $_GET['id'];
		 $cnt= $_GET['par'];
		 if($cnt=="tes"){
			$this->tes_model->ShowKelTes($id); 
		 }elseif($cnt=="soal"){
			 $this->tes_model->ShowJumSoal($id); 
		 }
	}

	public function gethasil(){
		$idt =  $_GET['idtes'];
		$idk =  $_GET['idkelas'];
		$anal=  $_GET['anal'];
		if($anal=="tk"){
			$this->tes_model->ShowLapTk($idt,$idk); 
		}elseif($anal=="dp"){
			$this->tes_model->ShowLapDp($idt,$idk); 
		}elseif($anal=="jml"){
			$this->tes_model->ShowJmlSis($idt,$idk); 
		}
	}
	
    //fungsi update data
    public function update(){
            $res['error']="";
            $res['success']="";
            $tab =  $this->uri->segment(3);
            $pri =  $this->uri->segment(4);
            $id =   $this->uri->segment(5);
      if(!empty($tab) or !empty($pri) ){
            if($tab==="kelas"){
                $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[kelas.nama_kelas]');
            }elseif($tab==="matpel"){
                $id_m = $id;
				//$this->form_validation->set_rules('username', 'Username', 'required|edit_unique[admin.username.'.$user_name.']');
				$this->form_validation->set_rules('nama_matpel', 'Nama Mata Pelajaran', 'required|is_unique[matpel.nama_matpel.id_matpel.'.$id_m.']');
                $this->form_validation->set_rules('kkm', 'KKM', 'required|numeric');
            
			}elseif($tab==="siswa"){

                $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
                $this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'required');
                $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir Lahir', 'required');
                //$this->form_validation->set_rules('status', 'Status', 'required');
                $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
            }elseif($tab==="guru"){
                $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required');
                $this->form_validation->set_rules('nuptk', 'NUPTK', 'required|numeric');
                $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required');
                $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
                $this->form_validation->set_rules('pend_guru', 'Pendidikan Guru', 'required');
                $this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required');
                $this->form_validation->set_rules('golongan', 'Golongan', 'required');
            }elseif($tab==="admin"){
				$id_a = $id;
				$this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.username.id_admin.'.$id_a.']');
                $this->form_validation->set_rules('nama_lengkap', 'Nama Admin', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required|md5');

            }elseif($tab==="tes"){
				$id_t = $id;
                $this->form_validation->set_rules('nama_tes', 'Nama Tes', 'required|is_unique[tes.nama_tes.id_tes.'.$id_t.']');
                $this->form_validation->set_rules('waktu', 'Lama Tes', 'required|numeric');
                //$this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required');
                $this->form_validation->set_rules('jumlah_soal', 'Banyak Soal', 'required|numeric');
                $this->form_validation->set_rules('status_tes', 'Banyak Soal', 'numeric');

            }elseif($tab==="bank_soal"){
                $this->form_validation->set_rules('id_matpel', 'Mata Pelajaran', 'required');
                $this->form_validation->set_rules('soal', 'Soal Pertanyan', 'required');
                $this->form_validation->set_rules('a', 'Pilihan Jawaban A', 'required');
                $this->form_validation->set_rules('b', 'Pilihan Jawaban B', 'required');
                $this->form_validation->set_rules('c', 'Pilihan Jawaban C', 'required');
                $this->form_validation->set_rules('d', 'Pilihan Jawaban D', 'required');
                $this->form_validation->set_rules('jawaban_benar', 'Jawaban Benar', 'required');
            }elseif($tab==="mengajar"){
                $this->form_validation->set_rules('nip', 'Guru', 'required');
                $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
            }elseif($tab==="jadwal"){
				$id_j = $this->input->post('id_tes');
				$this->form_validation->set_rules('tgl_tes', 'Tanggal Tes', 'required');
				$this->form_validation->set_rules('id_tes', 'Tes', 'required');
				$this->form_validation->set_rules('id_kelas', 'Jadwal Tes', 'required');
            }

            if ($this->form_validation->run() == FALSE){
               $res['error']='<div class="alert alert-danger">'.validation_errors().'</div>';

            }else{
                $this->tes_model->update($tab,$pri,$id);
                $res['success'] = '<div class="alert alert-success">Satu Data berhasil diupate</div>';
            }

            header('Content-Type: application/json');
            echo json_encode($res);
            exit;
          }else {
              redirect('/admin');
          }
    }
	
	public function downloadExcel2()
	{
		$alphas = range('A', 'Z');
		$kelasatas = array();
		$kelasbawah = array();
		$idt=$this->input->post('id_tes');
		$idk=$this->input->post('id_kelas');
		$data=json_decode($this->tes_model->ShowDataLap('jumso',$idt,$idk),true);
		$jumlah=$data[0]['jumlah_soal'];
		$kunci=explode("-",$data[0]['kunci']);
		$data=$this->tes_model->ShowDataLap('nilai',$idt,$idk);
		$data2=$this->tes_model->ShowDataLap('ntk',$idt,$idk);
		$data3=$this->tes_model->ShowDataLap('ndp',$idt,$idk);
				
        $this->load->library("excel");
 
            //membuat objek PHPExcel
            $objPHPExcel = new PHPExcel();
 
            //BEGIN OF Nilai Sheet
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //isi dari database merupakan isinya
                                        ->setCellValue('A1', 'No')
										->setCellValue('B1', 'Nama Siswa')
                                        ->setCellValue('C1', 'Hasil Tes Objektif')
										->setCellValue('C2', 'Benar')
										->setCellValue('D2', 'Salah')
										->setCellValue('E2', 'Kosong')
                                        ->setCellValue('F1', 'Nilai')
                                        ->setCellValue('G1', 'Keterangan');
			
			//menampilkan data nilai							
			for($tk=0;$tk<(count($data));$tk++){
				$nilai=round($data[$tk]['Benar']*100/$jumlah,2);
				
				if($nilai>$this->session->userdata('kkm')){
						 $ket='LULUS';
				}else{
						  $ket='REMEDI';
				}
				$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue('A'.($tk+3), $tk+1)
											->setCellValue('B'.($tk+3), $data[$tk]['nama_siswa'])
											->setCellValue('C'.($tk+3), $data[$tk]['Benar'])
											->setCellValue('D'.($tk+3), $data[$tk]['Salah'])
											->setCellValue('E'.($tk+3), $data[$tk]['Kosong'])
											->setCellValue('F'.($tk+3), $nilai)
											->setCellValue('G'.($tk+3), $ket);
											
			}
			
			//untuk menampilkan kunci jawaban
			for($k=0;$k<(count($kunci));$k++){
				if(7+$k<26){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alphas[7+$k].'1', $kunci[$k]);
				}else{
					$b=($k+7)-26;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alphas[0].$alphas[$b-1].'1', $kunci[$k]);
				}
				
			}
			
			//menampilkan urutan soal
			for($i=1;$i<=$jumlah;$i++){
				if(6+$i<26){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alphas[6+$i].'2', $i);
				}else{
					$b=($i+6)-25;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alphas[0].$alphas[$b-1].'2', $i);
				}
			}
			
			//menampilkan jawaban siswa
			for($tk=0;$tk<(count($data));$tk++){
				$jawab=explode("-",$data[$tk]['jaw']);
				for($jw=0;$jw<(count($jawab));$jw++){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alphas[7+$jw].($tk+3), $jawab[$jw]);
				}
											
			}
			
			$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
			$objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
			$objPHPExcel->getActiveSheet()->mergeCells('C1:E1');
			$objPHPExcel->getActiveSheet()->mergeCells('F1:F2');
			$objPHPExcel->getActiveSheet()->mergeCells('G1:G2');
            $objPHPExcel->getActiveSheet()->setTitle('Nilai');
			//END OF Nilai Sheet
			
			//BEGIN OF Tingkat Kesukaran Sheet
			$objWorkSheet = $objPHPExcel->createSheet(1); 
			$objWorkSheet->setCellValue('A1', 'No')
					->setCellValue('B1', 'Soal')
					->setCellValue('C1', 'A')
					->setCellValue('D1', 'B')
					->setCellValue('E1', 'C')
					->setCellValue('F1', 'D')
					->setCellValue('G1', 'TK')
					->setCellValue('H1', 'Kesulitan');
					
			//menampilkan data tingkat kesukaran soal
			for($tk2=0;$tk2<(count($data2));$tk2++){
				$objWorkSheet->setCellValue('A'.($tk2+2), $tk2+1)
											->setCellValue('B'.($tk2+2), $data2[$tk2]['soal'])
											->setCellValue('C'.($tk2+2), $data2[$tk2]['A'])
											->setCellValue('D'.($tk2+2), $data2[$tk2]['B'])
											->setCellValue('E'.($tk2+2), $data2[$tk2]['C'])
											->setCellValue('F'.($tk2+2), $data2[$tk2]['D'])
											->setCellValue('G'.($tk2+2), $data2[$tk2]['TK'])
											->setCellValue('H'.($tk2+2), $data2[$tk2]['Kesulitan']);
											
			}
			$objWorkSheet->setTitle("Nilai TK");
			//END OF Tingkat Kesukaran Sheet
			
			//BEGIN OF Daya Pembeda Sheet
			$objWorkSheet2 = $objPHPExcel->createSheet(2); 
			$objWorkSheet2->setCellValue('A1', 'No')
					->setCellValue('B1', 'NIS')
					->setCellValue('C1', 'Nama Siswa');
			
			//menampilkan urutan soal
			for($i=1;$i<=$jumlah;$i++){
				if(2+$i<26){
					$objWorkSheet2->setCellValue($alphas[2+$i].'1', $i);
				}else{
					$b=($i+2)-25;
					$objWorkSheet2->setCellValue($alphas[0].$alphas[$b-1].'1', $i);
				}
			}
			
			//menampilkan jawaban siswa
			for($dp=0;$dp<(count($data3));$dp++){
				if($dp<(count($data3)/2)){
						$objWorkSheet2->setCellValue('A'.($dp+2), $dp+1)
											->setCellValue('B'.($dp+2), $data3[$dp]['nis'])
											->setCellValue('C'.($dp+2), $data3[$dp]['nama_siswa']);
						$jawab=explode("-",$data3[$dp]['jawaban']);
						for($jw=0;$jw<(count($jawab));$jw++){
							$objWorkSheet2->setCellValue($alphas[3+$jw].($dp+2), $jawab[$jw]);
							
							if(!array_key_exists($jw,$kelasatas)){
								array_push($kelasatas, 0);
							}
							$kelasatas[$jw]+=$jawab[$jw];
						}	
				}elseif($dp>=(count($data3)/2)){
						$objWorkSheet2->setCellValue('A'.($dp+2), $dp+1)
											->setCellValue('B'.($dp+2), $data3[$dp]['nis'])
											->setCellValue('C'.($dp+2), $data3[$dp]['nama_siswa']);
						$jawab=explode("-",$data3[$dp]['jawaban']);
						for($jw=0;$jw<(count($jawab));$jw++){
							$objWorkSheet2->setCellValue($alphas[3+$jw].($dp+2), $jawab[$jw]);
							
							if(!array_key_exists($jw,$kelasbawah)){
								array_push($kelasbawah, 0);
							}
							$kelasbawah[$jw]+=$jawab[$jw];
						}	
				}								
			}
			$col=count($data3)+4;
			$jmlsis=count($data3)/2;
			$objWorkSheet2->setCellValue('A'.$col, 'No')
					->setCellValue('B'.$col, 'Batas Atas')
					->setCellValue('C'.$col, 'Batas Bawah')
					->setCellValue('D'.$col, 'Daya Pembeda')
					->setCellValue('E'.$col, 'Kualitas');
			
			for($ka=0;$ka<(count($kelasatas));$ka++){
				$dpm=($kelasatas[$ka]-$kelasbawah[$ka])/$jmlsis;
				if($dpm>0.4){
					$kualitas="DITERIMA BAIK";
				}elseif($dpm>0.3){
					$kualitas="DITERIMA, DIPERBAIKI";
				}elseif($dpm>0.2){
					$kualitas="DIPERBAIKI";
				}else{
					$kualitas="DIBUANG";
				}	
				$objWorkSheet2->setCellValue('A'.($col+1+$ka), $ka+1)
					->setCellValue('B'.($col+1+$ka), $kelasatas[$ka])
					->setCellValue('C'.($col+1+$ka), $kelasbawah[$ka])
					->setCellValue('D'.($col+1+$ka), round($dpm,2))
					->setCellValue('E'.($col+1+$ka), $kualitas);					
			}
			
			$objWorkSheet2->setTitle("Nilai DP");
			//END OF Daya Pembeda Sheet
			
            //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            //sesuaikan headernya 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //ubah nama file saat diunduh
			$nama="hasil-tes.xlsx";
            header('Content-Disposition: attachment;filename="'.$nama.'"');
            //unduh file
            $objWriter->save("php://output");
 	}
}
