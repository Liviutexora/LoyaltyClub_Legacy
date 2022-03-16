<?php $this->load->view("layouts_after_login/header",array("allPagesDocumentation" =>(isset($this->allPagesDocumentation) ? $this->allPagesDocumentation : array()))) ?>
  <?php
  $jsFiles = [];
  ?>
  <?php if(isset($this->current_user['tip']) && $this->current_user['tip'] == 1) { ?>
    <?php $this->load->view("home/home_user") ?>
  <?php } elseif(isset($this->current_user['tip']) && $this->current_user['tip'] == 2) { ?>
    <?php $jsFiles[] = "company.js"; ?>
    <?php $this->load->view("home/home_company") ?>
  <?php } elseif(isset($this->current_user['tip']) && $this->current_user['tip'] == 3) { ?>
    <?php $this->load->view("home/home_admin") ?>
  <?php } ?>
<?php $this->load->view("layouts_after_login/footer",array("jsFiles" => $jsFiles)) ?>