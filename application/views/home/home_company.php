<div class="card-deck">
   <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-3.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
         <h6>Sales</h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif">
            0.00 kr
         </div>
      </div>
   </div>
   <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
         <h6>Ticket</h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning">0</div>
      </div>
   </div>
   <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-2.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
         <h6>Loyality Fee</h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info" >0</div>
       <a href="#" class="btn btn-success pt-1 pb-1 pl-2 pr-2 " style="font-size:14px; line-height:1;" data-toggle="modal" data-target="#general-modal1">Generate Invoice <i class="fa fa-angle-right"></i></a>
      </div>
   </div>
</div>
<div class="row no-gutters">
   <button class="btn btn-primary w-100 mb-3">
   Your Subscription will be renewed in
   </button>
   <div class="card mb-3 w-100">
   <div class="card-header">
      <div class="row align-items-center justify-content-between">
         <div class="col-6 col-sm-auto  align-items-center pr-0">
            <h5 class="fs-0 mb-2 text-nowrap py-2 py-xl-0"> Tickets</h5>
           
         </div>
         <div class="col-6 col-sm-auto ml-auto text-right pl-0">
         </div>
      </div>
   </div>
   <div class="card-body  pt-0 card-datables">
      <!-- <button class="btn btn-warning mr-1 mb-1 float-right " type="button" ajaxlink="<?=site_url('insert-ticket')?>" data-toggle="modal" data-target="#general-modal1">New Payment</button> -->
      <button class="btn btn-warning mr-1 mb-1 float-right ">Add</button>
      <button class="btn btn-warning mr-1 mb-1 float-right ">Download</button>
      <div class="dashboard-data-table">
         <table class="table table-sm table-dashboard fs--1 datatable-table tickets-table border-bottom" width="100%" data-language-label='{"Datatables Label Display" : "<?=$this->lang->line('Datatables Label Display')?>","Datatables Label Per Page" : "<?=$this->lang->line('Datatables Label Per Page')?>","Datatables Label No Data" : "<?=$this->lang->line('Datatables Label No Data')?>","Datatables Label Page" : "<?=$this->lang->line('Datatables Label Page')?>","Datatables Label Of" : "<?=$this->lang->line('Datatables Label Of')?>","Datatables Label No Records Available" : "<?=$this->lang->line('Datatables Label No Records Available')?>","Datatables Label Total Records" : "<?=$this->lang->line('Datatables Label Total Records')?>","Datatables Label Next" : "<?=$this->lang->line('Datatables Label Next')?>","Datatables Label Previous" : "<?=$this->lang->line('Datatables Label Previous')?>" }'>
            <thead class="bg-200 text-900">
               <tr>
                <th class="sort pr-1 align-middle data-table-row-bulk-select"><?=$this->lang->line('Company Section Ticket Label Section Ticket Serial')?></th>
                <th>Bonus</th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Value')?></th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Date')?></th>
                <th>Client ID</th>
                <th class="sort pr-1 align-middle"><?=$this->lang->line('Company Section Ticket Label Section Ticket Status')?></th>

                  
                <!--   <th class="sort pr-1 align-middle">Paid To </th>
                  
                  
                  <th class="sort pr-1 align-middle data-table-row-bulk-select"><?=$this->lang->line('Company Section Ticket Label Section Ticket Serial')?></th> -->
                  
               </tr> 
            </thead>
            <tbody id="purchases">
                 <tr>
                   <td>WONFU</td>
                   <td>0.00</td>
                   <td>0.00</td>
                   <td>02-030-2022</td>
                   <td>0</td>
                   <td><span class="badge badge-pill badge-soft-danger">No Used</span></td>
               </tr>
               <tr>
                   <td>WONFU</td>
                   <td>0.00</td>
                   <td>0.00</td>
                   <td>02-030-2022</td>
                   <td>0</td>
                   <td><span class="badge badge-pill badge-soft-danger">No Used</span></td>
               </tr>
               <tr>
                   <td>WONFU</td>
                   <td>0.00</td>
                   <td>0.00</td>
                   <td>02-030-2022</td>
                   <td>0</td>
                   <td><span class="badge badge-pill badge-soft-danger">No Used</span></td>
               </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-danger">Total</th>
                    <th class="text-danger">0.00</th>
                    <th class="text-danger">0.00</th>
                    <th class="text-danger"></th>
                    <th class="text-danger">3</th>
                    <th class="text-danger"></th>
                </tr>
            </tfoot>
         </table>
      </div>
   </div>
</div>
</div>
<!-- Modal-->
<div class="modal show" id="general-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
       <form action="<?=site_url('insert-ticket')?>" method="post" id="insert-ticket-form" class="needs-validation" novalidate>
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Invoice Confirmation</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
           </div>
         
           <div class="modal-footer modal-footer1 justify-content-center">
              <h6>Are you sure you want to do this ?</h6>                    
              <div class="col-lg-12 text-center mt-3">
                 <button class="btn btn-info btn-sm" type="button" data-dismiss="modal">Yes</button>
                 <button class="btn btn-success btn-sm" type="button" data-dismiss="modal"> No</button>
              </div>
           </div>
           
       </form>
   </div>
 </div>
</div>