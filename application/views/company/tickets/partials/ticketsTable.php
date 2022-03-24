<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=$this->lang->line('Company Section Ticket Label Section Title Tickets')?></h5>
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
        <button class="btn btn-warning mr-1 mb-1 float-right open-modal" type="button" ajaxlink="<?=site_url('add-tickets')?>"><?=$this->lang->line('Company Section Ticket Label Section Ticket Add Tickets')?></button>
        <button class="btn btn-warning mr-1 mb-1 float-right download-tickets-btn" type="button" url="<?=site_url('download-tickets')?>"><?=$this->lang->line('Company Section Ticket Label Section Ticket Download Tickets')?></button>
        <div class="tickets-reload-page"><div>
        <div class="dashboard-data-table">
       
        <table class="table table-sm table-dashboard fs--1 datatable-table tickets-table border-bottom" width="100%" data-language-label='{"Datatables Label Display" : "<?=$this->lang->line('Datatables Label Display')?>","Datatables Label Per Page" : "<?=$this->lang->line('Datatables Label Per Page')?>","Datatables Label No Data" : "<?=$this->lang->line('Datatables Label No Data')?>","Datatables Label Page" : "<?=$this->lang->line('Datatables Label Page')?>","Datatables Label Of" : "<?=$this->lang->line('Datatables Label Of')?>","Datatables Label No Records Available" : "<?=$this->lang->line('Datatables Label No Records Available')?>","Datatables Label Total Records" : "<?=$this->lang->line('Datatables Label Total Records')?>","Datatables Label Next" : "<?=$this->lang->line('Datatables Label Next')?>","Datatables Label Previous" : "<?=$this->lang->line('Datatables Label Previous')?>" }' data-options='{"responsive":false,"pagingType":"simple","lengthChange":false,"searching":false,"pageLength":11}'>
            <thead class="bg-200 text-900">
            <tr>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Serial')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Discount')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Value')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Date')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Client ID')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Status')?></th>
                <th class="no-sort pr-1 align-middle"></th>
            </tr>
            </thead>
            <tbody id="purchases">

            </tbody>
        </table>
        </div>
    </div>
</div>