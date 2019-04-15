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
            'active'=>'current'
        ],
        [
            'name'=>'Password',
            'link'=>'settings-password.php',
            'active'=>''
        ],
        [
            'name'=>'Religions',
            'link'=>'settings-religions.php',
            'active'=>''
        ]
    ];
    $usersettings = new UserSettings($db,$settings,$id);

    $userinfoquery = "SELECT * FROM USERS where userid = $id";
    $userinfo = $db->fetchQuery($userinfoquery);
    ?>

<section class='index-body settings-index-body' id='body'>

    <?php $usersettings->displaySettings();?>

    <div class='account-settings-body'>
    <div class='account-settings-box'>
        <h1>Account Settings</h1>
    </div>
    <div class='account-settings-box'>
        <form method='post' action='php/updateAccountSettings.php' enctype='multipart/form-data'>
            <h3 class='settings-header'>Username</h3>
            <input type='text' 
                   name='username' 
                   value=<?php echo $userinfo[0]['username'] ?>
                   onKeyDown = 'if(!checkUsernameLength(this) && (event.keyCode != 8)){return false} 
                                if (event.keyCode === 32) {return false;}'
            >
    </div>
    <div class='account-settings-box settings-pictures-box'>
        <div class='settings-profile-pic-box'>
            <h3 class='settings-header'>Profile Picture</h3>
                <input type='file' name='profile' id='profile' class='inputfile' onchange='updateProfile(this)'>
                <div id='profile-prev'>
                    <h3 class='settings-header' id='profile-size-error' style='display:none; color:#ff0000'>Image too Large. Must be less than 500KB</h3>
                    <img src='<?php echo getRoot()."images/Users/".$id."/Profile/".$userinfo[0]['pPicture']?> ' id='profile-preview'>
                </div>
                <div class='settings-picture-button'>
                <label for="profile">Change Picture</label>
                </div>
        </div>
        <div>
            <h3 class='settings-header'>Banner Picture</h3>
                <input type='file' name='banner' id='banner' class='inputfile' onchange='updateBanner(this)'>
                <div id='banner-prev'>
                    <h3 class='settings-header' id='banner-size-error' style='display:none; color:#ff0000'>Image too Large. Must be less than 500KB</h3>
                    <img src='<?php echo getRoot()."images/Users/".$id."/Banner/".$userinfo[0]['bPicture']?> ' id='banner-preview'>
                </div>
                <div class='settings-picture-button'>
                <label for="banner">Change Picture</label>
                </div>
        </div>
    </div>
    <div class='account-settings-box'>
                <div class='account-bio'>
                <h3 class='settings-header'>Bio</h3><textarea name='bio' onkeyup='auto_grow(this)' value=''><?php echo $userinfo[0]['bio']?></textarea>
                </div>
    </div>
    <div class='account-settings-box'>
                <div class='update-button'>
                    <button type='submit' name='update' id='update-settings'>Update Settings</button>
                </div>
        </form>
    </div>
    </div>

<section>

<?php
    $footer = new Footer($db,$src);
    $footer->buildFooter();
?>
