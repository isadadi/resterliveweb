<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RosterLive USU | <?php echo $title ?> </title>

    <!-- Bootstrap -->
    <link href="<?=base_url("assets/vendors/bootstrap/dist/css/bootstrap.min.css")?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url("assets/vendors/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url("assets/vendors/nprogress/nprogress.css")?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url("assets/vendors/iCheck/skins/flat/green.css")?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url("assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css")?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=base_url("assets/vendors/jqvmap/dist/jqvmap.min.css")?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.css")?>" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?=base_url("assets/vendors/select2/dist/css/select2.min.css")?>" rel="stylesheet">

    <!--notify-->
   <link href="<?=base_url("assets/vendors/pnotify/dist/pnotify.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/vendors/pnotify/dist/pnotify.buttons.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/vendors/pnotify/dist/pnotify.nonblock.css")?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url("assets/build/css/custom.min.css")?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><span>RosterLive USU</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">                 
                  <?php 
                  $act = array('','','','','','','','');
                  
                    if($title=='Data Fakultas')
                      $act[0]="active";
                    else if($title=='Data Prodi')
                      $act[1]="active";                   
                     else if($title=='Data Dosen')
                      $act[2]="active"; 
                     else if($title=='Mata Kuliah')
                      $act[3]="active"; 
                     else if($title=='Ruangan')
                      $act[4]="active"; 
                     else if($title=='Jadwal')
                      $act[5]="active"; 
                    else if($title=='Jadwal Ujian')
                      $act[6]="active"; 
                    else if($title=='Jadwal Libur')
                      $act[7]="active"; 
                    if($this->session->userdata('rl_role') == 1){

                    ?>
                
                  <li class="<?=$act[0]?>"><a href="<?=base_url("fakultas")?>"><i class="fa fa-edit"></i> Data Fakultas </a></li>
                  <li class="<?=$act[1]?>"><a href="<?=base_url("prodi")?>"><i class="fa fa-desktop"></i> Data Prodi </a></li>
                  <?php }else{ ?>
                  <li class="<?=$act[2]?>"><a href="<?=base_url("dosen")?>"><i class="fa fa-table"></i> Data Dosen </a></li>
                  <li class="<?=$act[3]?>"><a href="<?=base_url("matakuliah")?>"><i class="fa fa-bar-chart-o"></i> Mata Kuliah </a></li>
                  <li class="<?=$act[4]?>"><a href="<?=base_url("ruangan")?>"><i class="fa fa-briefcase"></i> Ruangan </a></li>
                  <li class="<?=$act[5]?>"><a href="<?=base_url("jadwal")?>"><i class="fa fa-calendar"></i>Jadwal </a></li>
                  <li class="<?=$act[6]?>"><a href="<?=base_url("ujian")?>"><i class="fa fa-edit"></i>Jadwal Ujian</a></li>
                   <li class="<?=$act[7]?>"><a href="<?=base_url("libur")?>"><i class="fa fa-calendar"></i>Jadwal Libur</a></li>
                  <?php } ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="<?=base_url("logout")?>" class="user-profile">
                    <img src="<?=base_url("assets/images/user.png")?>" alt=""><?=$this->session->userdata('rl_username')?>
                    
                  </a>                 
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->