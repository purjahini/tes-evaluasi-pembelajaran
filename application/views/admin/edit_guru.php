<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/guru/nip/<?=$id?>" method="POST">
                    <?php foreach($query->result() as $row):?>
                      <div class="row">
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">NIP</label>
                              <input type="text" class="form-control" name="nip" id="InputNip" maxlength="12" value="<?=$row->nip?>" readonly>
                          </div>
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">Nama</label>
                              <input type="text" class="form-control" name="nama_guru" id="InputNama" maxlength="64" value="<?=$row->nama_guru?>">
                          </div>
                          <div class="col-xs-4">
                              <label for="exampleInputEmail1">NUPTK</label>
                              <input type="text" class="form-control" name="nuptk" id="InputNuptk" maxlength="12" value="<?=$row->nuptk?>">
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
                             <label for="InputGol">Golongan</label>
                             <select class="form-control" name="golongan">
                               <option <?php echo ($row->golongan === "III A") ? 'selected' : ''; ?>>III A</option>
                               <option <?php echo ($row->golongan === "III B") ? 'selected' : ''; ?>>III B</option>
                               <option <?php echo ($row->golongan === "III C") ? 'selected' : ''; ?>>III C</option>
                               <option <?php echo ($row->golongan === "III D") ? 'selected' : ''; ?>>III D</option>
                               <option <?php echo ($row->golongan === "IV A") ? 'selected' : ''; ?>>IV A</option>
                               <option <?php echo ($row->golongan === "IV B") ? 'selected' : ''; ?>>IV B</option>
                               <option <?php echo ($row->golongan === "IV C") ? 'selected' : ''; ?>>IV C</option>
                               <option <?php echo ($row->golongan === "IV D") ? 'selected' : ''; ?>>IV D</option>

                             </select>
                         </div>

                      </div>
                         <br>
                      <div class="row">

                          <div class="col-xs-4">
                              <label for="InputMatpel">Pendidikan Guru</label>
                              <select class="form-control" name="pend_guru">
                                <option <?php echo ($row->pend_guru === "D2") ? 'selected' : ''; ?>>D2</option>
                                <option <?php echo ($row->pend_guru === "S1") ? 'selected' : ''; ?>>S1</option>
                                <option <?php echo ($row->pend_guru === "S2") ? 'selected' : ''; ?>>S2</option>
                                <option <?php echo ($row->pend_guru === "S3") ? 'selected' : ''; ?>>S3</option>
                              </select>
                          </div>
                          <div class="col-xs-4">
                             <label for="InputMatpel">Guru Mata Pelajaran</label>
                             <select class="form-control" name="id_matpel">
                                <?=$this->tes_model->ShowMatPel($row->id_matpel);?>
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
