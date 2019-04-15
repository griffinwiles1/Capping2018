<?php
require '../config/ApplicationTop.php';
include '../Classes/prayerCommenter.php';

print_ary($_POST);

$prayid = isset($_POST['prayid']) ? $_POST['prayid'] : '';
$comment = isset($_POST['comment']) ? cleanVar($_POST['comment']) : '';

if($prayid){
    $checkprayer = CheckExists($prayid, $db);
    if($checkprayer){
        $commenter = new prayerCommenter($db, $id);
        $result = $commenter->createComment($prayid, $comment);
        echo $result;
    }
}

/**
 * 
 * Sometimes a person will comment on a prayer as that prayer is getting deleted
 * we need to check that the prayer still exists with this function.
 * 
 */
function CheckExists($id, $db){
    $query = "SELECT p.prayid
              FROM Prayers p
              WHERE p.prayid = '$id'";
    $result = $db->fetchQuery($query);
    if($result){
        return true;
    }
    return false;
}

header('Location:../index.php');
?>