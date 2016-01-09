         <div class="col-md-4">
        </div>
      <div class="col-md-4">

		<div class="modal-content">

			<div class="modal-header">

                <div class="row">
                    <div class="col-xs-3">
                <img height="50px" src="<?php echo base_url();?>assets/css/images/logo.png">
				</div><div class="col-xs-9" style="height:50px;">
                        <h4 class="modal-title" id="myModalLabel" style="margin-top:15px; margin-right:20px;">Form Masuk Siswa</h4>
                    </div></div>
			</div> <!-- /.modal-header -->

			<div class="modal-body">

				<form role="form" method="post" action="siswa/login_validasi">
					<div class="form-group">
						  <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Nomor Induk Siswa" aria-describedby="basic-addon1">
                          </div>
					</div> <!-- /.form-group -->

					<div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                        </div>
					</div> <!-- /.form-group -->
			</div> <!-- /.modal-body -->

			<div class="modal-footer">
				<button class="form-control btn btn-primary">Masuk</button>
			</div> <!-- /.modal-footer -->
                </form>
			<?php
			if ($error != null) {
				
				echo '<div class="alert alert-danger">'.$error.'</div>';
			}
			?>
		</div><!-- /.modal-content -->

           </div>
      <div class="col-md-4">
        </div>
