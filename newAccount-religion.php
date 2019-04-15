<?php
    include 'config/dbconfig.php';
    include 'config/permissions.php';
    include 'config/functions.php';

    $chosen = isset($_POST['religion']) ? $_POST['religion'] : '';

    $checkquery = "SELECT u.primary_religion
                  FROM Users u
                  WHERE u.userid = $id";
    $checkresult = $db->fetchQuery($checkquery);
    if($checkresult[0]['primary_religion'] != NULL){
        header('Location:'.getRoot().'index.php');
    }

    $religionsquery = "SELECT DISTINCT r.relid, r.religion_name
                       FROM Religions r
                       WHERE r.relid <> 1
                       ORDER BY r.religion_name";
    $religions = $db->fetchQuery($religionsquery);

    if($chosen != ''){
        $prquery = "UPDATE Users SET primary_religion = '$chosen' WHERE userid = $id";
        $prqueryresult = $db->UpdateQuery($prquery);
        if($prqueryresult){
            $urquery = "INSERT INTO User_religions(userid, relid) Values('$id','$chosen')";
            $urqueryresult = $db->insertQuery($urquery);
            header('Location:'.getRoot().'index.php');
        }
    }
?>

<html>
    <head>
        <title>PSN-Login</title>
</head>
<link rel='stylesheet' type='text/css' href='css/core.php'>
<link href='https://fonts.googleapis.com/css?family=Work Sans' rel='stylesheet'>
<body>
<section class='header login'>
    <div class='header-box'>
        <ul>
            <li class='header-link'>
            <a href='login.php'>Home</a></li>
        </ul>
    </div>
</section>
    <section class='newaccount-body'>
        <div class='newaccount-form-box'>
            <h2>Step Two - Choose Religion</h2>
            <div class='religions-container'> 
                <?php foreach($religions as $i){
                    echo"<div class='religion-box'>
                    <div class='religion-header header-white'>
                    <h1 class='religion-header-text'>".$i['religion_name']."</h1>
                    </div>
                    <div class='addreligion-stats'>
                    <h2 class='religion-header-text'>".countFollowers($i['relid'], $db)." Followers</h2>
                    </div>
                    <div class='religion-follow-action'>
                    <form id='set-up-religion ' method='post' action='newAccount-religion.php'>
                    <button class='add-religion' value='".$i['relid']."' name='religion'>Follow</button>
                    </form>
                </div>
                </div>";     
                }?>
            </div>
        </div>
    </section>
</body>
</html>