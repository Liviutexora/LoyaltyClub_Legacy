<?php $this->load->view("layouts_after_login/header") ?>
  <?php if(isset($this->current_user['tip']) && $this->current_user['tip'] == 1) { ?>
    <?php $this->load->view("home/home_user") ?>
  <?php } elseif(isset($this->current_user['tip']) && $this->current_user['tip'] == 2) { ?>
    <?php $this->load->view("home/home_company") ?>
  <?php } ?>
<?php $this->load->view("layouts_after_login/footer") ?>