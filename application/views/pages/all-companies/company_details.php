
<?php $this->load->view("layouts/header",array("setNavabarDarkModeCssClass" => "navbar-glass-shadow")) ?>
<section >
<div class="bg-holder overlay" style="background-image:url(<?=site_url('assets/img/generic/bg-1.jpg')?>);background-position: center bottom;">
</div>
<div class="container content">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="product-slider position-relative">
                <div class="owl-carousel owl-theme position-lg-absolute l-0 t-0 h-100 product-images" data-owl-carousel-controller=".product-thumbs" data-options='{"items":1,"nav":true,"dots":false,"slideBy":1}'>
                    <div class="item h-100"><img class="rounded h-100 <?=($companyDetails['logo'] ? 'fit-cover': '')?>" src="<?=($companyDetails['logo'] ? site_url("uploads/companies/".$companyDetails['id_firma']."/avatar-image/".$companyDetails['logo']."") : site_url("assets/img/products/noimage2.png") )?>" alt=""></div>

                </div>
                </div>
                <div class="owl-carousel owl-theme mt-1 product-thumbs" data-options='{"items":5,"nav":true,"mouseDrag":false,"dots":false,"slideBy":1,"margin":4}'>
                <div class="item"><img class="rounded preview-img" src="<?=($companyDetails['logo'] ? site_url("uploads/companies/".$companyDetails['id_firma']."/avatar-image/".$companyDetails['logo']."") : site_url("assets/img/products/noimage2.png") )?>" alt=""></div>
              
                </div>
            </div>
            <div class="col-lg-6">
                <h5><?=$companyDetails['companyName']?></h5>
                <?php foreach ($allCompanyActivities as $key => $activity) { ?>
                    <?php $categoryUrl = $activity['id_activitate']."-".preg_replace('/[\s,\']+/', '-', $activity['titlu_eng']); ?>
                    <a class="fs--1 mb-2" href="<?=site_url('/companies/'.urlencode(strtolower($categoryUrl)).'')?>"><?=$activity['titlu_eng']?></a><?=($key < count($allCompanyActivities)-1 ? "," : "")?>
                <?php } ?>
               
                <a class="fs--2 mb-3 d-block text-decoration-none" href="#review" data-tab-target="#review" data-fancyscroll data-offset="0"><span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span><span class="fa fa-star text-300 star-icon"></span><span class="ml-1 text-600">(0)</span></a>
                <p class="fs--1"><?=($companyDetails['description'] ? $companyDetails['description'] : $this->lang->line('Company Description No Description Label'))?></p>
                <p class="fs--1 mb-1"> <span><?=$this->lang->line('Company Section Company Details Label Company Website')?>: </span><?=($companyDetails['website'] ? "<a href='".$companyDetails['website']."'>".$companyDetails['website']."</a>" : "-" )?></p>
                <p class="fs--1 mb-1"> <span><?=$this->lang->line('Company Section Company Details Label Company Address')?>: </span><?=($companyDetails['street'] ? $companyDetails['street']. ($companyDetails['number'] ? " ".$companyDetails['number'] : ""). ($companyDetails['postal_code'] ? " ".$companyDetails['postal_code'] : "") : "-" )?></p>
                <p class="fs--1 mb-1"> <span><?=$this->lang->line('Company Section Company Details Label Company Phone')?>: </span><?=($companyDetails['phone'] ? '<a href="tel:'.$companyDetails['phone'].'">'.$companyDetails['phone'].'</a>' : "-" )?></p>
                <div class="row">
                <?php if($companyDetails['google_maps_url']) { ?>
                <div class="col-auto"><a class="btn btn-sm btn-primary" href="<?=$companyDetails['google_maps_url']?>"><span class="fas fa-globe"></span> <?=$this->lang->line('Company Section Company Details Label Go To Location')?></a></div>
                <?php } ?>
                <div class="col-sm-auto pl-3 <?=($companyDetails['google_maps_url'] ? 'pl-sm-0' : '')?> "><a class="btn btn-sm btn-outline-danger border-300 mr-2 mt-2 mt-sm-0" href="#!" data-toggle="tooltip" data-placement="top" title="<?=$this->lang->line('Coming Soon')?>"><span class="far fa-heart mr-1"></span>0</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
</section >
<?php $this->load->view("layouts/footer") ?>