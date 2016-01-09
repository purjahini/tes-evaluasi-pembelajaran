      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  
      <section id="main-content">
		<section class="wrapper site-min-height">
			<div class="row mt">
				<div class="col-md-12">
					<div class="content-panel">
						<table class="table table-hover">
							<h4><i class="fa fa-tasks"></i>Daftar Tes</h4>
							<hr>
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Tes</th>
										<th>Jumlah Soal</th>
										<th>Waktu</th>
										<th>Jadwal</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										foreach($query as $row){
										$no++;
                                    ?>
									<tr>
										<td><?php echo $no?></td>
										<td><?php echo $row->nama_tes?></td>
										<td><?php echo $row->jumlah_soal?> Soal</td>
										<td><?php echo $row->waktu?> Menit</td>
										<td><?php echo $row->tgl_tes?></td>
										<?php 
										$datetime = date_default_timezone_set('Asia/Jakarta');
										$tgl=explode(" ",$row->tgl_tes);
										$tgl2=explode("/",$tgl[0]);
										$tgl3=explode(".",$tgl[1]);
										$jam = $tgl3[0];
										$menit = $tgl3[1];
										$detik = 0;
										
										$hari = $tgl2[0];
										$bulan = $tgl2[1];
										$tahun = $tgl2[2];
									
										$time = mktime($jam,$menit,$detik,$bulan,$hari,$tahun);
										$plus = $row->waktu*60; //10; menit dikali dengan 60 detik
										$timePlus = $time + $plus;										
										$time2=mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
										if($time2>$timePlus){
												echo "<td><span class='label label-danger'>Sudah Terlewat</span></td>";
										}elseif($time2<$time){
												echo "<td><span class='label label-info'>Belum Mulai</span></td>";
										}else{
										?>
											<td><a href="<?php echo base_url();?>siswa/cektes/<?=$row->id_tes?>" class="btn btn-success btn-xs">Mulai</a></td>
										<?php
										}
										?>
										
									</tr>
									<?php } ?>
								</tbody>
						</table>
					</div><!--/content-panel -->
				</div><!-- /col-md-12 -->
			</div><!-- row -->
		</section><!--/wrapper -->
      </section>
