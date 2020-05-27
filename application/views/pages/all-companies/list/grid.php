<div class="row">
    <?php foreach ($allCompanies as $companyDetails) { ?>
    <?php 
    $isThisCompanyNew = false;
    $companyCreatedDate = date("Y-m-d", strtotime($companyDetails['data']));  
    $FirstDay = date("Y-m-d", strtotime('monday this week'));  
    $LastDay = date("Y-m-d", strtotime('sunday this week'));  
    if($companyCreatedDate >= $FirstDay && $companyCreatedDate <= $LastDay) {
        $isThisCompanyNew = true;
    }
    ?>
    <div class="mb-4 p-2 col-md-6 col-lg-4">
        <div class="border rounded h-100 d-flex flex-column justify-content-between pb-2">
            <div class="overflow-hidden">
                <div class="position-relative rounded-top overflow-hidden"><a class="d-block" href="#"><img class="img-fluid rounded-top" height="50px" src="<?=($companyDetails['logo'] ? site_url("uploads/companies/".$companyDetails['id_firma']."/avatar-image/".$companyDetails['logo']."") : site_url("assets/img/products/noimage2.png") )?>" alt=""></a><?=($isThisCompanyNew ? '<span class="badge badge-pill badge-success position-absolute r-0 t-0 mt-2 mr-2 z-index-2">New</span>' : '')?>
                </div>
                <div class="pt-3 pl-3 pr-3 pb-0">
                    <h5 class="fs-0"><a class="text-dark" href="../e-commerce/product-details.html"><?=$companyDetails['nume_firma']?></a></h5>
                    <p class="fs--1 mb-2"><a class="text-500" href="#!"><?=ucfirst(strtolower($companyDetails['mainActivity']))?></a></p>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between px-3">
                <div> <span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span> <span class="fa fa-star text-300"></span> <span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span> <span class="ml-1">(0)</span></div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>