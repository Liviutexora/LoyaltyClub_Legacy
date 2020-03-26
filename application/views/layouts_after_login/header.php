<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Dashboard</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <script src="<?=site_url("assets/js/config.navbar-vertical.js")?>"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="<?=site_url("assets/lib/perfect-scrollbar/perfect-scrollbar.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/datatables-bs4/dataTables.bootstrap4.min.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/leaflet/leaflet.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/leaflet.markercluster/MarkerCluster.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/leaflet.markercluster/MarkerCluster.Default.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/css/theme".($this->darkMode ? '-dark' : '').".css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/css/app.css")?>" rel="stylesheet">

  </head>


  <body>

  <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

    <div class="loading-div">
        <div class="spinner-grow text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-light" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
          <span class="sr-only">Loading...</span>
        </div>
    </div>

      <div class="container" data-layout="container">
      <div id="modal_window"></div>
      <?php if(isset($this->current_user['tip']) && $this->current_user['tip'] == 1) { ?>
        <?php $this->load->view("menu/user") ?>
      <?php } elseif(isset($this->current_user['tip']) && $this->current_user['tip'] == 2) { ?>
        <?php $this->load->view("menu/company") ?>
      <?php } ?>
        <div class="content">
          <nav class="navbar navbar-light navbar-glass fs--1 font-weight-semi-bold row navbar-top sticky-kit navbar-expand">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button><a class="navbar-brand text-left ml-3" href="<?=site_url('/')?>">
              <div class="d-flex align-items-center"><img class="mr-2" src="<?=site_url("assets/img/icons/".($this->darkMode ? 'loyaltyclub-white.png' : 'logo_blue.png')."")?>" alt="" width="90" />
              </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown1">
              
              <ul class="navbar-nav align-items-center ml-auto">
              <li class="nav-item dropdown"><a class="nav-link notification-indicator notification-indicator-primary px-0" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell fs-4" data-fa-transform="shrink-6"></span><!--  --></a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
                    <div class="card card-notification shadow-none" style="max-width: 20rem">
                      <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                          <div class="col-auto">
                            <h6 class="card-header-title mb-0"><?=$this->lang->line("User Section Notification Label Notifications")?></h6>
                          </div>
                          <!--div class="col-auto"><a class="card-link font-weight-normal" href="#"><?=$this->lang->line("User Section Notification Label Mark All As Read")?></a></div-->
                        </div>
                      </div>
                      <div class="list-group list-group-flush font-weight-normal fs--1">
                        <div class="list-group-title"><?=$this->lang->line("Comming Soon")?></div>
                        
                       
                      </div>
                      <!--div class="card-footer text-center border-top-0"><a class="card-link d-block" href="#"><?=$this->lang->line("User Section Notification Label View All")?></a></div-->
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown"><a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circle" src="<?=($this->avatarImage ? $this->avatarImage : site_url('assets/img/team/avatar.png'))?>" alt="" />

                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                    <div class="bg-white rounded-soft py-2">
                      <a class="dropdown-item" href="<?=site_url("logout")?>">Logout</a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </nav>