<div class="well">
    <div class="errorresponse">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <form class="form-inline" id="frmupdatepass" role="form" action="<?=base_url() ?>admin/updatepass" method="POST">
					<div class="row"> 
                        <div class="col-xs-12">
							<label for="exampleLamaTes">Password Lama</label>
							<input type="password" class="form-control" name="pass" id="InputPass1" maxlength="12" value="">
						</div>
					</div>
					<br>
					<div class="row"> 
                        <div class="col-xs-12">
							<label for="exampleLamaTes">Password Baru</label>
							<input type="password" class="form-control" name="newpass" id="InputPass2" maxlength="12" value="">
						</div>
					</div>
					<br>
					<div class="row"> 
                        <div class="col-xs-12">
							<label for="exampleLamaTes">Konfirmasi Password Baru</label>
							<input type="password" class="form-control" name="confpass" id="InputPass3" maxlength="12" value="">
						</div>
					</div>
					<br>
                    <div class="row"> 
                        <div class="col-xs-12" align="left">
							<input type="submit" class="btn btn-success" id="Edit" value="Update Password">
						</div>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
