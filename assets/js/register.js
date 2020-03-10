$(document).ready(function(){
    $(document).on('change','#account_type_input',function() {
      display_register_company_private_block();
    });
    $(document).on('click','.next a',function() {
      display_register_company_private_block();
    });

    $display_final_step = false;

    wizard = $('.theme-wizard').bootstrapWizard({'tabClass': 'nav',onNext: function(tab, navigation, index) {

        if(index==2 && $("#first-step-form").valid() ) {
            
            
            if($('#account_type_input').val() == "private") {
                $("#last-step-form-private").valid();
                form_id = "last-step-form-private";
            } else {
                $("#last-step-form-company").valid();
                form_id = "last-step-form-company";
            }
            if(!$display_final_step) {
                url = $("#"+ form_id+"").attr('action');
                account_type = $('#account_type_input').val();
                csrf = $('#csrf').val();
                name = $("#"+ form_id+"").find("input[name='name']").val();
                email = $("#"+ form_id+"").find("input[name='email']").val();
                password = $("#"+ form_id+"").find("input[name='password']").val();
                confirmPassword = $("#"+ form_id+"").find("input[name='confirmPassword']").val();
                sponsor = $("#"+ form_id+"").find("input[name='sponsor']").val();
                cui = $("#last-step-form-company").find("input[name='cui']").val();
                terms = $("#"+ form_id+"").find('input[name="terms"]').prop("checked");

                $.ajax({
                    type: "POST",
                    url:  url,
                    data: {
                        account_type: account_type,
                        csrf: csrf,
                        name: name,
                        email: email,
                        password: password,
                        confirmPassword: confirmPassword,
                        sponsor: sponsor,
                        cui:cui,
                        terms:terms

                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log('Error: ' + xhr.responseText);
                    },
                    success: function (data) {
                        var obj = jQuery.parseJSON(data );
                        if(obj.error) {
                            $("#"+ form_id+"").find('#save_result').html(obj.message);
                        } else {
                            $display_final_step = true;$('.theme-wizard').bootstrapWizard('next');
                        }
                      
                    }
                });
           
            }
          
            return $display_final_step;
           
        }
        else {
            
            return $("#first-step-form").valid();
        }

     

    }
    ,onTabClick: function(tab, navigation, index) {

        return false;
    },onTabShow: function(tab, navigation, index) {
        if(index == 1) {
            $(".previous .btn-link").css("display","block");
        }else if(index==2){
            $('.card-footer').css("display","none");
           
        } else {
            $(".previous .btn-link").css("display","none");
        }
    },onPrevious: function(tab, navigation, index) {
       
    }
  });

  $(document).on('click','.login-btn',function() {
      loginFormValid = $("#login-form").valid();
      url = $("#login-form").attr('action');
      remember = $("#login-form").find('input[name="remember"]').prop("checked");
      password = $("#login-form").find('input[name="password"]').val();
      email = $("#login-form").find('input[name="email"]').val();
      if(loginFormValid) {
        $.ajax({
                type: "POST",
                url:  url,
                data: {
                    remember: remember,
                    password: password,
                    email: email

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error: ' + xhr.responseText);
                },
                success: function (data) {
                    var obj = jQuery.parseJSON(data );
                    if(obj.error) {
                        $("#login-form").find('#save_result').html(obj.message);
                    } else {
                        $("#login-form").find('#save_result').html(obj.message);
                    }
                
                }
        });
      }
  });

    $(document).on('click','.forgot-password-button',function() {
        forgotPasswordFormValid = $(".forgot-password-form").valid();
        url = $(".forgot-password-form").attr('action');
        email = $(".forgot-password-form").find('input[name="email"]').val();
      
        if(forgotPasswordFormValid) {
        $.ajax({
                type: "POST",
                url:  url,
                data: {
                    email: email

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error: ' + xhr.responseText);
                },
                success: function (data) {
                    var obj = jQuery.parseJSON(data );
                    if(obj.error) {
                        $(".forgot-password-form").find('#save_result').html(obj.message);
                    } else {
                        $(".forgot-password-form").find('#save_result').html(obj.message);
                    }
                
                }
        });
        }
    });

  });
  
  function display_register_company_private_block(){
    if($('#account_type_input').val() == "private") {
      $('.company_details').css("display","none");
      $('.private_details').css("display","block");
    } else {
        $('.company_details').css("display","block");
        $('.private_details').css("display","none");
    }
  }