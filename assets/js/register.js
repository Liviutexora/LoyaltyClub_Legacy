$(document).ready(function(){
  $(document).on('change','#account_type_input',function() {
    display_register_company_private_block();
  });
  $(document).on('click','.next a',function() {
    display_register_company_private_block();
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