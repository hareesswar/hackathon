<?php
    $host = 'localhost'; 
    $db_name = 'user'; 
    $db_username = 'root'; 
    $db_password = ''; 

    try
    {
        $db = new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
		//echo "connected to db";
    }
    catch (PDOException $e)
    {
        exit('Error Connecting To DataBase');
    }
?>