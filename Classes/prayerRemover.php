<?php
    class prayerRemover{

        protected $db;//Sets the Database -- Allows for queries in this class

        protected $userid;//The User Id of the current session

        Public function __construct($db,$userid){
            $this->db = $db;
            $this->userid = $userid;
        }

        /**
         * Function to remove a prayer
         *
         * $prayer => Array of all the information for prayer
         *
         */
        function removePrayer($prayer){
            if($this->checkpermission($prayer['userid'])) {   //Check if the current user is allow to remove the prayer
                $this->removeRelation($prayer['prayid']);//Remove all field where the prayer is a foreign key
                $this->removeimg($prayer['img']);//Remove the image from the directory
                $this->remove($prayer['prayid']);//Remove prayer from prayer table
            }
            else {

            }
        }

        /**
         * A prayer can be deleted by the user of the prayer, or by an admin.
         * Check for those conditions
         *
         * $this->userid => current user
         * $uid => user of the prayer
         *
         */
        function checkpermission($uid){
            if($this->userid == $uid || $this->userid == 1) {
                return true;
            }
            return false;
        }

        /**
         * All fields that use the prayer id as a foreign key must be deleted before
         * the prayer is deleted. Do that here
         *
         * Tables that use prayid as FK
         *
         * Prayer_Religion
         * Comment
         * Likes
         * Prayer_Tag
         *
         */
        function removeRelation($pid){
            $queryArray = ["DELETE FROM Prayer_Tags WHERE prayid = $pid",
                            "DELETE FROM Prayer_Religions WHERE prayid = $pid",
                            "DELETE FROM Comments WHERE prayid = $pid",
                            "DELETE FROM Likes WHERE prayid = $pid"];
            foreach($queryArray as $i) {
                $this->db->deleteQuery($i);
            }
        }

        /**
         * If the prayer has an image attached to it, remove it from the directory
         * Path can be built dynamically by using $this->userid.
         *
         */
        function removeimg($img){
            if($img != null) {
                $path = "../images/Users/".$this->userid."/Uploads/".$img;
                unlink($path);
            }
        }

        /**
         * Remove the prayer from the prayer table.
         * This should be done last
         *
         */
        function remove($pid){
            $query = "DELETE FROM Prayers WHERE prayid = $pid";
            $this->db->deleteQuery($query);
        }

        /**
         * 
         * Function to ban a prayer. Same idea as remove prayer but the current user does not need permission
         * 
         */
        function banPrayer($prayer){
            $this->removeRelation($prayer['prayid']);//Remove all field where the prayer is a foreign key
            $this->removeimg($prayer['img']);//Remove the image from the directory
            $this->remove($prayer['prayid']);//Remove prayer from prayer table
        }

    }

?>
