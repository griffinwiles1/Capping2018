<?php
    header("Content-type: text/css; charset: UTF-8");
    include '../config/dbconfig.php';
    include '../config/functions.php';
    include '../config/permissions.php';
    /**
     *
     * Themes for the site.
     * The Gold Theme will not be live because it sucks
     *
     */
    $theme = [
        'LIGHT'=>['background'=>'#efe6f3',
                  'text'=>'rgba(0,0,0,.65)',
                  'boxcolor'=>'#f3e1ff',
                  'link'=>'#a415df',
                  'feed'=>'#ffffff',
                  'menuborder'=>'rgba(0,0,0,.3)',
                  'boldcolor'=>'#000000',
                  'buttoncolor'=>'#a415df',
                  'buttonhover'=>'#8405af',
                  'buttontext'=>'#f3e1ff',
                  'commentbox'=>'#fbfbfb'
                ],
        'DARK'=>['background'=>'#140026',
                  'text'=>'rgba(255,255,255,.65)',
                  'boxcolor'=>'#1b0036',
                  'link'=>'rgba(200,0,200,.65)',
                  'feed'=>'#250036',
                  'menuborder'=>'#111111',
                  'boldcolor'=>'#ffffff',
                  'buttoncolor'=>'#a415df',
                  'buttonhover'=>'#8405af',
                  'buttontext'=>'#ffffff',
                  'commentbox'=>'#320942'
                ],
        'GOLD'=>['background'=>'#ffff66',
                  'text'=>'rgba(0,0,0,.65)',
                  'boxcolor'=>'#ffff12',
                  'link'=>'#a415df',
                  'feed'=>'#ffffbb',
                  'menuborder'=>'rgba(0,0,0,.3)',
                  'boldcolor'=>'#000000',
                  'buttoncolor'=>'#a415df',
                  'buttonhover'=>'#8405af',
                  'buttontext'=>'#f3e1ff',
                  'commentbox'=>'#ffff88'
            ]
    ];
    $chosen = 'LIGHT';
    if($id != ''){
        $curthemequery = "SELECT u.theme
                  FROM USERS u
                  WHERE u.userid = $id";
        $curthemeresult = $db->fetchQuery($curthemequery);

        if($curthemeresult[0]['theme'] != Null){
            $chosen = $curthemeresult[0]['theme'];
        }
    }

    $backgroundcolor = $theme[$chosen]['background'];
    $boxcolor = $theme[$chosen]['boxcolor'];
    $textcolor = $theme[$chosen]['text'];
    $linkcolor = $theme[$chosen]['link'];
    $feedcolor = $theme[$chosen]['feed'];
    $menuborder = $theme[$chosen]['menuborder'];
    $boldcolor = $theme[$chosen]['boldcolor'];
    $buttoncolor = $theme[$chosen]['buttoncolor'];
    $buttonhover = $theme[$chosen]['buttonhover'];
    $commentcolor = $theme[$chosen]['commentbox'];
    $buttontext = $theme[$chosen]['buttontext'];
?>
/*************** COMMON ******************/
    html {
        font-size: 16px;
    }

    body {
        margin: 0px;
        background-color: <?php echo $backgroundcolor ?>;
        font-family: 'Work Sans' !important;
    }

    ::placeholder {
        color: rgba(0,0,0,.4);
    }

    p {
        color: <?php echo $textcolor?>;
        margin-block-start: 0px;
        margin-block-end: 0em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    div {
        margin-block-start: 0px;
        margin-block-end: 0em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        margin: 0px;
        padding: 0px;
    }

    h2 {
        font-family: 'Work Sans';
    }

    h3 {
        margin-block-start: 0em;
        margin-block-end: 0em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }

    input {
        margin-bottom: 10px;
        height: 35px;
        border-color: rgb(0,0,0,.15);
        border-radius: 5px;
        text-indent: 5px;
        font-size: 16px;
        font-family: 'Work Sans' !important;
    }

    input, textarea, select, button, text {
        font-family: 'Work Sans';
    }

    select {
        margin-bottom: 10px;
        width: 70%;
        height: 35px;
        border-color: rgb(0,0,0,.15);
        border-radius: 5px;
        text-indent: 5px;
    }

    textarea {
        resize: none;
        overflow: hidden;
        min-height: 35px;
        width: 95%;
        border-color: #1DA1F2;
        font-size: 16px;
        border-radius: 7px;
        text-indent: 5px;
        font-family: 'Work Sans';
    }

    form {
        margin-bottom: 0em;
    }

    textarea:focus {
        outline: none;
    }

    .error {
        color: #b31b1b;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    ul {
        padding: 0px;
        display: flex;
    }

    #header-profile-menu-list {
        display: block;
    }

    li {
        list-style-type: none;
    }

    .hidden {
        display: none;
    }

    .logo-box {
        width: 20%;
    }

    .logo {
        height: 46px;
        width: 46px;
        border-radius: 50%;
        border-color: <?php echo $boxcolor ?>;
    }

    .logo-li {
        transform: translateY(-29%);
        margin: auto;
    }

    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    button {
        width: auto;
        height: auto;
        padding: 7px;
        border-radius: 100px;
        border: 1px solid <?php echo $boldcolor?>;
        background-color: <?php echo $buttoncolor?>;
        color: <?php echo $buttontext?>;
        display: inline-block;
        font-weight: bold;
        font-size: 16px;
        font-family: 'Work Sans';
    }

    button:hover {
        cursor: pointer;
        background-color: <?php echo $buttonhover ?>;
    }

    label {
        width: auto;
        height: auto;
        padding: 7px;
        border-radius: 100px;
        border: 1px solid <?php echo $boldcolor?>;
        background-color: <?php echo $buttoncolor?>;
        color: <?php echo $buttontext?>;
        display: inline-block;
        font-weight: bold;
    }

    label:hover {
        cursor: pointer;
        background-color: <?php echo $buttonhover ?>;
    }

    .overlay {
        position: fixed;
        height: calc(100% + 20px);
        width: 100%;
        background-color: rgba(0,0,0,.6);
        z-index: 99;
        overflow-y: scroll;
    }

    .close {
        height: 30px;
        width: 30px;
        position: relative;
        margin-left:calc(100% - 45px);
        transform: translateY(-25px);
    }

    .close:hover {
        cursor: pointer;
    }

    ::-webkit-scrollbar {
        width: 15px;
    }

    ::-webkit-scrollbar-track {
        transform: translateX(-5px);
    }

    ::-webkit-scrollbar-thumb {
        background: #cccccc;
        border-radius: 8px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #999999;
        cursor: pointer;
    }
/*************** HEADER ******************/
    .header {
        height: 50px;
        width: 100%;
        border-bottom: 1px solid <?php echo $menuborder?>;
        background-color: <?php echo $boxcolor ?>;
        position: fixed;
        z-index: 50;
    }

    .mobile-header {
        display: none;
    }

    .header-box {
        width: 96%;
        margin-right: 10px;
        margin-left: 40px;
        display: flex;
        height: calc(100% - 16px);
    }

    .logo-box {
        width: 6%;
    }

    .header-link-box {
        width: 40%;
    }

    .header-link>a {
        color: <?php echo $textcolor ?>;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
        display: inline-block;
        height: 100%;
        width: calc(100% + 40px);
        transform: translateX(-20px);
    }

    .header-link {
        height: 100%;
        width: auto;
        border-bottom: 1px solid <?php echo $linkcolor ?>;
        padding-right: 20px;
        padding-left: 20px;
    }

    .header-link:hover {
        height: calc(100% - 2px);
        border-bottom-width: 3px;
        border-bottom-color: <?php echo $linkcolor ?>;
    }

    .active {
        height: calc(100% - 2px);
        border-bottom-width: 3px;
        border-bottom-color: <?php echo $linkcolor?>;
    }

    .active a {
        color: <?php echo $linkcolor ?>;
    }

    .header-link:hover a {
        color: <?php echo $linkcolor?>;
    }

    .header-profile-pic {
        width: 52%;
        transform: translateY(-35%);
    }

    #header-profile-pic-link:hover {
        cursor: pointer;
    }

    #header-profile-pic-link {
        position: absolute;
        right: 36px;
        margin-top: -13px;
    }

    .index-profile-pic {
        border-radius: 50%;
        height: 45px;
        width: 45px;
        border-color: <?php echo $boxcolor?>;
        color: #fff;
        margin: auto;
    }

    #header-profile-menu {
        height: auto;
        width: 200px;
        position: fixed;
        margin-top: 50px;
        right: 0px;
        background-color: <?php echo $feedcolor?>;
        border-radius:0px 0px 5px 5px;
        border: 1px solid <?php echo $menuborder ?>;
        z-index: 1000;
    }

    .header-profile-menu-name {
        display: block;
        height: calc(25% - 10px);
        width: 100%;
        padding-top: 10px;
        margin-block-start: 0em;
        margin-block-end: 0em;
        border-bottom: 1px solid <?php echo $menuborder ?>;
    }

    .header-profile-menu-name:hover {
        background-color: <?php echo $backgroundcolor ?>;
    }

    .header-profile-menu-name-name>a {
        color: <?php echo $boldcolor ?>;
        font-weight: bold;
        text-decoration: none;
        font-size: 22px;
        display: inline-block;
        height: 100%;
        width: 100%;
        padding-left: 10px;
        width: calc(100% - 10px);
    }

    .header-profile-menu-name-name {
        height: 40%;
    }

    .header-profile-menu-name-username {
        height: 60%;
    }

    .header-profile-menu-name-username>a {
        padding-bottom: 10px;
        color: <?php echo $textcolor ?>;
        text-decoration: none;
        font-size: 16px;
        padding-left: 20px;
        width: calc(100% - 20px);
        display: inline-block;
        height: 100%;
    }

    .header-profile-menu-settings {
        display: block;
        height: auto;
        margin-block-start: 0em;
        margin-block-end: 0em;
        border-bottom: 1px solid <?php echo $menuborder ?>;
    }

    .header-profile-menu-list-item:hover {
        background-color: <?php echo $backgroundcolor?>;
    }

    .header-profile-menu-list-item>a {
        color: <?php echo $textcolor ?>;
        text-decoration: none;
        font-size: 16px;
        padding-left: 10px;
        width: calc(100% - 10px);
        display: inline-block;
        padding-top: 10px;
        height: calc(100% - 10px);
    }

    .header-profile-menu-list-item {
        height: 40px;
    }

    .header-profile-menu-logout {
        display: block;
        height: auto;
        margin-block-start: 0em;
        margin-block-end: 0em;
    }

    .header-profile-menu-logout .header-profile-menu-list-item:hover {
        border-radius: 0px 0px 5px 5px;
    }

    #sort-compose {
        margin-left: 3%;
        margin-top: -8px;
    }
/*************** LOGIN PAGE **************/
    .login-body {
        width: 40%;
        float: right;
        margin-right: 6%;
        margin-bottom: 24px;
        margin-top: 96px;
    }

    .login-form-box {
        width: auto;
        height: 280px;
        width: 100%;
        background-color: <?php echo $boxcolor?>;
        border: 1px solid <?php echo $menuborder ?>;
        border-radius: 5px;
        margin: auto;
    }

    .login-form-box-body {
        width: 100%;
        background-color: #ffffff;
        padding-bottom: 10px;
        border-bottom: 1px solid <?php echo $menuborder ?>;
        border-radius: 5px 5px 0px 0px;
    }

    #login-form-inputs {
        margin: auto;
        width: 90%;
        margin-top: 10px;
    }

    .submit-button {
        width: auto;
        height: auto;
        padding: 7px;
        border-radius: 100px;
        border: 1px solid <?php echo $boldcolor?>;
        background-color: <?php echo $buttoncolor?>;
        color: <?php echo $buttontext?>;
        padding-right: 15px;
        padding-left: 15px;
        font-weight: bold;
        display: inline-block;
    }

    .submit-button:hover {
        cursor: pointer;
        background-color: <?php echo $buttonhover ?>;
    }

    .pray-desc {
        width: 40%;
        float: left;
        border-radius: 5px;
        background-color: <?php echo $boxcolor ?>;
        margin-left: 6%;
        margin-top: 96px;
    }

    .pray-desc-header {
        text-align: center;
        padding: 0px;
        border: 1px solid <?php echo $menuborder ?>;
        border-radius: 5px 5px 0px 0px;
    }
    .pray-desc-header h2 {
        font-size: 20px;
    }

    .pray-desc-body {
        background-color: #fff;
        padding: 20px;
        border: 1px solid <?php echo $menuborder ?>;
        border-top: 0px;
        border-radius: 0px 0px 5px 5px;
    }

    .pray-desc-body p {
        font-size: 18px;
    }
/*************** NEW ACCOUNT *************/
    .newaccount-body {
        width: 50%;
        margin: auto;
        padding-top: 72px;
        padding-bottom: 20px;
    }

    .newaccount-form-box {
        width: auto;
        max-width: 835px;
        border: 1px solid rgba(0,0,0,.2);
        background-color: #ffffff;
        padding: 25px 0px 25px 60px;
        font-family: 'Work Sans';
        border-radius: 5px;
    }

    .verifyerror {
        color: #ff0000;
    }

    #failedpassword {
        color: #ff0000;
    }

    #invalidChars {
        color: #ff0000;
    }

    .religions-container {
        display: flex;
        flex-wrap: wrap;
    }
/*************** INDEX *******************/
    .index-body {
        display: flex;
        width: 96%;
        margin: auto;
        height: auto;
        padding-bottom: 25px;
        padding-top: 60px;
    }

    .index-left-box {
        width: 20%;
        display: table;
        height: auto;
        max-height: 600px;
        background-color: <?php echo $boxcolor ?>;
        margin-top: 20px;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
    }

    .index-left-box p {
        padding: 8px;
    }

    .index-center-box {
        width: 50%;
        margin-left: 6%;
        margin-right: 6%;
        height: auto;
    }

    .index-right-box {
        width: 20%;
        background-color: <?php echo $boxcolor ?>;
        margin-top: 20px;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
        display: table;
    }

    .index-right-box p {
        padding-left: 16px;
    }

    .compose-prayer {
      overflow: hidden;
      padding-top: 12%;
      position: relative;
      height: 75px;
    }

    .compose-prayer iframe {
       border: 0;
       height: 100%;
       left: 0;
       position: absolute;
       top: 0;
       width: 100%;
    }

    .index-name {
        padding: 0px;
        margin: 0px;
        font-weight: bold;
        font-size: 20px;
    }

    .index-username {
        padding: 0px 0px 0px 5px;
        margin: 0px;
        font-size: 16px;
    }

    .index-left-stat-box {
        width: 33%;
        display: block;
        padding-bottom: 10px;
    }

    .featured-tag-box {
        padding-bottom: 20px;
    }

    .index-trends-header {
        padding-top: 12px;
        padding-bottom: 12px !important;
        margin-bottom: 4px;
        font-size: 20px;
        border-bottom: 1px solid <?php echo $menuborder ?>;
    }
/*************** COMPOSE *****************/
    .compose-header {
        width: auto;
        margin: auto;
    }

    #startprayer {
        height: auto;
        background-color: <?php echo $buttoncolor ?>;
        color: <?php echo $buttontext?>;
        padding: 4px;
        border-radius: 100px;
        border: 1px solid <?php echo $textcolor?>;
        font-size: 22px;
        padding-right: 15px;
        padding-left: 15px;
        font-weight: bold;
        width: 60px;
        text-align: center;
    }

    #startprayer:hover {
        cursor: pointer;
        background-color: <?php echo $buttonhover ?>;
    }

    .prayer-box {
        height: auto;
        width: 50%;
        margin: auto;
        background-color: <?php echo $feedcolor?>;
        margin-top: 60px;
        border-radius: 5px;
        margin-bottom: 100px;
    }

    #closebutton {
        height: 30px;
        width: 30px;
    }

    #closebutton:hover {
        cursor: pointer;
    }

    .close-button {
        transform: translate(-20px, 20px);
    }

    .compose-content-bottom {
        display: inline-flex;
        margin-block-start: 0em;
        margin-block-end: 0em;
        margin-top: 25px;
        width: 100%;
    }

    .compose-content {
        background-color: <?php echo $boxcolor?>;
        padding: 50px;
        border-top-style: solid;
        border-top-color: #cccccc;
        border-top-width: 1px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #compose-area {
        min-height: 100px;
        width: 100%;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }

    #tags-area {
        width: 100%;
        border-color: #1DA1F2;
        font-size: 16px;
        border-bottom-left-radius: 7px;
        border-bottom-right-radius: 7px;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        text-indent: 5px;
        font-family: 'Work Sans';
        border-width: 1px;
    }

    #tags-area:focus {
        outline: none;
    }

    #submit-prayer {
        width: auto;
        height: auto;
        padding: 7px;
        border-radius: 100px;
        border: 1px solid <?php echo $boldcolor?>;
        background-color: <?php echo $buttoncolor?>;
        color: <?php echo $buttontext?>;
        font-size: 16px;
        font-weight: bold;
    }

    #submit-prayer:hover {
        cursor: pointer;
        background-color: <?php echo $buttonhover ?>;
    }

    .compose-img-upload {
       width: auto;
       margin-right: auto;
    }

    .compose-submit {
        width: auto;
    }

    #preview {
        margin-top: 20px;
        width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    #uploadpreview {
        width: 100%;
        border-radius: 5px;
        border: 1px solid #000;
    }

    #upload-size-error {
        color: #ff0000;
    }

    #cur-tags {
        display: flex;
        flex-wrap: wrap;
    }

    .tag {
        border: 1px solid <?php echo $menuborder ?>;
        padding-top: 3px;
        padding-bottom: 3px;
        text-align: center;
        margin-right: 5px;
        padding-left: 5px;
        padding-right: 5px;
        border-radius: 3px;
        background-color: <?php echo $backgroundcolor?>;
        display: flex;
        margin-top: 8px;
    }

    .tag-desc {
        padding-right: 5px;
    }

    .drop-tag {
        height: 10px;
        width: 10px;
        transform: translateY(5px);
    }

    .drop-tag:hover {
        cursor: pointer;
    }
/*************** PROFILE *****************/
    .profile-banner {
        width: 100%;
        max-height: 500px;
        overflow: hidden;
        padding-top: 50px;
    }

    .profile-page-body{
        height:100%;
    }

    .profile-banner-box {
        width: 100%;
    }

    .profile-body {
        position: relative;
        width: 50%;
        margin: auto;
        transform: translateY(-155px);
        text-align: center;
        padding-bottom: 32px;
    }

    .profile-header-name {
        font-size: 2.6em;
        width: auto;
        color: <?php echo $textcolor ?>;
    }

    .profile-profile-pic {
        border-radius: 50%;
        width: 240px;
        height: 240px;
        color: #fff;
        transform: translateY(-132px);
        border: 5px solid <?php echo $menuborder?>;
        margin: auto;
        display: block;
        position: relative;
    }

    .profile-banner-pic {
        height: auto;
        width: 100%;
    }

    #profile-prayers {
        width: 50%;
        margin: auto;
        transform: translateY(-205px);
        margin-bottom:25px;
    }

    #bio {
        width: 50%;
        margin: auto;
        text-align: center;
        transform: translateY(-215px);
        color: <?php echo $textcolor ?>;
    }

    #profile-stats {
        transform: translateY(-185px);
        width: 50%;
        margin: auto;
        display: table;
        height: auto;
        max-height: 600px;
        background-color: <?php echo $feedcolor ?>;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
        margin-bottom: 36px;
    }

    #profile-stats p {
        padding: 6px;
        padding-left: 12px;
        padding-bottom: 8px;
    }

    .trends-header {
        margin-top: 4px;
        margin-bottom: 10px;
        font-size: 20px;
        background-color: <?php echo $commentcolor ?>;
        font-size: 20px;
    }
/*************** USERSETTINGS ************/
    .usersettings-box {
        display: block;
        margin-block-start: 0em;
        margin-block-end: 0em;
    }

    .settings-link {
        border: 1px solid <?php echo $menuborder ?>;
        height: 60px;
        background-color: #fefefe;
        width: 250px;
    }

    .settings-link>a {
        position: relative;
        color: <?php echo $textcolor ?>;
        text-decoration: none;
        font-size: 20px;
        text-align: center;
        display: block;
        height: calc(100% - 21px);
        padding-top: 18px;
        width: 100%;
    }

    .settings-link:hover {
        background-color: <?php echo $backgroundcolor ?>;
    }

    .current {
        background-color: <?php echo $buttoncolor ?>;
    }

    .current:hover{
        background-color: <?php echo $buttoncolor ?>;
    }
/*************** PRAYER FEED *************/
    .feed-content-header {
        margin-block-start: 0em;
        margin-block-end: 0em;
    }

    #deleteprayer {
        height: 15px;
        width: 15px;
    }

    #deleteprayer:hover {
        cursor: pointer;
    }

    .feed-content-name {
        width: 100%;
    }

    .feed-container {
        border: 1px solid <?php echo $menuborder ?>;
        width: 99.6%;
        height: auto;
        background-color: <?php echo $feedcolor ?>;
        margin-top: 20px;
        padding-top: 10px;
        border-radius: 5px;
    }

    .feed-box {
        padding: 20px;
        padding-bottom: 16px;
        display: flex;
        border-bottom: 1px solid <?php echo $backgroundcolor ?>;
    }

    .feed-profile-img-box {
        width: 10%;
    }

    .feed-profile-img {
        height: 46px;
        width: 46px;
        border-radius: 50%;
    }

    .feed-content-box {
        width: 90%;
        margin-left: 20px;
    }

    .feed-profile-link:hover {
        text-decoration: none;
    }

    .feed-profile-name {
        color: <?php echo $boldcolor?>;
        font-weight: bold;
        display: inline-block;
        font-size: 22px;
        padding-bottom: 5px;
    }

    .feed-profile-username {
        color: <?php echo $textcolor ?>;
        display: inline-block;
    }

    .feed-content {
        overflow-wrap: break-word;
        white-space: pre-line;
        white-space: pre-wrap;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .feed-interact-menu {
        margin-block-end: 0em;
    }

    .feed-like {
        width: auto;
        display: inline-flex;
        font-weight: bold;
    }

    .feed-downvote {
        width: auto;
        margin-left: 5%;
        display: inline-flex;
        text-align: center;
        font-weight: bold;
    }

    .feed-like:hover {
        cursor: pointer;
    }

    .feed-downvote:hover {
        cursor: pointer;
    }

    .up-down-active {
        color: <?php echo $linkcolor?>;
    }

    .prayer-date {
        margin-left: calc(100% - 300px);
    }

    .like-button {
        width: 20px;
        height: 20px;
        border-radius: 50%;

    }

    .feed-num-likes {
        color: <?php echo $textcolor ?>;
        padding-left: 5px;
        font-size: 16px;
    }


    .feed-img-box {
        width: 90%;
        margin-top: 10px;
        margin-bottom: 5px;
        vertical-align: middle;
    }

    .feed-img {
        margin: auto;
        width: 100%;
        position: relative;
    }

    .feed-img:hover {
        cursor: pointer;
    }

    .feed-img-container {
        max-height: 400px;
        margin: auto;
        overflow: hidden;
        border: 1px solid <?php echo $boldcolor ?>;
        border-radius: 5px;
    }

    .imglarge-box {
        width: 50%;
        background-color: <?php echo $boxcolor ?>;
        padding-top: 50px;
        padding-bottom: 50px;
        margin: auto;
        margin-top: 60px;
        margin-bottom: 100px;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
    }

    .imglarge-img-container {
        width: 95%;
        margin: auto;
        border-radius: 5px;
        overflow: hidden;
    }

    #imglarge {
        width: 100%;
    }

    .prayer-score {
        margin-left: 10px;
        margin-top: 20px;
        font-size: 30px;
    }

    .prayer-tags-menu {
        margin-top: 12px;
        margin-bottom: 0px;
    }

    .prayer-tag {
        margin-right: 6px;
        color: <?php echo $textcolor ?>;
    }
/*************** COMMENTS ****************/
    .feed-comment-box {
        width: 80%;
        padding-left: 10%;
        padding-right: 10%;
        padding-bottom: 0px;
        background-color: <?php echo $commentcolor ?>;
        border-radius: 5px;
    }

    .post-comment {
        padding-top: 20px;
        padding-bottom: 20px
    }

    .comment-feed {
        display: flex;
        padding-bottom: 20px;
        padding-top: 20px;
        border-bottom: 1px solid <?php echo $backgroundcolor ?>;
    }

    .comment-content {
        overflow-wrap: break-word;
        white-space: pre-line;
        white-space: pre-wrap;
    }
    .comment {
        width: 100%;
        margin-bottom: 10px;
    }

    #submit-comment {
        height: auto;
        background-color: <?php echo $buttoncolor ?>;
        color: <?php echo $buttontext?>;
        padding: 6px;
        border-radius: 100px;
        border: 1px solid <?php echo $textcolor?>;
        font-size: 16px;
        padding-right: 15px;
        padding-left: 15px;
        font-weight: bold;

    }

    #submit-comment:hover {
        cursor: pointer;
        background-color: <?php echo $buttonhover ?>;
    }

    .comment-profile-name {
        color: <?php echo $boldcolor?>;
        font-weight: bold;
        display: inline-block;
        font-size: 16px;
        padding-bottom: 5px;
    }

    .comment-profile-username {
        color: <?php echo $textcolor ?>;
        display: inline-block;
        font-size: 14px;
    }

    .comment-feed-content {
        padding-left: 10px;
        width: 90%;
    }

    .show-more {
        width: 100%;
        height: 50px;
    }

    .delete-comment-button {
        width: 10px;
        height: 10px;
    }

    .delete-comment-button:hover {
        cursor: pointer;
    }
/*************** RELIGION MENU ***********/
    .sort-menu {
        font-size: 22px;
        margin-top: 20px;
        border: 1px solid <?php echo $menuborder ?>;
        background-color: <?php echo $feedcolor ?>;
        border-radius: 5px;
    }

    .religion-menu-header {
        padding: 20px;
        display: block;
        color: <?php echo $textcolor?>;
    }

    .religion-menu-items {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        width: 200px;
        position: absolute;
        background-color: <?php echo $feedcolor ?>;
        border-radius: 0px 0px 5px 5px;
        border: 1px solid <?php echo $menuborder ?>;
        margin-top: 20px;
        margin-left: -18px;
        display: none;
        z-index: 20;
    }

    .religion-menu-header:hover ul {
        display: block;
    }

    .religion-menu-header:hover {
        cursor: pointer;
        color: <?php echo $linkcolor ?>;
    }

    .religion-menu-item {
        padding: 10px;
        padding-left: 16px;
        color: <?php echo $textcolor ?>;
    }

    .religion-menu-item:hover{
        background-color: <?php echo $backgroundcolor ?>;
        cursor: pointer;
    }
/*************** ACCOUNT SETTINGS ********/
    .account-settings-box {
        width: 60%;
        background-color: <?php echo $feedcolor ?>;
        margin-left: 25px;
        padding: 25px;
        padding-top: 10px;
        border-radius: 5px;
        border: 1px solid rgba(0,0,0,.3);
        margin-bottom:10px;
        color: <?php echo $textcolor ?>;
    }

    .account-settings-body{
        width:100%;
    }

    .account-settings-box h1{
        margin:0px;
        margin-top:20px;
    }

    .settings-pictures-box{
        display:inline-flex;
    }

    .settings-profile-pic-box{
        margin-right:20px;
        height:200px;
    }

    #profile-prev {
        margin-bottom: 10px;
    }

    .settings-picture-button{
        width:100%;
        margin:auto;
    }

    #profile-preview {
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }

     #banner-prev {
        margin-bottom: 10px;
        height:200px;
        overflow:hidden;
    }

    #banner-prev img {
        height: auto;
        width: 100%;
        min-height:200px;
    }

    #banner-preview {
        width: 600px;
        height: 300px;
    }

    .account-bio {
        margin-top: 25px;
    }

    .update-button {
        padding-top: 25px;
        width:100%;
        align-contents:center;
    }

    .settings-header {
        margin-top: 20px;
        margin-bottom: 10px;
        color: <?php echo $textcolor ?>;
    }

    .password-change{
        display:inline-block;
        width:60%;
    }
/*************** RELIGIONS ***************/
    .settings-religions-body {
        width: 75%;
        background-color: <?php echo $feedcolor ?>;
        padding: 20px;
        padding-top: 0px;
        margin-left: 25px;
        border-radius: 5px;
        border: 1px solid rgba(0,0,0,.3);
        margin-bottom: 10px;
        color: <?php echo $textcolor ?>;
    }

    .my-religions {
        display: flex;
        flex-wrap: wrap;
    }

    .religion-box {
        width: 30%;
        margin-right: 10px;
        margin-bottom: 10px;
        background-color: <?php echo $boxcolor?>;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
    }

    .all-religions {
        flex-wrap: wrap;
        display: flex;
    }

    .religion-header {
        background-color: <?php echo $buttoncolor ?>;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .religion-header-text {
        margin: 0px;
        padding-top: 15px;
        padding-bottom: 15px;
        text-align: center;
    }

    .religion-follow-action h3 {
        padding-top: 24px;
    }

    .header-white {
        color: <?php echo $buttontext ?>;
    }

    .addreligion-stats {
        padding-top: 10px;
        padding-bottom: 10px;
        color: <?php echo $textcolor ?>;
        border-top: 1px solid <?php echo $menuborder ?>;
        border-bottom: 1px solid <?php echo $menuborder ?>;
    }

    .drop-religion {
        width: 100%;
        border-radius: 0px;
    }

    .add-religion {
        width: 100%;
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .add-primary {
        width: 100%;
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .religion-follow-action form {
        border: 0px;
    }
/*************** MESSAGES ****************/
    .messages-users-settings-box {
        display: inline-block;
        width: 21%;
        margin-top: 20px;
    }

    .messages-users-heading-box {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        background-color: <?php echo $feedcolor ?>;
        border: 1px solid rgba(0,0,0,.3);
        border-radius:5px 5px 0px 0px;
    }

    .messages-users-heading {
        color: <?php echo $textcolor ?>;
        font-weight: bold;
        font-size: 30px;
        margin: auto;
        display: table;
    }

    .messages-users {
        width: 100%;
        background-color: <?php echo $feedcolor ?>;
        height: 530px;
        border: 1px solid rgba(0,0,0,.3);
        overflow-y: auto;
    }

    .messages-settings {
        width: calc(100% - 8px);
        padding-top: 8px;
        padding-left: 8px;
        background-color: <?php echo $feedcolor ?>;
        border: 1px solid rgba(0,0,0,.3);
        border-top: 0px;
        border-radius: 0px 0px 5px 5px;
        height: 44px;
    }

    #user-search {
        width: 97%;
    }

    .messages-feed {
        width: 50%;
        background-color: <?php echo $feedcolor?>;
        margin-left: 50px;
        border: 1px solid rgba(0,0,0,.3);
        border-radius: 5px;
        margin-top: 20px;
        height: auto;
    }

    .msg-user-name-box {
        padding-top: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(0,0,0,.3);
    }

    .msg-name {
        color: <?php echo $textcolor ?>;
        font-weight: bold;
        font-size: 30px;
        margin: auto;
        display: table;
    }

    .msg-convo {
        overflow-y: auto;
        overflow-x: hidden;
        padding: 10px;
        height: 65%;
    }

    .compose-message {
        border-top: 1px solid rgba(0,0,0,.3);
        height: auto;
        padding: 10px;
    }

    .compose-message>form {
        display: flex;
    }

    #msg {
        width :80%;
        margin-right: auto;
    }

    .message-preview {
        display: flex;
        padding: 10px;
        border-bottom: 1px solid rgba(0,0,0,.3);
    }

    .message-preview:hover {
        background-color: <?php echo $backgroundcolor ?>;
        cursor: pointer;
    }

    .message-preview-content {
        margin-left: 10px;
        width: 75%;
    }

    .message-preview-msg {
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 100%;
        display: block;
        overflow: hidden;
    }

    .msg-container {
        min-height: 50px;
        width: 100%;
        display: table;
    }

    .msg-from-me {
        background-color: <?php echo $buttoncolor ?>;
        border-bottom-left-radius: 20px;
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
        margin-bottom: 10px;
        padding: 10px;
        color: #ffffff;
        float: right;
    }

    .msg-to-me {
        background-color: #cccccc;
        margin-bottom: 10px;
        padding: 10px;
        border-bottom-right-radius: 20px;
        border-top-right-radius: 20px;
        border-top-left-radius: 20px;
        float: left;
    }

    .msg-content {
        color:rgba(0, 0, 0, .85);
        max-width: 200px;
        overflow-wrap: break-word;
        white-space: pre-line;
        white-space: pre-wrap;
    }

    .messages-default {
        padding-top: 25px;
        width: 90%;
        margin: auto;
    }

    .messages-default-title {
        width: 100%;
        text-align: center;
        color: <?php echo $textcolor ?>;
    }

    #user-searchautocomplete-list {
        display: block;
        position: absolute;
        width: 20.1%;
        background-color: <?php echo $feedcolor ?>;
        border: 1px solid <?php echo $menuborder ?>;
        border-radius: 5px 5px 0px 0px;
        border-bottom: none;
        max-height: 200px;
        overflow: auto;
        color: <?php echo $textcolor ?>;
    }

    .autocomplete-uni-item:hover{
        cursor: pointer;
        background-color: <?php echo $backgroundcolor?>;
    }

    .autocomplete-uni-item {
        padding: 6px;
        font-size: 20px;
        border-bottom: 1px solid <?php echo $menuborder ?>;
    }

    .mobile-message-button {
        display: none;
    }

    .message-preview-name {
        color: <?php echo $textcolor ?>;
    }
/*************** DATABASE ****************/
    .database-body {
        padding-top: 70px;
        display: flex;
        width: 93%;
        margin: auto;
        padding-bottom: 25px;
    }

    .database-all-tables {
        display: block;
    }

    .database-content-container {
        width: 80%;
        margin: auto;
        margin-top: 0px;
        background-color: <?php echo $feedcolor ?>;
        display: block;
    }

    .database-run-query {
        display: block;
        height: 50px;
        width: 90%;
        margin: auto;
        padding-top: 25px;
    }

    .query-input {
        width: 90%;
    }

    .database-tables-box {
       height: auto;
       padding-bottom: 20px;
    }

    .database-table {
        width: 90%;
        margin: auto;
        overflow: scroll;
        display: flex;
    }

    .table-header {
        width: 90%;
        margin: auto;
        font-size: 30px;
        padding-bottom: 10px;
        text-transform: capitalize;
    }

    .database-columns {
        display: block;
    }

    .database-table-fields {
        border: 1px solid #333333;
        background-color: <?php echo $buttoncolor ?>;
        color: #ffffff;
        padding: 20px;
    }


    .database-table-values {
        border-color: #333333;
        border: 1px solid <?php echo $feedcolor ?>;
        font-color: #ffffff;
        padding: 20px;
        max-width: 300px;
        height: 50px;
        overflow-y: hidden;
        position: relative;
    }

    .database-table-values:hover {
        border: 1px solid #333333;
        background-color: #cccccc;
        font-color: #ffffff;
        padding: 20px;
        max-width: 300px;
        min-height: 50px;
        height: auto;
    }
/*************** NOTIFICATIONS ***********/
    .notification-feed {
        width: 72%;
        margin: auto;
    }

    .notification-container{
        background-color: <?php echo $feedcolor ?>;
        margin-top: 16px;
        padding: 16px;
        width: 100%;
        min-height: 150px;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
    }

    .prayer-prev {
        max-height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
        border-radius: 5px;
        border: 1px solid <?php echo $menuborder ?>;
        margin-top: 8px;
    }

    .prayer-prev .feed-container {
        border: 0px;
        margin-top: 0px;
    }

    .prayer-prev .feed-content-delete {
        display: none;
    }
/*************** MEDIA QUERIES ***********/
/*********** 1250px ***********/
    @media screen and (max-width: 1250px) {
        .prayer-date {
            margin-left: 35%;
        }
    }
/*********** 1150px ***********/
    @media screen and (max-width: 1150px) {
        .header-box {
            margin-left: 20px;
        }

        .prayer-date {
            margin-left: 18%;
        }

        #sort-compose {
            margin-left: 20%;
        }

        .messages-users-heading {
            font-size: 24px;
        }
    }
/*********** 1024px ***********/
    @media screen and (max-width: 1024px) {
        .messages-feed {
            width: 60%;
        }

        .feed-profile-img {
            height: 38px;
            width: 38px;
        }

        .message-preview-name {
            font-size: 14px;
        }

        .message-preview-msg {
            font-size: 14px;
        }

        #user-searchautocomplete-list {
            width: 18.4%;
        }

        /* CREATE ACCOUNT */
        .newaccount-body {
            width: 86%;
        }

        .account-settings-box {
            width: 86%;
        }
    }
/*********** 920px ************/
    @media screen and (max-width: 920px) {
        .header-box {
            margin-left: 10px;
        }

        .index-left-box {
            display: none;
        }

        .index-right-box {
            display: none;
        }

        .index-center-box {
            width: 96%;
            margin: auto;
        }

        .prayer-date {
            margin-left: 45%;
        }

        #sort-compose {
            margin-left: 30%;
        }

        .messages-users-heading {
            font-size: 20px;
        }
    }
/*********** 830px ************/
    @media screen and (max-width: 830px) {
        .prayer-date{
            margin-left: 35%;
        }

        #sort-compose {
            margin-left: 40%;
        }
    }
/*********** 768px ************/
    @media screen and (max-width: 768px) {

    /****** INDEX ******/

        .index-body {
            width: 96%;
            padding-top: 135px;
            display:
        }

        .settings-index-body {
            display: block;
        }

        .index-left-box {
            display: none;
        }

        .index-center-box {
            width: 98%;
        }

        .index-right-box {
            display: none;
        }

        .feed-box {
            padding-top: 10px;
        }

        .sort-menu {
            padding: 10px;
        }

        .religion-menu-header {
            padding: 10px;
        }

        .religion-menu-item {
            font-size: 20px;
        }

        .imglarge-box {
            width: 92%;
            margin-left: 5%;
        }
    /****** HEADER ******/

        /* Hide old menu */
        .header {
            display: none;
        }

        .login {
            display:block;
        }

        .header-link-box {
            margin-left: 10%;
        }

        .mobile-header {
            display: block;
            height: 60px;
            width: 100%;
            border-bottom: 1px solid <?php echo $menuborder?>;
            background-color: <?php echo $boxcolor ?>;
            position: fixed;
            z-index: 50;
        }

        .mobile-header-link-box {
            margin: 0px;
        }

        /* Logo - Left */
        .mobile-logo {
            height: 50px;
            width: 50px;
            position: absolute;
            left: 12%;
            margin-top: 5px;
            border-radius: 50%;
        }

        /* Notifications - Center */
        .mobile-header-link-notifications {
            display: block;
            margin: auto;
            position: relative;
        }

        .mobile-notifications {
            height: 50px;
            width: 50px;
            margin-top: 5px;
            border-radius: 50%;
        }

        /* Profile Picture - Right */
        .mobile-profile {
            height: 50px;
            width: 50px;
            float: right;
            position: absolute;
            margin-top: 5px;
            border-radius: 50%;
            right: 12%;
        }

        .mobile-profile:hover {
            cursor: pointer;
        }

        #header-profile-menu {
            margin-top: 60px;
        }

        /* Search Bar */
        .mobile-search-box {
            height: 60px;
            width: 100%;
            position: fixed;
            top: 61px;
            background-color: <?php echo $boxcolor ?>;
            border-bottom: 1px solid <?php echo $menuborder ?>;
            opacity: 1;
        }

        .mobile-search-box-up {
            top: 0px;
        }

        .mobile-search-link-box {
            margin: 0px;
            height: 60px;
            margin-bottom: 10px;
        }

        /* Messages - Left */
        .mobile-messages {
            height: 50px;
            width: 50px;
            left: 25%;
            float: right;
            position: absolute;
            margin-top: 5px;
        }

        /* Pray - Right */
        .mobile-header-link-prayer {
            margin-top: 10px;
            float: right;
            position: absolute;
            right: 25%;
        }

        .prayer-box {
            width: 72%;
        }

        #mobile-start-prayer {
            height: auto;
            background-color: <?php echo $buttoncolor ?>;
            color: <?php echo $buttontext?>;
            padding: 6px;
            border-radius: 100px;
            border: 1px solid <?php echo $textcolor?>;
            font-size: 22px;
            padding-right: 15px;
            padding-left: 15px;
            font-weight: bold;
        }

        #mobile-start-prayer:hover {
            cursor: pointer;
            background-color: <?php echo $buttonhover ?>;
        }

    /****** PROFILE ******/

        .profile-banner-pic {
            padding-top: 72px;
        }

        .profile-profile-pic {
            width: 140px;
            height: 140px;
            color: #fff;
            transform: translateY(-80px);
            margin: auto;
        }

        .profile-body {
            transform: translateY(-100px);
        }

        .profile-header-name {
            font-size: 2em;
        }

        #profile-prayers {
            transform: translateY(-136px);
            width: 82%;
        }

        #profile-stats {
            transform: translateY(-136px);
            width: 81.2%;
            margin: auto;
        }

        #bio {
            transform: translateY(-152px);
            width: 81.2%;
            margin: auto;
            text-align: center;
        }

    /****** MESSAGES ******/
        .messages-users-settings-box {
            width: 28%;
        }

        .messages-users-heading {
            font-size: 20px;
        }

        .message-preview-name {
            margin-top: 2px;
            font-size: 12px;
        }

        .message-preview-msg {
            margin-top: 6px;
            font-size: 12px;
        }

        .messages-feed {
            margin-left: 20px;
            width: 70%;
        }

        #user-searchautocomplete-list {
            width: 24.3%;
        }

      /****** SETTINGS ******/

        .usersettings-box {
            display: flex;
        }

        .settings-header {
            margin-top: 16px;
        }

        .account-bio {
            margin-top: 0px;
        }

        .account-settings-box {
            margin: auto;
            margin-top: 24px;
        }

        .settings-profile-pic-box {
            height: 300px;
        }

        .settings-religions-body {
            width: 86%;
            margin: auto;
            margin-top: 24px;
        }

        .settings-pictures-box {
            display: block;
        }

        .religions-box {
            width: 48%;
        }

        /****** LOGIN ******/
        .pray-desc {
            width: 70%;
            margin-left: 15%;
            margin-top: 0px;
        }

        .login-body {
            width: 70%;
            margin-right: 15%;
            padding-top: 32px;
            margin-top: 72px;
        }

        /*** CREATE ACCOUNT ***/
        .newaccount-body {
            width: 98%;
        }
    }
/*********** 600px ************/
    @media screen and (max-width: 600px) {

    /****** HEADER ******/

        .mobile-header {
            height: 50px;
        }

        .mobile-profile {
            height: 40px;
            width: 40px;
            right: 8%;
        }

        #header-profile-menu{
            margin-top: 50px;
        }

        .mobile-logo {
            height: 40px;
            width: 40px;
            left: 8%;
        }

        .mobile-notifications {
            height: 40px;
            width: 40px;
        }

        .mobile-search-box {
            height: 50px;
            top: 51px;
        }

        .mobile-search-link-box {
            margin: 0px;
            height: 40px;
            margin-bottom: 5px;
        }

        .mobile-messages {
            height: 40px;
            width: 40px;
            left: 25%;
            margin-top: 5px;
        }

        .mobile-header-link-prayer {
            margin-top: 5px;
        }

        #mobile-start-prayer {
            font-size: 20px;
        }

        .prayer-box {
            width: 94%;
            margin-top: 40px;
        }

        .compose-header {
            margin-left: 24px;
            height: 60px;
        }

        .compose-header h1 {
            margin-top: 24px;
            font-size: 26px;
        }

        #closebutton {
            height: 20px;
            width: 20px;
        }

        .compose-content {
            padding: 25px;
        }

        .compose-content-bottom {
            margin-top: 15px;
        }

    /****** INDEX ******/

        .index-body {
            padding-top: 110px;
        }

        .feed-profile-img-box {
            width: 17%;
        }

        .feed-profile-name {
            font-size: 20px;
        }

        #deleteprayer {
            height: 10px;
            width: 10px;
        }

        .delete-comment-button {
            height: 6px;
            width: 6px;
        }

        .prayer-date {
            margin-left: 25%;
            font-size: 12px;
        }

    /****** PROFILE ******/

        .profile-banner-pic {
            padding-top: 52px;
        }

        .profile-profile-pic {
            width: 100px;
            height: 100px;
            transform: translateY(-58px);
            margin: auto;
        }

        .profile-body {
            transform: translateY(-72px);
        }

        .profile-header-name {
            font-size: 1.5em;
        }

        #profile-prayers {
            transform: translateY(-104px);
            width: 92%;
        }

        #profile-stats {
            transform: translateY(-104px);
            width: 91.2%;
            margin: auto;
        }

        #bio {
            transform: translateY(-116px);
            width: 91.2%;
            margin: auto;
            text-align: center;
        }

    /****** MESSAGES ******/

        .messages-users-heading {
            font-size: 16px;
        }

        .feed-profile-img {
            height: 32px;
            width: 32px;
        }

        .message-preview-content {
            margin-left:6px;
        }

        .message-preview {
            padding: 4px;
        }

        .message-preview-img {
            display: none;
        }

        #user-searchautocomplete-list {
            width: 23.8%;
        }

    /****** LOGIN ******/
      .pray-desc {
          width: 80%;
          margin-left: 10%;
      }

      .login-body {
          width: 80%;
          margin-right: 10%;
      }

    /****** CREATE ACCOUNT ******/
        .religion-box {
            width: 42%;
            margin-right: 20px;
            margin-bottom: 20px;
        }
    }
/*********** 425px ************/
    @media screen and (max-width: 425px) {

    /****** HEADER ******/

        .mobile-profile {
            right: 5%;
        }

        .mobile-logo {
            left: 5%;
        }

        .mobile-messages {
            left: 20%;
        }

        .mobile-header-link-prayer {
            right: 20%;
        }

        .prayer-box {
            width: 94%;
            margin-top: 40px;
        }

        .compose-header {
            margin-left: 24px;
            height: 60px;
        }

        .compose-header h1 {
            margin-top: 24px;
            font-size: 26px;
        }

        #closebutton {
            height: 20px;
            width: 20px;
        }

        .compose-content {
            padding: 25px;
        }

        .compose-content-bottom {
            margin-top: 15px;
        }

    /****** INDEX ******/

        .index-body {
            padding-top: 100px;
        }

        .feed-profile-img-box {
            width: 17%;
        }

        .feed-profile-name {
            font-size: 20px;
        }

        .feed-profile-username {
            font-size: 12px;
        }

        #deleteprayer {
            height: 10px;
            width: 10px;
        }

        .delete-comment-button {
            height: 6px;
            width: 6px;
        }

    /****** PROFILE ******/

        .profile-banner-pic {
            padding-top: 32px;
        }

        .profile-profile-pic {
            width: 72px;
            height: 72px;
            transform: translateY(-44px);
        }

        .profile-body {
            transform: translateY(-52px);
        }

        .profile-header-name {
            font-size: 1.2em;
        }

        #profile-prayers {
            transform: translateY(-86px);
        }

        #profile-stats {
            transform: translateY(-86px);
        }

        #bio {
            transform: translateY(-96px);
            text-align: center;
        }

    /****** MESSAGES ******/

        .messages-users-settings-box {
            width: 92%;
            display: none;
            margin-left:20px;
        }

        .message-preview-img{
            display:block;
        }

        .messages-users{
            height:450px;
        }

        .mobile-message-button {
            display: block;
            height: 50px;
            width: auto;
            position: absolute;
            left: 0px;
            margin-top: 72%;
        }

        .messages-users-heading {
            font-size: 14px;
        }

        .messages-feed {
            margin-left: 20px;
            width: 92%;
        }

        #user-searchautocomplete-list {
            width: calc(90% - 7px);
        }

        .messages-default {
            height: 516px;
        }

      /****** LOGIN ******/
        .pray-desc {
            width: 92%;
            margin-left: 4%;
        }

        .login-body {
            width: 92%;
            margin-right: 4%;
        }

        .religion-box {
            width: 68%;
            margin-left: 16%;
            margin-right: 16%;
        }
    }
