<?php
    header('location:../index.php');
    include '../config/dbconfig.php';
    include '../config/permissions.php';


    $query = isset($_POST['query']) ? $_POST['query'] : '';
    $db->UpdateQuery($query);

    header('location:databasePage.php');
?>