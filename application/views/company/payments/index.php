<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
   <div class="card-header">
      <div class="row align-items-center justify-content-between">
         <div class="col-6 col-sm-auto  align-items-center pr-0">
            <h5 class="fs-0 mb-2 text-nowrap py-2 py-xl-0"> My Payment</h5>
            <h6 class="fs--1 mb-0">#001ABD</h6>
         </div>
         <div class="col-6 col-sm-auto ml-auto text-right pl-0">
         </div>
      </div>
   </div>
   <div class="card-body  pt-0 card-datables">
      <!-- <button class="btn btn-warning mr-1 mb-1 float-right " type="button" ajaxlink="<?=site_url('insert-ticket')?>" data-toggle="modal" data-target="#general-modal1">New Payment</button> -->
      <button class="btn btn-warning mr-1 mb-1 float-right ">Generate Invoice</button>
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
<?php $this->load->view("layouts_after_login/footer",array("jsFiles" => array("user.js"))) ?>


<!-- Modal-->
<div class="modal show" id="general-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?=site_url('insert-ticket')?>" method="post" id="insert-ticket-form" class="needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make a New Payment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div id="save-result"></div>
                    <div class="form-group row">
                        <label for="ticket-serial" class="col-sm-4 col-form-label">
                            Trader ID <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="payment-serial" name="payment-serial"  required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ticket-serial" class="col-sm-4 col-form-label">
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="company-name" name="company-name"  required="required" placeholder="Complete Company Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ticket-value" class="col-sm-4 col-form-label"><?=$this->lang->line('User Section Tickets Page Label Value')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control float-left" id="payment-value" name="payment-value" pattern="^[1-9][0-9]*"  required="required">
                            <!-- <div class="input-group-prepend"><span class="input-group-text">kr</span></div> -->
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="ticket-discount" class="col-sm-4 col-form-label"><?=$this->lang->line('User Section Tickets Page Label Discount')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control float-left" id="ticket-discount" name="ticket-discount" pattern="^[0-9]*"  required="required">
                            <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                        </div>
                    </div> -->
            </div>
            <div class="modal-footer modal-footer1 justify-content-center">
                <h6>Are you sure the above information is correct ?</h6>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#success">Yes</button>
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#failed">No</button>
            </div>
            <div class="modal-footer modal-footer1">                
                    <button class="btn btn-info btn-sm" type="button" data-dismiss="modal"><?=$this->lang->line('Modals Label Btn Cancel')?></button>
                    <button class="btn btn-success btn-sm" onclick="submit_form('#insert-ticket-form', '#save-result')" type="submit"><?=$this->lang->line('Modals Label Btn Save Changes')?></button>
            </div>
        </form>
    </div>
  </div>
</div>


<!-- Success Modal-->
<div class="modal show" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body text-center mb-4">
            <img src="http://www.mantrayoga.co.in/loyaltyclub/assets/img/icons/success.png" class="mb-4 w-50">
            <h4>Payment Successful</h4>
            <p>Transaction Number: 123456789</p>
        </div>        
    </div>
  </div>
</div>


<!-- Fail Modal-->
<div class="modal show" id="failed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Failed Payment</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>        
        <div class="modal-body text-center mb-4">
            <div class="alert alert-warning alert-dismissible fade show text-left" role="alert">
              Failed Payment Please try again
              <!-- <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="font-weight-light" aria-hidden="true">×</span></button> -->
            </div>
            <img src="http://www.mantrayoga.co.in/loyaltyclub/assets/img/icons/warning.png" class="mb-4 ">
            <h4>Your payment failed</h4>
            <p>Please try again</p>
        </div>        
    </div>
  </div>
</div>