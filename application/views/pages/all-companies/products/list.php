<div class="row">
    <?php foreach ($products as $productDetails) { ?>
    <?php 
    $isThisProductNew = false;
    $productCreatedDate = date("Y-m-d", strtotime($productDetails['created_at']));  
    $FirstDay = date("Y-m-d", strtotime('monday this week'));  
    $LastDay = date("Y-m-d", strtotime('sunday this week'));  
    if($productCreatedDate >= $FirstDay && $productCreatedDate <= $LastDay) {
        $isThisProductNew = true;
    }
    ?>

<div class="col-12 p-3">
    <div class="p-1">
    <div class="row">
        <div class="col-sm-5 col-md-4">
        <div class="position-relative h-sm-100">
            <div class="owl-carousel owl-theme h-100 position-relative" data-options='{"items":1,"nav":true,"autoplay":true,"dots":false,"loop":true}'>
            <?php $hasImages = false; ?>
            <?php foreach ($productDetails['photos'] as $productPhoto) { ?>
            <?php $imgUrl = site_url("uploads/companies/".$productDetails['parinte']."/products/".$productDetails['id']."/".$productPhoto['product_photo_name'].""); ?>
            <?php $hasImages = true; ?>
            <div class="item"><a class="d-block" href="#!"> <div style="background-image: url(<?=$imgUrl?>);height: 185px;background-size:contain;background-position: center top;background-repeat: no-repeat;"></div>
              </a>
            </div>
            <?php } ?>
            <?php if(!$hasImages) { ?>
                <?php $imgUrl = site_url("assets/img/products/noimage2.png"); ?>
                <div class="item"><a class="d-block" href="#!"> <div style="background-image: url(<?=$imgUrl?>);height: 185px;background-size:contain;background-position: center top;background-repeat: no-repeat;"></div>
                </a>
                </div>
            <?php } ?>
            </div>
            <?php if($isThisProductNew) { ?>
                <span class="badge badge-pill badge-success position-absolute r-0 t-0 mt-2 mr-2 z-index-2">New</span>
            <?php } ?>
        </div>
        </div>
        <div class="col-sm-7 col-md-8">
        <div class="row">
            <div class="col-lg-8">
            <h5 class="mt-3 mt-sm-0"><a class="text-dark fs-0 fs-lg-1" href="#"><?=$productDetails['titlu']?></a></h5>
            <p class="fs--1 mb-2 mb-md-3"><a class="text-500" href="#!"><?=$productDetails['descriere']?></a></p>
            </div>
            <div class="col-lg-4 d-flex justify-content-between flex-column">
            <div>
                <h4 class="fs-1 fs-md-2 text-warning mb-0">$<?=$productDetails['pret']?></h4>
                <div class="d-none d-lg-block">
                <p class="fs--1 mb-1"><?=$this->lang->line("Company Section Product Label Section Label Product Bonus")?>: <strong><?=$productDetails['promotie']?>%</strong></p>
             
                </p>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<?php } ?>
<?php if(!count($products)) { ?>
    <div class="col-md-6 col-lg-4 mb-4">
        
         <?=$this->lang->line("Company Section Product Label Section Label Product No Products")?>
      
    </div>
    
    <?php } ?>
</div>