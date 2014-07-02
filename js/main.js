/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(e) {

    $("#loginForm").validate({
        debug: true,
        submitHandler: ajaxLoginCall
    });

    $("#registerForm").validate({
        rules: {
            pass_word: {
                required: true, minlength: 6
            },
            conf_password: {
                required: true, equalTo: "[name='pass_word']", minlength: 5
            },
            defaultReal: {
                required: true, equalTo: "#captch_txt"
            }
        },
        messages: {
            defaultReal: "Invalid Captcha entered"
        },
        debug: true,
        submitHandler: ajaxRegisterCall
    });

    $("#changePwdForm").validate({
        rules: {
            pass_word: {
                required: true, minlength: 6
            },
            conf_password: {
                required: true, equalTo: "[name='pass_word']", minlength: 5
            }
        },
        debug: true,
        submitHandler: ajaxChangePwdFormCall
    });

    $("#updateUserForm").validate({
        debug: true,
        submitHandler: ajaxUpdateUserCall
    });

    $("#updateProdForm").validate({
        debug: true,
        submitHandler: ajaxUpdateProdCall
    });

    $("#addProdForm").validate({
        debug: true,
        submitHandler: ajaxAddProdCall
    });

    $('#myForm').ajaxForm({
        beforeSend: function() {
            $(".progress").show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            $(".progress-bar").width(percentComplete + '%'); //dynamicaly change the progress bar width
            $(".sr-only").html(percentComplete + '%'); // show the percentage number
        },
        success: function() {
            $(".progress").hide(); //hide progress bar on success of upload
        },
        complete: function(response) {
            window.location.reload();
        }
    });

    $('#productForm').ajaxForm({
        beforeSend: function() {
            $(".progress").show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            $(".progress-bar").width(percentComplete + '%'); //dynamicaly change the progress bar width
            $(".sr-only").html(percentComplete + '%'); // show the percentage number
        },
        success: function() {
            $(".progress").hide(); //hide progress bar on success of upload
        },
        complete: function(response) {
            window.location.href = response.responseText;
        }
    });

    //set the progress bar to be hidden on loading
    $(".progress").hide();


    $('#search_typeahead').typeahead({
        ajax: {
            url: 'product/search/',
            triggerLength: 3
        },
        preDispatch: function(query) {
            return {
                search: query
            }
        },
        displayField: 'PROD_NAME',
        valueField: 'PROD_ID',
        onSelect: displayResult
    });

    $('.del_prod_img').on('click', function(e) {
        e.preventDefault();
        var reqData = {
            img: $(this).data('ref'),
            prod_id: $(this).parent().parent().data('id')
        };
        ajaxCallCommonReqWithRef('product/del_img', reqData, 'prod_img_del', $(this));
    });

    $('.del_banner_img').on('click', function(e) {
        e.preventDefault();
        var reqData = {
            img: $(this).data('ref')
        };
        ajaxCallCommonReqWithRef('user/del_img', reqData, 'user_img_del', $(this));
    });

//    $('.def_prod_img').on('click', function(e) {
//        e.preventDefault();
//        if (!$(this).hasClass('fa-check-square-o')) {
//            alert($(this).data('ref'));
//            var reqData = {
//                img: $(this).data('ref'),
//                prod_id: $(this).parent().data('id')
//            };
//
//            ajaxCallCommonReqWithRef('product/def_img', reqData, 'prod_img_def', $(this));
//        }
//    });

});

function displayResult(item) {
    window.location.href = 'product/portfolio/' + item.value;
}

function ajaxLoginCall() {
    ajaxSubmitForm('#loginForm', 'p_login', false);
}

function ajaxRegisterCall() {
    ajaxSubmitForm('#registerForm', 'p_register', false);
}

function ajaxUpdateUserCall() {
    ajaxSubmitForm('#updateUserForm', 'update_user', false);
}

function ajaxChangePwdFormCall() {
    ajaxSubmitForm('#changePwdForm', 'change_pwd', false);
}

function ajaxUpdateProdCall() {
    ajaxSubmitForm('#updateProdForm', 'update_prod', false);
}

function ajaxAddProdCall() {
    ajaxSubmitForm('#addProdForm', 'add_prod', false);
}

function checkData(type, obj) {
    var reqData = {
        type: type,
        val: $(obj).val()
    };
    $('#' + type + '_load').show();
    ajaxCallCommonReqWithRef('user/check_data', reqData, 'check_data', $(this));
}

function showPrice() {
    var val = $('[name="price_type"] > option:selected').text();
    if (val === 'Fixed') {
        $("#price_div").show();
        $('[name="prod_dis"]').hide();
    } else {
        $("#price_div").show();
        $('[name="prod_dis"]').show();
    }
}

$(function() {
    $('[name="price_type"]').change(function() {
        showPrice();
    });

    $('[name="img_count"]').change(function() {
        var count = $(this).val();
        var str = '';
        for (var i = 1; i <= count; i++) {
            str += '<div>';
            if (!$('[name="auto_thumb"]').is(":checked")) {
                str += '<div style="display:inline-block;">\n\
                        <label>Thumb Image</label><br />\n\
                        <input type="file" name="thumb_' + i + '" id="file" />\n\
                </div>';
            }

            str += '<div style="display:inline-block;">\n\
                            <label>Large Image</label><br />\n\
                        <input type="file" name="large_' + i + '" id="file" />\n\
                        </div>\n\
                        <div style="display:inline-block;">\n\
                        <input type="radio" name="def_img" value="' + i + '" ' + (i == 1 ? "checked='true'" : "") + ' /> Show as default\n\
                        </div>\n\
                    </div>';


        }
        $('#img_data').html(str);
    });
});

function productAjaxLoad(loc) {
    $('#ajax_loading').show();
    $.ajax({
        url: "product/json/0",
        dataType: "json",
        complete: function(data, status) {
            var html = '';
            var json = data.responseJSON;
            if (json.length == 0) {
                html += '<div class="t_center">No Products are available</div>';
            }
            for (var i = 0; i < json.length; i++) {
                html += makeGridItem(json[i]);
            }

            if (loc == 'admin') {
                $("#grid_items > table > tbody").append(html);
            } else {
                $("#grid_items").append(html);
            }
            $('#ajax_loading').hide();
        }
    });
}

function makeGridItem(dataObj) {
    dataObj["SIZE"] = 4;
    var source = $("#template-grid-item").html();
    var template = Handlebars.compile(source);
    return template(dataObj);
}

function numbersonly(e, decimal) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (e) {
        key = e.which;
    }
    else {
        return true;
    }
    keychar = String.fromCharCode(key);

    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 27)) {
        return true;
    }
    else if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    }
    else if (decimal && (keychar == ".")) {
        return true;
    }
    else
        return false;
}

$(window).load(function() {
//    function toggleChevron(e) {
//        $(e.target)
//                .prev('.panel-heading')
//                .find("i.indicator")
//                .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
//    }
//    $('#accordion').on('hidden.bs.collapse', toggleChevron);
//    $('#accordion').on('shown.bs.collapse', toggleChevron);
});

var toHandle = function(result) {
    return result.toLowerCase()
            .replace(/[\'\"\(\)\[\]]/g, "")
            .replace(/\W/g, " ")
            .replace(/\ +/g, "-")
            .replace(/(-+)$/g, "")
            .replace(/^(-+)/g, "");
};

function closeMe() {
    var win = window.open("", "_self"); /* url = "" or "about:blank"; target="_self" */
    win.close();
}
