/**
 * Exit Intent Layer / Lightbox
 */
$(document).ready(function () {
    var doc = $(document),
            obj = $('.mod_exitintent'),
            eVars = 0,
            recAreaLeft = 0,
            recAreaRight = 0,
            recAreaTop = 0,
            recAreaBottom = 0,
            displaySteps = 0,
            recDelay = 0,
            recDistance = 0,
            scrollDistance = 0,
            displayCounter = 0,
            autoTimer = 0;


    if (obj.length) {
        eVars = $.parseJSON(obj.attr('data-json'));
        recAreaLeft = 0;
        recAreaRight = $(window).width();
        recAreaTop = 0;
        recAreaBottom = $(window).height();
        displaySteps = eVars.steps;
        recDelay = eVars.delay;
        recDistance = eVars.distance;
        scrollDistance = eVars.scroll;
        autoTimer = eVars.timer;

        if (autoTimer) {
            setTimeout(function () {
                callLightbox();
                $('body').addClass('exitintent_open');
            }, autoTimer * 1000);
        }

        doc.mousemove(function (e) {
            //mouse position
            xx = e.pageX;
            yy = e.pageY;

            if (displayCounter < displaySteps) {
                if (isTouched()) {
                    delayTimeout = setTimeout(function () {
                        isTouched() ? callLightbox() : null;
                        $('body').addClass('exitintent_open');
                        clearTimeout(delayTimeout);
                    }, recDelay);
                }
            }
        });

        doc.scroll(function () {
            if (displayCounter < displaySteps) {
                if (touchSquare($(window).scrollTop())) {
                    callLightbox();
                    $('body').addClass('exitintent_open');
                }
            }
        });

        touchSquare = function (top) {
            if (scrollDistance && top > scrollDistance) {
                return true;
            } else {
                return false;
            }
        };

        isTouched = function () {
            if (touchLeft() || touchRight() || touchTop() || touchBottom()) {
                return true;
            } else {
                return false;
            }
        };
        touchTop = function () {
            if (recDistance && xx > recAreaLeft && xx < recAreaRight && yy > recAreaTop && yy < recAreaTop + recDistance) {
                return true;
            } else {
                return false;
            }
        };
        touchBottom = function () {
            if (recDistance && xx > recAreaLeft && xx < recAreaRight && yy > recAreaBottom - recDistance && yy < recAreaBottom) {
                return true;
            } else {
                return false;
            }
        };
        touchLeft = function () {
            if (recDistance && xx > recAreaLeft && xx < recAreaLeft + recDistance && yy > recAreaTop && yy < recAreaBottom) {
                return true;
            } else {
                return false;
            }
        };
        touchRight = function () {
            if (recDistance && xx > recAreaRight - recDistance && xx < recAreaRight && yy > recAreaTop && yy < recAreaBottom) {
                return true;
            } else {
                return false;
            }
        };

        callLightbox = function () {
            if (obj.attr('data-show') == 1) {
                $.colorbox({
                    maxWidth: '95%',
                    maxHeight: '95%',
                    html: obj.html(),
                    onClosed: function () {
                        $('body').removeClass('exitintent_open');
                        displayCounter++;
                    }
                });
                return true;
            }
        };
    }
});




