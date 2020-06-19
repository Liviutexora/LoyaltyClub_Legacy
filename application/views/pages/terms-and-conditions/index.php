<?php $this->load->view("layouts/header",array("setNavabarDarkModeCssClass" => "navbar-glass-shadow")) ?>
<!-- ============================================-->
<!-- <section> begin ============================-->
<section >
<div class="bg-holder overlay" style="background-image:url(<?=site_url('assets/img/generic/bg-1.jpg')?>);background-position: center bottom;">
</div>
<div class="container content">
   <div class="card mb-3">   
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?=site_url("assets/img/illustrations/corner-1.png")?>);"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?=site_url("assets/img/illustrations/corner-1.png")?>);">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <h3 class="mb-0 float-left"><?=$this->lang->line('Pages Title Page Terms and Conditions')?></h3>
                               
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body card-body-companies-page">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <p class="mb-1"><?=$this->lang->line('Pages Page Terms and Conditions Label Select a Page')?>:</p>
                                    <ul class="list-group list-group-categories">
                                        <?php foreach ($allPagesTermsAndDocumentations as $pageDetails) { ?>
                                            <?php $pageUrl = $pageDetails['id']."-".preg_replace('/[\s,\']+/', '-', $pageDetails['titlu_eng']); ?>
                                            <a href="<?=site_url('/terms-and-conditions/'.$pageDetails['user_type'].'/'.urlencode(strtolower($pageUrl)).'')?>" class="list-group-item list-group-item-action list-group-item-category <?=($pageId == $pageDetails['id'] ? "list-group-item-category-selected": "")?>">
                                            <?=ucfirst(strtolower($pageDetails['titlu_eng']))?>
                                            </a>
                                            <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-md-9">
                                  <?=$pageDetails["text_eng"]?>
                                 
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->
<?php $this->load->view("layouts/footer") ?>