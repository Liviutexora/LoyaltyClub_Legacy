<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?=(site_url("assets/img/illustrations/corner-4.png"))?>);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
    <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <h3 class="mb-0 float-left"><?=$pageDetails['titlu_eng']?></h3>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body card-body-companies-page">
                            <div class="row">
                                <div class="col-md-12">
                                    <?=$pageDetails['text_eng']?>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer") ?>