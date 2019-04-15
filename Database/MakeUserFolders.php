<?php
    header('location:../index.php');
    require '../config/ApplicationTop.php';

    $userquery = "SELECT u.userid, u.pPicture, u.bPicture
                  FROM Users u";
    $users = $db->FetchQuery($userquery);

    $curdirs = glob("../images/Users/*" , GLOB_ONLYDIR);

    foreach($users as $i){
        $new = true;
        foreach($curdirs as $j){
            $dirnum = str_replace('../images/Users/', '' , $j);
            if(!$new){
                continue;
            }
            if($j == $i['userid']){
                $new = false;
                continue;
            }
            if($new){
                mkdir(getRoot()."images/Users/".$i['userid'] );
                mkdir(getRoot()."images/Users/".$i['userid']."/Profile" );
                mkdir(getRoot()."images/Users/".$i['userid']."/Banner" );
                mkdir(getRoot()."images/Users/".$i['userid']."/Uploads" );
                copy(getRoot()."images/icons/defaultProfile.jpg" , getRoot()."images/Users/".$i['userid']."/Profile/".$i['pPicture']);
                copy(getRoot()."images/icons/defaultBanner.png" , getRoot()."images/Users/".$i['userid']."/Banner/".$i['bPicture']);
            }
        }
    }
?>