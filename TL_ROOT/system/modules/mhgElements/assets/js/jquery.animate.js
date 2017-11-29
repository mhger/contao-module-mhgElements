/*!
 * [mhgElements]
 * Copyright © 2017 Medienhaus Gersöne UG (haftungsbeschränkt)
 * https://www.medienhaus-gersoene.de
 */

$(window).load(function () {
    // animations
    if (jQuery().waypoint) {
        jQuery('.animate_fade, .animate_bounce, .animate_shake, .animate_atf, .animate_afc, .animate_afl, .animate_afr, .animate_aft, .animate_afb, .animate_wfc, ' +
                '.animate_hfc, .animate_rfc, .animate_rfl, .animate_rfr').each(function () {

            var $e = jQuery(this);

            new Waypoint({
                element: this,
                handler: function () {

                    if (!$e.hasClass('animate_start')) {
                        setTimeout(function () {
                            $e.addClass('animate_start');
                        }, 20);
                        this.destroy();
                    }
                },
                offset: '85%'
            });
        });

        // counter
        jQuery('.counter').each(function (index, elm) {
            var obj = $(this),
                    e = obj.find('.counter_number'),
                    count = parseInt(e.html()), // count to
                    number = 0, // inital
                    steps = 25;

            e.html(number);

            new Waypoint({
                element: this,
                handler: function () {
                    var step = Math.ceil((count - number) / steps),
                            i = Math.floor((count - number) / step),
                            handler = setInterval(function () {
                                number += step;
                                i--;
                                e.html(number);
                                if (i <= 0) {
                                    e.html(count);
                                    window.clearInterval(handler);
                                }
                            }, 50);
                    this.destroy();
                },
                offset: '85%'
            });
        });
    }
});


//if scrolled to top, restart animations
$(document).scroll(function (pos) {
    if ($(document).scrollTop() === 0) {

        $('.animate_start').removeClass('animate_start');

        if (jQuery().waypoint) {
            jQuery('.animate_fade, .animate_bounce, .animate_shake, .animate_atf, .animate_afc, .animate_afl, .animate_afr, .animate_aft, .animate_afb, .animate_wfc, ' +
                    '.animate_hfc, .animate_rfc, .animate_rfl, .animate_rfr').each(function () {
                var $e = jQuery(this);

                new Waypoint({
                    element: this,
                    handler: function () {

                        if (!$e.hasClass('animate_start')) {
                            setTimeout(function () {
                                $e.addClass('animate_start');
                            }, 20);
                            this.destroy();
                        }

                        if ($e.hasClass('animateOnce')) {
                            $e.removeClass('animate_fade animate_bounce animate_shake animate_atf animate_afc animate_afl animate_afr animate_aft animate_afb animate_wfc ' +
                                    'animate_hfc animate_rfc animate_rfl animate_rfr d1 d2 d3 d4 d5 d6 d7 d8 d9');
                        }

                    },
                    offset: '85%'
                });

            });
        }
    }
});