function mobileMessage() {
    console.log("Mobile Message");
    var feed = document.getElementById('msg-feed');
    var users = document.getElementById('msg-users');
    if(!feed.classList.contains('hidden')) {
        //If the search user bar is hidden
        feed.classList.add('hidden');
        users.setAttribute('style', 'display:block')
    } else {
        users.removeAttribute('style', 'display:block')
        feed.classList.remove('hidden');
    }
}
