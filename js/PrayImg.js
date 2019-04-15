function center_img(element) {
    var h = element.clientHeight;
    // console.log(h);
    if(h >= 400){
        var margin = h - 400;
        var offset = margin / -2;
        element.style.top = offset +"px";
    }
}

function showLargeImg(img){
    var overlay = document.getElementById('overlay');
    var body = document.getElementById('imglarge-body');
    var close = document.getElementById('closelargeimg');
    var page = document.getElementById('body');
    var height = document.body.scrollTop;
    page.setAttribute('style' , 'position:fixed');
    page.style.top -= height;
    var par = body.parentNode;
    par.removeChild(body);
    overlay.appendChild(body);
    $(overlay).fadeIn();
    $(body).fadeIn();
    $('#imglarge').attr('src', img.src);
    close.setAttribute('onclick','CloseLargeImg('+height+')');
}

function CloseLargeImg(height){
    var overlay = document.getElementById('overlay');
    var body = document.getElementById('imglarge-body');
    var close = document.getElementById('closelargeimg');
    var page = document.getElementById('body');
    page.removeAttribute('style' , 'position:fixed');
    document.body.scrollTop = height;
    // page.removeAttribute('style' , 'position:fixed');
    close.removeAttribute('onclick');
    $(overlay).fadeOut();
    $(body).fadeOut();
}
