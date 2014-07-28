$(function() {
    $('body').on('keydown', '.numbers-only', function(event) {
        // Prevent shift key since its not needed
        if (event.shiftKey == true) {
            event.preventDefault();
        }
        // Allow Only: keyboard 0-9, numpad 0-9, backspace, tab, left arrow, right arrow, delete
        if ((event.keyCode >= 48 && event.keyCode <= 57) ||
                (event.keyCode >= 96 && event.keyCode <= 105) ||
                event.keyCode == 8 ||
                event.keyCode == 9 ||
                event.keyCode == 37 ||
                event.keyCode == 39 ||
                event.keyCode == 46 ||
                ($(this).data('decimal') && (event.keyCode == 190 || event.keyCode == 110) && $(this).val().indexOf('.') === -1)) {
            // Allow normal operation
        } else {
            // Prevent the rest
            event.preventDefault();
        }
    });

    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({allow_single_deselect: true});
    jQuery(".chosen-select-dis-search").chosen({
        'width': '100%',
        'white-space': 'nowrap',
        disable_search: true
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

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function selectDropDownByText(id, text) {
    $(id + " option").each(function() {
        this.selected = $(this).text() === text;
    });
}

jQuery(window).load(function() {

    // Page Preloader
    jQuery('#status').fadeOut();
    jQuery('#preloader').delay(350).fadeOut(function() {
        jQuery('body').delay(350).css({'overflow-y': 'visible'});
    });
});

function animationHover(element, animation) {
    element = $(element);
    element.hover(
            function() {
                element.addClass('animated ' + animation);
            },
            function() {
                //wait for animation to finish before removing classes
                window.setTimeout(function() {
                    element.removeClass('animated ' + animation);
                }, 2000);
            });
}

$(document).ready(function() {
    $('#logo').each(function() {
        animationHover(this, 'bounce');
    });
});

$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

$(document).ready(function() {
    $("[rel='tooltip']").tooltip();

    $('.productbox').hover(
            function() {
                $(this).find('.caption').slideDown(250); //.fadeIn(250)
            },
            function() {
                $(this).find('.caption').slideUp(250); //.fadeOut(205)
            }
    );
});