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
            <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa fa-home fa-fw" aria-hidden="true"></i></span><span class="nav-link-text">Home</span>
            </div>
        </a>
        <ul class="nav collapse show" id="home" data-parent="#navbarVerticalCollapse">
            <li class="nav-item active"><a class="nav-link" href="<?=site_url("/")?>">Dashboard</a>
            </li>
            
        </ul>
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
                                <input class="form-check-input" url="<?=site_url('user/enableDisableDarkMode')?>" yes="<?=$this->lang->line("Yes")?>" no="<?=$this->lang->line("No")?>" modal-title="<?=($this->lang->line("User Section Dark Mode Modal Title"))?>" modal-content="<?=( $this->darkMode == 1 ? $this->lang->line("User Section Dark Mode Modal Disable Title") : $this->lang->line("User Section Dark Mode Modal Enable Title") )?>" enabled="<?=($this->darkMode == 1 ? 1 : 0 )?>" id="make-dark" type="checkbox">
                                <label class="form-check-label" for="make-dark"><?=$this->lang->line("User Section Menu Label Dark Mode")?></label>
                            </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
        </li>
        
    </ul>
    </div>
</nav>