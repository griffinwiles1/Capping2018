<?php
    session_start();
    $_SESSION['userId'] = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
    $id =  isset($id) ? $id : $_SESSION['userId'];
    $usersettings = isLoggedIn($id, $db);
    // $username = $usersettings['username'];
    // $firstname = $usersettings['firstname'];
    // $lastname = $usersettings['lastname'];
    // $browser = ExactBrowserName();
    // checkBrowser($browser);
    //print_ary($usersettings);
    // $password = $usersettings['password'];

    function checkUser($username, $pass, $db, $attempts){
        $validuserquery = "SELECT userid
                           FROM Users
                           WHERE username = '$username'
                           AND user_password = '$pass'";
        $checkResult = $db->FetchQuery($validuserquery);
        if($checkResult){
            setUser($checkResult[0]['userid']);
            header('Location:index.php');
        }
        else{
            $response['error'] = 'Please Enter a Valid Username and Password';
            $newattempts = $attempts + 1;
            $response['attempts'] = $newattempts;
            if($newattempts > 5){
                header('location:verifyAccount.php');
            } else{
               return $response;
            }
        }
    }

    function setUser($id){
        $_SESSION['userId'] = $id;
        return $_SESSION['userId'];
    }

    function isLoggedIn($id, $db){
        $SETTINGS['username'] = '';
        $SETTINGS['firstname'] = ''; 
        $SETTINGS['lastname'] = ''; 
        $SETTINGS['password'] = '';    
        if($_SESSION['userId'] != ''){
            checkPReligion($id, $db);
            return $SETTINGS;
        }
        else{
            $page = basename($_SERVER['REQUEST_URI']);
            if (require_login($page)) {
                header('Location:login.php');
            }else{
                return false;
            }
        }
    }

    function checkPReligion($id, $db){
        $query = "SELECT u.primary_religion
                  FROM Users u
                  WHERE u.userid = $id";
        $result = $db->fetchQuery($query);
        $page = basename($_SERVER['REQUEST_URI']);
        if($page != 'newAccount-religion.php' && $page != 'core.php'){
            if($result[0]['primary_religion'] == null){
                header('Location:newAccount-religion.php');
            } else{
                return true;
            }
        }
        return true;
    }

    function signOut(){
        session_destroy();
        header('Location:login.php');
    }

    function require_login($page){
        $nologin = ['login.php','newAccount.php', 'core.php'];
        foreach($nologin as $i){
            if($i == $page){
                return false;
            }else{
                continue;
            }
        }
        return true;
    }

    /**
     * 
     * Return an array ($_PERMISSIONS[]) that defines what a user can and cannot do
     * for a certain religion based off their reputation
     * 
     */
    function returnPermissions($id, $relid){
        $repquery = "SELECT reputation, isMod
                     FROM User_Religions
                     WHERE userid = $id
                     AND relid = $relid";
        $rep = $this->db->fetchQuery($repquery);
        $_PERMISSIONS['canpray'] = false;
        $_PERMISSIONS['cancomment'] = false;
        $_PERMISSIONS['canlike'] = false;
        $_PERMISSIONS['canreport'] = false;
        //Write checks here

        if($rep['isMod']){
            $_PERMISSIONS['canpray'] = true;
            $_PERMISSIONS['cancomment'] = true;
            $_PERMISSIONS['canlike'] = true;
            $_PERMISSIONS['canreport'] = true;
        }
        return $_PERMISSIONS;
    }

    /**
     * 
     * Check if the current browser is supported
     * 
     */
    function checkBrowser($browser){
        // print_ary($browser);
        echo $browser;
        $supported = ['Chrome'];
        $check = false;
        foreach($supported as $i){
            if($i = $browser){
                $check = true;
                continue;
            }
        }
        if(!$check){
            header('Location:unsupportedBrowser.php');
        }
    }
?>