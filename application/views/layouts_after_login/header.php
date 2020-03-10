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

      <?php if(isset($this->current_user['tip']) && $this->current_user['tip'] == 1) { ?>
        <?php $this->load->view("menu/user") ?>
      <?php } elseif(isset($this->current_user['tip']) && $this->current_user['tip'] == 2) { ?>
        <?php $this->load->view("menu/company") ?>
      <?php } ?>
        <div class="content">
          <nav class="navbar navbar-light navbar-glass fs--1 font-weight-semi-bold row navbar-top sticky-kit navbar-expand">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button><a class="navbar-brand text-left ml-3" href="index.html">
              <div class="d-flex align-items-center"><img class="mr-2" src="assets/img/illustrations/falcon.png" alt="" width="40" /><span class="text-sans-serif">falcon</span>
              </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown1">
              
              <ul class="navbar-nav align-items-center ml-auto">
              <li class="nav-item dropdown"><a class="nav-link notification-indicator notification-indicator-primary px-0" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-bell fa-w-14 fs-4" data-fa-transform="shrink-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.5em;"><g transform="translate(224 256)"><g transform="translate(0, 0)  scale(0.625, 0.625)  rotate(0 0 0)"><path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-bell fs-4" data-fa-transform="shrink-6"></span> --></a>
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
                      <img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />

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