function change_validation_position(form_selector) {
    $(form_selector).validate({
        errorPlacement: function (error, element) {
			
            element.parent().find('.help-block').remove();
            element.parent().find('.glyphicon-remove').remove();
           
            if (error.html().length != 0) {
            	element.parent().find('.glyphicon-ok').remove();
            	element.parent().toggleClass('has-feedback', error.html().length != 0);
            	element.parent().toggleClass('has-error', error.html().length != 0);
            	element.parent().removeClass('has-success');
                element.after('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><span class="help-block"></span>');
            	placement = $(element).attr("data-placement");
            	if(!placement)
            		placement = 'top';
            	else {
            		
            	}
            	$(element).tooltip({placement: placement, title:''+error.html()+'',template: '<div class="tooltip tooltip-wr" role="tooltip" style="white-space: nowrap;"><div class="tooltip-arrow tooltip-arrow-error-wr"></div><div class="tooltip-inner tooltip-inner-error-wr"></div></div>'});
            	
            	$(element).tooltip('toggle');
            	element.parent().find('.tooltip').find('.tooltip-arrow-error-wr').css("border-"+placement+"-color","#d43f3a")

            } else {
            	element.parent().find('.glyphicon-remove').remove();
                element.after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span><span class="help-block"></span>');
                element.parent().removeClass('has-error');
                element.parent().addClass('has-success');
                element.parent().toggleClass('has-feedback', error.html().length == 0);
            	element.parent().toggleClass('has-success', error.html().length == 0);
            	
            	$(element).tooltip('destroy');
            }
        },
        success: function (element) {
        },
        err: {
    		container: 'tooltip'
		}
    });
}

function submit_form(form_selector, target, callback) {
    target = target || "#save_result";
    var loader_location = site_url + "/images/ajax-loader.gif";

    $(target).html('<img src="' + loader_location + '" />');
    change_validation_position(form_selector);
    $(form_selector).ajaxSubmit({
        beforeSubmit: function (arr, $form) {
            tabs_ids = [];
           
            $( "li.active" ).each(function( index ) {
                tab_id = $(this).find("a").attr("href");
                if(tab_id && !tabs_ids.includes(tab_id)) {
                    tabs_ids.push(tab_id);
                }
            });

            for(var i =0; i<tabs_ids.length; i++) {
                var cookie_exit = readCookie("autoselectab"+tabs_ids[i]);
                if(cookie_exit) {
                    eraseCookie(tabs_ids[i]);
                    createCookie("autoselectab"+tabs_ids[i], tabs_ids[i], 1);
                } else {
                    createCookie("autoselectab"+tabs_ids[i], tabs_ids[i], 1);
                }
            }
            
            
            if ($($form).valid() == true) {
                return true;

            }
            $(target).html('');
            return false;
        },

        success: function (data) {

            $(target).html(data);
            if (callback) {
                eval(callback + "(data)")
            }
        }
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
    }
};

app.setDarkMode();


