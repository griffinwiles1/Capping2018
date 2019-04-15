<?php
    define('ROOT_DIR', __DIR__);
    // toggle this to change the setting
    define('DEBUG', false); 
    // you want all errors to be triggered
    //error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    $databaseServer = 'MYSQL';
    
    //LocalHost
    // $servername = '127.0.0.1';
    // $username = "root";
    // $password = "";
    // $dbname = 'psndata';


    //LiveHost
    $servername = '127.0.0.1';
    $username = "PrayAdmin";
    $password = "1nPabl0W3Trust";
    $dbname = 'psndata';
    
    if($databaseServer == 'MYSQL'){
        include dirname(__FILE__).'/../Database/mydb.php';
        
        // Create connection for MYSQL
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $db = new mydb($conn);   
    }
    
    if($databaseServer == 'Postgres'){
        include '/../Database/pgdb.php';
        
        //Create Connection for Postgres
        $conn = pg_connect("host=".$servername." user=".$username." password=".$password." dbname=".$dbname."");

        if (!$conn) {
            die('Could not connect: ' . pg_last_error());
        }
        
        //Postgres
        $db = new pgdb($conn);
    }
?>