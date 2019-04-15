<?php 
    

    class MessageCreator{
        protected $db; //Sets the Database -- Allows for queries in this class

        protected $userid;//Id of the user uploading the image

        Public function __construct($db, $userid){
            $this->db = $db;
            $this->userid = $userid;
        }

        function getUsers(){
            /**
             * query-> Select user info for any user that has 
             * 1->Recieved a message from me OR
             * 2->Sent a message to me
             * 
             */
            $query = "SELECT DISTINCT u.userid, u.fname, u.lname, u.username, u.pPicture, Max(m.messageid)
                      FROM User_Messages um, Users u, Messages m
                      WHERE (um.userid = u.userid
                      AND m.messageid = um.messageid
                      AND m.userid = '$this->userid')
                      OR (m.userid = u.userid
                      AND m.messageid = um.messageid
                      AND um.userid = '$this->userid')
                      GROUP BY (u.userid)
                      ORDER BY Max(m.messageid) desc";
            $result = $this->db->fetchQuery($query);
            return $result;
        }

        /**
         * 
         * Returns all messages with said user
         * 
         */
        function getMessages($id){
            $query = "SELECT DISTINCT m.userid, m.msg, u.fname, m.messageid, m.dateAdded
                      FROM User_messages um, Messages m, Users u
                      WHERE um.messageid = m.messageid
                      AND u.userid = $id
                      AND ((um.userid = '$id'
                      AND m.userid = $this->userid)
                      OR (m.userid = '$id'
                      AND um.userid = $this->userid))
                      ORDER BY m.dateAdded, m.messageid";
            $result = $this->db->fetchQuery($query);
            return $result;
        }

        function previewConvo($user, $msg){
            echo "<div id='msg-prv--".$user['userid']."'class='message-preview' onclick=setMessage(".$user['userid'].")>
                    <form method='post' action='php/setmessage.php'>
                        <button name='userid' id='set-msg--".$user['userid']."'class='hidden' value='".$user['userid']."'></button>
                    </form>
                    <div class='message-preview-img'>
                        <img class='feed-profile-img'src='images/Users/".$user['userid']."/Profile/".$user['pPicture']."'>
                    </div>
                    <div class='message-preview-content'>
                        <div class='message-preview-name'>
                            <h3>".$user['fname']." ".$user['lname']."</h3>
                        </div>
                        <div class='message-preview-msg'>
                            <p>". $msg ."</p>
                        </div>
                    </div>
                  </div>";
        }

        function displayConvo($msgs, $recid){
            echo"<div class='msg-user-name-box'>
                    <p class='msg-name'>".$msgs[0]['fname']."</p>
                 </div>
                 <div id='msg-convo' class='msg-convo'>
                 ";
            if($msgs[0]['msg']){
                foreach($msgs as $i){
                    echo"<div class='msg-container'>";
                    if($i['userid'] == $this->userid){
                        echo "<div class='msg-from-me'>
                        <p class='msg-content' style='color:#ffffff'>".$i['msg']."</p>
                        </div>";
                    }else{
                        echo "<div class='msg-to-me'>
                        <p class='msg-content'>".$i['msg']."</p>
                        </div>";
                    }
                    echo "</div>";
                }
            }
            echo "</div>
                <div class='compose-message'>
                    <form method='post' action='php/submitMessage.php'>
                    <textarea name='msg' id='msg' placeholder='Compose Message'></textarea>
                    <button class='submit-button'type='submit' name='id' value='".$recid."'> Submit</button>
                    </form>
                 </div>
                 <script>scrollBottom()</script>";
        }

        function brandNewConvo($id){
            $query = "SELECT DISTINCT u.fname
                      FROM Users u
                      WHERE u.userid = '$id'";
            $result = $this->db->fetchQuery($query);

            $values[0]['fname'] = $result[0]['fname'];
            $values[0]['msg'] = null;
            $values[0]['userid'] = $id;

            return $values;
        }
    }
?>