function scrollBottom(){
    console.log('it got here');
    var div = document.getElementById('msg-convo');
    console.log(div);
    console.log(div.scrollHeight);
    div.scrollTop = div.scrollHeight;
    console.log(div.scrollTop);
}