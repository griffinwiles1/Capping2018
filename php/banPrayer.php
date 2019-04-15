<?php
    require '../config/ApplicationTop.php';
    include '../Classes/prayerRemover.php';

    print_r($_POST);

    $prayid = cleanVar($_POST['prayid']);    
    
    $prayerinfoquery = "SELECT p.userid, pr.relid, p.img, p.prayid
                        FROM Prayers p, Prayer_Religions pr
                        WHERE p.prayid = $prayid
                        AND pr.prayid = p.prayid";
    $prayerinfo = $db->fetchQuery($prayerinfoquery);

    $prayeruser = $prayerinfo[0]['userid'];
    $prayrel = $prayerinfo[0]['relid'];

    if($prayeruser != 1){
        removePrayer($prayerinfo, $db, $prayeruser);
        messageUser($prayeruser, $db);
        subRep($prayeruser, $prayrel, $db);
    }

    /**
     * 
     * Remove the prayer from the database
     * 
     */
    function removePrayer($prayer, $db, $id){
        $deleter = new prayerRemover($db, $id);
        $deleter->removePrayer($prayer[0]);
    }


    /**
     * 
     * Send a message to notify the user that his prayer has been removed
     * 
     */
    function messageUser($prayeruser, $db){
        $msg = 'One of your prayers has been flagged as not suitable for its religion and has been removed. Please only post postive content.';
        $msgquery = "INSERT INTO Messages(userid, msg)VALUES(1,'$msg')";
        $msgid = $db->InsertQuery($msgquery);

        $query = "INSERT INTO USER_MESSAGES(userid, messageid)VALUES('$prayeruser','$msgid')";
        $result = $db->InsertQuery($query);

        return true;
    }


    /**
     * 
     * When A prayer gets deleted the user will lose 50 reputation
     * 
     */
    function subRep($user, $rel, $db){
        $repquery = "UPDATE User_Religions
                     SET reputation = reputation - 50
                     WHERE userid = '$user'
                     AND relid = '$rel'";
        $represult = $db->UpdateQuery($repquery);
    }
?>