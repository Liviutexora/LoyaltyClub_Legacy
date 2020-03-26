<!-- Modal-->
<div class="modal show" id="general-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?=site_url('add-tickets')?>" method="post" id="add-tickets-form" class="needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('Company Section Ticket Label Section Ticket Add Tickets')?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div id="save-result"></div>
                    <div class="form-group row">
                        <label for="nr-of-tickets" class="col-sm-6 col-form-label"><?=$this->lang->line('Company Section Ticket Label Section Ticket Insert Nr Of Tickets')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nr-of-tickets" name="nr-of-tickets" pattern="^[1-9][0-9]*" required="required">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-info btn-sm" type="button" data-dismiss="modal"><?=$this->lang->line('Modals Label Btn Cancel')?></button>
                    <button class="btn btn-success btn-sm" onclick="submit_form('#add-tickets-form', '#save-result')" type="submit"><?=$this->lang->line('Modals Label Btn Save Changes')?></button>
            </div>
        </form>
    </div>
  </div>
</div>