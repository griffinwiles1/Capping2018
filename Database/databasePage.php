<?php
header('location:../index.php');
    include '../config/dbconfig.php';
    include '../config/permissions.php';
    include '../config/functions.php';
    include '../Classes/createheader.php';
    include '../Classes/createFooter.php';
    include 'databaseTables.php';
    
    if($id != 1){
        header('location:../index.php');
    }

    $view = isset($_GET['view']) ? $_GET['view'] : 'Users';

    $menus = [
        [
            'name'=>'Home',
            'link'=>'../index.php',
            'active'=>''
        ],
        [
            'name'=>'Profile',
            'link'=>'../profile.php',
            'active'=>''
        ],
        [
            'name'=>'Notifications',
            'link'=>'../notifications.php',
            'active'=>''
        ],
        [
            'name'=>'Messages',
            'link'=>'../messages.php',
            'active'=>''
        ]
    ];
    $src[] = ["src"=>"../js/userMenu.js", "type"=>"js"];
    $src[] = ["src"=>"../js/removePrayer.js", "type"=>"js"];
    $src[] = ["src"=>"../js/jqueryinit.php","type"=>"php"];
    $src[] = ["src"=>"../js/autoGrow.js","type"=>"js"];
    $src[] = ["src"=>"../js/filterRel.js","type"=>"js"];
    $src[] = ["src"=>"../http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js","type"=>"js"];
    $src[] = ["src"=>"../js/composePrayer.js","type"=>"js"];
    $css[] = ["src"=>"../css/core.php","type"=>"css"];
    $title = "P.R.A.Y.";
    $header = new Header($db, $menus, $title, $css);
    $header->ShowUserMenu($id);
    $header->displayHeader();

    $tablesquery = "SELECT TABLE_NAME as tname FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = 'psndata'";
    $tables = $db->fetchQuery($tablesquery);
?>


<section class='database-body'>
    <div class='database-all-tables'>
    <?php
        foreach($tables as $i){
            echo "<div>";
            echo "<a href='databasePage.php?view=".$i['tname']."'>".$i['tname']. "</a>";
            echo "</div>";
        }
    ?>
    </div>
<div class='database-content-container'> 
    <div class='database-run-query'>
        <form method='post' action='runquery.php'>
            <input class='query-input'type='text' name='query' placeholder='Write Query'>
            <button type='submit' name='run'>Run Query</button>
        </form>
    </div>
    <div class='database-tables-box'>
        <?php 
            $table = new Table($db);
            $table->displayTable($view);
        ?>
    </div>

    <form method='post' action='resetDatabase.php'>
        <button type='submit' name='reset'>Reset Database</button>
    </form>
</div>
</section>

 <?php
    $footer = new Footer($db,$src);
    $footer->buildFooter();
?>