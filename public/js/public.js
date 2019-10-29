(function($) {
    var $window = $(window),
        $body = $('body'),
        settings = {
            parallax: true,
            parallaxFactor: 5,
            sliderSpeed: 1000
        };
    breakpoints({
        xlarge: ['1281px', '1680px'],
        large: ['981px', '1280px'],
        medium: ['737px', '980px'],
        small: ['481px', '736px'],
        xsmall: ['361px', '480px'],
        xxsmall: [null, '360px']
    });
    $window.on('load', function() {
        // window.setTimeout(function() {
        //     $body.removeClass('is-preload');
        // }, 100);
        window.setTimeout(function() {
            $(".alert").remove(); 
        }, 6000);
    });
    if (!browser.canUse('object-fit')) {
        $('.image[data-position]').each(function() {
            var $this = $(this),
                $img = $this.children('img');
            $this.css('background-image', 'url("' + $img.attr('src') + '")').css('background-position', $this.data('position')).css('background-size', 'cover').css('background-repeat', 'no-repeat');
            $img.css('opacity', '0');
        });
    }
    if (browser.name == 'ie' || browser.name == 'edge') $body.addClass('is-ie');

    $('.scrolly').scrolly();
    if (browser.name == 'ie' || browser.name == 'edge' || browser.mobile) settings.parallax = false;
    if (settings.parallax) {
        var $dummy = $(),
            $bg;
        $window.on('scroll.transit_parallax', function() {
            $bg.css('background-position', 'top left, center ' + (-1 * (parseInt($window.scrollTop()) / settings.parallaxFactor)) + 'px');
        }).on('resize.transit_parallax', function() {
            if (breakpoints.active('<=medium')) {
                $body.css('background-position', 'top left, top center');
                $bg = $dummy;
            } else $bg = $body;
            $window.triggerHandler('scroll.transit_parallax');
        });
        $window.on('load.transit_parallax', function() {
            setTimeout(function() {
                $window.trigger('resize.transit_parallax');
            }, 0);
        });
    }
    $('.slider-wrapper').each(function() {
        var $this = $(this),
            $slider = $this.children('.slider'),
            $indicators = $('<div class="indicators" />').appendTo($this),
            $slide = $slider.children(),
            $indicator, locked = false,
            i;
        for (i = 0; i < $slide.length; i++) $('<a href="#">' + (i + 1) + '</a>').appendTo($indicators);
        $indicator = $indicators.children('a').each(function(index) {
            var $this = $(this),
                $target = $slide.eq(index);
            $this.on('click', function(event, initial) {
                var x;
                event.stopPropagation();
                event.preventDefault();
                if ($this.hasClass('active')) return;
                if (locked) return;
                locked = true;
                x = ($target.position().left + $slider.scrollLeft()) - (Math.max(0, $slider.width() - $target.outerWidth()) / 2);
                $slide.addClass('inactive');
                $indicator.removeClass('active');
                $this.addClass('active');
                if (initial) {
                    $slider.scrollLeft(x);
                    $target.removeClass('inactive');
                    locked = false;
                } else {
                    $slider.stop().animate({
                        scrollLeft: x
                    }, settings.sliderSpeed, 'swing');
                    setTimeout(function() {
                        $target.removeClass('inactive');
                        locked = false;
                    }, Math.max(0, settings.sliderSpeed - 250));
                }
            });
        });
        $slide.on('click', function(event, initial) {
            var $this = $(this);
            $indicator.eq($this.index()).trigger('click', initial);
        });
        $slide.on('click', 'a', function(event) {
            if ($(this).parents('article').hasClass('inactive')) event.preventDefault();
        });
        $window.on('resize.transit_slider', function(event) {
            var $target = $slide.not('.inactive');
            $slider.scrollLeft(($target.position().left + $slider.scrollLeft()) - (Math.max(0, $slider.width() - $target.outerWidth()) / 2));
        });
        $slide.filter('.initial').trigger('click', true);
    });
})(jQuery);