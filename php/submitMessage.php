<?php
require '../config/ApplicationTop.php';


print_ary($_POST);

$recid = isset($_POST['id']) ? $_POST['id'] : '';
$msg = isset($_POST['msg']) ? cleanVar($_POST['msg']) : '';

function sendMessage($recid, $msg, $id, $db){
    $msg = checkMessage($msg);//make sure message is safe
    if($msg){
        $msgid = createMessage($msg,$id,$db);//create message in messages table
        linkMessage($recid,$msgid,$db);//send created message to the user in User_Messages table
    }
    header('location:../messages.php');
}

//Check message for content, sql injection and xss
function checkMessage($msg){
    if($msg == ''){
        return false;
    }else{
        // echo cleanForHTML($msg);
        return cleanForHTML($msg);
    }
}

//create the message
function createMessage($msg, $id,$db){
    $query = "INSERT INTO Messages(userid, msg)VALUES('$id','$msg')";
    $result = $db->InsertQuery($query);
    return $result;
}

//link the message to other user
function linkMessage($recid,$msgid,$db){
    $query = "INSERT INTO USER_MESSAGES(userid, messageid)VALUES('$recid','$msgid')";
    $result = $db->InsertQuery($query);
}

sendMessage($recid, $msg, $id, $db);

?>