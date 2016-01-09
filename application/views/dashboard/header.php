<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Test Online System</title>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.2.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/id.js"></script>
	
	<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/less/datepicker.less" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/colorbox.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/js/jquery.colorbox-min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS
    <link href="<?php echo base_url();?>assets/css/plugins/morris.css" rel="stylesheet">
     -->
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script>

        $(document).ready(function() {
			
			 //button edit
            $(document).delegate(".btnpass","click",function(e){
               e.preventDefault();
                var editid = $(this).data('id');
                var editurl = $(".btnpass").attr('href');
                $.colorbox({
                    href:editurl+editid,
                    top:60,
                    width:400,
                    onComplete:function(){
                 
                      $("#frmupdatepass").submit(function(e){
                            e.preventDefault();

                            var url = $(this).attr('action');
                            $.ajax({
                                url:url,
                                type:'POST',
                                dataType:'json',
                                data: $("#frmupdatepass").serialize()
                            }).done(function (data){
                                window.mydata = data;
                                    if(mydata['error'] !=""){
                                        $(".errorresponse").html(mydata['error']);
                                    }
                                    else
									{
                                        $(".errorresponse").text('');
                                        $('#frmupdatepass')[0].reset();

                                        $.colorbox.close();
                                        setTimeout(function() { $("#response").html(mydata['success']).fadeIn("slow"); }, 500);
                                        setTimeout(function() { $("#response").fadeOut(); }, 3000);
                                        Document.search();
                                    }
                            });
                        });
                    }
                });

            });
			
            Document.search();

            //form cari
            $('#query').on('keyup', function () {
                Document.search();
            });
			
			$('#kelas').on('change', function () {
				var getValueKel= $(this).val();
				var getValueTes= $('#tes').val();
				var shoJmlSis=0;
				
                Document.search();
				
				$.getJSON('http://localhost/tes/admin/gethasil',{'idtes' : getValueTes,'idkelas':getValueKel,'anal':'jml'},function(data){
					//var shoJmlSis2=0;
					$.each(data,function(index,value){
						shoJmlSis = value.jml_siswa;
					})						
				}) 
				
				$.getJSON('http://localhost/tes/admin/gethasil',{'idtes' : getValueTes,'idkelas':getValueKel,'anal':'tk'},function(data){
                            var showLap=0, nol=1;
							var color='';
							//memunculkan data kelas yang ditemukan
                            $.each(data,function(index,value){
							  
								  if (value.Kesulitan == "MUDAH") {
										color = "class='success'";
								  }else if(value.Kesulitan == "SEDANG"){
									  color = "class='warning'";
								  }else{
									  color = "class='danger'";								  
								  }
								  
									showLap += '<tr><td>' + nol +'</td>' +
											 '<td>' + value.soal + '</td>' +
											  '<td>' + value.A + '</td>' +
											  '<td>' + value.B  + '</td>' +
											  '<td>' + value.C  + '</td>' +
											  '<td>' +  value.D  + '</td>' +
											  '<td>' +  value.TK  + '</td>' +
											  '<td '+ color +'>' + value.Kesulitan + '</td></tr>';
								nol++;
								
                            })
							//memasukan data kelas ke dalam option dengan id kelas
                            $("#document-tk").html(showLap)
                 })
						
					$.getJSON('http://localhost/tes/admin/gethasil',{'idtes' : getValueTes,'idkelas':getValueKel,'anal':'dp'},function(data){
                            var showLap2=0, nodp=1;
							var nilai_bawah=[], nilai_atas=[];
							var showLap3=0;
							//memunculkan data kelas yang ditemukan
                            $.each(data,function(index,value){
								if(index<shoJmlSis){
								showLap2 += '<tr><td>' + nodp +'</td>' +
											'<td>' + value.nis + '</td>' +
											'<td>' + value.nama_siswa + '</td>';
											var arrdp=value.jawaban.split("-");
											
											//menghitung batas atas soal ke-n
											for(var gDP = 0; gDP < (arrdp.length); gDP++){
												showLap2 +='<td>'+ arrdp[gDP] +'</td>';
												if(nilai_atas[gDP]==null){
													nilai_atas[gDP]=0;
												}
												nilai_atas[gDP]+=parseInt(arrdp[gDP]);
											}
								showLap2+='</tr>';
								}else if(index>=shoJmlSis){
									showLap2 += '<tr><td>' + nodp +'</td>' +
											'<td>' + value.nis + '</td>' +
											'<td>' + value.nama_siswa + '</td>';
											var arrdp=value.jawaban.split("-");
											//menghitung batas bawah soal ke-n 
											for(var gDP = 0; gDP < (arrdp.length); gDP++){
												showLap2 +='<td>'+ arrdp[gDP] +'</td>';
												if(nilai_bawah[gDP]==null){
													nilai_bawah[gDP]=0;
												}
												nilai_bawah[gDP]+=parseInt(arrdp[gDP]);
											}
								showLap2+='</tr>';
									
								}
								nodp++;
                            })
							
							$.each(nilai_atas,function(index,value){
								var kualitas, colo;
								
								//rumus penomoran
								var a= parseInt(index)+1;
								
								//rumus daya pembeda
								var dpm=(parseInt(value)-parseInt(nilai_bawah[index]))/shoJmlSis;
								
								//menghitung nilai
								if(dpm>0.4){
										kualitas="DITERIMA BAIK";
										colo = "class='success'";
								}else if(dpm>0.3){
									kualitas="DITERIMA, DIPERBAIKI";
									colo = "class='info'";									
								}else if(dpm>0.2){
									kualitas="DIPERBAIKI";
									colo = "class='warning'";									
								}else{
									kualitas="DIBUANG";
									colo = "class='danger'";									
								}
								showLap3 +='<tr><td>'+  a +'</td>'+
											'<td>'+ value +'</td>'+
											'<td>'+ nilai_bawah[index] +'</td>'+
											'<td>'+ dpm.toFixed(2) +'</td>'+
											'<td '+colo+'>'+ kualitas +'</td>'+
											'</tr>';
							})
														
						
							//memasukan data kelas ke dalam option dengan id kelas
                            $("#document-dp").html(showLap2);
							$("#document-dp2").html(showLap3);
                     })
            });
			
			//$('#query2').on('change', function () {
              //  Document.search();
            //});
			
			

            //button simpan di klik
            $("#frmadd").submit(function (e){
                e.preventDefault();
                $("#loader").show();
                var url = $(this).attr('action');
                var data = $(this).serialize();
                $.ajax({
                    url:url,
                    type:'POST',
                    data:data
                }).done(function (data){

                    window.mydata = data;
                    if(mydata['error'] !=""){

                        setTimeout(function() { $("#response").html(mydata['error']).fadeIn("slow"); }, 500);
                        setTimeout(function() { $("#response").fadeOut(); }, 3000);
                        $("#loader").hide();
                    }else if(mydata['success'] !=""){
                        setTimeout(function() { $("#response").html(mydata['success']).fadeIn("slow"); }, 500);
                        setTimeout(function() { $("#response").fadeOut(); }, 3000);
                        $("#loader").hide();
                        $('#frmadd')[0].reset();
                        Document.search();
                    }
                });
            });

            //button delete di klik
            $(document).delegate(".btndelete","click",function(e){
                e.preventDefault();
                var deleteurl = $(".btndelete").attr('href');
                var deleteid = $(this).data('id');
                if(confirm("Data dihapus?")){
                    $.ajax({
                    url:deleteurl,
                    type:'POST' ,
                    data:'id='+deleteid
                    }).done(function (data){
                    setTimeout(function() { $("#response").html(data).fadeIn("slow"); }, 500);
                    setTimeout(function() { $("#response").fadeOut(); }, 3000);
                    Document.search();
                    });
                }else{
                    return false;
                }
            });


            //button edit
            $(document).delegate(".btnedit","click",function(e){
               e.preventDefault();
                var editid = $(this).data('id');
                var editurl = $(".btnedit").attr('href');
                $.colorbox({
                    href:editurl+editid,
                    top:60,
                    width:700,
                    onComplete:function(){


                      $('#InputTgl').datepicker();
					  //$('#datetimepicker7').datepicker();
					   $('#datetimepicker7').datetimepicker({
							daysOfWeekDisabled: [0],
							locale: 'id'
							// useCurrent: false //Important! See issue #1075
						});

                      $("#frmupdate").submit(function(e){
                            e.preventDefault();

                            var url = $(this).attr('action');
                            $.ajax({
                                url:url,
                                type:'POST',
                                dataType:'json',
                                data: $("#frmupdate").serialize()
                            }).done(function (data){
                                window.mydata = data;
                                    if(mydata['error'] !=""){
                                        $(".errorresponse").html(mydata['error']);
                                    }
                                    else{
                                        $(".errorresponse").text('');
                                        $('#frmupdate')[0].reset();

                                        $.colorbox.close();
                                        setTimeout(function() { $("#response").html(mydata['success']).fadeIn("slow"); }, 500);
                                        setTimeout(function() { $("#response").fadeOut(); }, 3000);
                                        Document.search();
                                    }
                            });
                        });
                    }
                });

            });
			
		

        });
    </script>

</head>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Sistem Tes Berbasis Web</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user">
					</i> <?php echo $this->session->userdata('nama'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url();?>admin/editpass/" data-id='<?=$this->session->userdata('pengguna')?>' class="btnpass"><i class="fa fa-fw fa-user"></i>Ganti Password</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url();?>logout/admin"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="dash"><a href="javascript:;" data-toggle="collapse" data-target="#"><b>DASHBOARD</b></a></li>
                    <?php if($this->session->userdata('level')==="Admin" || $this->session->userdata('level')==="Super Admin"){ ?>
					<li class="active">
                         <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-dashboard"></i>Data Utama<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                               <li>
                                    <a href="<?=base_url();?>admin/tampil/kelas">Kelas</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>admin/tampil/matpel">Mata Pelajaran</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>admin/tampil/ajar">Mengajar</a>
                                </li>
                            </ul>
                    </li>
                    <li>
                       <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-edit"></i>Data Pengguna<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="user" class="collapse">
                                <?php if($this->session->userdata('level')==="Super Admin"){ ?>
								<li>
                                    <a href="<?=base_url();?>admin/tampil/admin">Admin</a>
                                </li>
								<?php } ?>
                                <li>
                                    <a href="<?=base_url();?>admin/tampil/guru">Guru</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>admin/tampil/siswa">Siswa</a>
                                </li>
                            </ul>
                    </li>
					<?php } ?>
                      <li>
                       <a href="javascript:;" data-toggle="collapse" data-target="#ujian"><i class="fa fa-fw fa-table"></i>Data Tes<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="ujian" class="collapse">

                                    <li>
                                        <a href="<?=base_url();?>admin/tampil/tes">Tes</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url();?>admin/tampil/jadwal">Jadwal Tes</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url();?>admin/tampil/soal">Bank Soal</a>
                                    </li>
                            </ul>
                    </li>
					   <?php if($this->session->userdata('level')==="Guru"){ ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#lap"><i class="fa fa-fw fa-bar-chart-o"></i>Laporan<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="lap" class="collapse">
                                    <li>
                                        <a href="<?=base_url();?>admin/tampil/laporan">Laporan Hasil Tes</a>
                                    </li>
                            </ul>
                    </li>
					   <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
			

        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div id="response"></div>
                        <ol class="breadcrumb">
                            <li class="active">
							
                                <i class="fa fa-dashboard"></i> Dashboard
								<?php 
							$segments=$this->uri->segment(1);
							
							if(!empty($segments)){
								echo "<i class='fa fa-angle-double-right'></i> ".ucfirst($segments);
								if($this->uri->segment(3)!==false){
									echo " <i class='fa fa-angle-double-right'></i> Data ".ucfirst($this->uri->segment(3));
								}
							}
							
							?>
                            </li>
                        </ol>
                    </div>
                </div>