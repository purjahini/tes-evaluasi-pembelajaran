      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  <?php 
		$datetime = date_default_timezone_set('Asia/Jakarta');
		$tgl=explode(" ",$this->session->userdata('tgltes'));
		$tgl2=explode("/",$tgl[0]);
		$tgl3=explode(".",$tgl[1]);
		$jam = $tgl3[0];
		$menit = $tgl3[1];
		$detik = 0;
		
		$hari = $tgl2[0];
		$bulan = $tgl2[1];
		$tahun = $tgl2[2];
	
		$time = mktime($jam,$menit,$detik,$bulan,$hari,$tahun);
		$plus = $this->session->userdata('waktu')*60; //10; menit dikali dengan 60 detik
		$timePlus = $time + $plus;
		$hasil = date("Y-m-d H:i:s", $timePlus);

	  ?>
      <section id="main-content">
        <section class="wrapper site-min-height">
			<h3 class="nun"><i class='fa fa-angle-right'></i><?=$this->session->userdata('nmtes')?> </h3>
			<div class="row mt">
				<div class="col-lg-12">
					<div class="form-panel">
						<?php
							
							$row=$query->row($this->session->userdata('qn'));
							$n=$this->session->userdata('qn')+1;
							
							echo "<div class='row'>
							<div class='col-xs-9'><h4 class='nun' align='center'><i class='fa fa-angle-right'></i> Pertanyaan ".  $n ." dari ".$this->session->userdata('jum')."</h4>
							</div><div class='col-xs-3' align='right'><div id='defaultCountdown'></div></div>
							</div>";
							echo "<form name=myfm method=post action=".base_url()."siswa/tes>";
							
							
							
							echo "$n. $row->soal";
							echo "<div class='radio'><label>&nbsp&nbsp&nbsp&nbsp<input type=radio name=ans value=A "; echo ($row->jawaban === "A")?"checked":""; echo ">$row->a </label></div>";
							echo "<div class='radio'><label>&nbsp&nbsp&nbsp&nbsp<input type=radio name=ans value=B "; echo ($row->jawaban === "B")?"checked":""; echo">$row->b </label></div>";
							echo "<div class='radio'><label>&nbsp&nbsp&nbsp&nbsp<input type=radio name=ans value=C "; echo ($row->jawaban === "C")?"checked":""; echo">$row->c </label></div>";
							echo "<div class='radio'><label>&nbsp&nbsp&nbsp&nbsp<input type=radio name=ans value=D "; echo ($row->jawaban === "D")?"checked":""; echo">$row->d </label></div>";

							if(($this->session->userdata('qn') < $query->num_rows()-1) && $this->session->userdata('qn')==0){
								echo "<input class='btn btn-theme' type=submit name=submit value='Selanjutnya'></form>";
							}elseif(($this->session->userdata('qn') < $query->num_rows()-1)&& $this->session->userdata('qn')!=0){
								echo "<input class='btn btn-theme' type=submit name=submit value='Sebelumnya'> <input class='btn btn-theme' type=submit name=submit value='Selanjutnya'></form>";
							}else{
								echo "<input class='btn btn-theme' type=submit name=submit value='Sebelumnya'> <input class='btn btn-theme04' type=submit name=submit value='Selesai'></form>";
							}					
						?>
					</div><!--/content-panel -->
				</div><!-- /col-md-12 -->
			</div><!-- row -->
		</section><!--/wrapper -->
	</section>
<script>
		$(document).ready(function (periods) {
		var austDay = new Date('<?php echo $hasil ?>');
		
			$('#defaultCountdown').countdown({until: austDay,
				onExpiry: function() {
					alert("Waktu tes sudah habis"); 
					window.location = '<?php echo base_url();?>siswa/tes/selesai';
				},
			});
		
		var waktucountdown = String($('#defaultCountdown').countdown('getTimes'));
			if(waktucountdown==='0,0,0,0,0,0,0'){
				alert("Waktu tes sudah habis"); 
				window.location = '<?php echo base_url();?>siswa/tes/selesai';
			}
		});
	</script>