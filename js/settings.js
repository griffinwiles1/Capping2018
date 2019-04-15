function updateProfile(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if(input.files[0].size >= 500000){
                $('#profile-size-error')
                .attr('style','display:block');
            }else{
                $('#profile-preview')
                .attr('src', e.target.result)
                .attr('style','display:block');
                $('#profile-size-error')
                .attr('style','display:none');
            };
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function updateBanner(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if(input.files[0].size >= 500000){
                $('#banner-size-error')
                .attr('style','display:block');
            }else{
                $('#banner-preview')
                .attr('src', e.target.result)
                .attr('style','display:block');
                $('#banner-size-error')
                .attr('style','display:none');
            };
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function checkUsernameLength(inp){
        var len = inp.value.length;
        if(len >= 12){
            var value = inp.value;
            value = value.substring(0, 12);
            inp.value = value;
            return false;
        }
        return true;
}

function checkNameLength(inp){
    var len = inp.value.length;
    if(len >= 20){
        var value = inp.value;
        value = value.substring(0, 20);
        inp.value = value;
        return false;
    }
    return true;
}