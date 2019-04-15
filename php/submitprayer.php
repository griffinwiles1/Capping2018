<?php 
    require '../config/ApplicationTop.php';
    include getRoot().'Classes/ImageUploader.php';

    $relid = isset($_POST['religion']) ? $_POST['religion'] : '';
    $content = isset($_POST['newprayer']) ? cleanVar($_POST['newprayer']) : '';
    $img = isset($_FILES['upload']) ? $_FILES['upload'] : '' ;

    $content = substr($content, 0 , 139);

    print_ary($_FILES);
    print_ary($_POST);

    $keys = array_keys($_POST);
    
    $tags = [];

    foreach($keys as $i){
        $str = $i;
        $check = 'tag--';
        if(strpos($str, $check) !== false){
            $tags[] = $_POST[$i];
        }
    }

    //print_ary($tags);

    if($content != ''){

        if($img['error'] != 4){
            $uploadtype = 'Uploads';
            $uploader = new fileUploader($db,$uploadtype,$id);
            $imgname = $uploader->uploadFile($img);
            if($imgname['error']){
                $error = $imgname['str'];
            }else{
                $name = $imgname['str'];
                $prayerquery = "INSERT into PRAYERS(userid, content, img) 
                        VALUES ($id , '$content', '$name')";
            $prayid = $db->InsertQuery($prayerquery);
            addTags($tags, $prayid, $db);
            addprayerReligion($prayid, $relid, $db);
            
            header('location:../index.php');
        }
        }else{
            $prayerquery = "INSERT into PRAYERS(userid, content, img) 
                            VALUES ($id , '$content', null)";
            $prayid = $db->InsertQuery($prayerquery);
            
            addTags($tags, $prayid, $db);
            addprayerReligion($prayid, $relid, $db);
            
            header('location:../index.php');
        }
    }else{
        header('location:../index.php');
    }
    
    function addprayerReligion($prayid, $relid,$db){
        $prayerrelquery = "INSERT into Prayer_Religions(prayid, relid)
                            Values ($prayid, $relid)";
        $prayerrelresult = $db->Insertquery($prayerrelquery);
    }
    
    function addTags($tags, $prayid, $db){
        foreach($tags as $i){
            $name = substr($i, 0, 13);
            $checkquery = "SELECT *
                           FROM Tags
                           WHERE tag_name = '$name'";
            $check = $db->fetchQuery($checkquery);
            if(!$check){
                $newTagQuery = "INSERT into TAGS(tag_name)VALUES('$name')";
                $newTag = $db->InsertQuery($newTagQuery);
                $tagPrayerQuery = "INSERT INTO PRAYER_TAGS(prayid, tagid) VALUES($prayid, $newTag)";
                $tagPrayer = $db->InsertQuery($tagPrayerQuery);
            }else{
                $tagid = $check[0]['tagid'];
                $tagPrayerQuery = "INSERT INTO PRAYER_TAGS(prayid, tagid) VALUES ($prayid, $tagid )";
                $tagPrayer = $db->InsertQuery($tagPrayerQuery);
            }
        }
    }
    ?>