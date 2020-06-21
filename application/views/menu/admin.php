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
        <ul class="nav collapse" id="home" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url("/")?>">Dashboard</a>
            </li>
            
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#loyalty-private" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-user-shield" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("Admin Section Menu Label Customers")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="loyalty-private" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('admin/users')?>"><?=$this->lang->line("Admin Section Menu Label Customers List")?></a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('dynamic-content/documentation/private')?>"><?=$this->lang->line("Admin Section Menu Label Customers Documentation")?></a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('dynamic-content/terms-and-conditions/private')?>"><?=$this->lang->line("Admin Section Menu Label Customers Terms And Conditions")?></a></li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#loyalty-company" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-building" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("Admin Section Menu Label Companies")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="loyalty-company" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('admin/companies')?>"><?=$this->lang->line("Admin Section Menu Label Companies List")?></a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('dynamic-content/documentation/company')?>"><?=$this->lang->line("Admin Section Menu Label Customers Documentation")?></a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('dynamic-content/terms-and-conditions/company')?>"><?=$this->lang->line("Admin Section Menu Label Customers Terms And Conditions")?></a></li>
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('admin/domains')?>"><?=$this->lang->line("Admin Section Menu Label Domains List")?></a></li>
        </ul>
        </li> 
        
    </ul>
    </div>
</nav>