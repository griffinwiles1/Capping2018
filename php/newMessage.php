<?php
    require '../config/ApplicationTop.php';


    $username = isset($_GET['name']) ? $_GET['name'] : '';

    if($username != ''){
        $query = "SELECT u.userid
                  FROM users u
                  WHERE u.username = '$username'";
        $result = $db->fetchQuery($query);

        $newid = $result[0]['userid'];

        $_SESSION['curconvo'] = $newid;
    }

    header('location:../messages.php');

?>