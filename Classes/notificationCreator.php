<?php
    class Notificationer{
        protected $db;//Sets the Database -- Allows for queries in this class

        protected $userid;//The User Id of the current session

        protected $praycreator;

        Public function __construct($db,$userid, $creator){
            $this->db = $db;
            $this->userid = $userid;
            $this->praycreator = $creator;
        }

        function showLikes($i){
            echo " <div class='notification-container'>
                    <p> ".$i['likes']." People Liked Your Prayer</p>
                    <div class='prayer-prev'>";
                    $this->prayerPrev($i['prayid']);
                    echo"</div></div></div>
            ";
        }

        function showComments($i){
            echo " <div class='notification-container'>
                    <p> ".$i['comments']." People Commented On Your Prayer</p>
                    <div class='prayer-prev'>";
                    $this->prayerPrev($i['prayid']);
                    echo"</div></div></div>
            ";
        }

        function prayerPrev($prayid){
            $prayer = $this->queryinfo($prayid);
            $this->praycreator->showPrayer($prayer);
        }

        function queryinfo($prayid){
            $prayerquery = "SELECT p.userid, u.fname, u.lname, u.username, p.content, pr.relid, p.prayid, p.img,
                        r.religion_name, u.pPicture, p.dateLastMaint
                    FROM Prayers p, Users u, Prayer_Religions pr, Religions r
                    WHERE p.userid = u.userid
                    AND pr.prayid = p.prayid
                    AND pr.relid = r.relid
                    AND p.prayid = '$prayid'";
            $prayers = $this->db->FetchQuery($prayerquery);
            return $prayers[0];
        }

        function showWarning(){

        }
    }

?>