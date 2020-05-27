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
                                <h3 class="mb-0 float-left"><?=$this->lang->line('Companies Page Title Label')?></h3>
                                <a class="text-600 float-right" href="<?=site_url('companies/'.$this->uri->segment(2).'?display='.(!$displayType || $displayType == "list" ? "grid" : "list"))?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->lang->line('Companies Page Display Comapnies '.ucfirst((!$displayType || $displayType == "list" ? "grid" : "list")).'')?>"><span class="fas fa-th"></span> </a>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body card-body-companies-page">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <p class="mb-1"><?=$this->lang->line('Companies Page Select A Category')?>:</p>
                                    <ul class="list-group list-group-categories">
                                        <?php foreach ($allActivities as $activityDetails) { ?>
                                            <?php $categoryUrl = $activityDetails['id']."-".preg_replace('/[\s,\']+/', '-', $activityDetails['titlu_eng']); ?>
                                            <a href="<?=site_url('/companies/'.urlencode(strtolower($categoryUrl)).'')?>" class="list-group-item list-group-item-action list-group-item-category <?=($categoryId == $activityDetails['id'] ? "list-group-item-category-selected": "")?>">
                                            <?=ucfirst(strtolower($activityDetails['titlu_eng']))?>
                                            </a>
                                            <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-md-9 mt-3">
                                  <?php echo  $list; ?>
                                  <div class="col-md-12 text-center">
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