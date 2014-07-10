function ajaxCallUpdateCombo(type, requestTo, source, destination, req, defVal) {
    var selVal = $("#" + source).val();
    $("#" + req + "_loader").show();
    if (selVal != "") {
        $.ajax({
            type: 'POST',
            url: requestTo,
            dataType: 'json',
            data: {
                selVal: selVal,
                req: req,
                type: type
            },
            success: function(data) {
                var flag = false;
                if (data.error === false) {
                    var msgArr = data.msg.split("@");
                    $('#' + destination + ' >option').remove();
                    $("<option value=''></option>").appendTo("#" + destination);
                    for (x in msgArr) {
                        var arrData = msgArr[x].split("#");
                        if (arrData.length == 2) {
                            $("<option " + (defVal == arrData[0] ? "selected" : "") + " value=" + arrData[0] + ">" + arrData[1] + "</option>").appendTo("#" + destination);
                            flag = true;
                        }
                    }
                    $('#message').removeClass().addClass((data.error === true) ? 'error' : 'success')
                            .text(data.msg).show(500);
                    if (data.error === true)
                        $('#demoForm').show(500);
                    if (flag) {
                        $("#" + destination).show().addClass('chosen-select-dis-search');
                        jQuery(".chosen-select-dis-search").chosen({
                            'width': '100%',
                            'white-space': 'nowrap',
                            disable_search: true
                        });
                        $("#" + destination + '_par').fadeIn('slow');
                    }
                } else {
                    $("#" + destination).hide();
                }
                $("#" + req + "_loader").hide();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }
    return false;
}

function ajaxCallCommonReq(requestTo, reqData, req) {
    $('#ajax_load_' + req).show();
    $.ajax({
        type: 'POST',
        url: requestTo,
        dataType: 'json',
        data: reqData,
        success: function(data) {
            if (data.error === false) {
                if (req === 'prod_img_del') {
                    $('#' + reqData.parent).fadeOut('slow');
                } else if (req === 'prod_img_def') {
                    var ref_id = reqData.ref;
                    alert($(this).parent().data('id'));
                }
            } else {

            }
            $('#ajax_load_' + req).hide();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    return false;
}

function ajaxCallCommonReqWithRef(requestTo, reqData, req, ref) {
    $('#ajax_load_' + req).show();
    $.ajax({
        type: 'POST',
        url: requestTo,
        dataType: 'json',
        data: reqData,
        success: function(data) {
            if (data.error === false) {
                if (req === 'prod_img_del' || req === 'user_img_del') {
                    ref.parent().parent().fadeOut('slow');
                } else if (req === 'prod_img_def') {
                    var ref_id = ref.parent().data('id');
                } else if (req === 'check_data') {
                    $('#' + reqData.type + '_load').hide();
                } else if (req === 'prod_comp_view') {
                    ref.html(data.message);
                    ref.slideDown(500);
                    ref.data('ajax-load', 'true');
                } else if (req === 'prod_activate') {
                    var active = (reqData.status === '1');
                    ref.attr('data-status', (active ? '0' : '1'));
                    ref.find('i').removeClass('fa-check').removeClass('fa-times');
                    ref.fadeIn("slow", function() {
                        ref.find('i').addClass('fa-' + (!active ? 'times' : 'check'));
                    });
                }
            } else {
                if (req === 'email_id' || req === 'domain_name') {
                    ref.val('').focus();
                    $('html,body').animate({scrollTop: $('form').offset().top}, 800);
                }
                bootstrap_alert('danger', data.message, 5000);
            }
            $('#ajax_load_' + req).hide();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    return false;
}

function ajaxGenericHtmlCall(requestTo, reqData, req) {
    $('#ajax_load_' + req).show();

    $.ajax({
        type: 'POST',
        url: requestTo,
        dataType: 'html',
        data: reqData,
        async: false,
        success: function(data) {

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //alert(errorThrown);
        }
    });
    return false;
}

function bootstrap_alert(type, message, timeout) {
    $('#form_errors').show().html('<div class="alert alert-' + type + ' fade in"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>' + message + '</div>');

    if (timeout || timeout === 0) {
        setTimeout(function() {
            $('#form_errors').fadeIn('slow');
        }, timeout);
    }
}
;

function ajaxSubmitForm(form, req, show_alert) {
    var mode = $("#mode").val();
    if (!show_alert || confirm("Do you want to " + (mode == "add" ? "save" : "edit") + " this form?")) {
        //$("#" + req + "_submit").hide();
        var formData = $(form).serialize();
        //alert(formData);
        //$("#" + req + "_ajax_loading").show();

        var l = Ladda.create(document.getElementById(req + "_submit"));
        l.start();
        var progress = 0;
        var interval = setInterval(function() {
            progress = Math.min(progress + Math.random() * 0.1, 1);
            l.setProgress(progress);
        }, 100);

        $.ajax({
            type: "POST",
            url: $(form).attr('action'),
            cache: false,
            dataType: 'json',
            data: formData,
            success: function(data) {

                setTimeout(function() {
                    if (data.error === false) {
                        if (req == 'p_login' || req == 'p_register' || req == 'update_user' || req == 'change_pwd') {
                            window.location.href = data.redirect;
                        } else if (req == 'edit_prod') {
                            $('html,body').animate({scrollTop: 0}, 'slow', function() {
                                location.reload();
                            });

                        } else if (req == 'add_prod') {
                            jQuery('#prod_data_det').delay(350).fadeOut(function() {
                                jQuery('#image_upload_det').delay(350).fadeIn('slow');
                                $('html,body').animate({scrollTop: 30}, 'slow');
                            });
                        }

                        if (data.message != undefined && data.message != '') {
                            bootstrap_alert('success', data.message, 5000);
                        }
                    } else {
                        bootstrap_alert('danger', data.message, 5000);
                    }

                    l.stop();
                    clearInterval(interval);
                }, 1000);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Error:" + errorThrown);
            }
        });
    } else {
        //$("#submit").show();
    }
    return false;
}

function ajaxSerializeSubmitForm(form, url, req, show_alert) {
    var mode = $("#mode").val();
    if (!show_alert || confirm("Do you want to " + (mode == "add" ? "save" : "edit") + " this form?")) {
        //$("#" + req + "_submit").hide();
        var formData = $(form).serializePost();
        alert(formData);
        //$("#" + req + "_ajax_loading").show();
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function(data) {
                if (data.error === false) {
                    alert(data.message);
                } else {
                    alert("message: " + data.message);
                    //$("#" + req + "_submit").show();
                }
                //$("#" + req + "_ajax_loading").hide();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Error:" + errorThrown);
            }
        });
    } else {
        //$("#submit").show();
    }
    return false;
}

function resetForm(form) {
    $(form)[0].reset();
}

(function($) {
    $.fn.serializePost = function() {
        var data = {};
        var formData = this.serializeArray();
        for (var i = formData.length; i--; ) {
            var name = formData[i].name;
            var value = formData[i].value;
            var index = name.indexOf('[]');
            if (index > -1) {
                name = name.substring(0, index);
                if (!(name in data)) {
                    data[name] = [];
                }
                data[name].push(value);
            }
            else
                data[name] = value;
        }
        return data;
    };
})(jQuery);