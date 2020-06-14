<?php $this->load->view("layouts_after_login/header") ?>

<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=$this->lang->line('Admin Section Documentation Label Title Add New Page Title')?></h5>
            </div>
     
        </div>
    </div>
    <div class="card-body px-0 pt-0  card-datables">
       
        <div class="dashboard-data-table">
        <div class="container">
            <form action="<?=site_url(''.(isset($pageDetails['id']) ? "/edit-page/".$pageDetails['id'] : "add-page/documentation/private" ).'')?>" method="post" id="add-edit-form" class="needs-validation" novalidate>
                <div id="save-result"></div>
                <div class="form-group">
                    <label for="page-title" class="col-form-label"><?=$this->lang->line('Admin Section Pages Page From Label Page Title')?> <span class="required-sign-label">*</span>: </label>
                    <input type="text" class="form-control" id="page-title" name="page-title" value="<?=(isset($pageDetails['titlu_eng']) ? $pageDetails['titlu_eng'] : "")?>"  required="required">
                </div>
                <div class="form-group">
                    <label for="page-content" class="col-form-label"><?=$this->lang->line('Admin Section Pages Page From Label Page Content')?> <span class="required-sign-label">*</span>: </label>
                    <div class="min-vh-50">
                        <textarea class="tinymce d-none" name="page-content" id="page-content"><?=(isset($pageDetails['text_eng']) ? $pageDetails['text_eng'] : "")?></textarea>
                    </div>
                </div>
                <button class="btn btn-success btn-sm float-right" onclick="submit_form('#add-edit-form', '#save-result')" type="submit"><?=$this->lang->line('Modals Label Btn Save Changes')?></button>
            </form>
        </div>

           
        </div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer",array("jslibs" => array("assets/lib/tinymce/tinymce.min.js"))) ?>