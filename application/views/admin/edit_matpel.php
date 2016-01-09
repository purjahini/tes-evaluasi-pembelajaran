<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12" align="center">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/matpel/id_matpel/<?=$id?>" method="POST">
                    <?php foreach($query->result() as $row):?>
                      
					<div class="form-group">
						<input type="text" class="form-control" name="nama_matpel" id="InputNip" maxlength="32" value="<?=$row->nama_matpel?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="kkm" id="InputNip" maxlength="3" value="<?=$row->kkm?>">
                        
                    </div>
                    <div class="form-group">
						<input type="submit" class="btn btn-success" id="Edit" value="update">
                    </div>
                    <?php endforeach;?>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
