<?php
    require '../config/ApplicationTop.php';

    $relid = isset($_POST['religion']) ? $_POST['religion'] : '';

    $query = "UPDATE USERS SET primary_religion = '$relid' WHERE userid = '$id'";
    $update = $db->UpdateQuery($query);

    header('location:../settings-religions.php');
?>