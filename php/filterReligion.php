<?php
require '../config/ApplicationTop.php';

$newrelid = isset($_POST['religion']) ? $_POST['religion'] : '';

if($newrelid != ''){
    $_SESSION['currel'] = $newrelid;
}

header('location:../index.php');
?>
