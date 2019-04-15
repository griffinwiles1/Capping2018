<?php
    require '../config/ApplicationTop.php';

    $relid = isset($_POST['religion']) ? $_POST['religion'] : '';

    $checkquery = "SELECT *
                   FROM User_Religions
                   WHERE relid = '$relid'
                   AND userid = '$id'";
    $check = $db->fetchQuery($checkquery);

    if(!$check){
        $insertquery = "INSERT INTO USER_RELIGIONS(relid, userid) VALUES($relid, $id)";
        $insert = $db->InsertQuery($insertquery);
        echo "Inserted";
    }else{
        $deleteQuery = "DELETE FROM User_Religions WHERE userid = '$id' AND relid = '$relid'";
        $delete = $db->DeleteQuery($deleteQuery);
        echo "Deleted";
    }

    header('location:../settings-religions.php');
?>