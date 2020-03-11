<div class="card mb-3">
    <div class="card-body rounded-soft bg-gradient"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <div class="row text-white align-items-center no-gutters">
        <div class="col">
            <h4 class="text-white mb-0"><?=$this->lang->line('User Section Graph Label Today')?> 764.39 kr</h4>
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
</div>
<div class="card bg-light mb-3">
    <div class="card-body p-3">
        <p class="fs--1 mb-0"><span class="fas fa-exchange-alt mr-2" data-fa-transform="rotate-90"></span><!--  --><?=$this->lang->line('User Section Tasks Label New Tasks')?></p>
    </div>
</div>
<div class="card-deck">
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
        </div>
        <!--/.bg-holder-->
       
        <div class="card-body position-relative">
        <h6><?=$this->lang->line("User Section Label Loyalty Tickets")?></h6>
        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":36487,"format":"alphanumeric"}'>564</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#!"><?=$this->lang->line("User Section Label Btn Add Ticket")?><svg class="svg-inline--fa fa-angle-right fa-w-8 ml-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg><!-- <span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span> --></a>
        </div>
    </div>
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-3.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
        <h6><?=$this->lang->line("User Section Label Revenue")?></h6>
        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countupp="{&quot;count&quot;:43594,&quot;format&quot;:&quot;comma&quot;,&quot;prefix&quot;:&quot;&quot;}">43,594 kr</div>
        </div>
    </div>
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-2.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
        <h6><?=$this->lang->line("User Section Label Users")?></h6>
        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info" data-countup="{&quot;count&quot;:23434,&quot;format&quot;:&quot;comma&quot;}">733</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#!"><?=$this->lang->line("User Section Label All Users")?><svg class="svg-inline--fa fa-angle-right fa-w-8 ml-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg><!-- <span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span> --></a>
        </div>
    </div>
    </div>