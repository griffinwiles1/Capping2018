function addLike(url, data, prayid){
    var like = document.getElementById("like--" +prayid);
    var dislike = document.getElementById("dislike--" +prayid);
    var likepic = document.getElementById("like-pic--" +prayid);
    var dislikepic = document.getElementById("dislike-pic--" +prayid);
    var scorediv = document.getElementById("score--" +prayid);
    var score = parseInt(scorediv.innerHTML);

    $.ajax({
        type: "POST",
        url: url,
        data: data, 
        success: function (data){
            // alert(data);
            if(like.classList.contains("up-down-active")){
                like.classList.remove("up-down-active");
                likepic.src = "images/icons/thumbs-up-grey.png";
                var newscore = score - 1;
                scorediv.innerHTML = newscore;

            }else{
                like.classList.add("up-down-active");
                likepic.src ="images/icons/thumbs-up-purple.png";
                var newscore = score + 1;
                scorediv.innerHTML = newscore;

                if(dislike.classList.contains("up-down-active")){
                    dislike.classList.remove("up-down-active");
                    dislikepic.src = "images/icons/thumbs-down-grey.png";
                    var newscore = score + 2;
                    scorediv.innerHTML = newscore;
                }
            }
        }
    });
}

function addDislike(url, data, prayid){
    var like = document.getElementById("like--" +prayid);
    var dislike = document.getElementById("dislike--" +prayid);
    var likepic = document.getElementById("like-pic--" +prayid);
    var dislikepic = document.getElementById("dislike-pic--" +prayid);
    var scorediv = document.getElementById("score--" +prayid);
    var score = parseInt(scorediv.innerHTML);
    $.ajax({
        type: "POST",
        url: url,
        data: data, 
        success: function (result) {
            // alert(result);
            if(dislike.classList.contains("up-down-active")){
                dislike.classList.remove("up-down-active");
                dislikepic.src = "images/icons/thumbs-down-grey.png";
                var newscore = score + 1;
                scorediv.innerHTML = newscore;
            }else{
                dislike.classList.add("up-down-active");
                dislikepic.src = "images/icons/thumbs-down-purple.png";
                var newscore = score - 1;
                scorediv.innerHTML = newscore; 

                if(like.classList.contains("up-down-active")){
                    like.classList.remove("up-down-active");
                    likepic.src = "images/icons/thumbs-up-grey.png";
                    var newscore = score - 2;
                    scorediv.innerHTML = newscore;
                }
            }
            checkscore(newscore, data);
        }
    });
}

function checkscore(newscore, data){
    if(newscore <= -5){
        $.ajax({
            type: "POST",
            url: 'php/banPrayer.php',
            data: data, 
            success: function (data) {
                //alert(data);
            }
        });
    } else{
        return true;
    }
}