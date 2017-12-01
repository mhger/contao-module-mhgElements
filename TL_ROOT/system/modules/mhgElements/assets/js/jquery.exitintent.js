/**
 * Exit Intent Layer / Lightbox
 */
var exitintent = {
    win: $(window),
    doc: $(document),
    element: null,
    config: null,
    isOpen: false,
    cursor: {x: 0, y: 0},
    layer: null,
    main: function () {
        this.element = $('.mod_exitintent');

        if (this.element.length) {
            this.config = $.parseJSON(this.element.attr('data-json'));
            this.config.show = parseInt(this.config.show);
            this.config.steps = parseInt(this.config.steps);
            this.config.delay = parseInt(this.config.delay > 0 ? this.config.delay : 5) * 1000;
            this.config.edge = parseInt(this.config.edge);
            this.config.scroll = parseInt(this.config.scroll);
            this.config.timer = parseInt(this.config.timer);
            this.config.modal = parseInt(this.config.modal);

            if (this.config.show) {
                this.counter = 0;
                this.init();
            }
        }
    },
    limit: function () {
        return (this.config.steps < 1 || this.counter < this.config.steps) ? false : true;
    },
    init: function () {
        console.log('exitintent init');
        var that = this;

        if (!this.limit()) {
            // show timed
            if (this.config.timer) {
                this.autoTimer(this.config.timer * 1000);
            }

            // show by scroll distance
            if (this.config.scroll) {
                this.win.on('scroll.exitintent', function (e) {
                    if (that.win.scrollTop() > that.config.scroll) {
                        that.openLayer('scroll');
                    }
                });
            }

            // show by cursor position to edge resp. outside window
            if (this.config.edge) {
                if (document.hasFocus()) {
                    this.doc.on('mouseleave.exitintent focusout.exitintent', function (e) {
                        that.openLayer('mouseout');
                    });

                    this.win.on('mousemove.exitintent', function (e) {
                        that.cursor = {x: e.clientX, y: e.clientY};
                        if (that.isTouched()) {
                            that.openLayer('cursor');
                        }
                    });
                } else {
                    this.openLayer('noFocus');
                }
            }
        }
    },
    stop: function () {
        this.win.off('.exitintent');
        this.doc.off('.exitintent');
    },
    autoTimer: function (t) {
        var that = this;

        setTimeout(function () {
            that.openLayer('timer');
        }, t);
    },
    openLayer: function (trigger) {
        console.log('trigger open: ' + trigger);
        this.stop();

        if (!this.isOpen && !this.limit()) {
            var that = this,
                    body = $('body');

            if (this.layer === null) {
                this.layer = $('<div class="exitintent_layer ' + this.config.theme + '"><div class="inside_wrapper"><i class="close">X</i>' + this.element.html() + '</div></div>');
                body.append(this.layer);
            }

            this.isOpen = true;
            body.addClass('exitintent_open');
            this.counter++;

            if (this.config.modal) {
                this.layer.on('click.exitintent', '.close', function (e) {
                    that.layer.off('.exitintent');
                    that.closeLayer();
                });
            } else {
                this.layer.on('click.exitintent', function (e) {
                    var target = $(e.target);
                    if (target.is('.exitintent_layer') || target.is('.close')) {
                        that.layer.off('.exitintent');
                        that.closeLayer();
                    }
                });
            }
        }
    },
    closeLayer: function () {
        if (this.isOpen) {
            var that = this,
                    body = $('body');

            body.removeClass('exitintent_open');
            this.isOpen = false;

            // re-initialize
            setTimeout(function () {
                that.init();
            }, this.config.delay);
        }
    },
    isTouched: function (direction) {
        direction = typeof direction === 'undefined' ? null : direction;

        if (null !== direction) {
            return false;
            if (direction === 'top' && this.cursor.y <= this.config.edge) {
                return true;
            } else if (direction === 'bottom' && this.cursor.y >= (this.win.height() - this.config.edge)) {
                return true;
            } else if (direction === 'left' && this.cursor.x <= this.config.edge) {
                return true;
            } else if (direction === 'right' && this.cursor.x >= (this.win.width() - this.config.edge)) {
                return true;
            }
        } else {
            if (this.isTouched('left') || this.isTouched('right') || this.isTouched('top') || this.isTouched('bottom')) {
                return true;
            }
        }

        return false;
    }
};

/* initialisation */
$(document).ready(function () {
    exitintent.main();
});