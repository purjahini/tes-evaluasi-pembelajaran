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

                var t = '', dt = {};
                for (var i = 0; i < d.data.length; i++) {
                  dt = d.data[i];
                  t += '<tr><td>' + dt.nip +'</td>' +
                     '<td>' + dt.nama_guru + '</td>' +
                      '<td>' + dt.nuptk + '</td>' +
                      '<td>' + dt.tmp_lahir + '</td>' +
                      '<td>' + dt.tgl_lahir + '</td>' +
                      '<td>' + dt.golongan + '</td>' +
                      '<td>' + dt.nama_matpel + '</td>' +
                      '<td><a href="<?php echo base_url();?>admin/delete/guru/nip" data-id='+dt.nip+ ' class="btndelete" title="hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>  <a href="<?php echo base_url();?>admin/edit/guru/nip/" data-id='+dt.nip+ ' class="btnedit" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td></tr>';
                }
                $('#document-data').html(t); // id dari tbody tabel data
              }
            });
          }
        }

</script>

                <div role="tabpanel">
<input type="hidden" id="tabel" value="guru">
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
                            <select class="form-control" name="cari_guru" id="query2" width="50%">
                              <option value="nip">NIP</option>
                              <option value="nama_guru">Nama</option>
                              <option value="nuptk">NUPTK</option>

                            </select>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>NIP</th>
                              <th>Nama Guru</th>
                              <th>NUPTK</th>
                              <th>Tempat Lahir</th>
                              <th>Tanggal Lahir</th>
                              <th>Golongan</th>
                              <th>Matpel</th>
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
                   <form id="frmadd" action="<?php echo base_url() ?>admin/create/guru" method="POST">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="exampleInputEmail1">NIP</label>
                            <input type="text" class="form-control" name="nip" id="InputNip" maxlength="12" placeholder="Masukkan NIP">
                        </div>
                        <div class="col-xs-4">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" name="nama_guru" id="InputNama" maxlength="64" placeholder="Masukkan Nama">
                        </div>
                        <div class="col-xs-4">
                            <label for="exampleInputEmail1">NUPTK</label>
                            <input type="text" class="form-control" name="nuptk" id="InputNuptk" maxlength="16" placeholder="Masukkan NUPTK">
                        </div>
                    </div>
                       <br>
                    <div class="row">

                        <div class="col-xs-4">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tmp_lahir" id="InputTmpLahir" placeholder="Tempat Lahir">
                        </div>
                        <div class="col-xs-4">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="text" class="form-control" name="tgl_lahir" id="InputTglLahir" maxlength="10" placeholder="01/01/1960" readonly>
                        </div>
                        <div class="col-xs-4">
                           <label for="InputGol">Golongan</label>
                           <select class="form-control" name="golongan">
                               <option value="">--Pilih Golongan--</option>
                               <option>III A</option>
                               <option>III B</option>
                               <option>III C</option>
                               <option>III D</option>
                               <option>IV A</option>
                               <option>IV B</option>
                               <option>IV C</option>
                               <option>IV D</option>
                           </select>
                       </div>

                    </div>
                       <br>
                    <div class="row">

                        <div class="col-xs-4">
                            <label for="InputMatpel">Pendidikan Guru</label>
                            <select class="form-control" name="pend_guru">
                                <option value="">--Pilih Pendidikan--</option>
                                <option>D2</option>
                                <option>S1</option>
                                <option>S2</option>
                                <option>S3</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                           <label for="InputMatpel">Guru Mata Pelajaran</label>
                           <select class="form-control" name="id_matpel">
                              <?=$this->tes_model->ShowMatPel();?>
                           </select>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6"><br>
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
            <script>
                $(function () {
                            $('#InputTglLahir').datepicker();
                });
            </script>
