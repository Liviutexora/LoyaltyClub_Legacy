<?php $this->load->view("layouts_after_login/header") ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-3 btn-reveal-trigger">
        <div class="card-header position-relative min-vh-25 mb-8">
            <div class="cover-image">
            <div class="bg-holder rounded-soft rounded-bottom-0" style="background-image:url('<?=($coverImage ? $coverImage : site_url("assets/img/generic/4.jpg") )?>');">
            </div>
            <!--/.bg-holder-->
            <form method="post" id="change-cover-image-form" action="<?=site_url('company/change-cover-image')?>" enctype="multipart/form-data">
                <input class="d-none" accept="image/gif, image/jpg, image/jpeg, image/png" id="upload-cover-image" name="upload-cover-image" type="file">
                <label class="cover-image-file-input" for="upload-cover-image"><span class="fas fa-camera mr-2"></span><?=$this->lang->line("User Section Profile Label Change Cover Photo")?></span></label>
            </form>
            </div>
            <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
            <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img src="<?=($avatarImage ? $avatarImage : site_url("assets/img/team/avatar.png") )?>" alt="" data-dz-thumbnail="" width="200">
                <form method="post" id="change-avatar-image-form" action="<?=site_url('company/change-avatar-image')?>" enctype="multipart/form-data">
                    <input class="d-none" accept="image/gif,image/jpg,image/jpeg,image/png" id="profile-image" name="upload-avatar-image" type="file">
                    <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image"><span class="bg-holder overlay overlay-0"></span><span class="z-index-1 text-white text-center fs--1"><span class="fas fa-camera"></span><span class="d-block"><?=$this->lang->line("User Section Profile Label Change Avatar Photo")?></span></span></label>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php  if($this->session->flashdata('errors')) { ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-warning" role="alert"><?=$this->session->flashdata('errors')?> </div>
    </div>
</div>
<?php } ?>

<div class="row no-gutters">
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0"><?=$this->lang->line("User Section Profile Label Profile Change Password")?></h5>
            </div>
            <div class="card-body bg-light">
                <div id="save-result-change-password"></div>
                <form action="<?=site_url('company/change-password')?>" method="post" id="change-password-form" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"><?=$this->lang->line("User Section Profile Label Profile Old Password")?></label>
                        <input class="form-control" id="old-password" name="old-password" required="required" type="password">
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label for="address"><?=$this->lang->line("User Section Profile Label Profile New Password")?></label>
                        <input class="form-control" id="new-password" name="new-password" required="required" type="password">
                    </div>
                    </div>
                    
                    <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" onclick="submit_form('#change-password-form', '#save-result-change-password')" type="submit"><?=$this->lang->line('User Section Profile Label Profile Update Info')?> </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row no-gutters">
    <div class="col-lg-12">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0"><?=$this->lang->line("User Section Profile Label Profile Change Email")?></h5>
            </div>
        <div class="card-body bg-light">
            <div id="save-result-change-email"></div>
                <form action="<?=site_url('company/change-email')?>" method="post" id="change-email-form" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name"><?=$this->lang->line("User Section Profile Label Profile Old Email")?></label>
                                <input class="form-control" id="old-email" type="text" value="<?=$companyDetails['email']?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address"><?=$this->lang->line("User Section Profile Label Profile New Email")?></label>
                                <input class="form-control" id="new-email" name="new-email" required="required" type="email" pattern="\S+@\S+\.\S+">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="submit_form('#change-email-form', '#save-result-change-email')" type="submit"><?=$this->lang->line('User Section Profile Label Profile Update Info')?> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer") ?>