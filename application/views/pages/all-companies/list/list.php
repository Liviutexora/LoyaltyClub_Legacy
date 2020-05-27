<div class="row no-gutters">
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
    <div class="col-12 p-2 mt-3">
        <div class="p-1">
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="position-relative h-sm-100"><a class="d-block h-100" href="#"><img class="img-fluid fit-cover w-sm-100 h-sm-200 rounded" src="<?=($companyDetails['logo'] ? site_url("uploads/companies/".$companyDetails['id_firma']."/avatar-image/".$companyDetails['logo']."") : site_url("assets/img/products/noimage2.png") )?>" alt=""></a>
                    <?=($isThisCompanyNew ? '<span class="badge badge-pill badge-success position-absolute r-0 t-0 mt-2 mr-2 z-index-2">'.$this->lang->line("New Company Label On Image").'</span>' : '')?>
                    </div>
                </div>
                <div class="col-sm-7 col-md-8">
                    <div class="row">
                        <div class="col-lg-8">
                        <h5 class="mt-3 mt-sm-0"><a class="text-dark fs-0 fs-lg-1" href="#"><?=$companyDetails['nume_firma']?></a></h5>
                        <p class="fs--1 mb-2 mb-md-3"><a class="text-500" href="#!"><?=ucfirst(strtolower($companyDetails['mainActivity']))?></a></p>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-between flex-column">
                        <div>
                           
                            <div class="mb-2 mt-3">
                            <div> <span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span> <span class="fa fa-star text-300"></span> <span class="fa fa-star text-300"></span><span class="fa fa-star text-300"></span> <span class="ml-1">(0)</span></div>
                            </div>
                          
                        </div>
                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>