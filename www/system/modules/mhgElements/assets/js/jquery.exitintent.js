//TRIGGER Exit Intent Lightbox
var
        eivars,
        recAreaLeft,
        recAreaRight,
        recAreaTop,
        recAreaBottom,
        displaySteps,
        recDelay,
        top_active,
        top_size,
        bottom_active,
        bottom_size,
        left_active,
        left_size,
        right_active,
        right_size,
        square_active,
        square_top,
        displayCounter = 0;


$(document)

        .ready(function () {
            if ($('.exitintent').length > 0 ) {
                eiVars = $.parseJSON($('.exitintent').attr('data-json'));
                recAreaLeft = 0;
                recAreaRight = $(window).width();
                recAreaTop = 0;
                recAreaBottom = $(window).height();
                displaySteps = eiVars.exitintent_steps;
                recDelay = eiVars.exitintent_delay;
                top_active = eiVars.exitintent_top;
                top_size = eiVars.exitintent_top_size;
                bottom_active = eiVars.exitintent_bottom;
                bottom_size = eiVars.exitintent_bottom_size;
                left_active = eiVars.exitintent_left;
                left_size = eiVars.exitintent_left_size;
                right_active = eiVars.exitintent_right;
                right_size = eiVars.exitintent_right_size;
                square_active = eiVars.exitintent_square;
                square_top = eiVars.exitintent_square_top;
            }
        })
            
        .mousemove(function (e) {
            if ($('.exitintent').length > 0 ) {
                //mouse position
                xx = e.pageX;
                yy = e.pageY;
                //recognizeable area and timers

                if (displayCounter < displaySteps) {
                    if (isTouched()) {
                        delayTimeout = setTimeout(function () {
                            isTouched() ? callLightbox() : null;
                            $('body').addClass('exitintent_open');
                            clearTimeout(delayTimeout);
                        }, recDelay);
                    }
                }
            }
        })

        .scroll(function () {
            if ($('.exitintent').length > 0 ) {
                if (displayCounter < displaySteps) {
                    if (touchSquare($(window).scrollTop())) {
                        callLightbox();
                        $('body').addClass('exitintent_open');
                    }
                }
            }
        });



function callLightbox() {
    if ($('.exitintent').attr('data-show') == 1) {
        $.colorbox({
            maxWidth: '95%',
            maxHeight: '95%',
            html: $('.exitintent').html(),
            onClosed: function () {
                $('body').removeClass('exitintent_open');
                displayCounter++;
            }
        });
        return true;
    }
}

function isTouched() {
    if (touchLeft() || touchRight() || touchTop() || touchBottom()) {
        return true;
    } else {
        return false;
    }
}
function touchTop() {
    if (top_active && xx > recAreaLeft && xx < recAreaRight && yy > recAreaTop && yy < recAreaTop + top_size) {
        return true;
    } else {
        return false;
    }
}
function touchBottom() {
    if (bottom_active && xx > recAreaLeft && xx < recAreaRight && yy > recAreaBottom - bottom_size && yy < recAreaBottom) {
        return true;
    } else {
        return false;
    }
}
function touchLeft() {
    if (left_active && xx > recAreaLeft && xx < recAreaLeft + left_size && yy > recAreaTop && yy < recAreaBottom) {
        return true;
    } else {
        return false;
    }
}
function touchRight() {
    if (right_active && xx > recAreaRight - right_size && xx < recAreaRight && yy > recAreaTop && yy < recAreaBottom) {
        return true;
    } else {
        return false;
    }
}
function touchSquare(top) {
    if (square_active && top > square_top) {
        return true;
    } else {
        return false;
    }
}