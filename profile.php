<?php
    require 'config/ApplicationTop.php';
    include 'Classes/prayers.php';
    include 'Classes/prayerCommentDisplayer.php';

    $pageid = isset($_GET['id']) ? $_GET['id'] : $id;

    $menus = [
        [
            'name'=>'Home',
            'link'=>'index.php',
            'active'=>''
        ],
        [
            'name'=>'Profile',
            'link'=>'profile.php',
            'active'=>'active'
        ],
        [
            'name'=>'Notifications',
            'link'=>'notifications.php',
            'active'=>''
        ],
        [
            'name'=>'Messages',
            'link'=>'messages.php',
            'active'=>''
        ]
    ];

    if($pageid != $id){
        $menus[1]['active'] = '';
    }

    $title = "P.R.A.Y.";

    $header = new Header($db, $menus,$title,$css);
    $header->ShowUserMenu($id);
    $header->displayHeader();

    $comments = new PrayerCommentDisplayer($db, $id);
    $feed = new PrayerCreator($db,$id,$comments);

    $prayerquery = "SELECT p.userid, u.fname, u.lname, u.username, p.content, pr.relid, p.prayid, p.img,
                        r.religion_name, u.pPicture, p.dateLastMaint
                    FROM Prayers p, Users u, Prayer_Religions pr, Religions r
                    WHERE p.userid = u.userid
                    AND pr.prayid = p.prayid
                    AND pr.relid = r.relid
                    AND u.userid = $pageid
                    ORDER BY p.prayid desc";
    $prayers = $db->FetchQuery($prayerquery);

    $prayertotalquery = "SELECT count(p.prayid) as total_prayers
                    FROM Prayers p, Users u, Prayer_Religions pr, Religions r
                    WHERE p.userid = u.userid
                    AND pr.prayid = p.prayid
                    AND pr.relid = r.relid
                    AND u.userid = $pageid";
    $totalprayers = $db->FetchQuery($prayertotalquery);

    $primaryrelquery = "SELECT r.religion_name
                      FROM Religions r, Users u
                      WHERE u.userid = $pageid
                      AND u.primary_religion = r.relid";
    $primaryrel = $db->fetchQuery($primaryrelquery);

    $allrelsquery = "SELECT r.religion_name
                      FROM Religions r, User_Religions u
                      WHERE u.userid = $pageid
                      AND u.relid = r.relid
                      ORDER BY r.religion_name";
    $allrels = $db->fetchQuery($allrelsquery);

    $userinfoquery = "SELECT username, fname, lname, bio, pPicture, bPicture, dateAdded, Primary_Religion
                      FROM Users
                      WHERE userid = $pageid";
    $userinfo = $db->fetchQuery($userinfoquery);
?>
    <section class='profile-page-body' id='body'>
    <div class='profile-banner'>
        <div class='profile-banner-box'>
            <img class='profile-banner-pic' src='images/Users/<?php echo $pageid?>/Banner/<?php echo $userinfo[0]['bPicture']?>'>
        </div>
    </div>
    <img class='profile-profile-pic' src='images/Users/<?php echo $pageid?>/Profile/<?php echo $userinfo[0]['pPicture']?>'>
    <div class='profile-body'>
        <h1 class='profile-header-name'><?php echo $userinfo[0]['fname'] . " " . $userinfo[0]['lname'] ?></h1>
    </div>

    <div id="bio">
        <?php echo $userinfo[0]['bio']?>
    </div>

    <div id="profile-stats">
        <p class="trends-header">My Stats</p>
        <p><b>Primary Religion:</b> <?php echo $primaryrel[0]['religion_name'] ?></p>
        <p><b>Total Prayers Sent:</b> <?php echo $totalprayers[0]['total_prayers'] ?></p>
        <p><b><?php echo count($allrels)?>
        Religions Followed:</b> <?php for($i = 0; $i < count($allrels); $i++) {
            if ($i == count($allrels) - 1) {
                echo $allrels[$i]['religion_name'];
            }
            else {
                echo $allrels[$i]['religion_name'].", ";
            }
        }?> </p>
    </div>

    <div id="profile-prayers">
        <?php
        foreach($prayers as $i){
            $feed->showPrayer($i);
        }?>
    </div>
    </section>
<?php
    $footer = new Footer($db,$src);
    $footer->buildFooter();
?>
