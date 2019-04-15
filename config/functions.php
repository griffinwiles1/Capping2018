<?php
    function print_ary($array){
        $loop = 1;
        echo '<p style="margin:0px">Array=>[ </p>';
        RecursiveArray($array, $loop);
        echo ']</br>';
    }

    function RecursiveArray($array, $loop){
        $paddingamnt = $loop * 60;
        $padding = $paddingamnt.'px';
        $itr = 0;
        foreach($array as $i){
            $key = array_keys($array);
            if(is_array($i)){
                $newloop = $loop +1;
                echo '<p style="margin:0px; padding-left:'.$padding.'">['.$key[$itr].']=>[</p>';
                RecursiveArray($i, $newloop);
                echo '<p style="margin:0px; padding-left:'.$padding.'">]</p>';
                $itr += 1;
            }
            else{
                echo '<p style="margin:0px; padding-left:'.$padding.'">['.$key[$itr].']=>'.$i.'</p>';
                $itr += 1;
            }
        }
    }

    /**
     * Function to determine if a page is valid based
     * on the get vars being passed
     *
     * $test => An array of all the valid values for a get var
     * $vars => An array of all GET vars allowed for a page
     *
     * If no get vars are on a page set $test[] = [0] and $vars = ['']
     *
    */
    function checkValidPage($test,$vars){
        $isvalid = array_filter(
            $test,
            function($value,$key){
                return !in_array($key, $value);
            },
            ARRAY_FILTER_USE_BOTH
        );

        $varsvalid = true;
        $keys = array_keys($_GET);
        if(isset($_GET)){
            foreach($keys as $i){
                $validvar = false;
                foreach($vars as $check){
                    if($validvar){
                    continue;
                }
                if($i == $check){
                    $validvar = true;
                    continue;
                }
            }
                if($validvar){
                    continue;
                }else{
                    $varsvalid = false;
                }
            }
        }
        if(!empty($isvalid) || !$varsvalid){
            header('location:index.php');
            exit;
        }
    }


    /**
     * 
     * Hackers live in this world and will find any way to steal important information
     * This function will secure any variable that someone has the ability to type and send to the database
     * by changing those variables into php safe variables
     * 
     * Some examples -- Anytime someone uses a doublequote or singlequote the query using that variable gets
     * confused. We have to add escape keys to those quotes before we send it into a query.
     * 
     * Another example involves script tags. If someone type <script></script> into a prayer the prayer
     * should read that. We need to add escape keys to the < and > part of that string in order to keep people from running
     * javascript functions that can hack our code.
     * 
     * 
     */
    function cleanVar($var){
        return cleanForSQL(cleanforHTML($var));
    }

    /**
     *
     * This function will take a variable and make sure it is safe from sql injection
     * This function will inject escape keys into all single and double quotes to insure
     * that those values are read as quotes and not the start of php strings
     *
     * Example of sql injection => ';DROP TABLES; --
     *
     */
    function cleanForSQL($var){
        $var = str_replace("'", "\\'", $var);
        $var = str_replace('"', '\\"', $var);
        $var = str_replace('`', '\\`', $var);
        return $var;
    }

    /**
     *
     * This function will strip all html/js tags from a variriable
     * to make it safe from xss
     *
     * Example of xss => <script>alert('xss')</script>
     *
     */
    function cleanforHTML($var){
        $var = str_replace('<', '\\<', $var);
        $var = str_replace('>', '\\>', $var);
        return $var;
    }

    /**
     *
     * If date is within today, return how long ago it occured as a string ex: '2 hrs'
     * otherwise return the date as mon dd, yyyy ex: Jan 1, 2018
     *
     */
    function formatDate($date){
        $currentDate = new DateTime(null, new DateTimeZone('America/New_York'));
        $currentTime = $currentDate->format('Y-m-d H:i:s');
        $formattedDate;
        $month;
        switch (substr($date,5,2)) {
            case "01":
                $month = "January";
                break;
            case "02":
                $month = "February";
                break;
            case "03":
                $month = "March";
                break;
            case "04":
                $month = "April";
                break;
                case "05":
                $month = "May";
                break;
            case "06":
                $month = "June";
                break;
            case "07":
                $month = "July";
                break;
            case "08":
                $month = "August";
                break;
            case "09":
                $month = "September";
                break;
            case "10":
                $month = "October";
                break;
            case "11":
                $month = "November";
                break;
            case "12":
                $month = "December";
                break;
        }
        if (substr($currentTime,0,4) == substr($date,0,4)) {
            if (substr($currentTime,5,2) == substr($date,5,2)) {
                if (substr($currentTime,8,2) == substr($date,8,2)) {
                    if (substr($currentTime,11,2) == substr($date,11,2)) {
                        if (substr($currentTime,14,2) == substr($date,14,2)) {
                            if (intval(substr($currentTime,17,2)) - intval(substr($date,17,2)) == 1) {
                                $formattedDate = intval(substr($currentTime,17,2)) - intval(substr($date,17,2))." second ago";
                                return $formattedDate;
                            }
                            else {
                                $formattedDate = intval(substr($currentTime,17,2)) - intval(substr($date,17,2))." seconds ago";
                                return $formattedDate;
                            }
                        }
                        else {
                            if (intval(substr($currentTime,14,2)) - intval(substr($date,14,2)) == 1) {
                                $formattedDate = intval(substr($currentTime,14,2)) - intval(substr($date,14,2))." minute ago";
                                return $formattedDate;
                            }
                            else {
                                $formattedDate = intval(substr($currentTime,14,2)) - intval(substr($date,14,2))." minutes ago";
                                return $formattedDate;
                            }
                        }
                    }
                    else {
                        if (intval(substr($currentTime,11,2)) - intval(substr($date,11,2)) == 1) {
                            $formattedDate = intval(substr($currentTime,11,2)) - intval(substr($date,11,2))." hour ago";
                            return $formattedDate;
                        }
                        else {
                            $formattedDate = intval(substr($currentTime,11,2)) - intval(substr($date,11,2))." hours ago";
                            return $formattedDate;
                        }
                    }
                }
            }
        }
        $formattedDate = $month." ".substr($date,8,2).", ".substr($date,0,4);
        return $formattedDate;
    }


    /**
     *
     * Return the root of the current page so we can call any page from any folder
     *
     */
    function getRoot(){
        $root = ROOT_DIR;
        $root = str_replace("\\", "/", $root);
        $root = str_replace('/config', '',$root);
        $pageroot = getcwd() ."/";
        $pageroot = str_replace("\\", "/", $pageroot);
        $root = str_replace($root."/", '' , $pageroot);
        $root = preg_replace("#(/.*?).*?(/)#", '/../', "/".$root);
        $root = substr($root, 1);
        return $root;
    }

    /**
     *
     * Return the number of prayers sent by a user to the current religion
     *
     */
    function prayersSent($id, $relid, $db){
        $query = "SELECT COUNT(pr.prayid) as num
            FROM prayers p, prayer_religions pr
            WHERE p.prayid = pr.prayid
            AND p.userid = '$id'
            AND pr.relid = '$relid'";
        $result = $db->fetchQuery($query);
        if($result){
            return $result[0]['num'];
        }else{
            return 0;
        }
    }

    /**
     *
     * Return the date joined in dateFormat() format
     * hint: dateAdded
     *
     */
    function dateJoined($id, $relid, $db){
        $query = "SELECT user_religions.dateAdded FROM user_religions WHERE userid = '$id' AND relid = '$relid'";
        $result = $db->fetchQuery($query);
        if($result){
            return formatDate($result[0]['dateAdded']);
        } else{
            return "Not Joined";
        }
    }

    /**
     *
     * Calculate the users reputation for a religion
     *
     */
    function getReputation($id, $relid, $db){
        $query = "SELECT user_religions.reputation FROM user_religions WHERE userid = '$id' AND relid = '$relid'";
        $result = $db->fetchQuery($query);
        if($result){
            return $result[0]['reputation'];
        } else {
            return 0;
        }
    }

    /**
     *
     * Calculate the prayer's score based off the likes and dislikes
     * Like = Score + 1
     * Dislike = Score - 1
     *
     * Hint: (select count where isLike = 1) - (Select count where islike = 0)
     *
     */
    function prayerScore($prayid, $db){
        $score = 0;
        $queryLikes = "SELECT count(likes.isLike) as likes FROM likes WHERE isLike = 1 AND prayid = '$prayid'";
        $resultLikes = $db->fetchQuery($queryLikes);
        $queryDislikes = "SELECT count(likes.isLike) as dislikes FROM likes WHERE isLike = 0 AND prayid = '$prayid'";
        $resultDislikes = $db->fetchQuery($queryDislikes);
        if($resultLikes && $resultDislikes){
            $score = $resultLikes[0]['likes'] - $resultDislikes[0]['dislikes'];
            return $score;
        } else{
            return $score;
        }
    }

    /**
     * 
     * Return the Number of followers for a Religion
     *
     */
    function countFollowers($relid, $db){
        $query = "SELECT COUNT(userid) as num
                  FROM User_Religions
                  WHERE relid = '$relid'";
        $count = $db->fetchQuery($query);
        // print_ary($count);
        return $count[0]['num'];
    }



    /**
     * 
     * Return the name of the browser being used
     * 
     */
    function ExactBrowserName(){
        $ExactBrowserNameUA=$_SERVER['HTTP_USER_AGENT'];
        // echo $ExactBrowserNameUA;

        if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
            // OPERA
            $ExactBrowserNameBR="Opera";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
            // CHROME
            $ExactBrowserNameBR="Chrome";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
            // INTERNET EXPLORER
            $ExactBrowserNameBR="Internet Explorer";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
            // FIREFOX
            $ExactBrowserNameBR="Firefox";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {
            // SAFARI
            $ExactBrowserNameBR="Safari";
        } else {
            // OUT OF DATA
            $ExactBrowserNameBR="OUT OF DATA";
        };

        return $ExactBrowserNameBR;
    }
?>
