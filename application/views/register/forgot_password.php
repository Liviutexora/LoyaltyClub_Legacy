<?php $this->load->view("layouts/header") ?>

<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">


    <div class="container" data-layout="container">
    <div class="row flex-center min-vh-100 py-6 text-center">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4" href="<?=site_url("/")?>"><img class="mr-2" src="<?=site_url("assets/img/icons/logo_blue.png")?>" alt="" width="110" /></a>
        <div class="card">
            <div class="card-body p-4 p-sm-5">
            <h5 class="mb-0"><?=$this->lang->line("Forgot Password Page Forgot your password?")?></h5><small><?=$this->lang->line("Forgot Password Page Enter your email and we'll send you a reset link.")?></small>
            <form class="mt-4 forgot-password-form form-validation" action="<?=site_url('forgot-password')?>">
                <div id="save_result"></div>
                <div class="form-group">
                <input class="form-control" type="email" name="email" required="required" placeholder="Email address" />
                </div>
                <div class="form-group"> 
                <button class="btn btn-primary btn-block mt-3 forgot-password-button" type="button"><?=$this->lang->line("Forgot Password Send reset link")?></button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</main>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->


<?php $this->load->view("layouts/footer") ?>