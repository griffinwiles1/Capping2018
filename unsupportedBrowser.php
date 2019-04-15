<?php
    require 'config/ApplicationTop.php';
    $browser = ExactBrowserName();

    // print_ary($browser);
    $supported = ['Chrome'];
    foreach($supported as $i){
        if($i = $browser){
            header('Location:'.getRoot().'index.php');
        }
    }
    echo "</br>This Browser is currently not supported by P.R.A.Y.";
    


?>