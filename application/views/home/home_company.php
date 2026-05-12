<div class="card-deck"> 
   <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-3.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
         <h6><?=$this->lang->line("Company Section Home Sales")?></h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif">
            <?=($amountValidatedTicket ? $amountValidatedTicket : 0)?> <?=$this->config->item('currency')?>
         </div>
      </div>
   </div>
   <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
         <h6><?=$this->lang->line("Company Section Home Tickets")?></h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?=$nrOfTickets?></div>
      </div>
   </div>
   <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-2.png);">
      </div>
      <!--/.bg-holder-->
      <div class="card-body position-relative">
         <h6><?=$this->lang->line("Company Section Home Loyality Fee")?></h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info" ><?=( $amountInvoice ? number_format($amountInvoice,2) : 0 )?></div>
       <a href="#" class="btn btn-success pt-1 pb-1 pl-2 pr-2 <?=($amountInvoice ? 'generate-invoice-btn' : 'disabled')?>"  url="<?=site_url('company-generate-invoice')?>"  lang-yes="<?=$this->lang->line('Yes')?>" lang-no="<?=$this->lang->line('No')?>" lang-content="<?=$this->lang->line('Company Section Home Are You Sure You Want To Generate Invoice')?>" style="font-size:14px; line-height:1;"><?=$this->lang->line('Company Section Home Generate Invoice')?> <i class="fa fa-angle-right"></i></a>
      </div>
   </div>
</div>
<div class="row no-gutters">
      <button class="btn btn-primary w-100 mb-3">
      <?=$this->lang->line("User Section Profile Label Profile Reference")?> <?=$this->current_user['id']?>
      </button>
      
      <div class="w-100 mb-3"> 
         <?php $this->load->view("company/tickets/partials/ticketsTable") ?>
      </div>
</div>
<!-- Modal-->
<!-- div class="modal show" id="general-modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
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
</div -->