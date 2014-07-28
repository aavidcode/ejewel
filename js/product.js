$(document).ready(function() {

    var prod_summary_form = $('#prod_summary_form');
    prod_summary_form.validate();

    var metal_grid_fields = $('#metal_grid_fields');
    metal_grid_fields.validate();

    var stone_grid_fields = $('#stone_grid_fields');
    stone_grid_fields.validate();

    var colored_stone_grid_fields = $('#colored_stone_grid_fields');
    colored_stone_grid_fields.validate();

    var other_grid_fields = $('#other_grid_fields');
    other_grid_fields.validate();

    var metal_form_fields = $("#metal_form_fields");
    metal_form_fields.validate();

    var stone_form_fields = $("#stone_form_fields");
    stone_form_fields.validate();

    var colored_stone_form_fields = $("#colored_stone_form_fields");
    colored_stone_form_fields.validate();

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    $('#productImgForm').ajaxForm({
        dataType: 'json',
        beforeSend: function() {
            $(".progress").show();
        },
        uploadProgress: function(event, position, total, percentComplete) {
            $(".progress-bar").width(percentComplete + '%');
            $(".sr-only").html(percentComplete + '%');
        },
        success: function(data) {
            $(".progress").hide();
            $('#file_upload').val('');
            var imgArr = data.imgs.split(';');
            var str = '';
            for (var i in imgArr) {
                str += '<div class="col-xs-6 col-md-3 mb10" data-id="' + data.prod_id + '">\n\
                        <a href="' + data.path + imgArr[i] + '" class="example-image-link thumbnail" data-lightbox="example-set">\n\
                        <img class="example-image" src="' + data.path + 'thumb_' + imgArr[i] + '" alt="" style="width:160px;">\n\
                        </a>\n\
                        <div class="right"><a href="#" class="del_prod_img" data-ref="' + imgArr[i] + '"><img src="images/icon_delete13.gif" alt="Delete Product image" title="Delete Product Image" /></a></div>\n\
                        </div> ';
            }
            $('#image_view').append(str);
            $("#upload_btn").hide();
            $("#finish_btn").show();
        }
    });

    $('body').on('click', '.del_prod_img', function(e) {
        e.preventDefault();
        var reqData = {
            img: $(this).data('ref'),
            prod_id: $(this).parent().parent().data('id')
        };
        ajaxCallCommonReqWithRef('admin/del_prod_img', reqData, 'prod_img_del', $(this));
    });

    $(".progress").hide();

    $('.slide_form').on('click', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        if ($(this).find('i').hasClass('fa-minus-square-o')) {
            $('#' + type + '_fields').slideUp();
            $(this).find('i').removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
        } else {
            $('#' + type + '_fields').slideDown();
            $(this).find('i').removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
        }
    });

    $('[name="metal_quality_type"]').on('change', function() {
        $('[name="metal_quality_type_1"]').removeClass('required').hide();
        $('[name="metal_quality_type_2"]').removeClass('required').hide();
        $('[name="metal_quality_type_' + $(this).val() + '"]').addClass('required').fadeIn('slow');
    });

    $('#metal_add_btn').on('click', function() {
        if (metal_form_fields.valid()) {
            add_metal(false, '', '');
        }
    });

    $('#stone_add_btn').on('click', function() {
        if (stone_form_fields.valid()) {
            add_stone(false, '', '');
        }
    });

    $('#colored_stone_add_btn').on('click', function() {
        if (colored_stone_form_fields.valid()) {
            add_colored_stone(false, '', '');
        }
    });

    $('[name="stone_size_type"]').on('change', function() {
        hideSizeBlocks();
        $('#stone_' + $(this).val() + '_size').fadeIn('slow');
    });

    $('[name="stone_shape"]').on('change', function() {
        $('#stone_size_type').hide();
        hideSizeBlocks();
        if ($(this).val() == 1) {
            $('#stone_size_type').fadeIn('slow');
        } else {
            $('#stone_2_size').fadeIn('slow');
        }
    });

    $('[name="colored_stone_type"]').on('change', function() {
        if ($(this).val() !== '') {
            ajaxCallUpdateCombo('', 'admin/ajax/c_stone_category', 'colored_stone_type', 'colored_stone_cat', 'c_stone_category', '');
            var selVal = $('#colored_stone_type > option:selected').text();
            if (selVal === 'Precious') {
                $('[name="colored_stone_color"]').attr("disabled", "disabled");
            } else {
                $('[name="colored_stone_color"]').removeAttr("disabled");
            }
        }
    });

    $('#colored_stone_cat').on('change', function() {
        var selVal = $('#colored_stone_cat > option:selected').text();
        if (selVal === 'Emerald') {
            selectDropDownByText('[name="colored_stone_color"]', 'Green');
        } else if (selVal === 'Ruby') {
            selectDropDownByText('[name="colored_stone_color"]', 'Red');
        } else if (selVal === 'Sapphire') {
            selectDropDownByText('[name="colored_stone_color"]', 'Blue');
        }
    });

    $('[name="price_type"]').on('change', function() {
        var type = parseInt($(this).val());
        componentDetails(false);
        switch (type) {
            case 1:
                $('#price_field').removeClass('hide');
                $('[name="prod_price"]').addClass('required');
                $('#discount_field').addClass('hide');
                $('[name="prod_dis"]').removeClass('required');
                break;
            case 2:
                $('#price_field').removeClass('hide');
                $('[name="prod_price"]').addClass('required');
                $('#discount_field').removeClass('hide');
                $('[name="prod_dis"]').addClass('required');
                break;
            case 3:
                $('#price_field').addClass('hide');
                $('[name="prod_price"]').removeClass('required');
                $('#discount_field').addClass('hide');
                $('[name="prod_dis"]').removeClass('required');
                componentDetails(true);
                break;
        }
    });

    $('#misc_add_btn').on('click', function() {
        add_misc('', '');
    });

    $('[name="category"]').on('change', function() {
        var val = $(this).val();
        if (val !== '') {
            val = parseInt(val);
            switch (val) {
                case 1:
                case 2:
                    showStoneDetails();
                    break;
                case 3:
                case 4:
                    showOnlyMetal();
                    break;
            }
        }
    });

    $('#add_prod_submit').on('click', function() {
        submit_form('add_prod', 'admin/product/add');
    });

    $('#edit_prod_submit').on('click', function() {
        submit_form('edit_prod', 'admin/product/edit/' + $(this).data('prod-id'));
    });

    function submit_form(req, url) {
        if (prod_summary_form.valid() &&
                metal_grid_fields.valid() &&
                stone_grid_fields.valid() &&
                colored_stone_grid_fields.valid() &&
                other_grid_fields.valid() &&
                check_other_values()) {
            ajaxProdSubmitForm(req, url);
        } else {
            $('html, body').animate({
                scrollTop: ($('.error:visible').offset().top - 300)
            }, 1500);
        }
    }


    $('#file_upload').on('change', function() {
        if ($(this).val() !== '') {
            $('#upload_btn').show();
        }
    });

    $('body').on('click', '.row_delete', function(e) {
        e.preventDefault();
        if (confirm('Do you want to delete this row?')) {
            var type = $(this).data('type');
            var parent = $(this).parent().parent();
            parent.fadeOut('slow', function() {
                resetFieldsInForm(parent.index(), type);
                parent.remove();
                resetOrder(type);
            });
        }
    });

    $('[name="jewel_type"]').on('change', function() {
        ajaxCallUpdateCombo('', 'admin/ajax/metal_types', 'jewel_type', 'metal_type', 'metal_types', '');
    });
});

function resetFieldsInForm(index, type) {
    index++;
    if (type === 'metal') {
        var data = $('[name="metal_data_' + index + '"]').val();
        var dataArr = data_arr(data);
        $("[name='metal_prim'] option[value*='" + dataArr['IS_PRIM'] + "']").prop('disabled', false);
        $("[name='metal_type'] option[value*='" + dataArr['COMP_TYPE_ID'] + "']").prop('disabled', false);
    }
}

function add_misc(desc, price) {
    var rowCount = $("#misc_grid_table > tbody > tr").length + 1;
    var html = '<tr>\n\
                    <td>Misc' + rowCount + '</td>\n\
                    <td><div class="col-sm-3"><input type="text" class="form-control" name="misc_desc_' + rowCount + '" value="' + desc + '" /></div></td>\n\
                    <td></td>\n\
                    <td class="t_right"><input style="width:100%;" type="text" name="misc_price_' + rowCount + '" class="t_right required form-control numbers-only" value="' + price + '" data-decimal="true" onBlur="calMiscTotal(this);"/></td>\n\
                    <td class="t_center"><a href="javascript:;" class="row_delete" data-type="misc" style="padding-left: 7px;"><i class="fa fa-times"></i></a></td>\n\
                </tr>';
    $("#misc_grid_table > tbody").append(html);
    $('#misc_count').val(rowCount);
}

function check_other_values() {
    if ($('#metal_count').val() === '0' &&
            $('#stone_count').val() === '0' &&
            $('#colored_stone_count').val() === '0') {
        alert('Enter Any one of the Component Details');
        return false;
    }
    return true;
}

function resetOrder(type) {
    var rows = $('#' + type + '_grid_table > tbody').find('tr');
    rows.each(function(index, value) {
        index++;
        $(this).find('td').each(function() {
            var id = $(this).attr('id');
            if (id) {
                $(this).attr('id', id.replace(/[\d]/g, index));
            }

            $(this).find(':input').each(function() {
                $(this).attr('name', $(this).attr('name').replace(/[\d]/g, index));
                if ($(this).attr('data-count')) {
                    $(this).attr('data-count', $(this).attr('data-count').replace(/[\d]/g, index));
                }
            });
        });
    });

    $('#' + type + '_count').val(rows.length);

    if (type === 'misc') {
        calMiscTotal('');
    } else {
        reCalculateWgt(type);
        //reCalculateBaseCost(type);

        var flag = calculatePrimMetalCost();
        if (!flag) {
            reCalculateTotalCost(type);
            flag = calLabourCost();
            if (!flag) {
                calFinalCost();
                calculateTotal();
            }
        }

        if (rows.length === 0) {
            $('#' + type + '_grid_table').addClass('hide');
        }
    }
}

function showOnlyMetal() {
    $('#stone_grid').hide();
    $('#colored_stone_grid').hide();
    $('#stone_grid > tbody').html('');
    $('#stone_count').val('0');
    $('#colored_stone_grid > tbody').html('');
    $('#colored_stone_count').val('0');
    $('#stone_total_qty').text('0');
    $('#stone_total_wt').text('0');
    $('#stone_total_rate').text('0');
    $('#stone_total_cost').text('0');
    $('#colored_stone_total_qty').text('0');
    $('#colored_stone_total_wt').text('0');
    $('#colored_stone_total_rate').text('0');
    $('#colored_stone_total_cost').text('0');
    if ($('#final_cost').text() > 0) {
        var flag = calculatePrimMetalCost();
        if (!flag) {
            flag = calLabourCost();
            if (!flag) {
                calFinalCost();
                calculateTotal();
            }
        }
    }
}

function showStoneDetails() {
    $('#stone_grid').show();
    $('#colored_stone_grid').show();
}

function componentDetails(flag) {
    if (flag) {
        $('.comp_price').removeClass('hide');
    } else {
        $('.comp_price').addClass('hide');
    }
    setRequiredCompFields(flag);
}

function getCompDetails(type) {
    var arr = new Array();
    if (type === 'metal') {
        var qul_type = $('[name="metal_quality_type"]').val();
        arr['GROSS_WEIGHT'] = $('[name="metal_gross_weight"]').val();
        arr['METAL_COLOR'] = $('[name="metal_color"] > option:selected').text();
        arr['COMP_TYPE_ID'] = $('[name="metal_type"] > option:selected').text();
        arr['TYPE'] = qul_type;
        arr['VALUE'] = $('[name="metal_quality_type_' + qul_type + '"] > option:selected').text();
        arr['IS_PRIM'] = $('[name="metal_prim"]').val();
        arr['FACTOR'] = '';
    } else if (type === 'stone') {
        arr['PLAC_ID'] = $('[name="stone_placement"] > option:selected').text();
        arr['COMP_TYPE_ID'] = $('[name="stone_type"] > option:selected').text();
        arr['SHAPE_ID'] = $('[name="stone_shape"] > option:selected').text();
        arr['COLOR_FROM_ID'] = $('[name="stone_color_from"] > option:selected').text();
        arr['COLOR_TO_ID'] = $('[name="stone_color_to"] > option:selected').text();
        arr['CLARITY_FROM_ID'] = $('[name="stone_clarity_from"] > option:selected').text();
        arr['CLARITY_TO_ID'] = $('[name="stone_clarity_to"] > option:selected').text();
        arr['CUT_ID'] = $('[name="stone_cut"] > option:selected').text();
        arr['SEIV_SIZE_FROM'] = $('[name="stone_seiv_size_from"] > option:selected').text();
        arr['SEIV_SIZE_TO'] = $('[name="stone_seiv_size_to"] > option:selected').text();
        arr['SIZE_FROM'] = $('[name="stone_mm_size_from"]').val();
        arr['SIZE_TO'] = $('[name="stone_mm_size_to"]').val();
        arr['TOTAL_STONES'] = $('[name="stone_total_stones"]').val();
        arr['GROSS_WEIGHT'] = $('[name="stone_gross_weight"]').val();
        arr['SET_ID'] = $('[name="stone_setting"] > option:selected').text();
        arr['FLU_ID'] = $('[name="stone_fluorescence"] > option:selected').text();
    } else if (type === 'colored_stone') {
        arr['PLAC_ID'] = $('[name="colored_stone_placement"] > option:selected').text();
        arr['COMP_TYPE_ID'] = $('[name="colored_stone_type"] > option:selected').text();
        arr['SHAPE_ID'] = $('[name="colored_stone_shape"] > option:selected').text();
        arr['C_STONE_COL_ID'] = $('[name="colored_stone_color"] > option:selected').text();
        arr['C_STONE_CAT_ID'] = $('[name="colored_stone_cat"] > option:selected').text();
        arr['CLARITY_FROM_ID'] = $('[name="colored_stone_clarity_from"] > option:selected').text();
        arr['CLARITY_TO_ID'] = $('[name="colored_stone_clarity_to"] > option:selected').text();
        arr['CUT_ID'] = $('[name="colored_stone_cut"] > option:selected').text();
        arr['SIZE_FROM'] = $('[name="colored_stone_mm_size_from"]').val();
        arr['SIZE_TO'] = $('[name="colored_stone_mm_size_to"]').val();
        arr['TOTAL_STONES'] = $('[name="colored_stone_total_stones"]').val();
        arr['GROSS_WEIGHT'] = $('[name="colored_stone_gross_weight"]').val();
    }
    arr['BASE_RATE'] = '';
    arr['MF_PRICE'] = '';
    return arr;
}

function calculateWgt(type, arr) {
    var wt = parseFloat($('#' + type + '_total_wt').text());
    $('#' + type + '_total_wt').text(parseFloat((wt + parseFloat(arr['GROSS_WEIGHT']))).toFixed(2));

    var qty = parseFloat($('#' + type + '_total_qty').text());
    $('#' + type + '_total_qty').text(parseFloat(qty + parseFloat(arr['TOTAL_STONES'])).toFixed(2));
    $("#" + type + "_grid_table").hasClass('hide') ? $("#" + type + "_grid_table").removeClass('hide') : '';

    var rowCount = $("#" + type + "_grid_table > tbody > tr").length;
    $('#' + type + '_count').val(rowCount);
}

function reCalculateWgt(type) {
    var rowCount = $('#' + type + '_count').val();
    var total_grs_wg = 0;

    for (var i = 1; i <= rowCount; i++) {
        var grs_wg = $('#' + type + '_grs_wg_' + i).text();
        if (grs_wg !== '') {
            total_grs_wg += parseFloat(grs_wg);
        }
    }
    $('#' + type + '_total_wt').text(total_grs_wg);
}

function reCalculateBaseCost(type) {
    var rowCount = $('#' + type + '_count').val();
    var total_base_cost = 0;

    for (var i = 1; i <= rowCount; i++) {
        var base_cost = $('[name="' + type + '_base_cost_' + i + '"]').val();
        if (base_cost !== '') {
            total_base_cost += parseFloat(base_cost);
        }
    }
    $('#' + type + '_total_rate').text(parseFloat(total_base_cost).toFixed(2));
}

function reCalculateTotalCost(type) {
    var rowCount = $('#' + type + '_count').val();
    var total_price = 0;

    for (var i = 1; i <= rowCount; i++) {
        var price = $('[name="' + type + '_price_' + i + '"]').val();
        if (price !== '') {
            total_price += parseFloat(price);
        }
    }

    $('#' + type + '_total_cost').text(parseFloat(total_price).toFixed(2));

    var grs_wt = parseFloat($('#' + type + '_total_wt').text());
    $('#' + type + '_total_rate').text(parseFloat((total_price / grs_wt)).toFixed(2));
}

function calFinalCost() {
    var metal_cost = parseFloat($('#metal_total_cost').text());
    var stone_cost = parseFloat($('#stone_total_cost').text());
    var colored_stone_cost = parseFloat($('#colored_stone_total_cost').text());
    var labour_cost = parseFloat($('#labour_price').val());
    $('#final_cost').text(parseFloat(metal_cost + stone_cost + colored_stone_cost + labour_cost).toFixed(2));
}

function calVat() {
    var final_cost = parseFloat($('#final_cost').text());
    var vat = (final_cost / 100) * 1;
    $('#vat_cost').val(parseFloat(vat).toFixed(2));
}

function calMiscTotal(id) {
    if ($(id).val() !== '' || id === '') {
        var count = $('#misc_count').val();
        var total_price = 0;

        for (var i = 1; i <= count; i++) {
            var price = $('[name="misc_price_' + i + '"]').val();
            if (price !== '') {
                total_price += parseFloat(price);
            }
        }
        $('#misc_cost').text(parseFloat(total_price).toFixed(2));
        calculateTotal();
    }
}

function calculateTotal() {
    var final_cost = parseFloat($('#final_cost').text());
    calVat();

    var vat_cost = parseFloat($('#vat_cost').val());
    var misc_cost = parseFloat($('#misc_cost').text());
    var total_prod_cost = parseFloat(final_cost + vat_cost + misc_cost).toFixed(2);

    $('[name="prod_price"]').val(total_prod_cost);
    $('#total_prod_cost').text(addCommas(total_prod_cost));
}

function calculatePrimMetalCost() {
    var diam_wt = parseFloat($('#stone_total_wt').text());
    var cs_wt = parseFloat($('#colored_stone_total_wt').text());
    if (diam_wt > 0 || cs_wt > 0) {
        var prim_index = $('#primary_index').val();
        var metal_base_cost = $('[name="metal_base_cost_' + prim_index + '"]').val();

        if (metal_base_cost !== '' && metal_base_cost > 0) {
            var primary_wt = parseFloat($('#primary_wt').val());
            var stone_gross_wt = (diam_wt + cs_wt) / 5;
            var prim_gross_wt = (primary_wt - stone_gross_wt);
            $('#primary_gross_wt').val(parseFloat(prim_gross_wt).toFixed(2));
            var prim_base_rate = parseFloat($('[name="metal_base_cost_' + prim_index + '"]').val());
            $('[name="metal_price_' + prim_index + '"]').val(parseFloat(prim_base_rate * prim_gross_wt).toFixed(2));

            calculateMetalTotalCost();
            calLabourCost();
            return true;
        }
    }
    return false;
}

function calculateMetalTotalCost() {
    var diam_wt = parseFloat($('#stone_total_wt').text());
    var cs_wt = parseFloat($('#colored_stone_total_wt').text());
    if (diam_wt > 0 || cs_wt > 0) {
        var rowCount = $('#metal_count').val();
        var total_price = 0;

        for (var i = 1; i <= rowCount; i++) {
            var price = $('[name="metal_price_' + i + '"]').val();
            if (price !== '') {
                total_price += parseFloat(price);
            }
        }
        $('#metal_total_cost').text(parseFloat(total_price).toFixed(2));
    }
}

function calculateRate(id, type) {
    if ($(id).val() !== "") {
        var rowCount = $('#' + type + '_count').val();
        var curCount = parseInt($(id).data('count'));
        var rate = parseFloat($(id).val());
        var grs_wg = parseFloat($('#' + type + '_grs_wg_' + curCount).text());
        $('[name="' + type + '_price_' + curCount + '"]').val(parseFloat(rate * grs_wg).toFixed(2));
        var total_rate = 0;
        var total_price = 0;

        if (type === 'metal') {
            var prim_index = parseInt($('#primary_index').val());
            if (prim_index === curCount) {
                calculatePrimMetalCost();
            }
        }

        for (var i = 1; i <= rowCount; i++) {
            var base_cost = $('[name="' + type + '_base_cost_' + i + '"]').val();
            if (base_cost !== '') {
                total_rate += parseFloat(base_cost);
            }

            var price = $('[name="' + type + '_price_' + i + '"]').val();
            if (price !== '') {
                total_price += parseFloat(price);
            }
        }

        var total_grs_wg = parseFloat($('#' + type + '_total_wt').text());
        $('#' + type + '_total_rate').text(parseFloat((total_price / total_grs_wg)).toFixed(2));
        $('#' + type + '_total_cost').text(parseFloat(total_price).toFixed(2));

        calLabourCost();
        calFinalCost();
        calculateTotal();
    }
}

function add_metal(isEdit, col_data, det_data) {
    var compShow = ($('[name="price_type"]').val() === '3') ? '' : 'hide';
    var rowCount = $("#metal_grid_table > tbody > tr").length + 1;

    var arr = null;
    if (!isEdit) {
        arr = getCompDetails('metal');
    } else {
        arr = data_arr(det_data);
    }

    var html = '<tr>\n\
                    <td>' + (arr['IS_PRIM'] === '1' ? 'Primary' : 'Secondary') + '</td>\n\
                    <td>' + arr['COMP_TYPE_ID'] + '</td>\n\
                    <td id="metal_grs_wg_' + rowCount + '">' + arr['GROSS_WEIGHT'] + '</td>\n\
                    <td>' + arr['VALUE'] + '</td>\n\
                    <td>' + arr['METAL_COLOR'] + '</td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control t_right read-only numbers-only" data-decimal="true" readonly name="metal_factor_' + rowCount + '" value="' + arr['FACTOR'] + '"/></td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control t_right numbers-only ' + (compShow === '' ? 'required' : '') + '" data-decimal="true" data-count="' + rowCount + '" onBlur="calculateRate(this, \'metal\');" name="metal_base_cost_' + rowCount + '" value="' + arr['BASE_RATE'] + '" /></td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control read-only t_right" readonly name="metal_price_' + rowCount + '" value="' + arr['MF_PRICE'] + '" />\n\
                    <input type="hidden" name="metal_data_' + rowCount + '" value="' + (isEdit ? col_data : getData('metal')) + '"/></td>\n\\n\
                    <td class="t_center"><a href="javascript:;" class="row_delete" data-type="metal" style="padding-left: 7px;"><i class="fa fa-times"></i></a></td>\n\
                </tr>';
    $("#metal_grid_table > tbody").append(html);

    if (arr['IS_PRIM'] === '1') {
        $("[name='metal_prim'] option[value*='1']").prop('disabled', true);
        $('#primary_wt').val(arr['GROSS_WEIGHT']);
        $('#primary_index').val(rowCount);
        calculatePrimMetalCost();
    }
    calculateWgt('metal', arr);

    if (!isEdit) {

        $("[name='metal_type'] option[value*='" + $('[name="metal_type"]').val() + "']").prop('disabled', true);

        if ($("[name='metal_price_type']").val() === '1') {
            calMetalBaseRate($('[name="metal_quality_type_' + arr['TYPE'] + '"]').val(), rowCount);
        }

        clear_form_elements('metal_fields');
        calLabourCost();

        if (!confirm('Do you want add another metal?')) {
            $('#metal_grid').find('.slide_form').trigger('click');
        } else {
            alert('Add another metal details');
            $('[name="metal_prim"]').focus();
        }
    }
}

function add_stone(isEdit, col_data, det_data) {
    var compShow = ($('[name="price_type"]').val() === '3') ? '' : 'hide';
    var rowCount = $("#stone_grid_table > tbody > tr").length + 1;
    var arr = null;
    if (!isEdit) {
        arr = getCompDetails('stone');
    } else {
        arr = data_arr(det_data);
    }
    var html = '<tr>\n\
                    <td>' + arr['PLAC_ID'] + '</td>\n\
                    <td>' + arr['COMP_TYPE_ID'] + '</td>\n\
                    <td>' + arr['SHAPE_ID'] + '</td>\n\
                    <td>' + arr['COLOR_FROM_ID'] + '</td>\n\
                    <td>' + arr['COLOR_TO_ID'] + '</td>\n\
                    <td>' + arr['CLARITY_FROM_ID'] + '</td>\n\
                    <td>' + arr['CLARITY_TO_ID'] + '</td>\n\
                    <td>' + arr['CUT_ID'] + '</td>\n\
                    <td>' + arr['SEIV_SIZE_FROM'] + '</td>\n\
                    <td>' + arr['SEIV_SIZE_TO'] + '</td>\n\
                    <td>' + arr['SIZE_FROM'] + '</td>\n\
                    <td>' + (arr['SIZE_FROM'] !== '' ? 'x' : '') + '</td>\n\
                    <td>' + arr['SIZE_TO'] + '</td>\n\
                    <td>' + arr['TOTAL_STONES'] + '</td>\n\
                    <td id="stone_grs_wg_' + rowCount + '">' + arr['GROSS_WEIGHT'] + '</td>\n\
                    <td>' + arr['SET_ID'] + '</td>\n\
                    <td>' + arr['FLU_ID'] + '</td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control t_right numbers-only ' + (compShow === '' ? 'required' : '') + '" data-decimal="true" data-count="' + rowCount + '" onBlur="calculateRate(this, \'stone\');" name="stone_base_cost_' + rowCount + '" value="' + arr['BASE_RATE'] + '" /></td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control read-only t_right" readonly name="stone_price_' + rowCount + '" value="' + arr['MF_PRICE'] + '" />\n\
                    <input type="hidden" name="stone_data_' + rowCount + '" value="' + (isEdit ? col_data : getData('stone')) + '"/></td>\n\
                    <td class="t_center"><a href="javascript:;" class="row_delete" data-type="stone" style="padding-left: 7px;"><i class="fa fa-times"></i></a></td>\n\
                </tr>';
    $("#stone_grid_table > tbody").append(html);

    calculateWgt('stone', arr);
    if (!isEdit) {
        calculatePrimMetalCost();
        clear_form_elements('stone_fields');

        if (!confirm('Do you want add another Stone?')) {
            $('#stone_grid').find('.slide_form').trigger('click');
        } else {
            alert('Add Another Stone details');
        }
    }
}

function add_colored_stone(isEdit, col_data, det_data) {
    var compShow = ($('[name="price_type"]').val() === '3') ? '' : 'hide';
    var rowCount = $("#colored_stone_grid_table > tbody > tr").length + 1;

    var arr = null;
    if (!isEdit) {
        arr = getCompDetails('colored_stone');
    } else {
        arr = data_arr(det_data);
    }

    var html = '<tr>\n\
                    <td>' + arr['PLAC_ID'] + '</td>\n\
                    <td>' + arr['COMP_TYPE_ID'] + '</td>\n\
                    <td>' + arr['SHAPE_ID'] + '</td>\n\
                    <td>' + arr['C_STONE_COL_ID'] + '</td>\n\
                    <td>' + arr['C_STONE_CAT_ID'] + '</td>\n\
                   <td>' + arr['CUT_ID'] + '</td>\n\
                    <td></td>\n\
                    <td></td>\n\
                    <td>' + arr['SIZE_FROM'] + '</td>\n\
                    <td>' + (arr['SIZE_FROM'] !== '' ? 'x' : '') + '</td>\n\
                    <td>' + arr['SIZE_TO'] + '</td>\n\
                    <td>' + arr['TOTAL_STONES'] + '</td>\n\
                    <td id="colored_stone_grs_wg_' + rowCount + '">' + arr['GROSS_WEIGHT'] + '</td>\n\
                    <td>' + $('[name="colored_stone_setting"] > option:selected').text() + '</td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control t_right numbers-only ' + (compShow === '' ? 'required' : '') + '" data-decimal="true" data-count="' + rowCount + '" onBlur="calculateRate(this, \'colored_stone\');" name="colored_stone_base_cost_' + rowCount + '" value="' + arr['BASE_RATE'] + '" /></td>\n\
                    <td class="comp_price ' + compShow + '"><input type="text" class="form-control read-only t_right" readonly name="colored_stone_price_' + rowCount + '" value="' + arr['MF_PRICE'] + '" />\n\
                    <input type="hidden" name="colored_stone_data_' + rowCount + '" value="' + (isEdit ? col_data : getData('colored_stone')) + '"/></td>\n\
                    <td class="t_center"><a href="javascript:;" class="row_delete" data-type="colored_stone" style="padding-left: 7px;"><i class="fa fa-times"></i></a></td>\n\
                </tr>';
    $("#colored_stone_grid_table > tbody").append(html);

    calculateWgt('colored_stone', arr);

    if (!isEdit) {
        calculatePrimMetalCost();
        clear_form_elements('colored_stone_fields');

        if (!confirm('Do you want add another Colored Stone?')) {
            $('#colored_stone_grid').find('.slide_form').trigger('click');
        } else {
            alert('Add Another Colored Stone details');
        }
    }
}

function hideSizeBlocks() {
    $('[name="stone_size_type"] option').each(function() {
        $('#stone_' + $(this).val() + '_size').hide();
    });
}

function showTextField(id) {
    var name = $(id).attr('name');
    if ($(id).val() === 'others') {
        $('[name="' + name + '_txt"]').removeClass('hide').addClass('required').focus();
    } else {
        $('[name="' + name + '_txt"]').addClass('hide').removeClass('required');
    }
}

function calLabourCost() {
    var sel_opt = $('[name="labour_price_type"]').val();
    var lab_cost = $('[name="labour_base_cost"]').val();
    lab_cost = (lab_cost !== "" ? parseFloat(lab_cost) : 0);
    var price = 0;
    if (sel_opt !== '' && lab_cost > 0) {
        sel_opt = parseInt(sel_opt);

        switch (sel_opt) {
            case 1:
                var metal_total_weight = parseFloat($('#metal_total_wt').text());
                price = (metal_total_weight * lab_cost);
                break;
            case 2:
                var metal_total_weight = parseFloat($('#metal_total_wt').text());
                var primary_wt = parseFloat($('#primary_wt').val());//5
                var primary_gross_wt = parseFloat($('#primary_gross_wt').val());
                if (primary_gross_wt > 0) {
                    price = (primary_gross_wt + (metal_total_weight - primary_wt)) * lab_cost;
                } else {
                    price = (metal_total_weight * lab_cost);
                }
                break;
            case 3:
                price = lab_cost;
                break;
        }
        $('#labour_price').val(parseFloat(price).toFixed(2));
        calFinalCost();
        calculateTotal();
        return true;
    }
    return false;
}

function calMetalBaseRate(fac_val, cur_count) {
    $.ajax({
        type: 'POST',
        url: 'admin/ajax/metal_base_rate',
        dataType: 'json',
        data: {
            fac_val: fac_val
        },
        success: function(data) {
            if (data.error === false) {
                $('[name="metal_factor_' + cur_count + '"]').val(data.factor);
                var base_rate = parseFloat(data.metal_cost) * parseFloat(data.factor);
                $('[name="metal_base_cost_' + cur_count + '"]').val(parseFloat(base_rate).toFixed(2));
                calculateRate($('[name="metal_base_cost_' + cur_count + '"]'), 'metal');
            }
        }
    });
}

function setRequiredCompFields(flag) {
    if (flag) {
        $('[name="labour_price_type"]').addClass('required');
        $('[name="labour_base_cost"]').addClass('required');
        $('[name="misc_price_1"]').addClass('required');
        $('[name="misc_desc_1"]').addClass('required');
    } else {
        $('[name="labour_price_type"]').removeClass('required');
        $('[name="labour_base_cost"]').removeClass('required');
        $('[name="misc_price_1"]').removeClass('required');
        $('[name="misc_desc_1"]').removeClass('required');
    }
}

function getData(type) {
    var str = '';
    if (type === 'metal') {
        var metal_t = $('[name="metal_quality_type"]').val();
        str = 'COMP_TYPE_ID:' + $('[name="metal_type"]').val() + ';' +
                'GROSS_WEIGHT:' + $('[name="metal_gross_weight"]').val() + ';' +
                'IS_PRIM:' + $('[name="metal_prim"]').val() + ';' +
                'TYPE:' + metal_t + ';' +
                'METAL_COLOR:' + $('[name="metal_color"]').val() + ';' +
                'VALUE:' + $('[name="metal_quality_type_' + metal_t + '"]').val();

    } else if (type === 'stone') {
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
                'PLAC_ID:' + $('[name="stone_placement"]').val() + ';' +
                'SET_ID:' + $('[name="stone_setting"]').val() + ';' +
                'SIZE_ID:' + ($('[name="stone_size_type"]').val() !== "" ? $('[name="stone_size_type"]').val()  : 0) + ';' +
                'SEIV_SIZE_FROM:' + $('[name="stone_seiv_size_from"]').val() + ';' +
                'SEIV_SIZE_TO:' + $('[name="stone_seiv_size_to"]').val() + ';' +
                'SIZE_FROM:' + $('[name="stone_mm_size_from"]').val() + ';' +
                'SIZE_TO:' + $('[name="stone_mm_size_to"]').val();

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
                'PLAC_ID:' + $('[name="colored_stone_placement"]').val() + ';' +
                'SET_ID:' + $('[name="colored_stone_setting"]').val();
    }
    return str;
}

function validateUpload() {
    if ($('#image_view').html() !== '') {
        window.location.href = 'admin/product/viewAll';
    } else {
        alert('Upload product images');
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