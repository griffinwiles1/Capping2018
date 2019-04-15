<?php
    class Header{
        protected $db;//Sets the Database -- Allows for queries in this class

        protected $menus;//Create the menu bar links

        protected $loggedIn;//Specifies if the user header should be added

        protected $userid;//Id of the user uploading the image

        protected $title;//Creates the page title

        protected $css;//Links all the css files used

        protected $profpic;//The profile pic name

        Public function __construct($db,$menus,$title,$css){
            $this->db = $db;
            $this->menus = $menus;
            $this->title = $title;
            $this->css = $css;
        }

        function showUserMenu($id, $bool = 1){
            $this->loggedIn = $bool;
            $this->userid = $id;
            $this->getUserInfo();
        }

        function displayHeader(){
            $this->createTitle();
            if($this->loggedIn == 1){
                $this->createCompose();
            }
            //Header
            echo "
                  <section class='header'>
                  <div class='header-box'>
                  <ul class='logo-box'>
                      <li class='logo-li'>
                          <a href='index.php'><img class='logo' src='".getRoot()."images/icons/favicon.png'></a>
                      </li>
                  </ul>
                  <ul class='header-link-box'>";
            foreach($this->menus as $i){
                echo "<li class='header-link ".$i['active']."'>
                        <a href='".$i['link']."'>".$i['name']."</a>
                      </li>";
            }
            echo "</ul>";

            echo "";
            if($this->loggedIn == 1){
                echo "
                <ul class='header-profile-pic'>
                    <li id='sort-compose'>
                        <div id='startprayer' onclick='ShowCompose()'>PRAY</div>
                    </li>
                    <li id='header-profile-pic-link' onclick='ShowMenu()'>
                        <img class='index-profile-pic' src='".getRoot()."images/Users/".$this->userid."/Profile/".$this->profpic."'>
                    </li>
                </ul>";
            }
            echo "</div></section>";
            if($this->loggedIn == 1){
                $this->createMobileHeader();
                $this->createUserMenu($this->userid);
            }else{
                echo"
                  <section class='header login'>
                  <div class='header-box'>
                  <ul class='logo-box'>
                      <li class='logo-li'>
                          <a href='index.php'><img class='logo' src='".getRoot()."images/icons/favicon.png'></a>
                      </li>
                  </ul>
                  <ul class='header-link-box'>";
            foreach($this->menus as $i){
                echo "<li class='header-link ".$i['active']."'>
                        <a href='".$i['link']."'>".$i['name']."</a>
                      </li>";
            }
            echo "</ul>";
            echo "</div></section>";
            }
        }

        function createMobileHeader() {
            echo"<section class='mobile-header'>
                <div class='mobile-header-box'>
                    <ul class='mobile-header-link-box'>
                        <li class='mobile-header-link-home'>
                            <a href='index.php'>
                                <img class='mobile-logo' src='images/icons/favicon.png'>
                            </a>
                        </li>
                        <li class='mobile-header-link-notifications'>
                            <a href='notifications.php'>
                                <img class='mobile-notifications' src='images/icons/NotificationIcon.png'>
                            </a>
                        </li>
                        <li id='mobile-header-link-profile' onclick='ShowMenuMobile()'>
                            <img class='mobile-profile' src='images/Users/".$this->userid."/Profile/".$this->profpic."'>
                        </li>
                    </ul>
                </div>
                <div class='mobile-search-box'>
                    <ul class='mobile-search-link-box'>
                        <li class='mobile-header-link-messages'>
                            <a href='messages.php'>
                                <img class='mobile-messages' src='images/icons/MessageIcon2.png'>
                            </a>
                        </li>
                        <li class='mobile-header-link-prayer'>
                            <div id='mobile-start-prayer' class='button' onclick='ShowCompose()'>PRAY</div>
                        </li>
                    </ul>
                </div>
            </section>";
        }

        function createTitle(){
           echo "<html>
           <script type='text/javascript' src='js/PrayImg.js'></script>
           <script type='text/javascript' src='js/updatemessages.js'></script>
                    <head>
                        <title>".$this->title."</title>
                        <link rel='shortcut icon' href='images/icons/favicon.png'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <link href='https://fonts.googleapis.com/css?family=Work Sans' rel='stylesheet'>
                    </head>
                    <body>";
            $this->addcss();
            echo "<div id='overlay' class='overlay hidden'></div>";
        }

        function addcss(){
            foreach($this->css as $i){
                echo "<link rel='stylesheet' type='text/css' href='".$i["src"]."'>";
                continue;
            }
        }

        function createUserMenu($id){
            $query = "SELECT fname, lname, username
                      FROM Users
                      WHERE userid = '$id'";
            $result = $this->db->fetchQuery($query);
            $firstname = $result[0]['fname'];
            $lastname = $result[0]['lname'];
            $username = $result[0]['username'];

            echo "<div id='header-profile-menu' class='hidden'>
                <ul class='header-profile-menu-name'>
                    <li class='header-profile-menu-name-name'>
                        <a href='".getRoot()."profile.php'>".$firstname." ".$lastname ."</a>
                    </li>
                    <li class='header-profile-menu-name-username'>
                        <a href='".getRoot()."profile.php'>@".$username."</a>
                    </li>
                </ul>
                <ul class='header-profile-menu-settings'>
                    <li class='header-profile-menu-list-item'>
                        <a href='".getRoot()."settings-account.php'> Settings </a>
                    </li>
                    <li class='header-profile-menu-list-item'>
                        <a href='".getRoot()."settings-religions.php'>Religions</a>
                    </li>
                    <li class='header-profile-menu-list-item'>
                        <a href='".getRoot()."php/changeTheme.php'> Theme </a>
                    </li>";
                    if($id == 1){
                        echo"
                        <li class='header-profile-menu-list-item'>
                            <a href='".getRoot()."Database/databasePage.php'>System Database</a>
                        </li>";
                    }
                echo"
                </ul>
                <ul class='header-profile-menu-logout'>
                    <li class='header-profile-menu-list-item'>
                        <a href='".getRoot()."signOut.php'> Log Out </a>
                    </li>
                </ul>
            </div>";
        }

        function createCompose(){
            $primaryrelquery = "SELECT u.primary_religion
                   FROM users u
                   WHERE u.userid = $this->userid";
            $primaryrelres = $this->db->fetchquery($primaryrelquery);
            $prel = $primaryrelres[0]['primary_religion'];

            $chosenreligion = isset($_SESSION['currel']) ? $_SESSION['currel'] : $prel;

            $curreligionquery = "SELECT r.religion_name, r.relid
                                FROM Religions r
                                WHERE r.relid = $chosenreligion";
            $curreligion = $this->db->fetchQuery($curreligionquery);

            $relid = $chosenreligion;
            $relname = $curreligion[0]['religion_name'];

            echo "
                <div id='compose-prayer' class='hidden'>
                <div class='prayer-box'>
                <ul class='compose-header-background'>
                    <li class='compose-header'>
                        <h1>Pray to ".$relname."</h1>
                    </li>
                    <li class='close-button'>
                        <img id='closebutton' src='images/icons/close.png'>
                    </li>
                </ul>
                    <form method='post' class='compose-content' action='php/submitprayer.php' enctype='multipart/form-data'>
                        <textarea id='compose-area' name='newprayer' placeholder='Compose Your Prayer'
                                  onkeyup='auto_grow(this)'  
                                  onkeydown= 'if(checkPrayerLength(this) && (event.keyCode != 8)) {return false;}'
                                  onpaste='checkPrayerLength(this)'
                                  ></textarea>
                        <input type='text' id='tags-area' name='prayertags' placeholder='Add a Tag'
                            onkeypress='if (event.keyCode == 13) {event.preventDefault(); addTag(this) }
                            if (event.keyCode === 32) {return false;}
                            if(checkTagLength(this)) {return false;}'>
                        <p id='characters-left'>140 Characters Left</p>
                        <div id='cur-tags'>
                        </div>
                        <div id='preview'>
                            <p id='upload-size-error' style='display:none; color:#ff0000'>Image too Large. Must be less than 500KB</p>
                            <img src='' id='uploadpreview' style='display:none'>
                        </div>
                        <ul class='compose-content-bottom'>
                        <li class='compose-img-upload'>
                            <input type='file' name='upload' id='upload' class='inputfile' onchange='readURL(this)'>
                            <label id='uploadbutton' for='upload'>Upload Picture</label>
                        </li>
                        <li class='compose-submit'>
                            <button type='submit' name='religion' id='submit-prayer' value='".$relid."'>Send Prayer</button>
                        </li>
                        </ul>
                    </form>
                </div>
            </div>";
        }

        function getUserInfo(){
            $query = "SELECT * FROM USERS WHERE userid = '$this->userid'";
            $result = $this->db->fetchQuery($query);
            $this->profpic = $result[0]['pPicture'];
        }
    }
?>
