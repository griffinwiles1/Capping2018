<?php
    class TagDisplayer{
        protected $db;//Sets the Database -- Allows for queries in this class

        protected $userid;//The User Id of the current session

        Public function __construct($db,$userid){
            $this->db = $db;
            $this->userid = $userid;
        }

        function showtag($tag){
            echo"<div class='featured-tag-box'>
            <p>#".$tag['tag_name']."</p>
            <p>Used ".$tag['nums']." Times</p>
            </div>";
        }
    }

?>
