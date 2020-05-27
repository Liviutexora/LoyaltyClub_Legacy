<nav class="navbar <?=(isset($setNavabarDarkModeCssClass) && $setNavabarDarkModeCssClass ? $setNavabarDarkModeCssClass : "")?> navbar-dark fs--1 font-weight-semi-bold navbar-standard navbar-theme navbar-expand-lg fixed-top">
        <div class="container"><a class="navbar-brand" href="<?=site_url('/')?>">
            <div class="d-flex align-items-center text-primary"><span class="text-white"><img src="<?=site_url('assets/img/icons/loyaltyclub-white.png')?>" width="100px"></span></div>
          </a>
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarStandard">
            <ul class="navbar-nav align-items-center">
              <!--li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownPages" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line("Pages")?></a>
                <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownPages">
                  <div class="bg-white rounded-soft py-2"><a class="dropdown-item" href="#"><?=$this->lang->line("Comming Soon")?></a>
                  </div>
                </div>
              </li-->
              <li class="nav-item dropdown"><a class="nav-link" id="navbarDropdownDocumentation" href="<?=site_url("companies")?>" ><?=$this->lang->line("Companies")?></a>
               
              </li>
              
            </ul>
            <ul class="navbar-nav align-items-center ml-auto">
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownLogin" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line("Login")?></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownLogin">
                  <div class="card shadow-none navbar-card-login">
                    <div class="card-body fs--1 p-4 font-weight-normal">
                      <div class="row text-left justify-content-between align-items-center mb-2">
                        <div class="col-auto">
                          <h5 class="mb-0"><?=$this->lang->line("Log in")?></h5>
                        </div>
                      </div>
                      <form class="needs-validation" id="login-form" action="<?=site_url("login")?>">
                        <div id="save_result"></div>
                        <div class="form-group">
                          <input class="form-control" type="email" name="email" required="required" placeholder="Email address" />
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="password" name="password" required="required" placeholder="Password" />
                        </div>
                        <div class="row justify-content-between align-items-center">
                          <div class="col-auto">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" name="remember" id="modal-checkbox" />
                              <label class="custom-control-label" for="modal-checkbox"><?=$this->lang->line("Remember me")?></label>
                            </div>
                          </div>
                          <div class="col-auto"><a class="fs--1" href="<?=site_url('forgot-password')?>"><?=$this->lang->line("Login Modal Forgot Password?")?></a></div>
                        </div>
                        <div class="form-group">
                          <button class="btn btn-primary btn-block mt-3 login-btn" type="button" ><?=$this->lang->line("Log in")?></button>
                        </div>
                      </form>
                      <!--div class="w-100 position-relative mt-4">
                        <hr class="text-300" />
                        <div class="position-absolute absolute-centered t-0 px-3 bg-white text-sans-serif fs--1 text-500 text-nowrap">or log in with</div>
                      </div-->
                      <!--div class="form-group mb-0">
                        <div class="row no-gutters">
                          <div class="col-sm-6 pr-sm-1"><a class="btn btn-outline-google-plus btn-sm btn-block mt-2" href="#"><span class="fab fa-google-plus-g mr-2" data-fa-transform="grow-8"></span> google</a></div>
                          <div class="col-sm-6 pl-sm-1"><a class="btn btn-outline-facebook btn-sm btn-block mt-2" href="#"><span class="fab fa-facebook-square mr-2" data-fa-transform="grow-8"></span> facebook</a></div>
                        </div>
                      </div-->
                    </div>
                  </div>
                </div>
              </li>
              <li class="nav-item"><a class="nav-link" href="#!" data-toggle="modal" data-target="#exampleModal"><?=$this->lang->line("Register")?></a></li>
            </ul>
          </div>
        </div>
      </nav>