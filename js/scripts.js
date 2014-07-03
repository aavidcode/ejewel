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
