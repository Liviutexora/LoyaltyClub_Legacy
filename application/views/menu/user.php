<nav class="navbar navbar-vertical navbar-expand-xl navbar-light">
    <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">
        <button class="btn btn-link navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    </div><a class="navbar-brand text-left" href="<?=site_url("/")?>">
        <div class="d-flex align-items-center py-3"><img class="mr-2" src="<?=site_url("assets/img/icons/".($this->darkMode ? 'loyaltyclub-white.png' : 'logo_blue.png')."")?>" alt="" width="90" />
        </div>
    </a>
    </div>
    <div class="collapse navbar-collapse navbar-glass perfect-scrollbar scrollbar" id="navbarVerticalCollapse">
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
          <a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-home fa-fw" aria-hidden="true"></i></span><span class="nav-link-text">Home</span>
            </div>
        </a>
        <ul class="nav collapse" id="home" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url("/")?>"><?=$this->lang->line("User Section Menu Label Dashboard")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#documentation" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><svg class="svg-inline--fa fa-copy fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="copy" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z"></path></svg></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Documentation")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="documentation" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="#"><?=$this->lang->line("Comming Soon")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#companies" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-home fa-building" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Companies")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="companies" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="#"><?=$this->lang->line("Comming Soon")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#profile" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-id-card" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Profile")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="profile" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('my-profile')?>"><?=$this->lang->line("User Section Profile Label Edit Profile Info")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator <?=(in_array(uri_string(),array("my-network")) ? '' : 'collapsed')?>" href="#my-network" data-toggle="collapse" role="button" aria-expanded="<?=(in_array(uri_string(),array("my-network")) ? 'true' : 'false')?>" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-network-wired" aria-hidden="<?=(in_array(uri_string(),array("my-network")) ? 'false' : 'true')?>"></i></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label My Network")?></span>
            </div>
        </a>
        <ul class="nav collapse <?=(in_array(uri_string(),array("my-network")) ? 'show' : '')?>" id="my-network" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('my-network')?>"><?=$this->lang->line("User Section Menu Label My Network List")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#loyalty-bank" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-money-check-alt" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Loyalty Bank")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="loyalty-bank" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url('my-tickets')?>"><?=$this->lang->line("User Section Menu Label My Tickets")?></a>
            </li>
        </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-indicator collapsed" href="#contact-us" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span><span class="nav-link-text"><?=$this->lang->line("User Section Menu Label Contact Us")?></span>
            </div>
        </a>
        <ul class="nav collapse" id="contact-us" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="#"><?=$this->lang->line("Comming Soon")?></a>
            </li>
        </ul>
        </li>
        <div class="px-3 px-xl-0 navbar-vertical-divider">
              <hr class="border-300 my-2">
        </div>
        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="authentication">
                  <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-user" aria-hidden="true"></i><!-- <span class="fas fa-unlock-alt"></span> --></span><span class="nav-link-text"><?=$this->lang->line('User Section Menu Label Professional')?></span>
                  </div>
                </a>
                <ul class="nav collapse show" id="authentication" data-parent="#navbarVerticalCollapse" style="">
                  <li class="nav-item"><a class="nav-link dropdown-indicator collapsed" href="#authentication-basic" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-basic"><?=$this->lang->line('User Section Menu Label Settings')?></a>
                    <ul class="nav collapse" id="authentication-basic" style="">
                      <li class="nav-item">
                        <a class="nav-link" href="#"> 
                            <div class="form-group form-check">
                                <input class="form-check-input" <?=($this->darkMode ? "checked='checked'" : '')?> url="<?=site_url('user/enableDisableDarkMode')?>" yes="<?=$this->lang->line("Yes")?>" no="<?=$this->lang->line("No")?>" modal-title="<?=($this->lang->line("User Section Dark Mode Modal Title"))?>" modal-content="<?=( $this->darkMode == 1 ? $this->lang->line("User Section Dark Mode Modal Disable Title") : $this->lang->line("User Section Dark Mode Modal Enable Title") )?>" enabled="<?=($this->darkMode == 1 ? 1 : 0 )?>" id="make-dark" type="checkbox">
                                <label class="form-check-label" for="make-dark"><?=$this->lang->line("User Section Menu Label Dark Mode")?></label>
                            </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
        </li>
        <div class="px-3 px-xl-0 navbar-vertical-divider">
              <hr class="border-300 my-2">
        </div>
        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#business" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="authentication">
                  <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-business-time" aria-hidden="true"></i><!-- <span class="fas fa-unlock-alt"></span> --></span><span class="nav-link-text"><?=$this->lang->line('User Section Menu Label Business')?></span>
                  </div>
                </a>
                <ul class="nav collapse show" id="business" data-parent="#navbarVerticalCollapse" style="">
               
                </ul>
              </li>
        </li>
        
    </ul>
    </div>
</nav>