<?php
    class UserSettings{

        protected $menus;

        protected $db;

        protected $userid;

        Public function __construct($db,$menus,$userid){
            $this->menus = $menus;
            $this->db = $db;
            $this->userid = $userid;
        }

        function displaySettings(){
            echo "<div class='usersettingsdiv'>";
            echo "<ul class='usersettings-box'>";
            foreach($this->menus as $i){
                echo "<li class='settings-link ".$i['active']."'>
                    <a href='".$i['link']."'>".$i['name']."</a>
                </li>";
            }
            echo '</ul>';
            echo '</div>';
        }
    }


?>
