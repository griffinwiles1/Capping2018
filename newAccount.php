<?php
    require 'config/ApplicationTop.php';
    $securityquests = ['What was the name of your childhood pet?',
                       'What was the model of your first car?',
                       'What is your mothers maiden name?',
                       'What was the name of the street you grew up on?'];

    // print_ary($_POST);
    if(isset($_POST['submit'])){
        $message = createAccount($db);
    }
    // print_ary($message);

    /**
     * Function To Create a New account.
     * If all the checks go through on the input fields, then create the account
     * 
     */
    function createAccount($db){
        $error['first'] = checkFirst();
        $error['username'] = checkUsername($db);
        $error['password'] = checkPassword();
        $error['security'] = checkSecurity();
        $itr = 0;
        foreach($error as $i){
            if($i == 1){
                $itr += 1;
                continue;
            }else{
                $key = array_keys($error);
                $message[$key[$itr]] = $i;
                $itr += 1;
            }
        }
        if(isset($message)){
            return $message;
        }else{
            doCreate($db);
        }
    }

    /**
     * 
     * Check the first not input
     * 
     */
    function checkFirst(){
        if(isset($_POST['firstname'])){
            if($_POST['firstname'] != ''){
                return true;
            }else{
                return 'Enter Your Name';
            }
        }
        return 'Enter Your Name';
    }

    /**
     * 
     * Check if the username is typed in
     * 
     */
    function checkUsername($db){
        if(isset($_POST['username'])){
            if($_POST['username'] != ''){
                return checkAvailableUsername($db);
            }else{
                return 'Enter Your Username';
            }
        }
        return 'Enter Your Username';
    }


    /**
     * 
     * Check if the username is taken
     * 
     */
    function checkAvailableUsername($db){
        $username = $_POST['username'];
        $usernamequery = "SELECT username
                          FROM users
                          WHERE username = '$username'";
        $usernameresult = $db->fetchquery($usernamequery);
        if($usernameresult){
            return 'Username is Taken';
        }else{
            return true;
        }
    }


    /**
     * 
     * Check password for completness 
     * 
     */
    function checkPassword(){
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirmpassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';
        if($password == ''){
            return 'Enter a Password';
        }
        if($confirmpassword == ''){
            return 'Confirm your Password';
        }
        if($password == $confirmpassword){
            $check = checkStrength($password);
            if($check == 'passed'){
                return true;
            } else{
                return $check;
            }

        }else{
            return 'Passwords Do Not Match';
        }
    }

    /**
     * 
     * Check password for strength
     * 
     */
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
     * Check if the security question is answered
     * 
     */
    function checkSecurity(){
        if(isset($_POST['securityAnswer'])){
            if($_POST['securityAnswer'] != ''){
                return true;
            }else{
                return 'Answer the security question';
            }
        }
        return 'Answer the security question';
    }


    /**
     * 
     * Create the account. First insert the information into the database, then Create the directories
     * 
     */
    function doCreate($db){
        $firstname = cleanVar($_POST['firstname']);
        $lastname = isset($_POST['lastname']) ? cleanVar($_POST['lastname']) : '';
        $username = cleanVar($_POST['username']);
        $password = cleanVar($_POST['password']);
        $security = cleanVar($_POST['securityAnswer']);
        $insertquery = "INSERT into USERS (fname,lname,username,user_password,pPicture,bPicture)
                        VALUES('$firstname', '$lastname','$username','$password' , 'default.png', 'default.png')";
        $insertresult = $db->InsertQuery($insertquery);
        createDir($insertresult);
        setDefaultPhoto($insertresult);
        setUser($insertresult);
        header('Location:'.getRoot().'newAccount-religion.php');
    }

    function createDir($id){
        mkdir(getRoot()."images/Users/".$id ,0777, true);
        mkdir(getRoot()."images/Users/".$id."/Profile" ,0777, true);
        mkdir(getRoot()."images/Users/".$id."/Banner" ,0777, true);
        mkdir(getRoot()."images/Users/".$id."/Uploads" ,0777, true);
    }

    function setDefaultPhoto($id){
        copy(getRoot()."images/icons/defaultProfile.jpg" , getRoot()."images/Users/".$id."/Profile/default.png");
        copy(getRoot()."images/icons/defaultBanner.png" , getRoot()."images/Users/".$id."/Banner/default.png");
    }

    $first_ph = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $last_ph = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $username_ph = isset($_POST['username']) ? $_POST['username'] : '';


    $message['first'] = isset($message['first']) ? $message['first'] : '';
    $message['username'] = isset($message['username']) ? $message['username'] : '';
    $message['password'] = isset($message['password']) ? $message['password'] : '';
    $message['security'] = isset($message['security']) ? $message['security'] : '';


    $title = "P.R.A.Y.";
    $header = new Header($db, $menus, $title, $css);
    $header->displayHeader();
?>
    <section class='newaccount-body'>
        <div class='newaccount-form-box'>
            <h2>Step One - Login Information</h2>
            <form id='newaccount-form-inputs' method='post' action='newAccount.php'>
                <div class='verifyerror' >
                    <?php echo $message['first'] ?>
                </div>
                <input type='text' name='firstname' placeholder='First Name' value='<?php echo $first_ph?>'
                       onKeyDown = 'if(!checkNameLength(this) && (event.keyCode != 8)){return false} 
                                    if (event.keyCode === 32) {return false;}' >
                <input type='text' name='lastname' placeholder='Last Name' value='<?php echo $last_ph?>'
                       onKeyDown = 'if(!checkNameLength(this) && (event.keyCode != 8)){return false} 
                                    if (event.keyCode === 32) {return false;}' >
                <div class='verifyerror' >
                    <?php echo $message['username'] ?>
                </div>
                <input type='text' name='username' placeholder='Username' value='<?php echo $username_ph?>'
                       onKeyDown = 'if(!checkUsernameLength(this) && (event.keyCode != 8)){return false} 
                                    if (event.keyCode === 32) {return false;}'>
                <div class='verifyerror' >
                    <?php echo $message['password'] ?>
                </div>
                <div class='hidden' id='failedpassword'>
                    Passwords Do Not Match
                </div>
                <div class='hidden' id='invalidChars'>
                    Password must reach 8 characters and contain at least one uppercase, and one number
                </div>
                <input type='password' id='password' name='password' placeholder='Password'>
                <input type='password' id='confirmpassword'name='confirmpassword' placeholder='Confirm Password' onblur='checkPassword()'>
                <div class='verifyerror'>
                    <?php echo $message['security'] ?>
                </div>
                <select name='security'>
                    <option value=0>Select a Security Question </option><?php
                    foreach($securityquests as $i){?>
                        <option value='<?php echo $i?>'><?php echo $i?></option><?php
                    }?>
                <input type='text' name='securityAnswer' placeholder='Enter Your Answer'></br>
                <button name='submit' type='submit' class='submit-button'>Create Account</button>
            </form>
        </div>

 <?php
    $footer = new Footer($db,$src);//Initialize the footer class
    $footer->buildFooter();//End file
?>

<script>
    function checkPassword(){
        var password = document.getElementById('password');
        var confirm = document.getElementById('confirmpassword');
        var passwordcontent = password.value;
        var confirmcontent = confirm.value;

        if(passwordcontent == confirmcontent){
            var failed = document.getElementById('failedpassword');
            checkStrength(passwordcontent);
            $(failed).fadeOut();
        }
        else{
            var failed = document.getElementById('failedpassword');
            $(failed).fadeIn();
        }
    }
    /**
     *
     * A password must have
     * 8 Digits
     * At least one Uppercase Letter, Lowercase Letter, and Special character
     *
     */
    function checkStrength(pw){
        var uppercase = new RegExp(/[A-Z]/);
        var number = new RegExp(/[0-9]/);
        var valid = true;
        if(pw.length < 8){
            valid = false;
        }
        if(!uppercase.test(pw)){
            valid = false;
        }
        if(!number.test(pw)){
            valid = false;
        }
        if(!valid){
            var failed = document.getElementById('invalidChars');
            $(failed).fadeIn();
        } else{
            var failed = document.getElementById('invalidChars');
            $(failed).fadeOut();
        }
    }
</script>
