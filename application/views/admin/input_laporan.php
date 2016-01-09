<script type="text/javascript">
 $(document).ready(function(){
                $("#tes").change(function(){
                    var getValue= $(this).val();					
					var h='',y='';
					
					//jika nilai option masih kosong/option belum dipilih
                    if(getValue == 0)
                    {
                        $("#kelas").html("<option>Pilih Tes Dulu</option>");
						 $('#document-data').html("");
						 $("#document-dp").html("");
						 $("#document-dp2").html("");
						 $("#document-tk").html("");
						 $('tr#kunci-data').html("");
						 $('tr#urutan-dp').html("");
						 $('tr#jawaban-data').html("");
				
                    }
					//jika option ada nilainya
                    else
                    {
						//memparsing data yang dipilih ke controller admin dengan fungsi getkel
                        $.getJSON('http://localhost/tes/admin/getkel',{'id' : getValue,'par':'tes'},function(data){
                            var showData="<option>Pilih Kelas Dulu</option>";
							//memunculkan data kelas yang ditemukan
                            $.each(data,function(index,value){
                                showData += "<option value="+value.id_kelas+">"+value.nama_kelas+"</option>";
                            })
							//memasukan data kelas ke dalam option dengan id kelas
                            $("#kelas").html(showData)
                        })
						
						$.getJSON('http://localhost/tes/admin/getkel',{'id' : getValue,'par':'soal'},function(data){
                            var shoData=0;
							var shoKunci=0;
							var urutandatadata="<th>No</th><th>Nis</th><th>Nama Siswa</th>";
							var kuncidatadata="<th>Benar</th><th>Salah</th><th>Kosong</th>";
							var jawabandatadata="<th rowspan='2'>No</th><th rowspan='2'>Nama Siswa</th><th colspan='3' >Hasil Tes Objektif</th><th rowspan='2'>Nilai</th><th rowspan='2'>Keterangan</th>";
							//memasukkan data yang ditemukan ke variabel shoData dan shoKunci
							
							$.each(data,function(index,value){
								
                                shoData = value.jumlah_soal;
								shoKunci = value.kunci;
                            })
							//memasukkan data yang ditemukan ke dalam textbox dengan id yang tertera
							$("#jumlah_soal").val(shoData);
							$("#kunci_soal").val(shoKunci);
							
							//menampilkan angka 1- jumlah maksimal soal
							for(var f = 1; f <= shoData; f++){
								y +='<th>'+ f +'</th>';
							}
							//memasukkan urutan soal ke baris dengan id kunci-data
							$('tr#kunci-data').append(kuncidatadata+y);
							$('tr#urutan-dp').append(urutandatadata+y);
							
							//memecah string kunci jawaban menjadi array 
							var kun=shoKunci.split("-");
							//menampilkan kunci jawaban secara berurut
							for(var g = 0; g < (kun.length); g++){
								h +='<th>'+ kun[g] +'</th>';
							}
							//memasukkan urutan kunci jwaban ke baris dengan id jawaban-data
							$('tr#jawaban-data').append(jawabandatadata+h);
                        })		
						
						
                    }
					
                })
				
});

</script>
<script>
        var Document = {
          param: {
            dataperpage: 50, // jumlah data per halaman
            query1: '',
            query2: '',
            curpage: 0,
            numpage: 0,
            tabel:''
          },

          url: 'http://localhost/tes/admin/data',


          search: function() {
            this.param.query1 = $('#kelas').val();
            this.param.query2 = $('#tes').val();
            this.param.tabel = $('#tabel').val();
            this.param.curpage = 0;
            this.loadData();
            return false;
          },

          setPage: function(n) {
            this.param.curpage = n;
            this.loadData();
            return false;
          },

          prevPage: function() {
            if (this.param.curpage > 0) {
              this.param.curpage--;
              this.loadData();
            }
            return false;
          },

          nextPage: function() {
            if (this.param.curpage < this.param.numpage) {
              this.param.curpage++;
              this.loadData();
            }
            return false;
          },

          loadData: function() {
            $.ajax({
              url: Document.url,
              type: 'POST',
              dataType: 'json',
              data: jQuery.param(Document.param),
              success: function(d) {

                $('#pagination').html(d.pagination);
                Document.param.numpage = d.numpage;
				var nilai='', ket='',no=1, index;
                var t = '', dt = {};
				//menampung nilai yang ada di textbox dengan id jumlah_soal
				var jum=$("#jumlah_soal").val();
				//menampilkan nama dll
                for (var i = 0; i < d.data.length; i++) {
					  dt = d.data[i];
					  var arr = dt.jaw.split('-'), color='';
					  //menampung data yang ada di textbox dengan id kunci_soal
					  //lalu merubahnya menjadi array 
					  var kunci=$('#kunci_soal').val().split("-");
					  nilai=dt.Benar*100/jum;
					  //menghitung apakah nilai siswa melbihi kkm atau tidak
					  if(nilai><?=$this->session->userdata('kkm')?>){
						  ket='LULUS';
					  }else{
						  ket='REMEDI';
					  }

					  t += '<tr><td>' + no +'</td>' +
						 '<td>' + dt.nama_siswa + '</td>' +
						  '<td>' + dt.Benar + '</td>' +
						  '<td>' + dt.Salah + '</td>' +
						  '<td>' + dt.Kosong + '</td>' +
						  '<td>' +  nilai.toFixed(2) + '</td>' +
						  '<td>' + ket + '</td>';
						  for (index = 0; index < arr.length; ++index) {
							  //jika jawaban siswa benar maka warna cell akan hijau
							  //jika salah akan berwarna merah
							  if (kunci[index] == arr[index]) {
									color = "class='success'";
							  }else{
								  color = "class='danger'";
							  }
							  //menampung jawaban siswa
							  t+='<td '+ color +'>' +  arr[index] + '</td>';
						  }
					  no++;
                }
				
                $('#document-data').html(t); // id dari tbody tabel data
				
				
              }
            });
          }
        }
</script>
                <div role="tabpanel">
<input type="hidden" id="tabel" value="laporan">
<input type="hidden" id="jumlah_soal" value="">
<input type="hidden" id="kunci_soal" value="">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li id="lihat" role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Nilai</a></li>
                <li id="tambah" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tingkat Kesulitan</a></li>
				<li id="beda" role="presentation"><a href="#pembeda" aria-controls="pembeda" role="tab" data-toggle="tab">Daya Pembeda</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Tab Lihat Data-->
                 <div role="tabpanel" class="tab-pane fade in active" id="home">
				 
                     <br>
                      <div class="row">
					  <form action="<?php echo base_url() ?>admin/downloadExcel2" method="POST">
                        <div class="col-lg-6">
						 
                        </div>

                        <div class="col-lg-2"  align="right">
                            
                            <div class="form-group">
								<select class="form-control" name="id_tes" id="tes">
                                  <option value="0">Pilih Tes</option>
                                  <?=$this->tes_model->ShowTes();?>
                                </select>
                          
                            </div><!-- /input-group -->
                        </div>
                          <div class="col-lg-2">
                           <div class="form-group">
                                <select class="form-control" name="id_kelas" id="kelas">
                                  <option value="">Pilih Kelas</option>
                                  <!--=$this->tes_model->ShowKel();?>-->
                                </select>
                              </div>
                        </div>
						<div class="col-lg-2">
                           <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="submit" value="Export">
                              </div>
                        </div>
						</form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr id="jawaban-data">
															
                            </tr>
							<tr id="kunci-data">
								
							</tr>
                          </thead>
                          <tbody  id="document-data">
                            <!--Data akan muncul disini-->
                          </tbody>
                        </table>
                      </div>
                    <div id="row">
                    <!--<div  id="pagination" class="col-lg-12">
                        Paging akan muncul disini
                    </div>-->
                    </div>

                </div>
                 <!--Tab Lihat Data-->
                   <!--Tab Tambah Data-->
                  <div role="tabpanel" class="tab-pane fade in" id="profile">
                      <br>
					  <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
								<th >No</th>
								<th width="60%">Soal</th>
								<th >A</th>
								<th >B</th>
								<th >C</th>
								<th >D</th>
								<th >TK</th>
								<th >Kesulitan</th>							
                            </tr>
                          </thead>
                          <tbody id="document-tk">
                            <!--Data akan muncul disini-->
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <!--Tab Tambah Data-->
				  <div role="tabpanel" class="tab-pane fade in" id="pembeda">
				  <br>
				  <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr id="urutan-dp">
												
                            </tr>
                          </thead>
                          <tbody  id="document-dp">
                            <!--Data akan muncul disini-->
                          </tbody>
						  
                        </table>
                      </div>
					  
					  <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
								<th>No</th>
								<th>Batas Atas</th>	
								<th>Batas Bawah</th>
								<th>Daya Pembeda</th>
								<th>Kualitas</th>								
                            </tr>
                          </thead>
						  <tbody  id="document-dp2">
                            <!--Data akan muncul disini-->
                          </tbody>
                         
						  
                        </table>
                      </div>
				 </div>
                </div>
                 <!--Tab Content-->
            </div>
            <!--Tab Panel-->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
		
