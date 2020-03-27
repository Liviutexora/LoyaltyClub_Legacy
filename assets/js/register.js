$(document).ready(function(){
    $(document).on('change','#account_type_input',function() {
      display_register_company_private_block();
    });
    $(document).on('click','.next a',function() {
      display_register_company_private_block();
    });

    $( "#last-step-form-private" ).submit(function( event ) {
        form = $(this);
        event.preventDefault();
        if ( form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form[0].classList.add('was-validated');
        return false;
    });

    $( "#last-step-form-company" ).submit(function( event ) {
        form = $(this);
        event.preventDefault();
        if ( form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form[0].classList.add('was-validated');
        return false;
    });

    $( "#first-step-form" ).submit(function( event ) {
        form = $(this);
        event.preventDefault();
        if ( form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form[0].classList.add('was-validated');
        return false;
    });

    $display_final_step = false;

    wizard = $('.theme-wizard').bootstrapWizard({'tabClass': 'nav',onNext: function(tab, navigation, index) {

        if(index==2 && $("#first-step-form")[0].checkValidity() ) {
            
            formIsValid = false;
            if($('#account_type_input').val() == "private") {
                $("#last-step-form-private").trigger("submit");
                formIsValid = $("#last-step-form-private")[0].checkValidity();
                form_id = "last-step-form-private";
            } else {
                $("#last-step-form-company").trigger("submit");
                formIsValid = $("#last-step-form-company")[0].checkValidity();
                form_id = "last-step-form-company";
            }
            if(!$display_final_step && formIsValid) {
                url = $("#"+ form_id+"").attr('action');
                account_type = $('#account_type_input').val();
                csrf = $('#csrf').val();
                name = $("#"+ form_id+"").find("input[name='name']").val();
                phone = $("#"+ form_id+"").find("input[name='phone']").val();
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
                        terms:terms,
                        phone:phone

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
            
            return  $("#first-step-form").trigger("submit") && $("#first-step-form")[0].checkValidity();
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