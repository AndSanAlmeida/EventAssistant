! function(e, n, t) {
    console.log("init");
    var o = {
        init: function(t) {
            o.owlCarousel(), o.portfolio(), o.lightCase(), o.counter(), o.scrollTo(), o.navbarChange()
        },
        owlCarousel: function() {
            e(".slideshow").owlCarousel({
                loop: !0,
                items: 1,
                nav: !0,
                navSpeed: 1e3,
                dots: !0,
                dotSpeed: 1e3,
                autoplay: !0,
                autoplaySpeed: 1e3,
                autoplayTimeout: 5e3,
                navText: ['<span class="icon-nav-slider nav-left"></span>', '<span class="icon-nav-slider nav-right"></span>']
            })
        },
        portfolio: function() {
            var n = e(".grid-portfolio").isotope({
                itemSelector: ".grid-item",
                masonry: {
                    gutter: ".gutter-sizer",
                    columnWidth: ".grid-sizer"
                },
                percentPosition: !0
            });
            return e(".filter-button-group").on("click", "a", function() {
                var t = e(this).attr("data-filter");
                n.isotope({
                    filter: t
                })
            }), e(".btn-filter a.is-checked").addClass("active"), e(".btn-filter a").on("click", function() {
                e(".btn-filter a").removeClass("active"), e(this).addClass("active")
            }), !1
        },
        lightCase: function() {
            jQuery(t).ready(function(t) {
                t("a[data-rel^=lightcase]").lightcase()
            })
        },
        counter: function() {
            e("#counter").each(function() {
                e(this).waypoint({
                    handler: function(t) {
                        e(".number").countTo({
                            speed: 1e3
                        }), this.destroy()
                    },
                    offset: "80%"
                })
            })
        },
        scrollTo: function() {
            e("#navbar-nav-header .nav-link").on("click", function(t) {
                var n, o = e(this).attr("href");
                n = "#home" !== o ? e(o).offset().top - 50 : 0, e("html, body").animate({
                    scrollTop: n
                }, 750), t.preventDefault()
            })
        },
        navbarChange: function() {
            e(n).scroll(function() {
                var t = e(n).scrollTop();
                return 150 < t ? (e("nav").removeClass("navbar-transparent"), e("body").addClass("not-on-top")) : (e("body").removeClass("not-on-top"), e("nav").addClass("navbar-transparent")), !1
            })
        }
    };
    e(t).ready(function() {
        o.init(e)
    })
}(window.jQuery, window, document);

// ToolTip
$("[data-toggle=\"tooltip\"]").tooltip({
    placement:'bottom',
    container: '.boxed-page'
});

// Pophovers
$("[data-toggle=\"popover\"]").popover({html:true});

// Copy to Clipboard
function CopyToClipboard(value, showNotification, notificationText) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(value).select();
    document.execCommand("copy");
    $temp.remove();

    if (typeof showNotification === 'undefined') {
        showNotification = true;
    }
    if (typeof notificationText === 'undefined') {
        notificationText = "Copied to clipboard";
    }

    var notificationTag = $("div.copy-notification");
    if (showNotification && notificationTag.length == 0) {

        $('.toast').toast('show');
    }
}