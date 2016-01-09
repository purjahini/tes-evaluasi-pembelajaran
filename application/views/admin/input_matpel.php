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
                  t += '<tr><td>' + dt.id_matpel +'</td>' +
                     '<td>' + dt.nama_matpel + '</td>' +
                      '<td>' + dt.kkm + '</td>' +
                      '<td><a href="<?php echo base_url();?>admin/delete/matpel/id_matpel" data-id='+dt.id_matpel+ ' class="btndelete" title="hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> <a href="<?php echo base_url();?>admin/edit/matpel/id_matpel/" data-id='+dt.id_matpel+ ' class="btnedit" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td></tr>';
                }
                $('#document-data').html(t); // id dari tbody tabel data
              }
            });
          }
        }

</script>

<input type="hidden" id="tabel" value="matpel">
<input type="hidden" id="query2" value="nama_matpel">

                      <div class="row">
                        <div class="col-lg-9">

                            <div class="input-group">

                            <form class="form-inline" id="frmadd" action="<?php echo base_url() ?>admin/create/matpel" method="POST">
                               <div class="form-group">
                                   <input type="text" class="form-control" name="nama_matpel" id="InputNip" maxlength="32" placeholder="Mata Pelajaran"></div>
                                <div class="form-group">
                                  <input type="text" class="form-control" name="kkm" id="InputNip" maxlength="3" placeholder="KKM">
                                  <input type="hidden" class="form-control" name="id_matpel" value="">
                                </div>
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            </div>




                        </div>

                        <div class="col-lg-3" align="left">
                            <form class="form-inline" method="post">
                            <div class="input-group">

                              <div class="input-group-addon">GO!</div>
                              <input type="text" name="query"  id="query" class="form-control" placeholder="Cari Data...">

                            </div><!-- /input-group -->

                            </form>
                        </div>

                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Mata Pelajaran</th>
                              <th>KKM</th>
                                 <th width="10%" >Aksi</th>
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
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
