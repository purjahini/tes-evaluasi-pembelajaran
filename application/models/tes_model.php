<?php
class Tes_model extends CI_Model {

  public function search_document() {
		$input = array('dataperpage', 'query1','query2', 'curpage','tabel');
		foreach ($input as $val)
		$$val = $this->input->post($val);

		$query4 = $this->db->escape_like_str($query1);

		if($tabel=="pengguna"){
			 $where = "pengguna.$query2 LIKE '%{$query4}%' and pengguna.level='admin'";
		}elseif($tabel=="tes" && $this->session->userdata('level')==="Guru"){
			$where = "$query2 LIKE '%{$query4}%' and nip='".$this->session->userdata('pengguna')."'";
		}elseif($tabel=="laporan"){
			$where = "bank_soal.id_tes = '$query2' and siswa.id_kelas ='$query1'";
		}elseif($tabel=="bank_soal"){
			$where = "soal LIKE '%{$query4}%' OR  nama_matpel LIKE '%{$query4}%'";
		}else{
			$where = "$query2 LIKE '%{$query4}%'";
		}

		if($tabel=="bank_soal" && $this->session->userdata('level')==="Guru"){
			$query = $this->db->query("SELECT COUNT($query2) AS HASIL FROM $tabel join matpel on bank_soal.id_matpel=matpel.id_matpel join guru on guru.id_matpel=matpel.id_matpel WHERE $where and guru.nip='".$this->session->userdata('pengguna')."' ");
		}elseif($tabel=="jadwal" && $this->session->userdata('level')==="Guru"){
		  $query = $this->db->query("SELECT COUNT($query2) AS HASIL FROM $tabel join tes on jadwal.id_tes=tes.id_tes WHERE $where and tes.nip='".$this->session->userdata('pengguna')."' ");
		}elseif($tabel=="admin"){
			$query = $this->db->query("SELECT COUNT($query2) AS HASIL FROM $tabel join pengguna on admin.username=pengguna.pengguna WHERE $where ");
		}elseif($tabel=="laporan"){
			$query = $this->db->query("SELECT COUNT( DISTINCT hasil_jawaban.nis )AS HASIL FROM hasil_jawaban
								JOIN siswa ON hasil_jawaban.nis = siswa.nis
								JOIN bank_soal ON hasil_jawaban.id_soal = bank_soal.id_soal
								WHERE $where");
		}elseif($tabel=="bank_soal"){
			$query = $this->db->query("SELECT COUNT($query2) AS HASIL FROM $tabel join matpel on bank_soal.id_matpel=matpel.id_matpel WHERE $where ");
		}else{
			$query = $this->db->query("SELECT COUNT($query2) AS HASIL FROM $tabel WHERE $where ");
		}
		
		$total = $query->row()->HASIL;
		$npage = ceil($total / $dataperpage);

		$start = $curpage * $dataperpage;
		$end = $start + $dataperpage;

		if($tabel==="siswa"){
			$query = $this->db->query("SELECT siswa.nis, siswa.nama_siswa, siswa.jenkel, siswa.tmp_lahir, siswa.tgl_lahir, kelas.nama_kelas  FROM $tabel JOIN kelas on kelas.id_kelas=siswa.id_kelas WHERE $where LIMIT $start, $dataperpage");
		}elseif ($tabel==="guru") {
		  $query = $this->db->query("SELECT guru.nip, guru.nuptk, guru.nama_guru, guru.tmp_lahir, guru.tgl_lahir, guru.golongan, matpel.nama_matpel FROM $tabel JOIN matpel on matpel.id_matpel=guru.id_matpel WHERE $where LIMIT $start, $dataperpage");
		}elseif ($tabel==="tes") {
		   $query = $this->db->query("SELECT tes.id_tes, tes.nama_tes,tes.waktu,tes.jumlah_soal, tes.status_tes FROM $tabel WHERE $where LIMIT $start, $dataperpage");
		}elseif ($tabel==="bank_soal") {
			if($this->session->userdata('level')==="Guru"){
				$query = $this->db->query("SELECT bank_soal.id_soal,bank_soal.soal, bank_soal.a, bank_soal.b, bank_soal.c, bank_soal.d, bank_soal.jawaban_benar, matpel.nama_matpel FROM $tabel JOIN matpel on bank_soal.id_matpel=matpel.id_matpel JOIN guru on guru.id_matpel=matpel.id_matpel WHERE $where and guru.nip='".$this->session->userdata('pengguna')."' LIMIT $start, $dataperpage");
			}else{
				$query = $this->db->query("SELECT bank_soal.id_soal,bank_soal.soal, bank_soal.a, bank_soal.b, bank_soal.c, bank_soal.d, bank_soal.jawaban_benar, matpel.nama_matpel FROM $tabel JOIN matpel on bank_soal.id_matpel=matpel.id_matpel WHERE $where LIMIT $start, $dataperpage");
			}
		}elseif ($tabel==="mengajar") {
		  $query = $this->db->query("SELECT mengajar.kd, mengajar.nip, mengajar.id_kelas, kelas.nama_kelas, kelas.kelas, guru.nama_guru FROM $tabel JOIN guru on mengajar.nip=guru.nip JOIN kelas on mengajar.id_kelas=kelas.id_kelas WHERE mengajar.nip LIKE '%$query4%' LIMIT $start, $dataperpage");
		}elseif ($tabel==="jadwal") {
		  if($this->session->userdata('level')==="Guru"){
				$query = $this->db->query("SELECT jadwal.id_jadwal,jadwal.tgl_tes, tes.nama_tes, kelas.nama_kelas FROM $tabel JOIN tes on jadwal.id_tes=tes.id_tes JOIN kelas on jadwal.id_kelas=kelas.id_kelas WHERE $where and tes.nip='".$this->session->userdata('pengguna')."' LIMIT $start, $dataperpage");
		  }else{
				$query = $this->db->query("SELECT jadwal.id_jadwal,jadwal.tgl_tes, tes.nama_tes, kelas.nama_kelas FROM $tabel JOIN tes on jadwal.id_tes=tes.id_tes JOIN kelas on jadwal.id_kelas=kelas.id_kelas WHERE $where LIMIT $start, $dataperpage");
		  }
		}elseif ($tabel==="pengguna") {
		  $query = $this->db->query("SELECT * FROM $tabel WHERE $where LIMIT $start, $dataperpage");
		}elseif ($tabel==="laporan") {
		  $query = $this->db->query("SELECT siswa.nama_siswa, siswa.nis, COUNT( 
									CASE WHEN hasil_jawaban.keterangan = 'Benar'
									THEN 1 
									ELSE NULL 
									END ) AS Benar, COUNT( 
									CASE WHEN hasil_jawaban.keterangan = 'Salah'
									THEN 1 
									ELSE NULL 
									END ) AS Salah, COUNT( 
									CASE WHEN hasil_jawaban.keterangan = 'Kosong'
									THEN 1 
									ELSE NULL 
									END ) AS Kosong, GROUP_CONCAT( hasil_jawaban.jawaban order by bank_soal.id_soal
									SEPARATOR  '-' ) AS jaw
									FROM hasil_jawaban
									JOIN siswa ON hasil_jawaban.nis = siswa.nis
									JOIN bank_soal ON hasil_jawaban.id_soal = bank_soal.id_soal
									WHERE $where
									GROUP BY hasil_jawaban.nis LIMIT $start, $dataperpage");
		}else{
		  $query = $this->db->query("SELECT * FROM $tabel WHERE $where LIMIT $start, $dataperpage");
		}

		$fields = $query->list_fields();

		$hasil = array(
		  'data' => array(),
		  'pagination' => '',
		  'numpage' => $npage - 1,
		);
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				foreach($fields as $field)
				{
				   $array[$field]= $row->$field;
				}
				$hasil['data'][] = $array;
			}
		}

		$hasil['pagination'] .='<div class="col-lg-4">Banyak Data : '.$total.'</div><div class="col-lg-8"><ul class="pagination">
		  <li class="'. ($curpage == 0 ? 'disabled' : '') .'" onclick="return Document.prevPage()"><a href>&laquo;</li>';

		$hasil['pagination'].= "<li>Halaman ".($curpage+1)." dari ".(($npage==1||$npage==0) ? $npage=1 : $npage) ."</li>";
		/*for ($i = 1; $i <= $npage1; $i++) {

			$hasil['pagination'] .= '<li class="' . ($curpage == ($i - 1) ? 'active' : '') . '" onclick="return Document.setPage(' . ($i - 1) .')"><a href>' . $i . '</a></li>';
		} */
		$hasil['pagination'] .= '<li class="' . ($curpage == $npage - 1 ? 'disabled' : '') . '" onclick="return Document.nextPage()"><a href>&raquo;</a></li>
		  </ul></div>';

		echo json_encode($hasil, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

    //fungsi untuk menyimpan kedatabase
    public function create($tabel){
        //mengambil seluruh data dari tabel yang akan di eksekusi
        $query = $this->db->query("SELECT * FROM $tabel");
        //mencari jumlah field dari tabel yang dipilih
        $fields = $query->list_fields();

        //perulangan menampilkan nama field disertai data dan dimasukkan ke dalam array
           foreach($fields as $field)
                {
                     $array[$field]= $this->input->post($field);
					 //contoh NIS=12119292, Nama=Udin dll
                }
            $data = $array;

            //menyimpan data ke tabel yang dipilih
            $this->db->insert($tabel, $data);
    }

    public function createuser($tabel){
		if($tabel==="siswa"){
			$pengguna=$this->input->post('nis');
			$level="Siswa";
		}elseif($tabel==="guru"){
			$pengguna=$this->input->post('nip');
			$level="Guru";
		}elseif($tabel==="admin"){
			$pengguna=$this->input->post('username');
			$level="Admin";
		}
	
		if($tabel==="siswa" || $tabel==="guru"){
			$data = array(
				'pengguna' => $pengguna,
				'password' => md5($this->input->post('tgl_lahir')),
				'level' => $level,
				'status' => 'Aktif'
			);
		}else{
			$data = array(
				'pengguna' => $pengguna,
				'password' => $this->input->post('password'),
				'level' => $level,
				'status' => 'Aktif'
			);
		}

			$this->db->insert('pengguna', $data);
    }

    public function update($tab,$pri,$id){
          $query=$this->db->query("SHOW FIELDS FROM $tab WHERE FIELD NOT IN ('$pri')");

          foreach($query->result() as $row){
                    $array[$row->Field]= $this->input->post($row->Field);
          }$data = $array;
          //menyimpan data ke tabel yang dipilih
          $this->db->where($pri, $id);
          $this->db->update($tab, $data);
    }
	
	public function updatepass(){
		$id=$this->session->userdata('pengguna');
		$pass=mysql_real_escape_string(md5($this->input->post('confpass')));
		$data = array(
               'password' =>$pass,
		);
		$this->db->where('pengguna', $id);
		$this->db->update('pengguna', $data);
    }

    public function ShowKel($kelas){
        if(empty($kelas)){
          $kelas="";
        }

        if($this->session->userdata('level')=="Guru"){
          $sql="SELECT kelas.id_kelas, kelas.nama_kelas, kelas.kelas FROM kelas join mengajar on kelas.id_kelas=mengajar.id_kelas WHERE mengajar.nip='".$this->session->userdata('pengguna')."' order by id_kelas asc";
        }else{
          $sql="SELECT id_kelas,nama_kelas, kelas FROM kelas order by id_kelas asc";
        }
        $query = $this->db->query($sql);
        foreach ($query->result() as $row){
          echo '<option value=';
          echo  $row->id_kelas." ";
          echo ($row->id_kelas === $kelas) ? "selected" : "";
          echo '>';
          echo $row->kelas." ".$row->nama_kelas.'</option>';
        }
    }

    public function ShowMatPel($matpel){
        if(empty($matpel)){
          $matpel="";
        }
        $sql="SELECT id_matpel,nama_matpel FROM matpel order by id_matpel asc";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row){
            echo '<option value=';
            echo  $row->id_matpel." ";
            echo ($row->id_matpel === $matpel) ? "selected" : "";
            echo '>';
            echo $row->nama_matpel.'</option>';
        }
    }

    public function ShowTes($tes){
        if(empty($tes)){
          $tes="";
        }
		
		if($this->session->userdata('level')==="Guru"){
			$sql="SELECT id_tes,nama_tes FROM tes WHERE nip='".$this->session->userdata('pengguna')."' order by id_tes asc";
        }else{
			$sql="SELECT id_tes,nama_tes FROM tes  order by id_tes asc";
		}
		$query = $this->db->query($sql);
        foreach ($query->result() as $row){
            echo '<option value=';
            echo  $row->id_tes." ";
            echo ($row->id_tes === $tes) ? "selected" : "";
            echo '>';
            echo $row->nama_tes.'</option>';
        }
    }

    public function ShowData($guru){
        if(empty($guru)){
          $guru="";
        }
        $sql="SELECT nip,nama_guru FROM guru order by nip asc";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row){
            echo '<option value=';
            echo  $row->nip." ";
            echo ($row->nip === $guru) ? "selected" : "";
            echo '>';
            echo $row->nip.' - '.$row->nama_guru.'</option>';
        }
    }
	
	public function ShowKelTes($id){		
		$query=$this->db->query("SELECT kelas.id_kelas, kelas.nama_kelas FROM `jadwal` join kelas on jadwal.id_kelas=kelas.id_kelas where jadwal.id_tes='$id' order by kelas.nama_kelas asc");
		$respon = array();
		$j=$query->num_rows();
		for($i=0;$i<$j;$i++){
				$respon[] = $query->row_array($i);
		}
		echo json_encode($respon);
	}
	
	public function ShowJumSoal($id){
		$query=$this->db->query("SELECT t.jumlah_soal, 
								GROUP_CONCAT( b.jawaban_benar order by b.id_soal
								SEPARATOR  '-' ) AS kunci 
								FROM tes t join bank_soal b on t.id_tes=b.id_tes 
								WHERE t.id_tes='$id'");
		$respon = array();
		if ($query->num_rows() > 0)
		{
		   $respon[] = $query->row_array(0);
		}
		echo json_encode($respon);
	}
	
	
	public function ShowDataLap($par,$idt,$idk){
		if($par=="jumso"){
			$query=$this->db->query("SELECT t.jumlah_soal, 
									GROUP_CONCAT( b.jawaban_benar order by b.id_soal
									SEPARATOR  '-' ) AS kunci 
									FROM tes t join bank_soal b on t.id_tes=b.id_tes 
									WHERE t.id_tes='$idt'");
			$respon = array();
			if ($query->num_rows() > 0)
			{
			   $respon[] = $query->row_array(0);
			}
			return json_encode($respon);
		}elseif($par=="nilai"){
			$query=$this->db->query("SELECT siswa.nama_siswa, siswa.nis, COUNT( 
									CASE WHEN hasil_jawaban.keterangan = 'Benar'
									THEN 1 
									ELSE NULL 
									END ) AS Benar, COUNT( 
									CASE WHEN hasil_jawaban.keterangan = 'Salah'
									THEN 1 
									ELSE NULL 
									END ) AS Salah, COUNT( 
									CASE WHEN hasil_jawaban.keterangan = 'Kosong'
									THEN 1 
									ELSE NULL 
									END ) AS Kosong, GROUP_CONCAT( hasil_jawaban.jawaban order by bank_soal.id_soal
									SEPARATOR  '-' ) AS jaw
									FROM hasil_jawaban
									JOIN siswa ON hasil_jawaban.nis = siswa.nis
									JOIN bank_soal ON hasil_jawaban.id_soal = bank_soal.id_soal
									WHERE bank_soal.id_tes = ".$idt." and siswa.id_kelas =".$idk."
									GROUP BY hasil_jawaban.nis ");
				$respon = array();
				if ($query->num_rows() > 0)
				{
				   $j=$query->num_rows();
					for($i=0;$i<$j;$i++){
							$respon[] = $query->row_array($i);
					}
				}
				return $respon;
		}elseif($par=="ntk"){
			$query=$this->db->query("SELECT b.soal, COUNT( 
				CASE WHEN h.jawaban =  'A'
				THEN 1 
				ELSE NULL 
				END ) AS A, COUNT( 
				CASE WHEN h.jawaban =  'B'
				THEN 1 
				ELSE NULL 
				END ) AS B, COUNT( 
				CASE WHEN h.jawaban =  'C'
				THEN 1 
				ELSE NULL 
				END ) AS C, COUNT( 
				CASE WHEN h.jawaban =  'D'
				THEN 1 
				ELSE NULL 
				END ) AS D, 
				CAST( COUNT( CASE WHEN h.jawaban = b.jawaban_benar THEN 1 ELSE NULL END ) / COUNT( h.nis ) AS DECIMAL( 5, 2 ) ) AS TK,  
				(CASE 	WHEN CAST( COUNT( CASE WHEN h.jawaban = b.jawaban_benar THEN 1 ELSE NULL END ) / COUNT( h.nis ) AS DECIMAL( 	 
					5, 2 ) ) > 0.71  THEN 'MUDAH' 
					WHEN CAST( COUNT( CASE WHEN h.jawaban = b.jawaban_benar THEN 1 ELSE NULL END ) / COUNT( h.nis ) AS DECIMAL(
						5, 2 ) ) > 0.31 THEN 'SEDANG'
						ELSE 'SUKAR'
						END) AS Kesulitan
				FROM hasil_jawaban h
				JOIN siswa s ON h.nis = s.nis
				JOIN bank_soal b ON h.id_soal = b.id_soal
				WHERE b.id_tes =  '$idt'
				AND s.id_kelas =  '$idk'
				GROUP BY b.id_soal
				ORDER BY b.id_soal ASC");

				$respon = array();
				if ($query->num_rows() > 0)
				{
				   $j=$query->num_rows();
					for($i=0;$i<$j;$i++){
							$respon[] = $query->row_array($i);
					}
				}
				return $respon;
			
		}elseif($par='ndp'){
			$limit=$this->db->query("SELECT ROUND((SELECT COUNT( DISTINCT h.nis ) 
									FROM hasil_jawaban h
									JOIN siswa s ON h.nis = s.nis
									JOIN bank_soal b ON h.id_soal = b.id_soal
									WHERE b.id_tes = '$idt'
									AND s.id_kelas = '$idk' ) * 0.27
									) AS jml_siswa");
			$limrow = $limit->row(); 
			
			$query=$this->db->query("(SELECT s.nama_siswa, s.nis, GROUP_CONCAT( 
			CASE WHEN h.jawaban = b.jawaban_benar
			THEN 1 
			ELSE 0 
			END 
			ORDER BY b.id_soal
			SEPARATOR '-' ) AS jawaban, COUNT( 
			CASE WHEN h.keterangan = 'Benar'
			THEN 1 
			ELSE NULL 
			END ) AS Benar
			FROM hasil_jawaban h
			JOIN siswa s ON h.nis = s.nis
			JOIN bank_soal b ON h.id_soal = b.id_soal
			WHERE b.id_tes = '$idt'
			AND s.id_kelas = '$idk'
			GROUP BY h.nis
			ORDER BY Benar DESC limit ".$limrow->jml_siswa.")
			UNION
			(SELECT s.nama_siswa, s.nis, GROUP_CONCAT( 
			CASE WHEN h.jawaban = b.jawaban_benar
			THEN 1 
			ELSE 0 
			END 
			ORDER BY b.id_soal
			SEPARATOR '-' ) AS jawaban, COUNT( 
			CASE WHEN h.keterangan = 'Benar'
			THEN 1 
			ELSE NULL 
			END ) AS Benar
			FROM hasil_jawaban h
			JOIN siswa s ON h.nis = s.nis
			JOIN bank_soal b ON h.id_soal = b.id_soal
			WHERE b.id_tes = '$idt'
			AND s.id_kelas = '$idk'
			GROUP BY h.nis
			ORDER BY Benar ASC limit ".$limrow->jml_siswa.") ORDER BY Benar DESC");

			$respon = array();
			   $j=$query->num_rows();
				for($i=0;$i<$j;$i++){
						$respon[] = $query->row_array($i);
				}
			
			return $respon;
		}
	}
	
	public function ShowLapTk($idt,$idk){
		$query=$this->db->query("SELECT b.soal, COUNT( 
		CASE WHEN h.jawaban =  'A'
		THEN 1 
		ELSE NULL 
		END ) AS A, COUNT( 
		CASE WHEN h.jawaban =  'B'
		THEN 1 
		ELSE NULL 
		END ) AS B, COUNT( 
		CASE WHEN h.jawaban =  'C'
		THEN 1 
		ELSE NULL 
		END ) AS C, COUNT( 
		CASE WHEN h.jawaban =  'D'
		THEN 1 
		ELSE NULL 
		END ) AS D, 
		CAST( COUNT( CASE WHEN h.jawaban = b.jawaban_benar THEN 1 ELSE NULL END ) / COUNT( h.nis ) AS DECIMAL( 5, 2 ) ) AS TK,  
		(CASE 	WHEN CAST( COUNT( CASE WHEN h.jawaban = b.jawaban_benar THEN 1 ELSE NULL END ) / COUNT( h.nis ) AS DECIMAL( 	 
			5, 2 ) ) > 0.71  THEN 'MUDAH' 
			WHEN CAST( COUNT( CASE WHEN h.jawaban = b.jawaban_benar THEN 1 ELSE NULL END ) / COUNT( h.nis ) AS DECIMAL(
				5, 2 ) ) > 0.31 THEN 'SEDANG'
				ELSE 'SUKAR'
				END) AS Kesulitan
		FROM hasil_jawaban h
		JOIN siswa s ON h.nis = s.nis
		JOIN bank_soal b ON h.id_soal = b.id_soal
		WHERE b.id_tes =  '$idt'
		AND s.id_kelas =  '$idk'
		GROUP BY b.id_soal
		ORDER BY b.id_soal ASC");

		$respon = array();
		if ($query->num_rows() > 0)
		{
		   $j=$query->num_rows();
			for($i=0;$i<$j;$i++){
					$respon[] = $query->row_array($i);
			}
		}
		echo json_encode($respon);
	}
	public function ShowJmlSis($idt,$idk){
		$query=$this->db->query("SELECT ROUND((SELECT COUNT( DISTINCT h.nis ) 
									FROM hasil_jawaban h
									JOIN siswa s ON h.nis = s.nis
									JOIN bank_soal b ON h.id_soal = b.id_soal
									WHERE b.id_tes = '$idt'
									AND s.id_kelas = '$idk' ) * 0.27
									) AS jml_siswa");
		$respon = array();
		if ($query->num_rows() > 0)
		{
		   $respon[] = $query->row_array(0);
		}
		echo json_encode($respon);
	}
	
	public function ShowLapDp($idt,$idk){
		$limit=$this->db->query("SELECT ROUND((SELECT COUNT( DISTINCT h.nis ) 
									FROM hasil_jawaban h
									JOIN siswa s ON h.nis = s.nis
									JOIN bank_soal b ON h.id_soal = b.id_soal
									WHERE b.id_tes = '$idt'
									AND s.id_kelas = '$idk' ) * 0.27
									) AS jml_siswa");
		$limrow = $limit->row(); 
		
		$query=$this->db->query("(SELECT s.nama_siswa, s.nis, GROUP_CONCAT( 
		CASE WHEN h.jawaban = b.jawaban_benar
		THEN 1 
		ELSE 0 
		END 
		ORDER BY b.id_soal
		SEPARATOR '-' ) AS jawaban, COUNT( 
		CASE WHEN h.keterangan = 'Benar'
		THEN 1 
		ELSE NULL 
		END ) AS Benar
		FROM hasil_jawaban h
		JOIN siswa s ON h.nis = s.nis
		JOIN bank_soal b ON h.id_soal = b.id_soal
		WHERE b.id_tes = '$idt'
		AND s.id_kelas = '$idk'
		GROUP BY h.nis
		ORDER BY Benar DESC limit ".$limrow->jml_siswa.")
		UNION
		(SELECT s.nama_siswa, s.nis, GROUP_CONCAT( 
		CASE WHEN h.jawaban = b.jawaban_benar
		THEN 1 
		ELSE 0 
		END 
		ORDER BY b.id_soal
		SEPARATOR '-' ) AS jawaban, COUNT( 
		CASE WHEN h.keterangan = 'Benar'
		THEN 1 
		ELSE NULL 
		END ) AS Benar
		FROM hasil_jawaban h
		JOIN siswa s ON h.nis = s.nis
		JOIN bank_soal b ON h.id_soal = b.id_soal
		WHERE b.id_tes = '$idt'
		AND s.id_kelas = '$idk'
		GROUP BY h.nis
		ORDER BY Benar ASC limit ".$limrow->jml_siswa.") ORDER BY Benar DESC");

		$respon = array();
		   $j=$query->num_rows();
			for($i=0;$i<$j;$i++){
					$respon[] = $query->row_array($i);
			}
		
		echo json_encode($respon);
	}
}
