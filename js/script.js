$(function() {
    $('.numbers-only').keypress(function() {
        return numbersonly($(this), $(this).data('decimal'));
    });

    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({allow_single_deselect: true});
    jQuery(".chosen-select-dis-search").chosen({
        'width': '100%',
        'white-space': 'nowrap',
        disable_search: true
    });
});

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
                'IS_PRIM:' + $('[name="metal_prim"]').val() + ';' +
                'CARET:' + $('[name="meta_caret"]').val();

    } else if (type === 'diamond') {
        str = 'CUT_ID:' + $('[name="stone_cut"]').val() + ';' +
                'COMP_TYPE_ID:' + $('[name="stone_type"]').val() + ';' +
                'TOTAL_STONES:' + $('[name="stone_total_stones"]').val() + ';' +
                'COLOR_FROM_ID:' + $('[name="stone_color_from"]').val() + ';' +
                'COLOR_TO_ID:' + $('[name="stone_color_to"]').val() + ';' +
                'CLARITY_FROM_ID:' + $('[name="stone_clarity_from"]').val() + ';' +
                'CLARITY_TO_ID:' + $('[name="stone_clarity_to"]').val() + ';' +
                'SHAPE_ID:' + $('[name="stone_shape"]').val() + ';' +
                'GROSS_WEIGHT:' + $('[name="stone_gross_weight"]').val() + ';' +
                'FLU_ID:' + $('[name="stone_fluorescence"]').val() + ';' +
                'PLAC_ID:' + $('[name="stone_placement"]').val() + ';';

        str += otherDiamondData();

    } else if (type === 'colored_stone') {
        str = 'COMP_TYPE_ID:' + $('[name="colored_stone_type"]').val() + ';' +
                'C_STONE_CAT_ID:' + $('[name="colored_stone_cat"]').val() + ';' +
                'C_STONE_COL_ID:' + $('[name="colored_stone_color"]').val() + ';' +
                'TOTAL_STONES:' + $('[name="colored_stone_total_stones"]').val() + ';' +
                'GROSS_WEIGHT:' + $('[name="colored_stone_gross_weight"]').val() + ';' +
                'SHAPE_ID:' + $('[name="colored_stone_shape"]').val() + ';' +
                'CUT_ID:' + $('[name="colored_stone_cut"]').val() + ';' +
                'SIZE_FROM:' + $('[name="colored_stone_mm_size_from"]').val() + ';' +
                'SIZE_TO:' + $('[name="colored_stone_mm_size_to"]').val() + ';' +
                'PLAC_ID:' + $('[name="colored_stone_placement"]').val();
    }
    return str;
}

function otherDiamondData() {
    var str = '';
    if ($('[name="stone_shape"]').val() === '1') {
        str += 'SIZE_ID:' + $('[name="stone_size_type"]').val() + ';';
    }

    if ($('[name="stone_size_type"]').val() === '1') {
        str += 'SIZE_FROM:' + $('[name="stone_seiv_size_from"]').val() + ';' +
                'SIZE_TO:' + $('[name="stone_seiv_size_to"]').val();
    } else {
        str += 'SIZE_FROM:' + $('[name="stone_mm_size_from"]').val() + ';' +
                'SIZE_TO:' + $('[name="stone_mm_size_to"]').val();
    }
    return str;
}

function getCompDetails(type) {
    var str = '';
    if (type === 'metal') {
        str = 'Gross Weight : ' + $('[name="metal_gross_weight"]').val() + '<br>' +
                'Prim : ' + $('[name="metal_prim"] > option:selected').text() + '<br>' +
                'Caret/Purity : ' + $('[name="meta_caret"]').val();

    } else if (type === 'diamond') {
        str = 'Cut : ' + $('[name="stone_cut"] > option:selected').text() + '<br>' +
                'Type : ' + $('[name="stone_type"] > option:selected').text() + '<br>' +
                'No. of Stones : ' + $('[name="stone_total_stones"]').val() + '<br>' +
                'Color From : ' + $('[name="stone_color_from"] > option:selected').text() + '<br>' +
                'Color To : ' + $('[name="stone_color_to"] > option:selected').text() + '<br>' +
                'Clarity From : ' + $('[name="stone_clarity_from"] > option:selected').text() + '<br>' +
                'Clarity To : ' + $('[name="stone_clarity_to"] > option:selected').text() + '<br>' +
                'Shape : ' + $('[name="stone_shape"] > option:selected').text() + '<br>' +
                'Gross Weight:' + $('[name="stone_gross_weight"]').val() + '<br>' +
                'Fluorescence:' + $('[name="stone_fluorescence"] > option:selected').text() + '<br>' +
                'Placement:' + $('[name="stone_placement"] > option:selected').text() + '<br>';

        str += otherDiamondDetails();

    } else if (type === 'colored_stone') {
        str = 'Type : ' + $('[name="colored_stone_type"] > option:selected').text() + '<br>' +
                'Category : ' + $('[name="colored_stone_cat"] > option:selected').text() + '<br>' +
                'Color : ' + $('[name="colored_stone_color"] > option:selected').text() + '<br>' +
                'Shape : ' + $('[name="colored_stone_shape"] > option:selected').text() + '<br>' +
                'Cut : ' + $('[name="colored_stone_cut"] > option:selected').text() + '<br>' +
                'No. of Stones : ' + $('[name="colored_stone_total_stones"]').val() + '<br>' +
                'Gross Weight : ' + $('[name="colored_stone_gross_weight"]').val() + '<br>' +
                'MM size from : ' + $('[name="colored_stone_mm_size_from"]').val() + '<br>' +
                'MM Size to : ' + $('[name="colored_stone_mm_size_to"]').val() + '<br>' +
                'Placement : ' + $('[name="colored_stone_placement"]').val();
    }
    return str;
}

function otherDiamondDetails() {
    var str = '';
    if ($('[name="stone_shape"]').val() === '1') {
        str += 'Size : ' + $('[name="stone_size_type"] > option:selected').text() + '<br>';
    }

    if ($('[name="stone_size_type"]').val() === '1') {
        str += 'SEIVE size from : ' + $('[name="stone_seiv_size_from"] > option:selected').text() + '<br>' +
                'SEIVE Size to : ' + $('[name="stone_seiv_size_to"] > option:selected').text();
    } else {
        str += 'MM size from : ' + $('[name="stone_mm_size_from"]').val() + '<br>' +
                'MM Size to : ' + $('[name="stone_mm_size_to"]').val();
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
    $('#add_btn').addClass('disabled');
}

function show_comp_price() {
    $('#component_price_grid').removeClass('hide');
    $('#basic_price_div').hide();
    var html = '';
    var count = 1;

    var stone_total_weight = 0;
    var metal_total_weight = 0;
    var prim_metal_weight = 0;

    $('#component_grid > table > tbody > tr').each(function() {
        html += '<tr>';

        var data_type = $('#component_grid').find('input[name="sel_comp_type_' + count + '"]').val();
        var int_count = 1;
        $(this).find('td').each(function() {
            if (data_type === 'labor' && int_count === 4) {
                html += "<td>" + labour_price_options(count) + "</td>";
            } else {
                if (!$(this).hasClass('table-action')) {
                    html += "<td>" + $(this).html() + "</td>";
                }
            }
            int_count++;
        });

        html += add_comp_base_rate_field(data_type, count);

        var gross_wgt = parseFloat(get_gross_weight(count));
        if (data_type === 'diamond' || data_type === 'colored_stone') {
            stone_total_weight += gross_wgt;
        } else if (data_type === 'metal') {
            if (is_prim_metal(count)) {
                prim_metal_weight = gross_wgt;
            } else {
                metal_total_weight += gross_wgt;
            }
        }

        html += add_comp_price_field(count);
        html += '</tr>';
        count++;
    });
    html += add_vat(count);
    count++;
    html += add_shipping_charges(count);
    var total_price = ($('#mf_total_price').length ? $('#mf_total_price').val() : '0.00');
    html += '<tr><td colspan="5" class="t_right"><a href="javascript:;" class="btn btn-primary btn-xs" onclick="cal_prod_total_price();">Calculate Total</a></td><td class="t_right"><span id="comp_total_price" class="bold" style="padding-right:12px;">' + total_price + '</span></td></tr>';
    $("#component_price_grid > table > tbody").empty().append(html);
    $('#stone_total_weight').val(stone_total_weight / 5);
    $('#prim_metal_weight').val(prim_metal_weight);
    $('#metal_total_weight').val(metal_total_weight);
    cal_prod_total_price();
}

function add_comp_price_field(count) {
    var html = '';
    var comp_price = $('#component_grid').find('input[name="comp_price_' + count + '"]').val();
    comp_price = (comp_price !== undefined ? comp_price : 0);
    html += '<td><div class="col-sm-12"><input class="form-control t_right ready-only" readonly type="text" name="price_' + count + '" value="' + comp_price + '" /></div></td>';
    return html;
}

function add_comp_base_rate_field(data_type, count) {
    var html = '';
    var comp_base_rate = $('#component_grid').find('input[name="comp_base_rate_' + count + '"]').val();
    comp_base_rate = (comp_base_rate !== undefined ? comp_base_rate : 0);
    html += '<td><div class="col-sm-10"><input class="form-control" class="numbers-only" onBlur="cal_price_onchange(\'' + data_type + '\', ' + count + ', this)" type="text" placeholder="Base Cost" name="base_cost_' + count + '" value="' + comp_base_rate + '" /></div></td>';
    return html;
}

function add_vat(count) {
    var vat = ($('#vat_price').length ? $('#vat_price').val() : 0);
    return '<tr>\n\
            <td>' + count + '</td>\n\
            <td>VAT (1.1%)</td>\n\
            <td></td><td></td><td></td>\n\
            <td><div class="col-sm-12"><input readonly class="form-control t_right ready-only" type="text" value="' + vat + '" name="price_' + count + '" /></div></td>\n\
            </tr>';
}

function labour_price_options(count) {
    var optVal = ($('[name="comp_price_type_' + count + '"]').length ? $('[name="comp_price_type_' + count + '"]').val() : '');
    var arr = new Array('', 'Gross Wgt', 'Nt Wgt', 'Fixed');
    var optStr = '';
    for (var i in arr) {
        optStr += '<option value="' + i + '" ' + (optVal == i ? 'selected' : '') + '>' + arr[i] + '</option>';
    }
    return '<div class="col-sm-10 l_pad_0"><select name="labour_price_type_' + count + '" class="form-control" onChange="labour_option_change(' + count + ');">\n\
            ' + optStr + '</select>';
}

function labour_option_change(count) {
    var price = cal_labour_price(count);
    $('#component_price_grid').find('input[name="price_' + count + '"]').val(price);
}

function cal_labour_price(count) {
    var sel_opt = $('#component_price_grid').find('select[name="labour_price_type_' + count + '"]').val();
    var lab_cost = parseFloat($('#component_price_grid').find('input[name="base_cost_' + count + '"]').val());
    var price = 0;
    if (sel_opt !== '' && lab_cost > 0) {
        sel_opt = parseInt(sel_opt);
        switch (sel_opt) {
            case 1:
                var prim_metal_weight = $('#prim_metal_weight').val();
                var metal_total_weight = $('#metal_total_weight').val();
                price = (parseFloat(prim_metal_weight) + parseFloat(metal_total_weight)) * lab_cost;
                break;
            case 2:
                var stone_total_weight = $('#stone_total_weight').val();
                var metal_total_weight = $('#metal_total_weight').val();
                var prim_metal_weight = $('#prim_metal_weight').val();
                price = (parseFloat(prim_metal_weight) + parseFloat(metal_total_weight) - parseFloat(stone_total_weight)) * lab_cost;
                break;
            case 3:
                price = lab_cost;
                break;
        }
    }
    return parseFloat(price).toFixed(2);
}

function add_shipping_charges(count) {
    var ship_charges = ($('#ship_charges').length ? $('#ship_charges').val() : 0);
    return '<tr>\n\
            <td>' + count + '</td>\n\
            <td>Shipping Charges</td>\n\
            <td></td><td></td><td></td>\n\
            <td><div class="col-sm-12"><input class="form-control numbers-only t_right" value="' + ship_charges + '" data-decimal="true" type="text" name="price_' + count + '" /></div></td>\n\
            </tr>';
}

function cal_vat_price() {
    var count = parseInt($('#comp_count').val());
    var total_price = calculate(count);
    var vat = parseFloat((total_price / 100) * 1.1).toFixed(2);
    $('#component_price_grid').find('input[name="price_' + (count + 1) + '"]').val(vat);
    return vat;
}

function cal_prod_total_price() {
    var count = parseInt($('#comp_count').val());
    var total_price = 0;
    for (var i = 1; i <= count; i++) {
        var data_type = $('#component_grid').find('input[name="sel_comp_type_' + i + '"]').val();
        var base_rate = $('#component_price_grid').find('input[name="base_cost_' + i + '"]').val();
        total_price += parseFloat(cal_price(data_type, i, base_rate));
    }

    var vat = (total_price / 100) * 1.1;
    $('#component_price_grid').find('input[name="price_' + (count + 1) + '"]').val(parseFloat(vat).toFixed(2));
    total_price += parseFloat(vat);

    var ship_charges = $('#component_price_grid').find('input[name="price_' + (count + 2) + '"]').val();
    total_price += parseFloat(ship_charges);

    $('#comp_total_price').text('Rs. ' + parseFloat(total_price).toFixed(2));
}

function calculate(count) {
    var total_price = 0;
    for (var i = 1; i <= count; i++) {
        var price = $('#component_price_grid').find('input[name="price_' + i + '"]').val();
        price = (price !== undefined && price !== '' ? price : 0);
        total_price += parseFloat(price);
    }
    return total_price;
}

function get_gross_weight(count) {
    var data = $('#component_grid').find('input[name="data_' + count + '"]').val();
    var arr = data_arr(data);
    return arr['GROSS_WEIGHT'];
}

function is_prim_metal(count) {
    var data = $('#component_grid').find('input[name="data_' + count + '"]').val();
    var arr = data_arr(data);
    return (arr['IS_PRIM'] === '1');
}

function cal_price_onchange(data_type, count, id) {
    cal_price(data_type, count, $(id).val());
}

function cal_price(data_type, count, val) {
    if (val !== '') {
        var price = 0;
        if (data_type === 'labor') {
            price = cal_labour_price(count);
        } else {
            var gross_weight = 0;
            if (is_prim_metal(count)) {
                gross_weight = ($('#prim_metal_weight').val() - $('#stone_total_weight').val());
            } else {
                gross_weight = get_gross_weight(count);
            }
            price = (val * gross_weight);
        }
        $('#component_price_grid').find('input[name="price_' + count + '"]').val(parseFloat(price).toFixed(2));
        return price;
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
    $('#hallmark_t').toggles({off: true, text: {on: 'Yes', off: 'No'}, checkbox: $('#hallmark')});
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
    $('#add_btn').addClass('disabled');
    var data_type = $(obj).find(":selected").data('type');
    if (data_type === 'labor') {
        $('#ajax_loader').delay(500).hide();
    } else {
        $("#" + data_type + "_fields").delay(350).fadeIn(function() {
            $('#ajax_loader').delay(500).hide();
        });
    }
    $('#add_btn').delay(300).removeClass('disabled');
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
                    <td><div id='more_" + rowCount + "'>" + getCompDetails(data_type) + "</div></td>\n\
                    <td class='table-action'>\n\
                        <input type='hidden' name='data_" + rowCount + "' value='" + getData(data_type) + "' />\n\
                    </td>\n\
                </tr>";
    //<a href=''><i class='fa fa-pencil'></i></a>\n\
    //                    <a href='' class='delete-row'><i class='fa fa-trash-o'></i></a>\n\
    $("#component_grid > table > tbody").append(html);
    $("#comp_count").val(rowCount);
    showMore('#more_' + rowCount, 25);
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

function showMoreLink(id) {
    var moretext = "[+]";
    var lesstext = "[-]";
    if ($(id).hasClass("less")) {
        $(id).removeClass("less");
        $(id).html(moretext);
    } else {
        $(id).addClass("less");
        $(id).html(lesstext);
    }
    $(id).parent().prev().toggle();
    $(id).prev().toggle();
    return false;
}

function showMore(id, showChar) {
    var ellipsestext = "...";
    var moretext = "[+]";
    var lesstext = "[-]";
    var content = $(id).html();

    if (content.length > showChar) {

        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);

        var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="javascript:;" class="morelink" onclick="showMoreLink(this);">' + moretext + '</a></span>';

        $(id).html(html);
    }
}