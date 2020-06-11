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
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <div class="card">
                <div class="card-header mail-header">
                    <div class="row">
                        <div class="col-md-4"><img width="80px" src="<?=site_url("assets/img/icons/loyaltyclub-white.png")?>" width="100px"></div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xxl-6">
                            <div class="card shadow-none email-content-container mb-3 p-3">
                                <?=$this->lang->line('Hello')?>,
                                <div class="mt-1"></div>
                                <?=$this->lang->line('The company')?> <?=(isset($companyName) ? $companyName : "")?> <?=$this->lang->line('has been registered on')?> www.<?=$_SERVER['HTTP_HOST']?>
                                <div class="mt-1"></div>
                                <?=$this->lang->line('Your login details are:')?>
                                <div class="mt-1"></div>
                                <b>Username:</b><?=(isset($email) ? $email : "")?>
                                <div class="mt-1"></div>
                                <b><?=$this->lang->line('Password:')?></b> <?=(isset($password) ? $password : "")?>
                                <div class="mt-1"></div>
                                <?=$this->lang->line('In the shortest time the team on')?> <a href='http://<?=$_SERVER['HTTP_HOST']?>'>www.<?=$_SERVER['HTTP_HOST']?></a> <?=$this->lang->line('will contact your company to establish contractual details and will activate your account.')?>
                                <div class="mt-1"></div>
                                <?=$this->lang->line('The team')?> <a href='http://<?=$_SERVER['HTTP_HOST']?>'>www.<?=$_SERVER['HTTP_HOST']?></a> <?=$this->lang->line('thanks you for your choice.')?>				
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                    
                    </div>
                </div>
            </div>
        </div>
    </main>
  </body>
  </html>
