
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
                    <?php 
                
                        $urlImage = ($companyDetails['logo'] ? site_url("uploads/companies/".$companyDetails['id_firma']."/avatar-image/".$companyDetails['logo']."") : site_url("assets/img/products/noimage2.png"));
                    
                        $urlImageDet = getimagesize( $urlImage,$urlImageDet);
                        $width =  $urlImageDet[0];
                        $height =  $urlImageDet[1];

                    ?>
                    <div class="item h-100">
                    <div class="slider_img" style="background: url(<?=$urlImage?>); background-repeat: no-repeat;background-position-x: center;background-position-y: center;background-size: contain;height: 100%;"></div>
                    <!--img class="rounded " style="<?=($height >= $width ? 'width:auto;height:100%;margin:0px auto;':'width:auto;height:100%;margin:0px auto;')?>" src=" <?=$urlImage?>" alt=""-->
                    
                    </div>

                </div>
                </div>
                <div class="owl-carousel owl-theme mt-1 product-thumbs" style="" data-options='{"items":5,"nav":true,"mouseDrag":false,"dots":false,"slideBy":1,"margin":4}'>
                <div class="item h-100">
                
                <div style="background: url(<?=$urlImage?>); background-repeat: no-repeat;background-position-x: center;background-position-y: center;background-size: contain;height: 100%;"></div>
                </div>
              
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
                <p class="fs--1 mb-1"> <span><?=$this->lang->line('Company Section Company Details Label Company Address')?>: </span><?=($companyDetails['street'] ? $companyDetails['street']. ($companyDetails['number'] ? " ".$companyDetails['number'] : ""). ($companyDetails['locality'] ? " ".$companyDetails['locality'] : ""). ($companyDetails['postal_code'] ? " ".$companyDetails['postal_code'] : "") : "-" )?></p>
                <p class="fs--1 mb-1"> <span><?=$this->lang->line('Company Section Company Details Label Company Phone')?>: </span><?=($companyDetails['phone'] ? '<a href="tel:'.$companyDetails['phone'].'">'.$companyDetails['phone'].'</a>' : "-" )?></p>
                <div class="row">
                <?php if($companyDetails['google_maps_url']) { ?>
                <div class="col-auto"><a class="btn btn-sm btn-primary" href="<?=$companyDetails['google_maps_url']?>"><span class="fas fa-globe"></span> <?=$this->lang->line('Company Section Company Details Label Go To Location')?></a></div>
                <?php } ?>
                <div class="col-sm-auto pl-3 <?=($companyDetails['google_maps_url'] ? 'pl-sm-0' : '')?> "><a class="btn btn-sm btn-outline-danger border-300 mr-2 mt-2 mt-sm-0" href="#!" data-toggle="tooltip" data-placement="top" title="<?=$this->lang->line('Coming Soon')?>"><span class="far fa-heart mr-1"></span>0</a></div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-12">
                  <div class="fancy-tab overflow-hidden mt-4">
                    <div class="nav-bar">
                      <div class="nav-bar-item active pl-0 pr-2 pr-sm-4">
                        <div class="mt-1 fs--1"><?=$this->lang->line('Company Section Company Details Label Our Offer')?></div>
                      </div>
                      <div class="nav-bar-item px-2 px-sm-4" id="review">
                        <div class="mt-1 fs--1"><?=$this->lang->line('Company Section Company Details Label Reviews')?></div>
                      </div>
                    </div>
                    <div class="tab-contents">
                      <div class="tab-content active">
                      <?php if(count($products)) { ?>
                      <div class="card mb-3">
                          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-lg-12">
                                      <div class="container-total-companies"><h7 class="mb-0 float-left"><?=$this->lang->line('Companies Page Showing')?> <?=$data['start']?>-<?=$data['end']?> <?=$this->lang->line('Companies Page Of')?> <?=$data['total']?> <?=$this->lang->line('Company Section Product Label Pagination Offers')?></h7></div>
                                      <div class="container-display-type"> 
                                          <a class="text-600 float-right display-type-control" href="<?=site_url('company/'.$this->uri->segment(2).'?display='.(!$data['displayType'] || $data['displayType'] == "list" ? "grid" : "list"))?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('Company Section Product Display Products '.ucfirst((!$data['displayType'] || $data['displayType'] == "list" ? "grid" : "list")).'')?>"><span class="fas fa-th"></span> </a>
                                      </div>
                                      <div class="container-display-per-page"> 
                                          <?=$this->lang->line('Company Section Product Label Show Offers')?><select class="form-control"><option value="10" <?=($data['companiesProductsPerPage'] == 10 ? "selected='selected'" : "")?>>10</option><option value="20" <?=($data['companiesProductsPerPage'] == 20 ? "selected='selected'" : "")?>>20</option><option value="30" <?=($data['companiesProductsPerPage'] == 30 ? "selected='selected'" : "")?>>30</option><option value="40" <?=($data['companiesProductsPerPage'] == 40 ? "selected='selected'" : "")?>>40</option><option value="50" <?=($data['companiesProductsPerPage'] == 50 ? "selected='selected'" : "")?>>50</option></select><?=$this->lang->line('Companies Per Page')?>
                                      </div>
                                      
                                  </div>
                                
                              </div>
                          </div>
                      </div>
                      <?php } ?>

                       <?php 
                        if(!$data['displayType'] || $data['displayType'] == "list") 
                          $this->load->view("/pages/all-companies/products/list", array("products" => $products, "companyDetails" => $companyDetails));
                        else 
                          $this->load->view("/pages/all-companies/products/grid", array("products" => $products, "companyDetails" => $companyDetails));
                       ?>
                          
                          <div class="col-md-12  text-right">
                                <?php echo $data['paginationLinks']; ?>
                          </div>
                      </div>
                      <div class="tab-content">
                        <div class="row">
                          <div class="col-lg-12 mb-12 mb-lg-0">
                            <?=$this->lang->line("Coming Soon")?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    </div>
</div>
</section >
<?php $this->load->view("layouts/footer") ?>
<script>
$(document).ready(function(){
    $( ".container-display-per-page select" ).change(function() {
        eraseCookie("companiesProductsPerPage");
        setCookie("companiesProductsPerPage",$(this).val(),365);
        window.location.reload();
    });
});

</script>