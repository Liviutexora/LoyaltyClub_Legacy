<div class="dropdown text-sans-serif text-right">
    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown2" data-toggle="dropdown" data-boundary="html" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
    <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown2">
        <div class="bg-white py-2">
            <!-- a class="dropdown-item" id="delete-ticket" idTicket="<?=$ticket->id?>" href="#!" lang-yes="<?=$this->lang->line('Yes')?>" lang-no="<?=$this->lang->line('No')?>" lang-content="<?=$this->lang->line('Delete Action Question')?>" url="<?=site_url('delete-ticket')?>"><?=$this->lang->line("Delete Action")?></a -->
            <?php if($ticket->status == 1) {?>
                <a class="dropdown-item" id="validate-ticket" idTicket="<?=$ticket->id?>" href="#!" lang-yes="<?=$this->lang->line('Yes')?>" lang-no="<?=$this->lang->line('No')?>" lang-content="<?=$this->lang->line('Company Section Ticket Label Section Ticket Validate Ticket Question')?>" url="<?=site_url('validate-ticket')?>"><?=$this->lang->line("Company Section Ticket Label Section Ticket Validate Ticket")?></a>
            <?php } ?>
        </div>
    </div>
</div>