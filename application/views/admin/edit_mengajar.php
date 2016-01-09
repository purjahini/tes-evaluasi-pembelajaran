<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12" align="center">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/mengajar/kd/<?=$id?>" method="POST">
                    <?php foreach($query->result() as $row):?>

                       <div class="form-group">

                         <select class="form-control" name="nip">
                           <option value="">Pilih Guru</option>
                           <?=$this->tes_model->ShowData($row->nip);?>
                         </select>
                     </div>
                       <div class="form-group">
                         <select class="form-control" name="id_kelas">
                           <option value="">Pilih Kelas</option>
                           <?=$this->tes_model->ShowKel($row->id_kelas);?>
                         </select>
                       </div>
                        <div class="form-group">

                            <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="update">
                        </div>
                    <?php endforeach;?>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
