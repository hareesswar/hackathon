<?php
    require 'connect.php';
    require 'class.php';
    $main = new Main($db);
    $main->user_course_list();
?>