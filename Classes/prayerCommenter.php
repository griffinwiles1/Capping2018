<?php
    class PrayerCommenter{
        protected $db;//Sets the Database -- Allows for queries in this class

        protected $userid;//The User Id of the current session

        Public function __construct($db,$userid){
            $this->db = $db;
            $this->userid = $userid;
        }

        function createComment($prayer, $content){
            $check = $this->checkContent($content);
            if($check){
                $result = $this->comment($prayer, $content);
                return $result;
            }
            return 'Invalid content';
        }

        function checkContent($content){
            return true;
        }

        function comment($prayer, $content){
            $commentquery = "INSERT into Comments(userid, prayid, comment) 
            VALUES($this->userid, $prayer, '$content')";

            $comment = $this->db->InsertQuery($commentquery);
            return $comment;
        }
    }

?>