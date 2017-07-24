<?php
    require 'connect.php';
    require 'class.php';
    $main = new Main($db);
    $main->details();
?>