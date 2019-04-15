<?php
    class PrayerCommentDisplayer{
        protected $db;//Sets the Database -- Allows for queries in this class

        protected $userid;//The User Id of the current session

        Public function __construct($db,$userid){
            $this->db = $db;
            $this->userid = $userid;
        }

        function showComments($prayer){
            $comments = $this->getCommentInfo($prayer['prayid']);
            if($comments){
                $this->createComments($comments, $prayer['prayid']);
            }
        }

        function getCommentInfo($id){
            $query = "SELECT c.commid AS cid, c.comment AS comment, u.pPicture AS user_img, u.userid as userid, u.fname, u.lname, u.username
                      FROM Comments c, Users u
                      WHERE prayid = '$id'
                      AND u.userid = c.userid";
            $result = $this->db->fetchQuery($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        function createComments($comment, $prayid){
            $num = 0;
            foreach($comment as $i){
                if($num < 10){
                    $this->displayComment($i,$prayid);
                }
                $num += 1;
            }
            if($num > 1){
                $this->showMore();
            }
        }

        function displayComment($comment, $prayid){
            echo "<div class='comment-feed'>
                    <div class='comment-usr-img'>
                    <img class='feed-profile-img' src='images/Users/".$comment['userid']."/Profile/".$comment['user_img']."'>
                    </div>

                    <div class='comment-feed-content'>
                    <a class='feed-profile-link' href='profile.php?id=".$comment['userid']."'>
                        <p class='comment-profile-name'>".$comment['fname']." ".$comment['lname']."</p>
                        <p class='comment-profile-username'>@".$comment['username']."</p>
                    </a>
                    <p class='comment-content'>".$comment['comment']."</p>
                    </div>";
                    if($this->canDelete($prayid, $comment['userid'])){
                        echo "<form method='post' action='php/removeComment.php'>
                        <img class='delete-comment-button'src='images/icons/close.png' onclick='removeComment(".$comment['cid'].")'>
                        <button id='removeComment--".$comment['cid']."' name='delete' type='submit' class='hidden' value='".$comment['cid']."'>
                        </form>";
                    }
                    echo "</div>";
        }

        function showMore(){
            
        }

        function canDelete($prayid, $cmntuserid){
            if($this->userid == $cmntuserid || $this->userid == 1){
                return true;
            }
            $query = "SELECT * FROM PRAYERS WHERE prayid = '$prayid' AND userid = '$this->userid'";
            $result = $this->db->fetchQuery($query);
            if($result){
                return true;
            }
        }
    }
?>