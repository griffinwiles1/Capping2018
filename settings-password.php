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
            'active'=>'current'
        ],
        [
            'name'=>'Religions',
            'link'=>'settings-religions.php',
            'active'=>''
        ]
    ];
    $usersettings = new UserSettings($db,$settings,$id);

    $check = isset($_POST['change-password']) ? 1 : 0;

    $oldpass = isset($_POST['oldpass']) ? cleanVar($_POST['oldpass']) : '';
    $newpass = isset($_POST['newpass']) ? cleanVar($_POST['newpass']) : '';
    $verifypass = isset($_POST['verifypass']) ? cleanVar($_POST['verifypass']) : '';
    $error['old'] = '';
    $error['password'] = '';
    if($check == 1){
        $error['old'] = checkOld($oldpass, $db, $id);
        $error['password'] = checkPassword($newpass, $verifypass);
        $validate = validate($error);
        if($validate){
            $success = addNew($newpass, $db, $id);
        }
    }

    /**
     *
     * Check the old password to make sure it matches
     * what is in the database. If password does not match
     * give an error.
     *
     */
    function checkOld($old, $db, $id){
        $query = "SELECT user_password
                  FROM Users
                  WHERE userid = $id";
        $check = $db->fetchQuery($query);
        if($check[0]['user_password'] == $old){
            return '';
        } else{
            return 'Invalid Password';
        }
    }

    function checkPassword($password, $confirmpassword){
        if($password == ''){
            return 'Enter a Password';
        }
        if($confirmpassword == ''){
            return 'Confirm your Password';
        }
        if($password == $confirmpassword){
            $check = checkStrength($password);
            if($check == 'passed'){
                return '';
            } else{
                return $check;
            }

        }else{
            return 'Passwords Do Not Match';
        }
    }

    function checkStrength($password){
        if(!preg_match('/[A-Z]/', $password)){
            return "Password must contain an Uppercase Letter";
        }
        if(!preg_match('/[0-9]/', $password)){
            return "Password must contain a Number";
        }
        if(strlen($password) < 8){
            return "Password must be 8 characters in Length";
        }
        return 'passed';
    }

    /**
     *
     *
     */
    function validate($error){
        foreach($error as $i){
            if($i != ''){
                return false;
            }
        }
        return true;
    }

    /**
     *
     * Once all the checks have been cleared, update the password in the database
     *
     */
    function addNew($new, $db, $id){
        $query = "UPDATE Users SET user_password = '$new' WHERE userid = $id";
        $result = $db->fetchQuery($query);
        return 'Password Update Worked!';
    }

    ?>

<section class='index-body settings-index-body' id='body'>
    <?php $usersettings->displaySettings();?>
    <div class='account-settings-body'>
        <div class='account-settings-box'>
            <h1>Update Your Password</h1>
        </div>
        <div class='account-settings-box'>
            <form method='post' action=''>
            <h3>Old Password</h3>
            <input class='password-change' id='oldpassword' type='password' name='oldpass' placeholder='Enter Your Old Password'>
            <p class='error' style='display:inline-block'><?php echo $error['old']?></p>
            <h3>New Password</h3>
            <input class='password-change' id='newpassword' type='password' name='newpass' placeholder='Enter Your New Password'>
            <p class='error' style='display:inline-block'><?php echo $error['password']?></p>
            <h3>Verify New Password</h3>
            <input class='password-change' id='verifypassword' type='password' name='verifypass' placeholder='Verify Your New Password'>
            </br>
            <button type='submit' name='change-password'>Update</button>
            </form>
            <?php if(isset($success)){
                echo "<p>".$success."</p>";
            }
            ?>
        </div>
    </div>

<section>

<?php
    $footer = new Footer($db,$src);
    $footer->buildFooter();
?>
