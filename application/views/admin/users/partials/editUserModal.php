<!-- Modal-->
<div class="modal show" id="general-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.5)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="<?=site_url('edit-user/'.$userDetails['id'].'')?>" method="post" id="edit-user-form" class="needs-validation" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('Admin Section Users Label User Edit User')?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="save-result"></div>
                <div class="form-group row">
                    <label for="name" class="col-sm-6 col-form-label"><?=$this->lang->line('Admin Section Users Label User Name')?> <span class="required-sign-label">*</span>: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="name" value="<?=$userDetails['nume']?>" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reference" class="col-sm-6 col-form-label"><?=$this->lang->line('Admin Section Users Label User Reference')?> <span class="required-sign-label">*</span>: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="reference" name="reference" pattern="^[1-9][0-9]*" value="<?=$userDetails['sponsor']?>" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info btn-sm" type="button" data-dismiss="modal"><?=$this->lang->line('Modals Label Btn Cancel')?></button>
                <button class="btn btn-success btn-sm" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=$this->lang->line('Loading Btn Text General')?>" onclick="submit_form('#edit-user-form', '#save-result')" type="submit"><?=$this->lang->line('Modals Label Btn Save Changes')?></button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
function submit_form(form_selector, target, callback) {
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
        btnSubmitText = $( form_selector ).find("button[type='submit']").html();
        btnLoadindText = $( form_selector ).attr("data-loading-text");
        if(!btnLoadindText)
            btnLoadindText = "Loading...";
        
        if ( form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }else {
            $(form_selector).ajaxSubmit({
                beforeSubmit: function (arr, $form) {
                    tabs_ids = [];
                    $( form_selector ).find("button[type='submit']").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+btnLoadindText+'');
                    $( form_selector ).find("button[type='submit']").prop("disabled",true);
                    if ($($form).valid() == true) {
                        return true;
                    }
                    $(target).html('');
                    return false;
                },
        
                success: function (data) {
                    $('input[name="nr-of-tickets"]').val("");
                    $(target).html(data);
                    $( form_selector ).find("button[type='submit']").html(btnSubmitText);
                    $( form_selector ).find("button[type='submit']").prop("disabled",false);
                }
            });
        }
        form[0].classList.add('was-validated');
        return false;
      });
}
</script>