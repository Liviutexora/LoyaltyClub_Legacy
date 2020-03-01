<?php $this->load->view("layouts/header_logged") ?>
  <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">


      <div class="container" data-layout="container">
        <nav class="navbar navbar-vertical navbar-expand-xl navbar-light">
          <div class="d-flex align-items-center">
            <div class="toggle-icon-wrapper">
              <button class="btn btn-link navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            </div><a class="navbar-brand text-left" href="<?=site_url("/")?>">
              <div class="d-flex align-items-center py-3"><img class="mr-2" src="<?=site_url("assets/img/icons/logo_top_menu.png")?>" alt="" width="90" />
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
             
            </ul>
          </div>
        </nav>
        <div class="content">
          <nav class="navbar navbar-light navbar-glass fs--1 font-weight-semi-bold row navbar-top sticky-kit navbar-expand">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button><a class="navbar-brand text-left ml-3" href="index.html">
              <div class="d-flex align-items-center"><img class="mr-2" src="assets/img/illustrations/falcon.png" alt="" width="40" /><span class="text-sans-serif">falcon</span>
              </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown1">
              
              <ul class="navbar-nav align-items-center ml-auto">
              
                <li class="nav-item dropdown"><a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-xl">
                      <img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />

                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                    <div class="bg-white rounded-soft py-2">
                      <a class="dropdown-item" href="<?=site_url("logout")?>">Logout</a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
      </div>
    </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    <?php $this->load->view("layouts/footer_logged") ?>