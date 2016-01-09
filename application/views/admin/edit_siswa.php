<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/siswa/nis/<?=$id?>" method="POST">
                    <?php foreach($query->result() as $row):?>
                      <div class="row">
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">NIS</label>
                              <input type="text" class="form-control" name="nis" id="InputNip" maxlength="12" value="<?=$row->nis?>" readonly>
                          </div>
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">Nama</label>
                              <input type="text" class="form-control" name="nama_siswa" id="InputNama" maxlength="64" value="<?=$row->nama_siswa?>">
                          </div>
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">Jenis Kelamin</label><br>
                              <label class="radio-inline">
                              <input type="radio"  name="jenkel" id="inlineRadio1"  value="Laki-laki" <?php echo ($row->jenkel === "Laki-laki") ? 'checked' : ''; ?>>Laki-laki
                              </label>
                              <label class="radio-inline">
                              <input type="radio"   name="jenkel" id="inlineRadio1"  value="Perempuan" <?php echo ($row->jenkel === "Perempuan") ? 'checked' : ''; ?>>Perempuan
                              </label>

                          </div>
                      </div>
                         <br>
                      <div class="row">

                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">Tempat Lahir</label>
                              <input type="text" class="form-control" name="tmp_lahir" id="InputTmpLahir" value="<?=$row->tmp_lahir?>">
                          </div>
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">Tanggal Lahir</label>
                              <input type="text" class="form-control" name="tgl_lahir" id="InputTgl" maxlength="10" value="<?=$row->tgl_lahir?>" readonly>
                          </div>
                          <div class="col-xs-4">
                             <label for="InputGol">Kelas</label>
                             <select class="form-control" name="id_kelas">
                                 <option value="">--Pilih kelas--</option>
                                 <?php

                                             echo $this->tes_model->ShowKel($row->id_kelas);

                                 ?>
                              </select>
                         </div>
                      </div>
                         
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
