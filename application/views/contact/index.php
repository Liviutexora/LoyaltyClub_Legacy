<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?=(site_url("assets/img/illustrations/corner-4.png"))?>);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
        <div class="col-lg-8">
            <h3 class="mb-0"><?=$this->lang->line("Contact Page Name")?></h3>
            <p class="mt-2"><?=$this->lang->line('Contact Page Please send an email at')?>: <a href = "mailto:loyaltyclubromania@gmail.com">loyaltyclubromania@gmail.com</a></p>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer") ?>