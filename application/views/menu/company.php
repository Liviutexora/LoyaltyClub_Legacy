<nav class="navbar navbar-vertical navbar-expand-xl navbar-light">
    <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">
        <button class="btn btn-link navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    </div><a class="navbar-brand text-left" href="<?=site_url("/")?>">
        <div class="d-flex align-items-center py-3"><img class="mr-2" src="<?=site_url("assets/img/icons/logo_blue.png")?>" alt="" width="90" />
        </div>
    </a>
    </div>
    <div class="collapse navbar-collapse navbar-glass perfect-scrollbar scrollbar" id="navbarVerticalCollapse">
    <ul class="navbar-nav flex-column">
        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text">Home</span>
            </div>
        </a>
        <ul class="nav collapse show" id="home" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url("/")?>">Dashboard</a>
            </li>
            
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-id-card" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("Company Section Menu Label Settings")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="profile" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('company/my-profile')?>"><?=$this->lang->line("Company Section Menu Label Edit Profile Info")?></a>
            </li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('company-details')?>"><?=$this->lang->line("Company Section Menu Label Edit Profile Company Details")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#loyalty-bank" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-money-check-alt" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("Company Section Menu Label Loyalty Bank")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="loyalty-bank" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('payments')?>">My Payments</a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('tickets')?>"><?=$this->lang->line("Company Section Menu Label Generate Tickets")?></a>
            </li>
			       <li class="nav-item active"><a class="nav-link" href="<?=site_url('invoices')?>">Invoices</a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('archives')?>">Archive</a></li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#products" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fab fa-product-hunt" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("Company Section Menu Label Products")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="products" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('products')?>"><?=$this->lang->line("Company Section Menu Label Products List")?></a>
            </li>
        </ul>
        </li>
        <?php if(count($this->allPagesDocumentation)) { ?>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#documentation" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-copy fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z"></path></svg></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Documentation")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="documentation" data-parent="#navbarVerticalCollapse">
            <?php foreach ($this->allPagesDocumentation as $key => $pageDetails) { ?>
             
              <?php $categoryUrl = $pageDetails['id']."-".preg_replace('/[\s,\']+/', '-', $pageDetails['titlu_eng']); ?>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('/pages/'.urlencode(strtolower($categoryUrl)).'')?>"><?=ucfirst(strtolower($pageDetails['titlu_eng']))?></a>
            </li>
            <?php } ?>
        </ul>
        </li>
        <?php } ?>
        <?php if(count($this->allPagesTermsAndDocumentations)) { ?>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#terms-and-conditions" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-copy fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z"></path></svg></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Terms and Conditions")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="terms-and-conditions" data-parent="#navbarVerticalCollapse">
            <?php foreach ($this->allPagesTermsAndDocumentations as $key => $pageDetails) { ?>
             
              <?php $categoryUrl = $pageDetails['id']."-".preg_replace('/[\s,\']+/', '-', $pageDetails['titlu_eng']); ?>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('/pages/'.urlencode(strtolower($categoryUrl)).'')?>"><?=ucfirst(strtolower($pageDetails['titlu_eng']))?></a>
            </li>
            <?php } ?>
        </ul>
        </li>
        <?php } ?>
        
    </ul>
    </div>
</nav>