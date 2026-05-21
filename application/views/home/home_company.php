


<div class="card-deck"> 
   <div class="card mb-3 overflow-hidden border-primary" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
      </div>
      <div class="card-body position-relative">
         <h6 class="text-primary">Loyalty Scanner</h6>
         <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info d-flex align-items-center" style="gap: 0.5rem;">
            <span class="fas fa-qrcode mr-2"></span>QR / SCAN
         </div>
         <a data-toggle="modal" data-target="#qr-scanner-modal" class="btn btn-info pt-1 pb-1 pl-2 pr-2" style="font-size:14px; line-height:1;">
            Scan QR <i class="fa fa-angle-right"></i>
         </a>
      </div>
   </div>
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

<!-- QR Scanner Modal -->
<div class="modal fade" id="qr-scanner-modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:420px;">
      <div class="modal-content">
         <div class="modal-header pb-3 pt-3">
            <h4 class="mb-0 font-weight-bold">Scan Loyalty QR</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div id="qr-reader" style="min-height:300px;"></div>
         </div>
         <div class="modal-footer justify-content-center">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="qr-transaction-modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:460px;">
      <div class="modal-content">

         <div class="modal-header pb-3 pt-3" style="background:#eaf2ff; border-bottom:1px solid #c9dcff;">
            <div class="w-100">
               <h4 class="mb-1 text-primary font-weight-bold" style="letter-spacing:0.01em;">
                  <?=$this->current_user['company_name'] ?? 'Company'?>
               </h4>
               <div class="mb-0" style="margin-top:2px; font-size:1.05em; color:#6c757d; letter-spacing:0.01em;">
                  <span style="display:inline-block; margin-top:2px;">Validate Loyalty Transaction</span>
               </div>
            </div>
            <button class="close" type="button" data-dismiss="modal">
               <span>&times;</span>
            </button>
         </div>

         <div class="modal-body">
            <div class="row">


                  <div class="col-md-8 mb-3">
                     <label>Client Name</label>
                     <input type="text" class="form-control" id="qr-client-name" readonly placeholder="Client identified after scan" style="background-color:#f8f9fa; color:#495057;">
                  </div>
                  <div class="col-md-4 mb-3">
                     <label>Loyalty ID</label>
                     <input type="text" class="form-control" id="qr-legacy-id" readonly placeholder="Legacy ID" style="background-color:#f8f9fa; color:#495057;">
                  </div>



               <div class="col-md-12 mb-3">
                  <label>Transaction Amount *</label>
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="0.00" style="background-color:#fff9e6;">
                     <div class="input-group-append">
                        <span class="input-group-text"><?=$this->config->item('currency')?></span>
                     </div>
                  </div>
               </div>

               <div class="col-md-4 mb-3">
                  <label>Loyalty %</label>
                  <input type="text" class="form-control" readonly placeholder="%" style="background-color:#f8f9fa; color:#495057;">
               </div>

               <div class="col-md-8 mb-3">
                  <label>Loyalty Value</label>
                  <div class="input-group">
                     <input type="text" class="form-control" readonly placeholder="0.00" style="background-color:#f8f9fa; color:#495057;">
                     <div class="input-group-append">
                        <span class="input-group-text"><?=$this->config->item('currency')?></span>
                     </div>
                  </div>
               </div>

               <div class="col-12 mb-3">
                  <label>
                     Invoice / Fiscal Receipt Series
                     <small class="text-muted">(Optional)</small>
                  </label>

                  <input
                     type="text"
                     class="form-control"
                     placeholder="Optional invoice / receipt reference"
                     style="background-color:#fffdf2;">
               </div>

            </div>
         </div>

         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">
               Cancel
            </button>

            <button class="btn btn-primary" type="button">
               Validate Transaction
            </button>
         </div>

      </div>
   </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let qrScanner = null;

    const scannerModal = document.getElementById('qr-scanner-modal');

   $('#qr-scanner-modal').on('shown.bs.modal', function () {

        if (qrScanner) return;

        qrScanner = new Html5Qrcode("qr-reader");

        Html5Qrcode.getCameras()
            .then(function(cameras){

                if (!cameras || cameras.length === 0) {
                    console.log('No camera found');
                    return;
                }

                const cameraId = cameras[0].id;

                qrScanner.start(
                    cameraId,
                    {
                        fps: 10,
                        qrbox: 250
                    },
                    function(decodedText){
                        console.log('QR detected:', decodedText);
                    },
                    function(error){
                        // ignore scan noise
                    }
                );
            })
            .catch(function(err){
                console.log(err);
            });

    });

    scannerModal.addEventListener('hidden.bs.modal', function () {

        if (!qrScanner) return;

        qrScanner.stop()
            .then(function(){
                qrScanner.clear();
                qrScanner = null;
            })
            .catch(function(){
                qrScanner = null;
            });

    });

});
</script>

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