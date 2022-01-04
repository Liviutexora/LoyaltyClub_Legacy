    
      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 bg-dark">

        <div>
          <hr class="my-0 border-600 opacity-25" />
          <div class="container py-3">
            <div class="row justify-content-between fs--1">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600 opacity-85"><br class="d-sm-none" /> <?=date('Y')?> &copy; <a class="text-white opacity-85" href="<?=site_url('/')?>">Loyalty Club</a></p>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script>
      
      /*-----------------------------------------------
      |   Theme Configuration
      -----------------------------------------------*/
      var storage = {
        isDark: <?=($this->darkMode ? 1 : 0)?>
      };
      var url = "<?=site_url('/')?>"
    </script>
    <script src="<?=site_url("assets/js/jquery.min.js")?>"></script>
    <script src="<?=site_url("assets/js/popper.min.js")?>"></script>
    <script src="<?=site_url("assets/js/bootstrap.min.js")?>"></script>
    <script src="<?=site_url("assets/lib/@fortawesome/all.min.js")?>"></script>
    <script src="<?=site_url("assets/lib/stickyfilljs/stickyfill.min.js")?>"></script>
    <script src="<?=site_url("assets/lib/sticky-kit/sticky-kit.min.js")?>"></script>
    <script src="<?=site_url("assets/lib/is_js/is.min.js")?>"></script>
    <script src="<?=site_url("assets/lib/lodash/lodash.min.js")?>"></script>
    <script src="<?=site_url("assets/lib/perfect-scrollbar/perfect-scrollbar.js")?>"></script>
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <script src="<?=site_url('assets/lib/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')?>"></script>
    <script src="<?=site_url('assets/lib/jquery-validation/jquery.validate.min.js')?>"></script>
    <script src="<?=site_url("assets/lib/owl.carousel/owl.carousel.js")?>"></script>
    <script src="<?=site_url("assets/lib/typed.js/typed.js")?>"></script>
    <script src="<?=site_url('assets/lib/dropzone/dropzone.min.js')?>"></script>
    <script src="<?=site_url('assets/lib/lottie/lottie.min.js')?>"></script>
    <script src="<?=site_url('assets/lib/plyr/plyr.polyfilled.min.js')?>"></script>
    <script src="<?=site_url("assets/js/theme.js?v=".$this->config->item('versionJS')."")?>"></script>
    <script src="<?=site_url("assets/js/register.js?v=".$this->config->item('versionJS')."")?>"></script>
    <script src="<?=site_url("assets/js/app.js?v=".$this->config->item('versionJS')."")?>"></script>

  </body>

</html>