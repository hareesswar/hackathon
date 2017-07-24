<?php
    require 'connect.php';
    require 'class.php';
    $main = new Main($db);
    $main->join_course();
?>