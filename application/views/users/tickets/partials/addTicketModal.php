<!-- Modal-->
<div class="modal show" id="general-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?=site_url('insert-ticket')?>" method="post" id="insert-ticket-form" class="needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('User Section Tickets Page Label Insert Ticket')?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div id="save-result"></div>
                    <div class="form-group row">
                        <label for="ticket-serial" class="col-sm-4 col-form-label"><?=$this->lang->line('User Section Tickets Page Label Serial')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="ticket-serial" name="ticket-serial"  required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ticket-value" class="col-sm-4 col-form-label"><?=$this->lang->line('User Section Tickets Page Label Value')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control float-left" id="ticket-value" name="ticket-value" pattern="^[1-9][0-9]*"  required="required">
                            <div class="input-group-prepend"><span class="input-group-text">kr</span></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ticket-discount" class="col-sm-4 col-form-label"><?=$this->lang->line('User Section Tickets Page Label Discount')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control float-left" id="ticket-discount" name="ticket-discount" pattern="^[0-9]*"  required="required">
                            <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-info btn-sm" type="button" data-dismiss="modal"><?=$this->lang->line('Modals Label Btn Cancel')?></button>
                    <button class="btn btn-success btn-sm" onclick="submit_form('#insert-ticket-form', '#save-result')" type="submit"><?=$this->lang->line('Modals Label Btn Save Changes')?></button>
            </div>
        </form>
    </div>
  </div>
</div>