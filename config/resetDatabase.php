<?php
    include 'dbconfig.php';
    include 'permissions.php';


    if($id != 1){
        header('location:../index.php');
    }
    $file = "../sqlchanges.sql";
    $result = $db->runScriptFile($file);

    if($result = true){
        echo "Update Successful";
    }

?>