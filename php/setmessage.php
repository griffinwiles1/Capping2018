<?php
    include '../config/dbconfig.php';
    include '../config/permissions.php';
    include '../config/functions.php';
    $_SESSION['curconvo'] = isset($_POST['userid']) ? $_POST['userid'] : 'Post var not set';
    // echo $_SESSION['curconvo'];
    header('location:../messages.php');
    // print_ary($_SESSION);
?>