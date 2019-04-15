<?php
    /**
     * Include this file first on every single php file
     * This script initializes the database, adds all custom built functions
     * includes the header and footer script, adds all css files, and includes all js functions
     * to be used throughout the site.
     * 
     */
    include 'dbconfig.php';
    include 'functions.php';
    include getRoot().'config/permissions.php';
    include getRoot().'Classes/createheader.php';
    include getRoot().'Classes/createFooter.php';

    $src[] = ["src"=>"js/userMenu.js", "type"=>"js"];
    $src[] = ["src"=>"js/removePrayer.js", "type"=>"js"];
    $src[] = ["src"=>"js/jqueryinit.php","type"=>"php"];
    $src[] = ["src"=>"js/autoGrow.js","type"=>"js"];
    $src[] = ["src"=>"js/filterRel.js","type"=>"js"];
    $src[] = ["src"=>"https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js","type"=>"js"];
    $src[] = ["src"=>"js/composePrayer.js","type"=>"js"];
    $src[] = ["src"=>"js/searchUsers.js","type"=>"js"];
    $src[] = ["src"=>"js/LikeDislike.js","type"=>"js"];
    $src[] = ["src"=>"js/mobileHeader.js", "type"=>"js"];
    $src[] = ["src"=>"js/mobileMessages.js", "type"=>"js"];
    $src[] = ["src"=>"js/settings.js", "type"=>"js"];

    $css[] = ["src"=>"css/core.php","type"=>"css"];

    $title = "P.R.A.Y.";
?>
