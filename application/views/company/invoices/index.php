<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=$this->lang->line('Company Section Ticket Label Section Title Invoices')?></h5>
        </div>
        <div class="col-6 col-sm-auto ml-auto text-right pl-0">
            <div class="d-none" id="purchases-actions">
            <div class="input-group input-group-sm">
                <select class="custom-select cus" aria-label="Bulk actions">
                <option selected="">Bulk actions</option>
                <option value="Refund">Refund</option>
                <option value="Delete">Delete</option>
                <option value="Archive">Archive</option>
                </select>
                <button class="btn btn-falcon-default btn-sm ml-2" type="button">Apply</button>
            </div>
            </div>
            
        </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0  card-datables">
       <div class="text-center"> <?=$this->lang->line("Coming Soon")?></div>
    </div>
</div>
<?php $this->load->view("layouts_after_login/footer",array("jsFiles" => array("company.js"))) ?>