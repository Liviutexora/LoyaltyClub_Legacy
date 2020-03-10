<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Loyalty Club</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/favicons/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <script src="<?=site_url("assets/js/config.navbar-vertical.js")?>"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="<?=site_url("assets/lib/perfect-scrollbar/perfect-scrollbar.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/owl.carousel/owl.carousel.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/lib/flatpickr/flatpickr.min.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/css/theme.css")?>" rel="stylesheet">
    <link href="<?=site_url("assets/css/app.css")?>" rel="stylesheet">

  </head>


  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    <?php $this->load->view("menu/before_login.php") ?>
    <?php $this->load->view("register/register_modal.php") ?>