<?php
    require '../config/ApplicationTop.php';

    $prayid = $_POST['prayid'];
    // $type = $_POST['type'];

    $checkquery = "SELECT *
                   FROM LIKES 
                   WHERE prayid = '$prayid' 
                   AND userid = '$id'";
    $check = $db->fetchQuery($checkquery);

    $prayerinfoquery = "SELECT p.userid, pr.relid
                        FROM Prayers p, Prayer_Religions pr
                        WHERE p.prayid = $prayid
                        AND pr.prayid = p.prayid";
    $prayerinfo = $db->fetchQuery($prayerinfoquery);

    $prayeruser = $prayerinfo[0]['userid'];
    $prayrel = $prayerinfo[0]['relid'];

    if($check){
        if($check[0]['isLike'] == 0){
            $query = "UPDATE LIKES
                  SET isLike = 1
                  WHERE userid = '$id'
                  AND prayid = '$prayid'";
            $result = $db->UpdateQuery($query);
            //Add two to users rep
            $repquery = "UPDATE User_Religions
                         SET reputation = reputation + 2
                         WHERE userid = '$prayeruser'
                         AND relid = '$prayrel'";
            $represult = $db->UpdateQuery($repquery);
        }else{
            $query = "DELETE FROM LIKES
                      WHERE userid = '$id'
                      AND prayid = '$prayid'";
            $result = $db->DeleteQuery($query);
            //sub 1 from users rep
            $repquery = "UPDATE User_Religions
                         SET reputation = reputation - 1
                         WHERE userid = '$prayeruser'
                         AND relid = '$prayrel'";
            $represult = $db->UpdateQuery($repquery);
        }
    }else{
        $query = "INSERT into LIKES(userid, prayid, isLike) VALUES
             ('$id', '$prayid', 1)";
        $result = $db->InsertQuery($query);
        //add 1 to users rep
        $repquery = "UPDATE User_Religions
                         SET reputation = reputation + 1
                         WHERE userid = '$prayeruser'
                         AND relid = '$prayrel'";
            $represult = $db->UpdateQuery($repquery);
    }

?>