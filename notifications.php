<?php 
    require 'config/ApplicationTop.php';
    include 'Classes/notificationCreator.php';
    include 'Classes/prayers.php';

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
            'active'=>'active'
        ],
        [
            'name'=>'Messages',
            'link'=>'messages.php',
            'active'=>''
        ]
    ];


    $title = "P.R.A.Y.";

    $header = new Header($db, $menus,$title,$css);
    $header->ShowUserMenu($id);
    $header->displayHeader();

    $prev = new PrayerCreator($db,$id);

    /**
     * 
     * Notifications for a user are comments and upvotes on a prayer
     * that is associated with that user
     * 
     * Do not include downvotes
     * If score on a prayer reaches the downvote limit give a warning
     * notification
     * 
     */
    $likesquery = "SELECT l.prayid, COUNT(l.userid) AS likes, l.dateLastMaint
                   FROM Likes l, Prayers p
                   WHERE p.userid = '$id'
                   AND p.prayid = l.prayid
                   AND l.isLike = 1
                   GROUP BY l.prayid, l.dateLastMaint
                   ORDER BY l.dateLastMaint desc";
    $likes = $db->fetchQuery($likesquery);

    $commentsquery = "SELECT COUNT(c.userid) AS comments, c.prayid, c.dateLastMaint
                      FROM Prayers p, Comments c
                      WHERE p.userid = '$id'
                      AND c.prayid = p.prayid
                      GROUP BY c.prayid, c.dateLastMaint
                      ORDER BY c.dateLastMaint desc";
    $comments = $db->fetchQuery($commentsquery);
    
    $notify = new Notificationer($db, $id, $prev);
?>
    <section class='index-body' id='body'>
    <div class='notification-feed'>
        <?php foreach($likes as $i){
            $notify->showLikes($i);    
        }?>
        <?php foreach($comments as $i){
            $notify->showComments($i);    
        }?>
    </div>
    </section>
<?php 
    $footer = new Footer($db,$src);
    $footer->buildFooter();
?>