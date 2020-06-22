<?php $this->load->view("layouts/header",array("setNavabarDarkModeCssClass" => "navbar-glass-shadow")) ?>
<!-- ============================================-->
<!-- <section> begin ============================-->
<section >
<div class="bg-holder overlay" style="background-image:url(<?=site_url('assets/img/generic/bg-1.jpg')?>);background-position: center bottom;">
</div>
<div class="container content">
   <div class="card mb-3">   
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-total-companies"><h7 class="mb-0 float-left"><?=$this->lang->line('Companies Page Showing')?> <?=$start?>-<?=$end?> <?=$this->lang->line('Companies Page Of')?> <?=$total?> <?=$this->lang->line('Companies Page Title Label')?></h7></div>
                                    <div class="container-display-type"> 
                                        <a class="text-600 float-right display-type-control" href="<?=site_url('companies/'.$this->uri->segment(2).'?display='.(!$displayType || $displayType == "list" ? "grid" : "list"))?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('Companies Page Display Comapnies '.ucfirst((!$displayType || $displayType == "list" ? "grid" : "list")).'')?>"><span class="fas fa-th"></span> </a>
                                    </div>
                                    <div class="container-display-per-page"> 
                                        <?=$this->lang->line('Companies Show Companies')?><select class="form-control"><option value="10" <?=($companiesPerPage == 10 ? "selected='selected'" : "")?>>10</option><option value="20" <?=($companiesPerPage == 20 ? "selected='selected'" : "")?>>20</option><option value="30" <?=($companiesPerPage == 30 ? "selected='selected'" : "")?>>30</option><option value="40" <?=($companiesPerPage == 40 ? "selected='selected'" : "")?>>40</option><option value="50" <?=($companiesPerPage == 50 ? "selected='selected'" : "")?>>50</option></select><?=$this->lang->line('Companies Per Page')?>
                                    </div>
                                    
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body card-body-companies-page">
                            <div class="row">
                                <div class="col-md-3 container-all-categories">
                                    <p class="mb-1 select-category-label"><?=$this->lang->line('Companies Page Select A Category')?>:</p><span class="fas fa-minus expand-categories-btn" data-toggle="collapse" href="#multiCollapseExample1" aria-expanded="false"></span>
                                    
                                    <ul class="list-group list-group-categories collapse show multi-collapse" id="multiCollapseExample1">
                                    <a href="<?=site_url('/companies')?>" class="list-group-item list-group-item-action list-group-item-category <?=(!$categoryId ? "list-group-item-category-selected": "")?>"><?=$this->lang->line("Companies All Categories Label")?></a>
                                        <?php foreach ($allActivities as $activityDetails) { ?>
                                            <?php $categoryUrl = $activityDetails['id']."-".preg_replace('/[\s,\']+/', '-', $activityDetails['titlu_eng']); ?>
                                            <a href="<?=site_url('/companies/'.urlencode(strtolower($categoryUrl)).'')?>" class="list-group-item list-group-item-action list-group-item-category <?=($categoryId == $activityDetails['id'] ? "list-group-item-category-selected": "")?>">
                                            <?=ucfirst(strtolower($activityDetails['titlu_eng']))?>
                                            </a>
                                            <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-md-9">
                                  <?php echo  $list; ?>
                                  <div class="col-md-12  text-center">
                                        <?php echo $paginationLinks; ?>
                                  </div>
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
<script>
$(document).ready(function(){
    $( ".container-display-per-page select" ).change(function() {
        eraseCookie("companiesPerPage");
        setCookie("companiesPerPage",$(this).val(),365);
        window.location.reload();
    });
});

</script>