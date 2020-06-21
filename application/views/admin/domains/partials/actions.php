<div class="dropdown text-sans-serif text-right">
    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown2" data-toggle="dropdown" data-boundary="html" aria-haspopup="true" aria-expanded="false"><span class="fas fa-cog fs--1"></span></button>
    <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown2">
        <div class="bg-white py-2">
            <a class="dropdown-item open-modal" ajaxlink="<?=site_url('edit-domain/'.$domain->id.'')?>"><?=$this->lang->line('Admin Section Edit Label Btn')?></a>
            <a class="dropdown-item" id="change-domain-status" domainId="<?=$domain->id?>" domainStatus="<?=($domain->domainStatus ? 0 : 1)?>" href="#!" lang-yes="<?=$this->lang->line('Yes')?>" lang-no="<?=$this->lang->line('No')?>" lang-content="<?=$this->lang->line('Delete Action Question')?>" url="<?=site_url('change-domain-status')?>"><?=($domain->domainStatus ? $this->lang->line("Action Disable Btn Label") : $this->lang->line("Action Enable Btn Label"))?></a>
            <a class="dropdown-item" id="delete-domain" domainId="<?=$domain->id?>" href="#!" lang-yes="<?=$this->lang->line('Yes')?>" lang-no="<?=$this->lang->line('No')?>" lang-content="<?=$this->lang->line('Delete Action Question')?>" url="<?=site_url('delete-domain')?>"><?=$this->lang->line("Delete Action")?></a>
        
            
        </div>
    </div>
</div>