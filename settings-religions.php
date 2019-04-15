<?php
    require 'config/ApplicationTop.php';
    include 'Classes/createUserSettings.php';

    $menus = [
        [
            'name'=>'Home',
            'link'=>'index.php',
            'active'=>''
        ],
        [
            'name'=>'Profile',
            'link'=>'profile.php',
            'active'=>''
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


    $header = new Header($db, $menus, $title, $css);
    $header->ShowUserMenu($id);
    $header->displayHeader();

    $settings = [
        [
            'name'=> 'Account',
            'link'=>'settings-account.php',
            'active'=>''
        ],
        [
            'name'=>'Password',
            'link'=>'settings-password.php',
            'active'=>''
        ],
        [
            'name'=>'Religions',
            'link'=>'settings-religions.php',
            'active'=>'current'
        ]
    ];
    $usersettings = new UserSettings($db,$settings,$id);

    $myreligionsquery = "SELECT r.religion_name, r.relid
                         FROM USER_RELIGIONS ur, Religions r
                         WHERE ur.userid = '$id'
                         AND ur.relid = r.relid
                         ORDER BY r.religion_name";
    $myreligions = $db->fetchQuery($myreligionsquery);

    $primaryreligionquery = "SELECT primary_Religion
                             FROM Users
                             WHERE userid = '$id'";
    $primaryreligion = $db->fetchQuery($primaryreligionquery);

    $prel = $primaryreligion[0]['primary_Religion'];


    $allreligionsquery = "SELECT DISTINCT r.religion_name, r.relid
                          FROM RELIGIONS r LEFT JOIN User_religions ur ON ur.relid = r.relid
                          WHERE r.relid <> 1
                          AND r.relid NOT IN (SELECT r.relid
                                          FROM Religions r, user_religions ur
                                          WHERE r.relid = ur.relid
                                          AND ur.userid = '$id')";
    $religions = $db->FetchQuery($allreligionsquery);


    ?>

<section class='index-body settings-index-body' id='body'>

    <?php $usersettings->displaySettings();?>
    <div>
    <div class='settings-religions-body'>

        <h1>My Religions</h1>
        <div class='my-religions'>
        <?php foreach($myreligions as $i){
            echo"<div class='religion-box'>
                <div class='religion-header'>
                <h1 class='religion-header-text header-white' >".$i['religion_name']."</h1>
                </div>
                <div class='addreligion-stats'>
                <h2 class='religion-header-text'>".countFollowers($i['relid'], $db)." Followers</h2>
                </div>
                <div class='religion-follow-action'>
                ";
                if($i['relid'] == $prel){
                    echo "<div>
                    <h3 class='religion-header-text'>Primary Religion</h3>
                    </div>";
                }else{
                echo "
                <form method='post' action='php/addReligion.php'>
                <button class='drop-religion ' value='".$i['relid']."' name='religion'>Unfollow</button>
                </form>
                <form method='post' action='php/addPrimary.php'>
                <button class='add-primary' value='".$i['relid']."' name='religion'>Make Primary</button>
                </form>";
                }
                echo"</div>
            </div>";
        }?>
        </div>
    </div>
    <div class='settings-religions-body'>
        <h1> All Religions </h1>
        <div class='all-religions'>
        <?php foreach($religions as $i){
            echo"<div class='religion-box'>
            <div class='religion-header header-white'>
            <h1 class='religion-header-text'>".$i['religion_name']."</h1>
            </div>
            <div class='addreligion-stats'>
            <h2 class='religion-header-text'>".countFollowers($i['relid'], $db)." Followers</h2>
            </div>
            <div class='religion-follow-action'>
            <form method='post' action='php/addReligion.php'>
            <button class='add-religion' value='".$i['relid']."' name='religion'>Follow</button>
            </form>
            </div>
        </div>";
        }?>
        </div>
    </div>
    </div>
<section>

<?php
    $footer = new Footer($db,$src);
    $footer->buildFooter();
?>
