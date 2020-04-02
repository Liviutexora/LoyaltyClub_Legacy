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
                    
                    if ($($form).valid() == true) {
                        return true;
        
                    }
                    $(target).html('');
                    return false;
                },
        
                success: function (data) {
        
                    $(target).html(data);
                   
                }
            });
        }
        form[0].classList.add('was-validated');
        return false;
      });
 
   
}

var company = {
    initTicketsDataTable : function(){
        $(document).ready(function(){
            if($('.tickets-table').length){
                
                languageLabels = $('.tickets-table').attr("data-language-label");
                languageLabels = JSON.parse(languageLabels);
            }
           // var search_columns = new Array(1,2,3,4,5);
	      //  var date_columns = new Array(3);
            $('.tickets-table thead td').each(function (index, element) {
                //datepicker class
                 var inputType = 'text';
                 if (jQuery.inArray(index, date_columns) !== -1) {
                      inputType = 'date';
                 }
      
                  if (jQuery.inArray(index, search_columns) !== -1) {
                      $(this).append('<input class="form-control " style="width:100%;" type="'+inputType+'"/>');
                  }
            });
            //datatables
            tickets_table = $('.tickets-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "responsive":false,
                "order": [], //Initial no order.
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": url+"list-of-tickets",
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   -1
                }
                ],
                "bSort": false,
                "sDom": 'lrtip',
                "pageLength": 10,
                "lengthMenu": [[5,10, 25, 50], [5, 10, 25, 50]],
                "language": {
                    "lengthMenu": ""+languageLabels['Datatables Label Display']+" _MENU_ "+languageLabels['Datatables Label Per Page']+"",
                    "zeroRecords": ""+languageLabels['Datatables Label No Data']+"",
                    "info": ""+languageLabels['Datatables Label Page']+" _PAGE_ "+languageLabels['Datatables Label Of']+" _PAGES_",
                    "infoEmpty": ""+languageLabels['Datatables Label No Records Available']+"",
                    "infoFiltered": "("+languageLabels["Datatables Label Total Records"]+" _MAX_)",
                    "oPaginate": {
                          "sNext": ""+languageLabels['Datatables Label Next']+"",
                          "sPrevious": ""+languageLabels['Datatables Label Previous']+""
                       }
                },
                "columns": [
                    { "data": "serialNumber" },
                    { "data": 'discount' },
                    { "data": 'value' },
                    { "data": 'createdDate' },
                   
                    { "data": 'clientID' },
                    { "data": 'status' },
                    { "data": 'actions' }
                   
                ]
            });
            $(document).on('#general-modal','hidden.bs.modal', function (e) {
                tickets_table.ajax.reload();
            });
            $(document).on('click','#delete-ticket',function(event) {
                content = $(this).attr("lang-content");
                yes = $(this).attr("lang-yes");
                no = $(this).attr("lang-no");
                url = $(this).attr("url");
                id = $(this).attr("idTicket");
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
                                                    id: id
                            
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

            $(document).on('click','#validate-ticket',function(event) {
                content = $(this).attr("lang-content");
                yes = $(this).attr("lang-yes");
                no = $(this).attr("lang-no");
                url = $(this).attr("url");
                id = $(this).attr("idTicket");
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
                                                    id: id
                            
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

           
            $(document).on("click",".download-tickets-btn", function () {
                var link = $(this).attr("url");
                btn = $(this);
                btnSubmitText = $(this).html();
                btnLoadindText = $(this).attr("data-loading-text");
                pattern = $('input[name="nr-of-tickets"]').attr("pattern");
                if(!btnLoadindText)
                    btnLoadindText = "Loading...";
                $.ajax({
                        url: link,
                        beforeSend: function( xhr ) {
                            btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+btnLoadindText+'');
                            btn.prop("disabled",true);
                        }
                }).done(function (data) {
                    $('body').append('<a id="link" href="'+data+'"  download="Tickets.pdf">&nbsp;</a>');
                    $('#link')[0].click();
                    btn.html(btnSubmitText);
                    
                    btn.prop("disabled",false);
                });
            });
            
            
        });
    }
};
company.initTicketsDataTable();

