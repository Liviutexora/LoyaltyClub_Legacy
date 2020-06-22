forms = "";
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
        
                    $(target).html(data);
                     $(".loading-div").css("display","none");
                     $( form_selector ).find("button[type='submit']").prop("disabled",false);
                   
                }
            });
        }
        form[0].classList.add('was-validated');
        return false;
      });
 
   
}

var app = {
    setDarkMode : function(){
        $(document).ready(function(){
            $(document).on('click','#make-dark',function(event) {
                content = $(this).attr("modal-content");
                yes = $(this).attr("yes");
                no = $(this).attr("no");
                enabled = $(this).attr("enabled");
                url = $(this).attr("url");
                var dialog = bootbox.dialog({
                        message: content,
                        closeButton: false,
                        buttons: {
                                noclose: {
                                        label: yes,
                                        className: "btn-success",
                                        callback: function () {
                                            $(".loading-div").css("display","block");
                                            $.ajax({
                                                type: "POST",
                                                url:  url,
                                                data: {
                                                    enabled: enabled
                            
                                                },
                                                error: function (xhr, textStatus, errorThrown) {
                                                    console.log('Error: ' + xhr.responseText);
                                                },
                                                success: function (data) {
                                                    dialog.find('.bootbox-body').prepend(data);
                                                  
                                                }
                                            });
                                        }
                                },
                                danger: {
                                        label: no,
                                        className: "btn-danger",
                                }
                        }
                });
            });
        });
    },
    setCoverImage : function() {
        $('#upload-cover-image').change(function() {
            $('#change-cover-image-form').submit();
        });
    },
    setAvatarImage : function() {
        $('#profile-image').change(function() {
            $('#change-avatar-image-form').submit();
        });
    },
    initOpenModals: function() {
       
        $(document).on("click",".open-modal", function () {
                var link = $(this).attr("ajaxlink");
                $('#modal_window').html("");
                $.ajax({
                        url: link
                }).done(function (data) {
                        $('#modal_window').html(data);
                        $('.modal').modal("show");
                });
        });
       
    }
};

app.setDarkMode();
app.setCoverImage();
app.setAvatarImage();
app.initOpenModals();
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function(){
    $(document).on("click",".expand-categories-btn", function () {
        checkExpandCategoriesBtn();
    });
}); 
$(window).resize(function(){
    if(window.innerWidth < 800) {
        if($(".expand-categories-btn").hasClass('fa-minus')) {
            $(".expand-categories-btn").removeClass('fa-minus');
            $(".expand-categories-btn").addClass('fa-plus');
            $(".list-group-categories").removeClass("show");
        }
    } else {
        $(".expand-categories-btn").removeClass('fa-plus');
        $(".expand-categories-btn").addClass('fa-minus');
        $(".list-group-categories").addClass("show");
    }
      
});
if(window.innerWidth < 800) {
    if($(".expand-categories-btn").hasClass('fa-minus')) {
        $(".expand-categories-btn").removeClass('fa-minus');
        $(".expand-categories-btn").addClass('fa-plus');
        $(".list-group-categories").removeClass("show");
    }
} else {
    $(".expand-categories-btn").removeClass('fa-plus');
    $(".expand-categories-btn").addClass('fa-minus');
}
     
function checkExpandCategoriesBtn() {
    if($(".expand-categories-btn").hasClass('fa-minus')) {
        $(".expand-categories-btn").removeClass('fa-minus');
        $(".expand-categories-btn").addClass('fa-plus');
        $(".list-group-categories").removeClass("show");
    } else {
        $(".expand-categories-btn").removeClass('fa-plus');
        $(".expand-categories-btn").addClass('fa-minus');
    }
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}




