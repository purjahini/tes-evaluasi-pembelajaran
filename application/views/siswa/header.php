<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Halaman Tes Evaluasi Siswa</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/siswa-bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/font-awesome/css/siswa-font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/siswa-jquery.countdown.css">
	<script src="<?php echo base_url();?>assets/js/siswa-jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/siswa-jquery-1.8.3.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/siswa-jquery.plugin.js"></script>
	<script src="<?php echo base_url();?>assets/js/siswa-jquery.countdown.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lineicons/siswa-style.css">    
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/siswa-style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/siswa-style-responsive.css" rel="stylesheet">
	<style>
	h3.nun{
		margin-bottom:-20px;
	}
	#defaultCountdown { 
		width: 240px; height: 45px; 
	}
	</style>
	
  </head>
 <body onload="getTime()">

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">

            <!--logo start-->
            <a href="index.html" class="logo"><b>Tes Evaluasi</b></a>
            <!--logo end-->

                <!--  notification start -->


        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                <?php
                if($this->session->userdata('jenkel')==="Laki-laki"){
                  $img="l.jpg";
                }else{
                  $img="p.jpg";
                }
                ?>
              	  <p class="centered"><a href=""><img src="<?php echo base_url();?>assets/img/<?=$img?>" class="img-circle" width="60"></a></p>
              	  <h4 class="centered"><?php echo $this->session->userdata('namasis'); ?></h4>
				  <h6 class="centered"><?php echo $this->session->userdata('kelas'); ?></h6>
				  

              	 <div id="showtime"></div>

				  <li class="sub-menu">
                      <a href="<?php echo base_url();?>logout/siswa" >
                          <i class="fa fa-sign-out"></i>
                          <span>Keluar</span>
                      </a>

                  </li>
               </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->