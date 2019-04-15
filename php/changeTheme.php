<?php
    require '../config/ApplicationTop.php';

    $curthemequery = "SELECT u.theme
                      FROM USERS u
                      WHERE u.userid = $id";
    $curthemeresult = $db->fetchQuery($curthemequery);

    $curtheme = $curthemeresult[0]['theme'];

    $newtheme = "DARK";

    if($curtheme == 'DARK'){
        $newtheme = 'LIGHT';
    }

    $updatethemequery = "UPDATE USERS
                         SET theme = '$newtheme'
                         WHERE userid = $id";
    $updatetheme = $db->updateQuery($updatethemequery);

    header('location:../index.php');
?>