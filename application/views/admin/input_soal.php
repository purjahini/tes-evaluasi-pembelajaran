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
                  var res = dt.soal.substr(0, 50)+'...';
                  t +='<tr><td>' + dt.nama_matpel + '</td>' +
                      '<td>' + res + '</td>' +
                      '<td>' + dt.a+ '</td>' +
                      '<td>' + dt.b+ '</td>' +
                      '<td>' + dt.c+ '</td>' +
                      '<td>' + dt.d+ '</td>' +
                      '<td>' + dt.jawaban_benar + '</td>' +
                      '<td><a href="<?php echo base_url();?>admin/delete/bank_soal/id_soal" data-id='+dt.id_soal+ ' class="btndelete" title="hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>  <a href="<?php echo base_url();?>admin/edit/bank_soal/id_soal/" data-id='+dt.id_soal+ ' class="btnedit" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td></tr>';
                }
                $('#document-data').html(t); // id dari tbody tabel data
              }
            });
          }
        }

</script>

                <div role="tabpanel">
<input type="hidden" id="tabel" value="bank_soal">
<input type="hidden" id="query2" value="soal">
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
                        <div class="col-lg-9">
                        </div>

                        <div class="col-lg-3"  align="right">
                            <form class="form-inline" method="post">
                            <div class="input-group">

                              <div class="input-group-addon">GO!</div>
                              <input type="text" name="query"  id="query" class="form-control" placeholder="Cari Data...">

                            </div><!-- /input-group -->

                            </form>
                        </div>
                         

                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Mata Pelajaran</th>
                              <th>Soal Pertanyaan</th>
                              <th>A</th>
                              <th>B</th>
                              <th>C</th>
                              <th>D</th>
                              <th>Jawaban Benar</th>
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
                   <form id="frmadd" action="<?php echo base_url() ?>admin/create/bank_soal" method="POST">
                    <div class="row">
                        <div class="col-xs-3">
                            <label for="exampleInputNamaTes">Mata Pelajaran</label>
                            <select class="form-control" name="id_matpel" id="IdMatpel">
                              <?=$this->tes_model->ShowMatpel();?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label for="exampleInputNamaTes">Jawaban Benar</label>
                            <select class="form-control" name="jawaban_benar" id="IdMatpel">
                              <option>A</option>
                              <option>B</option>
                              <option>C</option>
                              <option>D</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="exampleInputBanyakSoal">Soal Pertanyaan</label>
                            <textarea class="form-control" name="soal" row="3"></textarea>
                            <input type="hidden" class="form-control" name="id_soal">
                        </div>
                    </div>
                       <br>
                    <div class="row">
                      <div class="col-xs-6">
                          <label for="exampleLamaTes">Pilihan A</label>

                          <input type="text" class="form-control" name="a" id="InputLamaTes" >
                      </div>
                      <div class="col-lg-6">
                        <label for="exampleLamaTes">Pilihan B</label>

                        <input type="text" class="form-control" name="b" id="InputLamaTes" >

                      </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-xs-6">
                          <label for="exampleLamaTes">Pilihan C</label>

                          <input type="text" class="form-control" name="c" id="InputLamaTes" >

                      </div>
                      <div class="col-xs-6">
                        <label for="exampleLamaTes">Pilihan D</label>

                        <input type="text" class="form-control" name="d" id="InputLamaTes">

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
