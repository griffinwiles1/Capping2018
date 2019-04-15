<?php
    require '../config/ApplicationTop.php';;

    $commid = isset($_POST['delete']) ? $_POST['delete'] : '';

    $removequery = "DELETE FROM Comments WHERE commid = '$commid'";
    $result = $db->DeleteQuery($removequery);

    header('Location:../index.php');
?>