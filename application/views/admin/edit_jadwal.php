<div class="well">
    <div class="errorresponse">
        
    </div>
    <div class="row">
        <div class="col-lg-12">  
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/jadwal/id_jadwal/<?=$id?>" method="POST">  
                    <?php foreach($query->result() as $row):?>       
                     <div class="row">   
						<div class="col-xs-6">
                        <label for="exampleLamaTes">Tes</label>

                                <select class="form-control" name="id_tes">
                                  <option value="">Pilih Tes</option>
                                  <?=$this->tes_model->ShowTes($row->id_tes);?>
                                </select>
                        </div>
						<div class="col-xs-6">
                            <label for="exampleLamaTes">Jadwal</label>
								<div class='input-group date'  id='datetimepicker7'>
									<input type='text' class="form-control" name="tgl_tes" value="<?=$row->tgl_tes?>"/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
						</div>
                        
				</div>
				<div class="row"> 
				<div class="col-xs-6"><br><br>
                            <label for="exampleLamaTes">Kelas</label>
                                <select class="form-control" name="id_kelas">
                                  <option value="">Pilih Kelas</option>
                                  <?=$this->tes_model->ShowKel($row->id_kelas);?>
                                </select>
                        </div>
						
			</div>
			<div class="row"> 
                        <div class="col-xs-6" align="left"><br><br>
                            
                            <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="update">
                        </div>
			</div>
			<div class="row"> 
                        <br><br><br><br>
			</div>
                    <?php endforeach;?>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>