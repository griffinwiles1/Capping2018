var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.mobile-search-box').outerHeight();

// on scroll, let the interval function know the user has scrolled
$(window).scroll(function(event) {
    didScroll = true;
});

// run hasScrolled() and reset didScroll status
setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.mobile-search-box').removeClass('mobile-search-box').addClass('mobile-search-box-up');
        $('.mobile-messages').hide();
        $('.mobile-header-link-prayer').hide();
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.mobile-search-box-up').removeClass('mobile-search-box-up').addClass('mobile-search-box');
            $('.mobile-messages').show();
            $('.mobile-header-link-prayer').show();
        }
    }

    lastScrollTop = st;
}
