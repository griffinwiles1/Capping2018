<?php
include '../config/dbconfig.php';
include '../config/permissions.php';
include '../config/functions.php';
include '../Classes/prayerRemover.php';

print_ary($_POST);

$prayid = isset($_POST['delete']) ? $_POST['delete'] : '';

$prayerquery = "SELECT p.userid, p.prayid, p.img
                FROM Prayers p
                WHERE p.prayid = '$prayid'";
$prayer = $db->FetchQuery($prayerquery);
echo $prayerquery;
print_ary($prayer);

if($prayer){
    $deleter = new prayerRemover($db, $id);
    $deleter->removePrayer($prayer[0]);
}

header('Location:../index.php');
?>
