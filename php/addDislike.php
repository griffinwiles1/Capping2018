<?php
    require '../config/ApplicationTop.php';

    $prayid = cleanVar($_POST['prayid']);
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
        if($check[0]['isLike'] == 1){
            $query = "UPDATE LIKES
                  SET isLIke = 0
                  WHERE userid = '$id'
                  AND prayid = '$prayid'";
            $result = $db->UpdateQuery($query);
            //Sub 2 from users Rep
            $repquery = "UPDATE User_Religions
                         SET reputation = reputation - 2
                         WHERE userid = '$prayeruser'
                         AND relid = '$prayrel'";
            $represult = $db->UpdateQuery($repquery);
        } else{
            $query = "DELETE FROM LIKES
                      WHERE userid = '$id'
                      AND prayid = '$prayid'";
            $result = $db->DeleteQuery($query);
            //Add 1 to users Rep
            $repquery = "UPDATE User_Religions
                         SET reputation = reputation + 1
                         WHERE userid = '$prayeruser'
                         AND relid = '$prayrel'";
            $represult = $db->UpdateQuery($repquery);
        }
    }else{
        $query = "INSERT into LIKES(userid, prayid, isLike) VALUES
             ('$id', '$prayid', 0)";
        $result = $db->InsertQuery($query);
        //Sub 1 From users Rep
        $repquery = "UPDATE User_Religions
                         SET reputation = reputation - 1
                         WHERE userid = '$prayeruser'
                         AND relid = '$prayrel'";
            $represult = $db->UpdateQuery($repquery);
    }

?>