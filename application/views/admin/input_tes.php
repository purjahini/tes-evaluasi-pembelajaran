<script>
        var Document = {
          param: {
            dataperpage: 5, // jumlah data per halaman
            query1: '',
            query2: '',
            curpage: 0,
            numpage: 0,
            tabel:''
          },

          url: 'http://localhost/tes2/admin/data',


          search: function() {
            this.param.query1 = $('#query').val();
            this.param.query2 = $('#query2').val();
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

                var ak='', t = '', dt = {};
                for (var i = 0; i < d.data.length; i++) {

                  dt = d.data[i];

                  if(dt.status_tes==1){
                    ak='<span class="label label-success">Aktif</span>';
                  }else{
                    ak='<span class="label label-danger">Tidak Aktif</span>';
                  }
                  t +='<tr><td>' + dt.nama_tes + '</td>' +
                      '<td>' + dt.waktu + ' Menit </td>' +
                      '<td>' + dt.jumlah_soal + '</td>' +
                      '<td>' + ak + '</td>' +
                      '<td><a href="<?php echo base_url();?>admin/add/soal/id_tes" data-id='+dt.id_tes+ ' class="btnadd" title="Tambah Soal"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a> <a href="<?php echo base_url();?>admin/delete/tes/id_tes" data-id='+dt.id_tes+ ' class="btndelete" title="hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>  <a href="<?php echo base_url();?>admin/edit/tes/id_tes/" data-id='+dt.id_tes+ ' class="btnedit" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td></tr>';
                }
                $('#document-data').html(t); // id dari tbody tabel data
              }
            });
          }
        }

</script>

                <!-- /.row -->
                <div role="tabpanel">
<input type="hidden" id="tabel" value="tes">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li id="lihat" role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Lihat Data</a></li>
                <li id="tambah" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tambah Data</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Tab Lihat Data-->
                 <div role="tabpanel" class="tab-pane fade in active" id="home">
                     <br>
                      <div class="row">
                        <div class="col-lg-6">
                        </div>

                        <div class="col-lg-4"  align="right">
                            <form class="form-inline" method="post">
                            <div class="input-group">

                              <div class="input-group-addon">GO!</div>
                              <input type="text" name="query"  id="query" class="form-control" placeholder="Cari Data...">

                            </div><!-- /input-group -->

                            </form>
                        </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="sek_lain" id="query2" width="50%">
                              <option value="nama_tes">Nama Tes</option>
                              <option value="waktu">Lama Tes</option>

                            </select>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Nama Tes</th>
                              <th>Lama Tes</th>
                              <th>Banyak Soal</th>
                              <th>Status</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody  id="document-data">
                            <!--Data akan muncul disini-->
                          </tbody>
                        </table>
                      </div>
                    <div id="row">
                    <div  id="pagination" class="col-lg-12">
                        <!--Paging akan muncul disini-->
                    </div>
                    </div>

                </div>
                 <!--Tab Lihat Data-->
                   <!--Tab Tambah Data-->
                  <div role="tabpanel" class="tab-pane fade in" id="profile">
                      <br>
                   <form id="frmadd" action="<?php echo base_url() ?>admin/create/tes" method="POST">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="exampleInputNamaTes">Nama Tes</label>
                            <input type="text" class="form-control" name="nama_tes" id="InputNamaTes" maxlength="32" placeholder="Nama Tes">
                        </div>
                        <div class="col-xs-4">
                            <label for="exampleInputBanyakSoal">Banyak Soal</label>
                            <input type="text" class="form-control" name="jumlah_soal" id="InputBanyakSoal" maxlength="2">
                            <input type="hidden" class="form-control" name="id_tes">
                            <input type="hidden" class="form-control" name="nip" value="<?php echo $this->session->userdata('pengguna'); ?>">
                        </div>
                        <div class="col-xs-4">
                            <label for="exampleLamaTes">Lama Tes</label>
                            <div class="input-group">
                            <input type="text" class="form-control" name="waktu" id="InputLamaTes" maxlength="2"><div class="input-group-addon">Menit</div>
                          </div>
                        </div>
                    </div>
                       <br>
                    <div class="row">

                      <div class="col-xs-4">
                        
                        <?php if($this->session->userdata('level')==="Admin" || $this->session->userdata('level')==="Super Admin"){ ?>
						 <label for="exampleLamaTes">Guru</label>
								 <select class="form-control" name="nip">
                                  <option value="">Pilih Guru</option>
                                  <?=$this->tes_model->ShowData();?>
                                </select>
						<?php }else{ ?>
						<input type="hidden" class="form-control" name="nip" value="<?php echo $this->session->userdata('pengguna'); ?>">
						<?php } ?>
						<br>
						<input type="checkbox" name="status_tes" value="1"> <label for="exampleInputEmail1">Aktif</label>
                      </div>
                    </div><br>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                       </div>
                    </div>
                    </form>
                  </div>
                  <!--Tab Tambah Data-->
                </div>
                 <!--Tab Content-->
            </div>
            <!--Tab Panel-->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
