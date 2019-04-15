function ShowCompose(){
    var body = document.getElementById('compose-prayer');
    var overlay = document.getElementById('overlay');
    var button = document.getElementById('startprayer');
    var close = document.getElementById('closebutton');
    var page = document.getElementById('body');

    var height = document.body.scrollTop;
    page.setAttribute('style' , 'position:fixed');
    page.style.top -= height;
    var par = body.parentNode;
    par.removeChild(body);
    overlay.appendChild(body);
    // body.setAttribute('style', 'overflow:hidden');
    button.removeAttribute('onclick');
    $(body).fadeIn();
    $(overlay).fadeIn();
    close.setAttribute('onclick','CloseCompose('+height+')');
}

function CloseCompose(height){
    var box = document.getElementById('compose-prayer');
    var overlay = document.getElementById('overlay');
    var button = document.getElementById('startprayer');
    var close = document.getElementById('closebutton');
    var page = document.getElementById('body');
    page.removeAttribute('style' , 'position:fixed');
    document.body.scrollTop = height;
    close.removeAttribute('onclick');
    $(box).fadeOut();
    $(overlay).fadeOut()
    button.setAttribute('onclick','ShowCompose()');
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if(input.files[0].size >= 500000){
                $('#upload-size-error')
                .attr('style','display:block');
                $('#uploadpreview')
                .attr('style','display:none');
            }else{
                $('#uploadpreview')
                .attr('src', e.target.result)
                .attr('style','display:block');
                $('#uploadbutton').html('Change Picture');
                $('#upload-size-error')
                .attr('style','display:none');
            };
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addTag(inp){
    var tagval = inp.value;
    var check = document.getElementById('tag--'+tagval);
    tagval = tagval.replace('#', '');
    if(check == null){
        var dest = document.getElementById('cur-tags');
        var newdiv = document.createElement("DIV");
        newdiv.setAttribute('class', 'tag');
        newdiv.setAttribute('id', 'tag--'+tagval);
        var tagdesc = document.createElement('p');
        tagdesc.setAttribute('class', 'tag-desc');
        tagdesc.innerHTML = tagval;
        var hidinp = document.createElement("INPUT");
        hidinp.setAttribute('type', 'text');
        hidinp.setAttribute('class', 'hidden');
        hidinp.setAttribute('value', tagval);
        hidinp.setAttribute('name', 'tag--'+tagval);
        var droptag = document.createElement("img");
        droptag.setAttribute('class', 'drop-tag');
        droptag.setAttribute('src', 'images/icons/close.png');
        droptag.setAttribute('onclick', 'DropTag("'+tagval+'")')
        if(tagval != ''){
            
            dest.appendChild(newdiv);
            newdiv.appendChild(tagdesc);
            newdiv.appendChild(hidinp);
            newdiv.appendChild(droptag);
        
            inp.value = '';
        console.log(hidinp);
        console.log(tagdesc);
        console.log(tagval);
    }
    }
}

function DropTag(val){
    var div = document.getElementById('tag--'+val);
    var pnode = document.getElementById('cur-tags')
    pnode.removeChild(div);

}

function checkPrayerLength(inp){
    var len = inp.value.length;
    var p = document.getElementById('characters-left');
    if(len >= 139){
        var value = inp.value;
        value = value.substring(0, 139);
        inp.value = value;
        return true;
    }
    var left = 140 - len;
    p.innerHTML = left + ' Characters Left';
    return false;
}

function checkTagLength(inp){
    var len = inp.value.length;
    if(len >= 13){
        var value = inp.value;
        value = value.substring(0, 14);
        inp.value = value;
        return true;
    }
    return false;
}