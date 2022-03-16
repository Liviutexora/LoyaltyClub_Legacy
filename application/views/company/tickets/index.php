<?php $this->load->view("layouts_after_login/header") ?>
<?php $this->load->view("company/tickets/partials/ticketsTable") ?>
<?php $this->load->view("layouts_after_login/footer",array("jsFiles" => array("company.js"))) ?>