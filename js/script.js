function showOtherPrice() {
    var val = $('[name="price_type"] > option:selected').text();
    if (val === 'Fixed') {
        $("#price_div").show();
        $('[name="prod_dis"]').hide();
    } else {
        $("#price_div").show();
        $('[name="prod_dis"]').show();
    }
    $('#component_price_grid').addClass('hide');
    $('#basic_price_div').show();
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


function productAjaxLoad(loc) {
    $('#ajax_loading').show();
    $.ajax({
        url: "product/json/0",
        dataType: "json",
        complete: function(data, status) {
            var html = '';
            var json = data.responseJSON;
            if (json.length == 0) {
                html += '<tr><td colspan="7"><div class="m_10 t_c" sty>No Products are available</div></td></tr>';
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

function clear_form_elements(class_name) {
    jQuery("." + class_name).find(':input').each(function() {
        switch (this.type) {
            case 'password':
            case 'text':
            case 'textarea':
            case 'file':
            case 'select-one':
            case 'select-multiple':
                jQuery(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

//Admin - products
function show_price() {
    if (parseInt($('[name="price_type"]').val()) === 3) {
        show_comp_price();
    } else {
        showOtherPrice();
    }
}

function getData(type) {
    var str = '';
    if (type === 'metal') {
        str = 'COMP_TYPE_ID:' + $('[name="metal_type"]').val() + ';' +
                'GROSS_WEIGHT:' + $('[name="metal_gross_weight"]').val() + ';' +
                'CARET:' + $('[name="meta_caret"]').val();

    } else if (type === 'stone') {
        str = 'CUT_ID:' + $('[name="stone_cut"]').val() + ';' +
                'TOTAL_STONES:' + $('[name="stone_total_stones"]').val() + ';' +
                'COLOR_FROM_ID:' + $('[name="stone_color_from"]').val() + ';' +
                'COLOR_TO_ID:' + $('[name="stone_color_to"]').val() + ';' +
                'CLARITY_FROM_ID:' + $('[name="stone_clarity_from"]').val() + ';' +
                'CLARITY_TO_ID:' + $('[name="stone_clarity_to"]').val() + ';' +
                'SHAPE_ID:' + $('[name="stone_shape"]').val() + ';' +
                'GROSS_WEIGHT:' + $('[name="stone_gross_weight"]').val();
    } else if (type === 'colored_stone') {
        str = 'COMP_TYPE_ID:' + $('[name="colored_stone_type"]').val() + ';' +
                'C_STONE_CAT_ID:' + $('[name="colored_stone_cat"]').val() + ';' +
                'C_STONE_COL_ID:' + $('[name="colored_stone_color"]').val() + ';' +
                'TOTAL_STONES:' + $('[name="colored_stone_total_stones"]').val() + ';' +
                'GROSS_WEIGHT:' + $('[name="colored_stone_gross_weight"]').val();
    }
    return str;
}

function reset_form(data_type) {
    if ($("#component_grid").hasClass('hide')) {
        $("#component_grid").removeClass('hide');
    }
    $('[name="comp_type"]').val('');
    $("#" + data_type + "_fields").slideUp();
    clear_form_elements('form_fields');
    $('#add_btn').addClass('hide');
}

function show_comp_price() {
    $('#component_price_grid').removeClass('hide');
    $('#basic_price_div').hide();
    var html = '';
    var count = 1;

    $('#component_grid > table > tbody > tr').each(function() {
        html += '<tr>';
        $(this).find('td').each(function() {
            if (!$(this).hasClass('table-action')) {
                html += "<td>" + $(this).html() + "</td>";
            }
        });

        var data_type = $('#component_grid').find('input[name="sel_comp_type_' + count + '"]').val();
        if (data_type !== 'labor') {
            var comp_base_rate = $('#component_grid').find('input[name="comp_base_rate_' + count + '"]').val();
            comp_base_rate = (comp_base_rate !== undefined ? comp_base_rate : '');
            html += '<td><div class="col-sm-5"><input class="form-control" onBlur="cal_price(' + count + ', this)" type="text" placeholder="Base Cost" name="base_cost_' + count + '" value="' + comp_base_rate + '" /></div></td>';
        } else {
            html += '<td></td>';
        }

        var comp_price = $('#component_grid').find('input[name="comp_price_' + count + '"]').val();
        comp_price = (comp_price !== undefined ? comp_price : '');
        html += '<td><div class="col-sm-5"><input class="form-control" type="text" placeholder="Price" name="price_' + count + '" value="' + comp_price + '" /></div></td>';
        html += '</tr>';
        count++;
    });
    $("#component_price_grid > table > tbody").append(html);
}

function cal_price(count, id) {
    if ($(id).val() !== '') {
        var data = $('#component_grid').find('input[name="data_' + count + '"]').val();
        var arr = data_arr(data);
        var price = ($(id).val() * arr['GROSS_WEIGHT']);
        $('#component_price_grid').find('input[name="price_' + count + '"]').val(price);
    }
}

function data_arr(comp_data) {
    var data_arr = comp_data.split(';');
    var arr = new Array();
    for (var i in data_arr) {
        var int_data = data_arr[i].split(':');
        arr[int_data[0]] = int_data[1];
    }
    return arr;
}

function toggle_add() {
    $('#days_ret_30_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#days_ret_30')});
    $('#ret_100_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#ret_100')});
    $('#free_ship_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#free_ship')});
    $('#life_time_ret_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#life_time_ret')});
    $('#free_ret_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#free_ret')});
    $('#payment_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#payment')});
}

function comp_type_change(obj) {
    $('.form_fields').hide();
    $('#ajax_loader').show();
    $('#add_btn').addClass('hide');
    var data_type = $(obj).find(":selected").data('type');
    if (data_type === 'labor') {
        $('#ajax_loader').delay(500).hide();
        $('#add_btn').delay(300).removeClass('hide');
    } else {
        $("#" + data_type + "_fields").delay(350).fadeIn(function() {
            $('#ajax_loader').delay(500).hide();
            $('#add_btn').delay(300).removeClass('hide');
        });
    }
}

function toggle(id, is_on) {
    if (is_on == 1) {
        $('#' + id + '_t').toggles({on: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#' + id)});
    } else {
        $('#' + id + '_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#' + id)});
    }
}

function add_component() {
    var rowCount = $("#component_grid > table > tbody > tr").length + 1;
    var data_type = $('[name="comp_type"]').find(":selected").data('type');
    var comp_id = $('[name="comp_type"]').val();
    var html = "<tr>\n\
                    <td>" + rowCount + "</td>\n\
                    <td>" + $('[name="comp_type"]').find(":selected").text() + "\n\
                        <input type='hidden' name='sel_comp_id_" + rowCount + "' value='" + comp_id + "' />\n\
                        <input type='hidden' name='sel_comp_type_" + rowCount + "' value='" + data_type + "' />\n\
                        <input type='hidden' name='sel_comp_id_" + comp_id + "_" + rowCount + "' value='" + $('[name="' + data_type + '_type"]').val() + "' />\n\
                    </td>\n\
                    <td>" + $('[name="' + data_type + '_type"]').find(":selected").text() + "</td>\n\
                    <td class='table-action'>\n\
                        <a href=''><i class='fa fa-pencil'></i></a>\n\
                        <a href='' class='delete-row'><i class='fa fa-trash-o'></i></a>\n\
                        <input type='hidden' name='data_" + rowCount + "' value='" + getData(data_type) + "' />\n\
                    </td>\n\
                </tr>";
    $("#component_grid > table > tbody").append(html);
    $("#comp_count").val(rowCount);
    reset_form(data_type);
}

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