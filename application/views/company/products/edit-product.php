<?php $this->load->view("layouts_after_login/header") ?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
            <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0"><?=$this->lang->line('Company Section Product Label Section Label Edit Product')?></h5>
        </div>
        <div class="col-6 col-sm-auto ml-auto text-right pl-0">
            <div class="d-none" id="purchases-actions">
            <div class="input-group input-group-sm">
                <select class="custom-select cus" aria-label="Bulk actions">
                <option selected="">Bulk actions</option>
                <option value="Refund">Refund</option>
                <option value="Delete">Delete</option>
                <option value="Archive">Archive</option>
                </select>
                <button class="btn btn-falcon-default btn-sm ml-2" type="button">Apply</button>
            </div>
            </div>
            
        </div>
        </div>
    </div>

    <div class="card-body px-0 pt-0  card-datables">
    <form action="<?=site_url('edit-product/'.$productDetails['id'].'')?>" method="post" id="add-product-form" class="needs-validation" novalidate>
          
            <div class="modal-body">
                    <div id="save-result"></div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label"><?=$this->lang->line('Company Section Product Label Section Label Product Name')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" value="<?=$productDetails['titlu']?>" name="title" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label"><?=$this->lang->line('Company Section Product Label Section Label Product Description')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" name="description" required="required"><?=$productDetails['descriere']?></textarea>
                            <input type="hidden" id="product-id" type="text" value="<?=$productDetails['id']?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label"><?=$this->lang->line('Company Section Product Label Section Label Product Price')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="price" value="<?=$productDetails['pret']?>" name="price" pattern="^[0-9]+.[0-9]+" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="col-sm-4 col-form-label"><?=$this->lang->line('Company Section Product Label Section Label Product Bonus')?> <span class="required-sign-label">*</span>: </label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control float-left" id="discount" value="<?=$productDetails['promotie']?>" name="discount" pattern="^[0-9]*"  required="required">
                            <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                            <input type="hidden" id="product-id" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="col-md-4 col-form-label"><?=$this->lang->line('Company Section Product Label Section Label Product Photos')?>: </label>
                        <div class="col-md-8">
                            <div class="dropzone dropzone-multiple p-0" data-dropzone data-options='{"url":"<?=site_url('upload-photos')?>","parallelUploads" : "30","autoProcessQueue" : false, "acceptedFiles" : "image/*"  }'>
                                <div class="fallback">
                                    <input type="file" name="file2">
                                </div>
                                <div class="dz-message" data-dz-message> <img class="mr-2" src="../assets/img/icons/cloud-upload.svg" width="25" alt="">Drop your files here</div>
                                    <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                        <div class="media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger"><img class="dz-image" src="..." alt="..." data-dz-thumbnail>
                                            <div class="media-body d-flex flex-between-center">
                                                <div>
                                                <h6 data-dz-name></h6>
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-0 fs--1 text-400 line-height-1" data-dz-size></p>
                                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                                </div>
                                                </div>
                                                <div class="dropdown text-sans-serif">
                                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!" data-dz-remove>Remove File</a></div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php $this->load->view('company/products/partials/product-images',array('productPhotos' => $productPhotos)); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-info btn-sm" type="button" data-dismiss="modal"><?=$this->lang->line('Modals Label Btn Cancel')?></button>
                    <button class="btn btn-success btn-sm" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=$this->lang->line('Loading Btn Text General')?>" onclick="submit_product_form('#add-product-form', '#save-result')" type="submit"><?=$this->lang->line('Modals Label Btn Save Changes')?>
                    </button>
            </div>
        </form>
        


</div>

<?php $this->load->view("layouts_after_login/footer",array("jsFiles" => array("company.js"))) ?>

<script>
    $(document).ready(function(){
       
        $('#modal_window').on('shown.bs.modal', function (e) {
          
        });
    });

    function submit_product_form(form_selector, target, callback) {
    target = target || "#save_result";
   
   /*
    $.validator.addMethod("regex", function(value, element, regexpr) {          
        return regexpr.test(value);
    });
    $.validator.addMethod("check_user_phone", function(value, element) {
			    
        var phone = $("#phone").val().trim();

                if(phone) {
                    var phone = /\d/.test(phone);

                    if(!phone) {

                        $("#phone")[0].setCustomValidity("Wrong. It's 'Ivy'.");
                     
                        return false;
                    } else {
                       
                        return true;
                    }
                }
        
     });
     $(form_selector).validate({
        rules: {
                phone: {check_user_phone: true }
               }
    });*/
    form = $(form_selector);
   
    $(form_selector ).off( "submit");
    $( form_selector ).submit(function( event ) {
        event.preventDefault();
        if ( form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }else {
            $(form_selector).ajaxSubmit({
                beforeSubmit: function (arr, $form) {
                    tabs_ids = [];
                    $(".loading-div").css("display","block");
                    $( form_selector ).find("button[type='submit']").prop("disabled",true);
                    if ($($form).valid() == true) {
                        return true;
        
                    }
                    $(target).html('');
                    return false;
                },
        
                success: function (data) {
                    var obj = JSON.parse(data); 
                    var myDropzone = Dropzone.forElement(".dropzone");
                    if(!obj.error) {
                        if (myDropzone.getQueuedFiles().length > 0) {
                            
                            myDropzone.on("sending", function(file, xhr, formData) {
                                formData.append("product-id",  $("#product-id").val());
                            });

                            myDropzone.on("queuecomplete", function(file, xhr, formData) {
                                window.location = "/products";
                            });
                            myDropzone.processQueue();
                        } else {
                            window.location = "/products";
                        }
                    
                    } else {
                       
                        $(target).html(obj.message);
                    }
                    
                     $(".loading-div").css("display","none");
             
                   
                }
            });
        }
        form[0].classList.add('was-validated');
        return false;
      });
 
   
}


</script>