<?php
    require 'connect.php';
    require 'class.php';
    $main = new Main($db);
    $main->update_course_list();
?>