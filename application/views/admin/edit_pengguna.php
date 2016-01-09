<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <form class="form-inline" id="frmupdate" role="form" action="<?=base_url() ?>admin/update/admin/id_pengguna/<?=$id?>" method="POST">
                    <?php foreach($query->result() as $row):?>
                      <div class="row">
                          <div class="col-xs-6">
                              <label for="exampleInputEmail1">Username</label>
                              <input type="text" class="form-control" name="pengguna" id="InputNip" maxlength="12" value="<?=$row->pengguna?>">
                             
                          </div>
                           <div class="col-xs-6">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" class="form-control" name="password" maxlength="12" >							  
                          </div>

                      </div>
                         <br>
                        <div class="row">
                          <div class="col-xs-6">
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
