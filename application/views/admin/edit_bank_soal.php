<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/bank_soal/id_soal/<?=$id?>" method="POST">
                    <?php foreach($query->result() as $row):?>
                      
					  <div class="row">
                        <div class="col-xs-3">
                            <label for="exampleInputNamaTes">Mata Pelajaran</label>
                            <select class="form-control" name="id_matpel" id="IdMatpel">
                              <?=$this->tes_model->ShowMatpel($row->id_matpel);?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label for="exampleInputNamaTes">Jawaban Benar</label>
                            <select class="form-control" name="jawaban_benar" id="IdMatpel">
                             
							  <option <?php echo ($row->jawaban_benar === "A") ? 'selected' : ''; ?>>A</option>
                              <option <?php echo ($row->jawaban_benar === "B") ? 'selected' : ''; ?>>B</option>
                              <option <?php echo ($row->jawaban_benar === "C") ? 'selected' : ''; ?>>C</option>
                              <option<?php echo ($row->jawaban_benar === "D") ? 'selected' : ''; ?>>D</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label for="exampleInputBanyakSoal">Soal Pertanyaan</label>
                            <textarea class="form-control" name="soal" row="3"><?=$row->soal?></textarea>
                            
                        </div>
                    </div>
                       <br>
                    <div class="row">
                      <div class="col-xs-6">
                          <label for="exampleLamaTes">Pilihan A</label>

                          <input type="text" class="form-control" name="a" id="InputLamaTes" value="<?=$row->a?>" >
                      </div>
                      <div class="col-lg-6">
                        <label for="exampleLamaTes">Pilihan B</label>

                        <input type="text" class="form-control" name="b" id="InputLamaTes" value="<?=$row->b?>" >

                      </div>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-xs-6">
                          <label for="exampleLamaTes">Pilihan C</label>

                          <input type="text" class="form-control" name="c" id="InputLamaTes" value="<?=$row->c?>" >

                      </div>
                      <div class="col-xs-6">
                        <label for="exampleLamaTes">Pilihan D</label>

                        <input type="text" class="form-control" name="d" id="InputLamaTes" value="<?=$row->d?>">

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
