<?php 
$productPhotos = json_decode($productPhotos,true);
?>
<div class="row">
<?php foreach ($productPhotos as $productDetails) { ?>
    <div class="col-md-3 text-center">
        <img src="<?=site_url('uploads/companies/'.$this->session->userdata('user')['id'].'/products/'.$productDetails["product_photo_product_id"].'/'.str_replace(" ","_", $productDetails["product_photo_name"]))?>" class="img-thumbnail">
        <button class="btn btn-outline-info btn-sm" type="button" id="delete-product-image" idImage="<?=$productDetails["product_photo_id"]?>" href="#!" lang-yes="<?=$this->lang->line('Yes')?>" lang-no="<?=$this->lang->line('No')?>" lang-content="<?=$this->lang->line('Delete Action Question')?>" url="<?=site_url('delete-product-image')?>"><?=$this->lang->line('Company Section Product Label Btn Delete Product Image')?></button>
    </div>
<?php } ?>
</div>