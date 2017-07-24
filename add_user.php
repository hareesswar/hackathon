<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "user";
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $response = array();
		    $result=false;
	 
 
		    $name = $_POST['user_name'];
		    $email = $_POST['user_email'];
		    $password = $_POST['user_pass'];
		    $repass=$_POST['user_repass'];
		    $phone=$_POST['user_phone'];
		    $city=$_POST['user_city'];

	try {
	    
	    $sql = "SELECT * from users where email='$email'and password='$password')";
	    $conn->exec($sql);
	    
	    $response["success"] = 1;
	    $response["message"] = "User successfully created.";
	 
	    echo json_encode($response);
	    }
	catch(PDOException $e)
	    {
	    
	     $response["success"] = 0;
	        $response["message"] = "An error occurred.";
	        echo json_encode($response);
	    }
	$conn = null;

?>