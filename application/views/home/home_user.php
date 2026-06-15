<!--div class="card mb-3">
    <div class="card-body rounded-soft bg-gradient"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <div class="row text-white align-items-center no-gutters">
        <div class="col">
            <h4 class="text-white mb-0"><?=$this->lang->line('User Section Graph Label Today')?> 764.39 kr (<?=$this->lang->line("Coming Soon")?>)</h4>
            <p class="fs--1 font-weight-semi-bold"><?=$this->lang->line("User Section Graph Label This Month")?> <span class="opacity-50">684.87 kr</span></p>
        </div>
        <div class="col-auto d-none d-sm-block">
            <select class="custom-select custom-select-sm mb-3" id="dashboard-chart-select">
            <option value="network-incomes"><?=$this->lang->line("User Section Graph Label Network Incomes")?></option>
            <option value="personal-incomes" selected="selected"><?=$this->lang->line("User Section Graph Label Personal Incomes")?></option>
            <option value="new-registered"><?=$this->lang->line("User Section Graph Label New Registered")?></option>
            </select>
        </div>
        </div>
        <canvas class="max-w-100 rounded chartjs-render-monitor" id="chart-line" width="820" height="190" aria-label="Line chart" role="img" style="display: block; width: 820px; height: 190px;"></canvas>
    </div>
</div-->
<!--div class="card bg-light mb-3">
    <div class="card-body p-3">
        <p class="fs--1 mb-0"><span class="fas fa-exchange-alt mr-2" data-fa-transform="rotate-90"></span><?=$this->lang->line('User Section Tasks Label New Tasks')?> (<?=$this->lang->line("Coming Soon")?>)</p>
    </div>
</div-->
<div class="card-deck">

    <div class="card mb-3 overflow-hidden border-primary" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
        </div>
        <!--/.bg-holder-->
        <div class="card-body position-relative">
            <h6 class="text-primary">Loyalty Card</h6>
            <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info d-flex align-items-center" style="gap: 0.5rem;">
                <span class="fas fa-qrcode mr-2"></span>QR / CARD
            </div>
            <a href="<?=$this->config->item('laravel_app_url')?>/membership/<?=$this->session->userdata('user')['id']?>" class="btn btn-info pt-1 pb-1 pl-2 pr-2" style="font-size:14px; line-height:1;" target="_blank" rel="noopener">Open Card <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-3.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
        <h6><?=$this->lang->line("User Section Label Revenue")?></h6>
        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countupp="{&quot;count&quot;:43594,&quot;format&quot;:&quot;comma&quot;,&quot;prefix&quot;:&quot;&quot;}">
		<?=number_format($totalReceived,2)?> <?=$this->config->item("currency")?></div>
		<a href="<?=site_url('my-payment')?>" class="btn btn-success pt-1 pb-1 pl-2 pr-2 " style="font-size:14px; line-height:1;">New Payment <i class="fa fa-angle-right"></i></a>
        <div class="text-muted fs--2 mt-2">În dezvoltare</div>
        </div>
		
    </div>
	
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
        </div>
        <!--/.bg-holder-->
       
        <div class="card-body position-relative">
        <h6><?=$this->lang->line("User Section Label Loyalty Tickets")?></h6>
        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":36487,"format":"alphanumeric"}'><?=$nrOfTickets?></div>
		<a class="font-weight-semi-bold fs--1 text-nowrap open-modal" ajaxlink="<?=site_url('insert-ticket')?>" href="#!"><?=$this->lang->line("User Section Label Btn Add Ticket")?><span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span><!--  --></a>
        </div>
    </div>
    
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-2.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
        <h6><?=$this->lang->line("User Section Label Users")?></h6>
        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info" data-countup="{&quot;count&quot;:<?=$generalTotalNrUsers?>,&quot;format&quot;:&quot;comma&quot;}"><?=$generalTotalNrUsers?></div><a class="font-weight-semi-bold fs--1 text-nowrap" href="<?=site_url('my-network')?>"><?=$this->lang->line("User Section Label All Users")?><span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
        </div>
    </div>
</div>
<div class="row no-gutters">
    <div class="btn btn-primary w-100 mb-3" style="cursor: default;">
      ID Loyalty Club: <?=$this->session->userdata('user')['id']?>
    </div>
</div>
<div class="row no-gutters">
    <div class="col-12 mb-3">
        <div class="card overflow-hidden border-primary">
            <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-4.png);">
            </div>
            <div class="card-body position-relative">
                <h6 class="text-primary mb-3">Credit Loyalty Club</h6>
                <p class="mb-2 fs--1">Creditul acumulat în Loyalty Club va putea fi folosit în curând pentru achiziția de produse și servicii de la comercianții parteneri.</p>
                <p class="mb-2 fs--1">Continuă să acumulezi cashback și bonusuri.</p>
                <p class="mb-0 fs--1">Funcționalitatea este în dezvoltare.</p>
            </div>
        </div>
    </div>
</div>
    <div class="row no-gutters">
        <div class="col-12 mb-3">
            <div class="card h-lg-100">
            <div class="card-body d-flex align-items-center">
                <div class="w-100">
                <h6 class="mb-3 text-800"><?=$this->lang->line("User Section Label Personal Shopping")?> <strong class="text-dark"><?=$totalAmount?> <?=$this->config->item("currency")?> </strong><?=$this->lang->line('User Section Label Personal Shopping of')?> <?=$this->config->item("personalShoppingMaxValue")?> <?=$this->config->item("currency")?></h6>
                <div class="progress mb-3 rounded-soft" style="height: 10px;">
                    <div class="progress-bar bg-300 border-right border-white border-2x p-0" role="progressbar" style="width: 14%;" aria-valuenow="<?=(isset($data['currentGraphPercentage']['level1']) ? $data['currentGraphPercentage']['level1'] : 0)?>" aria-valuemin="0" aria-valuemax="<?=$graphTicketsMaxPrecentages['level1']?>"><div class="bg-primary h-100" style="width: <?=(($levelSelect == "level1" && isset($currentGraphPercentage['level1'])) ? min(100,$currentGraphPercentage['level1']) : (($levelSelect == "level2" || $levelSelect == "level3") ? 100 : 0))?>%;"></div></div>
                    <div class="progress-bar bg-300 border-right border-white border-2x p-0" role="progressbar" style="width: 33%;" aria-valuenow="<?=(isset($data['currentGraphPercentage']['level2']) ? $data['currentGraphPercentage']['level2'] : 0)?>" aria-valuemin="<?=$graphTicketsMaxPrecentages['level1']+0.1?>" aria-valuemax="<?=$graphTicketsMaxPrecentages['level2']?>"><div class="bg-info h-100" style="width: <?=(isset($currentGraphPercentage['level2']) ? $currentGraphPercentage['level2'] : ($levelSelect == "level3" ? 100 : 0))?>%;"></div></div>
                    <div class="progress-bar bg-300 border-right border-white border-2x p-0" role="progressbar" style="width: 53%;" aria-valuenow="<?=(isset($currentGraphPercentage['level3']) ? $currentGraphPercentage['level3'] : 0)?>" aria-valuemin="<?=$graphTicketsMaxPrecentages['level2']+1?>" aria-valuemax="<?=$graphTicketsMaxPrecentages['level3']?>"><div class="bg-success h-100" style="width: <?=(isset($currentGraphPercentage['level3']) ? $currentGraphPercentage['level3'] : 0)?>%;"></div></div>
                </div>
                <div class="row fs--1 font-weight-semi-bold text-500">
                    <div class="col-auto d-flex align-items-center pr-2"><span class="dot bg-primary"></span><span><?=$this->lang->line("User Section Label Personal Shopping Level 1")?></span></div>
                    <div class="col-auto d-flex align-items-center px-2"><span class="dot bg-info"></span><span><?=$this->lang->line("User Section Label Personal Shopping Level 2")?></span></div>
                    <div class="col-auto d-flex align-items-center px-2"><span class="dot bg-success"></span><span><?=$this->lang->line("User Section Label Personal Shopping Level 3")?></span></div>
                </div>
                </div>
            </div>
            </div>
        </div>
<!-- FUTURE SUBSCRIPTIONS MODULE
Hidden during production cleanup.
Will be restored when subscription system is implemented.
<div class="col-lg-6 col-xl-5 col-xxl-4 mb-3 pl-lg-2">
    <div class="card h-lg-100 overflow-hidden">
    <div class="bg-holder bg-card" style="background-image:url(../assets/img/illustrations/corner-1.png);">
    </div>

    <div class="card-body position-relative">
        <div class="row">
            <div class="col-md-8">
            <h5 ><?=$this->lang->line('User Section Profile Label Profile Reference')?></h5>
            </div>
            <div class="col-md-4">
            <div class="display-4 fs-2 mb-2 font-weight-normal text-sans-serif text-info float-right"><?=$this->session->userdata('user')['id']?></div>
            </div>

        </div>
        
        
        <h5 class="text-warning"><?=$this->lang->line('User Section Label Subscription Your subscription will be renewed in')?></h5>
        <p class="fs--1 mb-0"><?=$this->lang->line('User Section Label Subscription Your subscription will expire on')?>: 12-03-2021</p>
        <button class="btn btn-falcon-success fs--1 mt-4 mr-1 mb-1" type="button"><?=$this->lang->line('User Section Label Subscription Upgrade to')?> Professional (<?=$this->lang->line("Coming Soon")?>)</button>
        <a class="btn btn-link fs--1 text-warning mt-4 mt-lg-3 pl-0 pr-0 float-right" href="#!"><?=$this->lang->line('User Section Label Subscription Keep Me')?> standard (<?=$this->lang->line("Coming Soon")?>)<svg class="svg-inline--fa fa-chevron-right fa-w-10 ml-1" data-fa-transform="shrink-4 down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5625em;"><g transform="translate(160 256)"><g transform="translate(0, 32)  scale(0.75, 0.75)  rotate(0 0 0)"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" transform="translate(-160 -256)"></path></g></g></svg></a>
           
    </div>
    </div>
</div>
-->
    </div>

