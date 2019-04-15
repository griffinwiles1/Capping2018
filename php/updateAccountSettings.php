<?php
require '../config/ApplicationTop.php';
include getRoot().'Classes/ImageUploader.php';

print_ary($_POST);
print_ary($_FILES);

$curUserInfoquery = "SELECT * FROM USERS WHERE userid = $id";
$curUserInfo = $db->fetchQuery($curUserInfoquery);

$username = isset($_POST['username']) ? cleanVar($_POST['username']) : $curUserInfo[0]['username'];

if($id == 1){
    $username = "Admin";
}

$username = substr($username , 0, 12);

$bio = isset($_POST['bio']) ? cleanVar($_POST['bio']) : $curUserInfo[0]['bio'];

//upload profile image
if ($_FILES['profile']['size'] != 0 && $_FILES['profile']['error'] == 0){
    $pPic = $_FILES['profile'];
    $profileupload = new fileUploader($db,'Profile',$id);
    $profileupload->uploadFile($pPic);
}

//upload banner image
if ($_FILES['banner']['size'] != 0 && $_FILES['banner']['error'] == 0){
    $bPic = $_FILES['banner'];
    $bannerupload = new fileUploader($db,'Banner',$id);
    $bannerupload->uploadFile($bPic);
}

//update user table
$query = "UPDATE USERS set username = '$username' , bio = '$bio' WHERE userid = $id";
$result = $db->UpdateQuery($query);

//return to settings-account.php
header('location:'.getRoot().'settings-account.php');

?>