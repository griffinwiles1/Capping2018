<?php
    header('location:../index.php');
    include '../config/dbconfig.php';
    include '../config/permissions.php';
    include '../config/functions.php';

    if($id != 1){
        header('location:../index.php');
    }
    $file = "../sqlchanges.sql";
    $result = $db->runScriptFile($file);
    
    if($result = true){
        resetDirectories($db);
        // echo "Update Successful";
    }

    /**
     * 
     * 1)Gather all Directories from images/Users directory
     * 2)Loop through Directory and clear all content in them, then delete them
     * 3)Remake directory based off all ids in new users table
     * 4)add Profile and Banner Picture based off users table
     * 
     */
    function resetDirectories($db){
        $useridquery = "SELECT userid, pPicture, bPicture FROM Users";
        $userids = $db->fetchQuery($useridquery);
        $curdirs = glob("../images/Users/*" , GLOB_ONLYDIR);
        //Delete Directories not in users table
        foreach($curdirs as $i){
            $erase = true;
            $dirnum = str_replace('../images/Users/', '' , $i);
            // echo $i .'</br>';
            // echo $dirnum .'</br>';
            foreach($userids as $id){
                if(!$erase){
                    continue;
                }
                if($dirnum == $id['userid']){
                    $erase = false;
                    continue;
                }
            }
            if($erase){
                echo "Delete Directory ". $dirnum. '</br>';
                $it = new RecursiveDirectoryIterator($i, RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new RecursiveIteratorIterator($it,
                            RecursiveIteratorIterator::CHILD_FIRST);
                foreach($files as $file) {
                    if ($file->isDir()){
                        rmdir($file->getRealPath());
                    } else {
                        unlink($file->getRealPath());
                    }
                }
                rmdir($i);
            }
        }
        // Add new Directories in User Table
        foreach($userids as $id){
            $add = true;
            foreach($curdirs as $i){
                if(!$add){
                    continue;
                }
                $dirnum = str_replace('../images/Users/', '' , $i);
                if($id['userid'] == $dirnum){
                    $add = false;
                    continue;
                }
            }
            if($add){
                mkdir(getRoot()."images/Users/".$id['userid'] );
                mkdir(getRoot()."images/Users/".$id['userid']."/Profile" );
                mkdir(getRoot()."images/Users/".$id['userid']."/Banner" );
                mkdir(getRoot()."images/Users/".$id['userid']."/Uploads" );
                copy(getRoot()."images/icons/defaultProfile.jpg" , getRoot()."images/Users/".$id['userid']."/Profile/".$id['pPicture']);
                copy(getRoot()."images/icons/defaultBanner.png" , getRoot()."images/Users/".$id['userid']."/Banner/".$id['bPicture']);
            }
        }
    }

    header('location:databasePage.php');
?>