<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/tes/id_tes/<?=$id?>" method="POST">
                    <input type="hidden" name="nip" value="<?=$this->session->userdata('pengguna')?>" >
                    <?php foreach($query->result() as $row):?>
                      
                      <div class="row">
                          <div class="col-xs-4">
                              <label for="exampleInputNamaTes">Nama Tes</label>
                              <input type="text" class="form-control" name="nama_tes" id="InputNamaTes" maxlength="32" value="<?=$row->nama_tes?>">
                          </div>
                          
                          <div class="col-xs-4">
                              <label for="exampleInputBanyakSoal">Banyak Soal</label>
                              <input type="text" class="form-control" name="jumlah_soal" id="InputBanyakSoal" maxlength="2" value="<?=$row->jumlah_soal?>">

                          </div>
                               <div class="col-xs-4">
                            <label for="exampleLamaTes">Lama Tes</label>
                            <div class="input-group">
                            <input type="text" class="form-control" name="waktu" id="InputLamaTes" maxlength="2" value="<?=$row->waktu?>"><div class="input-group-addon">Menit</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-xs-4">
                          <br>
                          <input type="checkbox" name="status_tes" value="1" <?=($row->status_tes == 1) ? 'checked' : ''; ?>> <label for="exampleInputEmail1">Aktif</label>
                        </div>
                      </div><br>
                      <div class="row">
                          <div class="col-xs-6" align="left"><br>
                            <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="update">
                          </div>
                      </div>
                    <?php endforeach;?>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
