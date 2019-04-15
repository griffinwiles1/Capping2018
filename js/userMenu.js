    function ShowMenu(){
        var menu = document.getElementById('header-profile-menu');
        var button = document.getElementById('header-profile-pic-link');
        button.removeAttribute('onclick');
        $(menu).fadeIn();
        button.setAttribute('onclick','CloseMenu()');
    }

    function CloseMenu(){
        var menu = document.getElementById('header-profile-menu');
        var button = document.getElementById('header-profile-pic-link');
        button.removeAttribute('onclick');
        $(menu).fadeOut();
        button.setAttribute('onclick','ShowMenu()');
    }

    function ShowMenuMobile(){
        var menu = document.getElementById('header-profile-menu');
        var button = document.getElementById('mobile-header-link-profile');
        button.removeAttribute('onclick');
        $(menu).fadeIn();
        button.setAttribute('onclick','CloseMenuMobile()');
    }

    function CloseMenuMobile(){
        var menu = document.getElementById('header-profile-menu');
        var button = document.getElementById('mobile-header-link-profile');
        button.removeAttribute('onclick');
        $(menu).fadeOut();
        button.setAttribute('onclick','ShowMenuMobile()');
    }

