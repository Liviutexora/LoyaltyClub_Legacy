    <?php $this->load->view("layouts/header") ?>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-dark fs--1 font-weight-semi-bold navbar-standard navbar-theme navbar-expand-lg fixed-top">
        <div class="container"><a class="navbar-brand" href="<?=site_url('/')?>">
            <div class="d-flex align-items-center text-primary"><span class="text-white"><img src="<?=site_url('assets/img/icons/loyaltyclub-white.png')?>" width="100px"></span></div>
          </a>
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarStandard">
            <ul class="navbar-nav align-items-center">
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownPages" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line("Pages")?></a>
                <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownPages">
                  <div class="bg-white rounded-soft py-2"><a class="dropdown-item" href="#">Activity</a>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownDocumentation" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line("Companies")?></a>
                <div class="dropdown-menu dropdown-menu-card" aria-labelledby="navbarDropdownDocumentation">
                  <div class="bg-white rounded-soft py-2"><a class="dropdown-item" href="#">Getting started</a>
                  </div>
                </div>
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
                      <form class="form-validation" id="login-form" action="<?=site_url("login")?>">
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
                          <!--div class="col-auto"><a class="fs--1" href="../authentication/basic/forgot-password.html">Forgot Password?</a></div-->
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
      <?php $this->load->view("register/register_modal.php") ?>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 overflow-hidden" id="banner">

        <div class="bg-holder overlay" style="background-image:url(<?=site_url('assets/img/generic/bg-1.jpg')?>);background-position: center bottom;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row justify-content-center align-items-center pt-8 pt-lg-10 pb-lg-9 pb-xl-0">
            <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-left"><a class="btn btn-outline-danger mb-4 fs--1 border-2x rounded-pill" href="#"><span class="mr-2" role="img" aria-label="Gift">🎁</span><?=$this->lang->line("Become a professional")?></a>
              <h1 class="text-white font-weight-light"><?=$this->lang->line("Bring")?> <span class="typed-text font-weight-bold" data-typed-text='["<?=$this->lang->line('hope')?>","<?=$this->lang->line('freedom')?>","<?=$this->lang->line('friends')?>","<?=$this->lang->line('success')?>","<?=$this->lang->line('loyalty')?>"]'></span><br /><?=$this->lang->line('in your life')?></h1>
              <p class="lead text-white opacity-75">With the power of Falcon, you can now focus only on functionaries for your digital products, while leaving the UI design on us!</p><a cbeautylass="btn btn-outline-light border-2x rounded-pill btn-lg mt-4 fs-0 py-2" href="#!" data-toggle="modal" data-target="#exampleModal"><?=$this->lang->line("Become one of us")?><span class="fas fa-play" data-fa-transform="shrink-6 down-1 right-5"></span></a>
            </div>
            <div class="col-xl-7 offset-xl-1 align-self-end"><a class="img-landing-banner" href="../index.html"><!--img class="img-fluid d-dark-none" src="../assets/img/generic/dashboard-alt.png" alt="" /--><!--img class="img-fluid d-light-none" src="<?=site_url('assets/img/generic/dashboard-alt-dark.png')?>../" alt="" /--></a></div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->



      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section>

        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
              <h1 class="fs-2 fs-sm-4 fs-md-5">WebApp theme of the future</h1>
              <p class="lead">Built on top of Bootstrap 4, super modular Falcon provides you gorgeous design &amp; streamlined UX for your WebApp.</p>
            </div>
          </div>
          <div class="row align-items-center justify-content-center mt-8">
            <div class="col-md col-lg-5 col-xl-4 pl-lg-6"><img class="img-fluid px-6 px-md-0" src="<?=site_url("assets/img/illustrations/6.png")?>" alt="" /></div>
            <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
              <h5 class="text-danger"><span class="far fa-lightbulb mr-2"></span>PLAN</h5>
              <h3>Blueprint & design </h3>
              <p>With Falcon as your guide, now you have a fine-tuned state of the earth tool to make your wireframe a reality.</p>
            </div>
          </div>
          <div class="row align-items-center justify-content-center mt-7">
            <div class="col-md col-lg-5 col-xl-4 pr-lg-6 order-md-2"><img class="img-fluid px-6 px-md-0" src="<?=site_url("assets/img/illustrations/5.png")?>" alt="" /></div>
            <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
              <h5 class="text-info"> <span class="far fa-object-ungroup mr-2"></span>BUILD</h5>
              <h3>38 Sets of components</h3>
              <p>Build any UI effortlessly with Falcon's robust set of layouts, 38 sets of built-in elements, carefully chosen colors, typography, and css helpers.</p>
            </div>
          </div>
          <div class="row align-items-center justify-content-center mt-7">
            <div class="col-md col-lg-5 col-xl-4 pl-lg-6"><img class="img-fluid px-6 px-md-0" src="<?=site_url("assets/img/illustrations/4.png")?>" alt="" /></div>
            <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
              <h5 class="text-success"><span class="far fa-paper-plane mr-2"></span>DEPLOY</h5>
              <h3>Review and test</h3>
              <p>From IE to iOS, rigorously tested and optimized Falcon will give the near perfect finishing to your webapp; from the landing page to the logout screen.</p>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-light text-center">

        <div class="container">
          <div class="row">
            <div class="col">
              <h1 class="fs-2 fs-sm-4 fs-md-5">Here's what's in it for you</h1>
              <p class="lead">Things you will get right out of the box with Falcon.</p>
            </div>
          </div>
          <div class="row mt-6">
            <div class="col-lg-4">
              <div class="card card-span h-100">
                <div class="card-span-img"><span class="fab fa-sass fs-4 text-info"></span></div>
                <div class="card-body pt-6 pb-4">
                  <h5 class="mb-2">Bootstrap 4.3.1</h5>
                  <p>Build your webapp with the world's most popular front-end component library along with Falcon's 32 sets of carefully designed elements.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-6 mt-lg-0">
              <div class="card card-span h-100">
                <div class="card-span-img"><span class="fab fa-node-js fs-5 text-success"></span></div>
                <div class="card-body pt-6 pb-4">
                  <h5 class="mb-2">SCSS & Javascript files</h5>
                  <p>With your purchased copy of Falcon, you will get all the uncompressed & documented SCSS and Javascript source code files.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-6 mt-lg-0">
              <div class="card card-span h-100">
                <div class="card-span-img"><span class="fab fa-gulp fs-6 text-danger"></span></div>
                <div class="card-body pt-6 pb-4">
                  <h5 class="mb-2">Gulp based workflow</h5>
                  <p>All the painful or time-consuming tasks in your development workflow such as compiling the SCSS or transpiring the JS are automated.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-200 text-center">

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
              <div class="owl-carousel owl-theme owl-theme-dark" data-options='{"margin":30,"nav":true,"autoplay":true,"autoplayHoverPause":true,"loop":true,"dots":false,"items":1}'>
                <div class="px-5 px-sm-6">
                  <p class="fs-sm-1 fs-md-2 font-italic text-dark">Falcon is the best option if you are looking for a theme built with Bootstrap. On top of that, Falcon's creators and support staff are very brilliant and attentive to users' needs.</p>
                  <p class="fs-0 text-600">- Scott Tolinski, Web Developer</p><img class="w-auto mx-auto" src="<?=site_url("assets/img/logos/google.png")?>" alt="" height="45" />
                </div>
                <div class="px-5 px-sm-6">
                  <p class="fs-sm-1 fs-md-2 font-italic text-dark">We've become fanboys! Easy to change the modular design, great dashboard UI, enterprise-class support, fast loading time. What else do you want from a Bootstrap Theme?</p>
                  <p class="fs-0 text-600">- Jeff Escalante, Developer</p><img class="w-auto mx-auto" src="<?=site_url("assets/img/logos/netflix.png")?>" alt="" height="30" />
                </div>
                <div class="px-5 px-sm-6">
                  <p class="fs-sm-1 fs-md-2 font-italic text-dark">When I first saw Falcon, I was totally blown away by the care taken in the interface. It felt like something that I'd really want to use and something I could see being a true modern replacement to the current class of Bootstrap themes.</p>
                  <p class="fs-0 text-600">- Liam Martens, Designer</p><img class="w-auto mx-auto" src="<?=site_url("assets/img/logos/paypal.png")?>" alt="" height="45" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section>

        <div class="bg-holder overlay" style="background-image:url(<?=site_url('assets/img/generic/bg-2.jpg')?>);background-position: center top;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-lg-8">
              <p class="fs-3 fs-sm-4 text-white"><?=$this->lang->line('Join our community')?></p>
              <button class="btn btn-outline-light border-2x rounded-pill btn-lg mt-4 fs-0 py-2" type="button"><?=$this->lang->line('Start our business')?></button>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-dark pt-8 pb-4">

        <div class="container">
          <div class="position-absolute btn-back-to-top bg-dark"><a class="text-600" href="#banner" data-fancyscroll="data-fancyscroll"><span class="fas fa-chevron-up" data-fa-transform="rotate-45"></span></a></div>
          <div class="row">
            <div class="col-lg-4">
              <h5 class="text-uppercase text-white opacity-85 mb-3">Our Mission</h5>
              <p class="text-600">Falcon enables front end developers to build custom streamlined user interfaces in a matter of hours, while it gives backend developers all the UI elements they need to develop their web app. And it's robust design can be easily integrated with backends whether your app is based on ruby on rails, laravel, express or any other serverside system.</p>
              <div class="icon-group mt-4"><a class="icon-item bg-white text-facebook" href="#!"><span class="fab fa-facebook-f"></span></a><a class="icon-item bg-white text-twitter" href="#!"><span class="fab fa-twitter"></span></a><a class="icon-item bg-white text-google-plus" href="#!"><span class="fab fa-google-plus-g"></span></a><a class="icon-item bg-white text-linkedin" href="#!"><span class="fab fa-linkedin-in"></span></a><a class="icon-item bg-white" href="#!"><span class="fab fa-medium-m"></span></a></div>
            </div>
            <div class="col pl-lg-6 pl-xl-8">
              <div class="row mt-5 mt-lg-0">
                <div class="col-6 col-md-6">
                  <h5 class="text-uppercase text-white opacity-85 mb-3">Company</h5>
                  <ul class="list-unstyled">
                    <li class="mb-1"><a class="text-600" href="#!">About</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Contact</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Careers</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Blog</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Terms</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Privacy</a></li>
                    <li><a class="text-600" href="#!">Imprint</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-6">
                  <h5 class="text-uppercase text-white opacity-85 mb-3">Product</h5>
                  <ul class="list-unstyled">
                    <li class="mb-1"><a class="text-600" href="#!">Features</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Roadmap</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Changelog</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Pricing</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Docs</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">System Status</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Agencies</a></li>
                    <li class="mb-1"><a class="text-600" href="#!">Enterprise</a></li>
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




    <?php $this->load->view("layouts/footer") ?>