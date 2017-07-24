<?php
    
    class Main
    {
	  private $db;
      public function __construct($database)
	  {
        $this->db=$database;		
      }
	  public function add_user()
	  {
	    $response = array();
	    $result=false;
 
	 
	    $name = $_POST['user_name'];
	    $email = $_POST['user_email'];
	    $password = $_POST['user_pass'];
	    $repass=$_POST['user_repass'];
	    $phone=$_POST['user_phone'];
	    $city=$_POST['user_city'];
	 
	    $result=$this->db->query("INSERT INTO users (name,email,password,phone,city) VALUES ('$name','$email','$password','$phone','$city')");
	    if ($result) {
        $response["success"] = 1;
        $response["message"] = "User successfully created.";
 
        echo json_encode($response);
    	} else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    	}
		
	  }
	  public function show_feed()
	  {
	  	$response=array();
	    $result=$this->db->query("SELECT * from courses");
	    foreach ($result as $row) {
	    	array_push($response,$row["course"]);

	    }
	    	
	    	echo json_encode($response);
	  }
	  public function user_course_list()
	  {
	  	if(isset($_POST['user_email']))
	    {
		  	$response = array();

		  	$email=$_POST['user_email'];
		  	$pass=$_POST['user_pass'];
		  	
		  	$result = $this->db->query("SELECT * FROM users where email='$email' and password='$pass'");
			
			if (!empty($result)) 
			{
				foreach($result as $row)
				{ 
				  $list=array();
				  $list["name"]=$row['name'];
				  $list['courses_given']=$row['courses_given'];
				  $list['courses_taken']=$row['courses_taken'];
				  $list['phone']=$row['phone'];
				  $list['city']=$row['city'];
				  $response["success"]=1;
				  $response["list"]=array();
				  array_push($response["list"], $list);
				  $response["success"] = 1;
		          // echoing JSON response
		          echo json_encode($response);
				}
			}
			else
			{
				$response["success"] = 0;
	            $response["message"] = "User not found";
	 
		        // echo no users JSON
		        echo json_encode($response);
			}
		}
		else
		{
			$response["success"] = 0;
       		$response["message"] = "Required field(s) is missing";
 
	    	// echoing JSON response
	    	echo json_encode($response);
		}
	  }
	  public function update_course_list()
	  {
	  	$reponse=array();
	  	if(isset($_POST['user_email'])&&isset($_POST['course']))
	  	{
	  		$email=$_POST['user_email'];
	  		$course=$_POST['course'];
	  		$result=$this->db->query("UPDATE users SET courses_given = CONCAT(courses_given,'-',' $course') WHERE email='$email'");
		    if ($result) {

		    $this->db->query("INSERT INTO courses (course) VALUES ('$course')");
	        // successfully inserted into database
	        $response["success"] = 1;
	        $response["message"] = "Successful Updation.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	} else {
	        // failed to insert row
	        $response["success"] = 0;
	        $response["message"] = "An error occurred.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	}
			} else {
	    	// required field is missing
	    	$response["success"] = 0;
	        $response["message"] = "Required field(s) is missing";
	 
	    	// echoing JSON response
	    	echo json_encode($response);
			}


	  	}

	  	public function details()
	  	{
	  		if(isset($_POST['course']))
	    {
		  	$response = array();

		  	$course=$_POST['course'];
		 
		  	
		  	$result = $this->db->query("SELECT * FROM users where courses_given like '%- $course%'");
			
			if (!empty($result)) 
			{
				 $response["list"]=array();
				foreach($result as $row)
				{ 
				  $list=array();
				  $list["name"]=$row['name'];
				  $list['phone']=$row['phone'];
				  $list['city']=$row['city'];
				  $list['email']=$row['email'];
				 
				  array_push($response["list"], $list);
				  
		          // echoing JSON response
		         
				}
					$response['success']=1;
					 echo json_encode($response);
				  
			}
			else
			{
				$response["success"] = 0;
	            $response["message"] = "User not found";
	 
		        // echo no users JSON
		        echo json_encode($response);
			}
		}
		else
		{
			$response["success"] = 0;
       		$response["message"] = "Required field(s) is missing";
 
	    	// echoing JSON response
	    	echo json_encode($response);
		}
	  	}

	  	public function contribute_course()
	  	{
	  		$reponse=array();
	  	if(isset($_POST['user_email'])&&isset($_POST['course']))
	  	{
	  		$email=$_POST['user_email'];
	  		$course=$_POST['course'];
	  		$result=$this->db->query("UPDATE users SET courses_given = CONCAT(courses_given,'-',' $course') WHERE email='$email'");
		    if ($result) {
		    // successfully inserted into database
	        $response["success"] = 1;
	        $response["message"] = "Successful Updation.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	} else {
	        // failed to insert row
	        $response["success"] = 0;
	        $response["message"] = "An error occurred.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	}
			} else {
	    	// required field is missing
	    	$response["success"] = 0;
	        $response["message"] = "Required field(s) is missing";
	 
	    	// echoing JSON response
	    	echo json_encode($response);
			}
	  	}
	  	public function join_course()
	  	{
	  		$reponse=array();
	  	if(isset($_POST['user_email'])&&isset($_POST['course']))
	  	{
	  		$email=$_POST['user_email'];
	  		$course=$_POST['course'];
	  		$result=$this->db->query("UPDATE users SET courses_taken = CONCAT(courses_taken,'-',' $course') WHERE email='$email'");
		    if ($result) {
		    // successfully inserted into database
	        $response["success"] = 1;
	        $response["message"] = "Successful Updation.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	} else {
	        // failed to insert row
	        $response["success"] = 0;
	        $response["message"] = "An error occurred.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	}
			} else {
	    	// required field is missing
	    	$response["success"] = 0;
	        $response["message"] = "Required field(s) is missing";
	 
	    	// echoing JSON response
	    	echo json_encode($response);
			}
	  	}
	  	public function delete()
	  	{
	  		$response=array();
	  		$email=$_GET['user_email'];
	  		$course=$_GET['course'];
	  		$result=$this->db->query("UPDATE users SET courses_taken=REPLACE(courses_taken,'- '$course'',' ') where email='$email'");
	  		if ($result) {
		    // successfully inserted into database
	        $response["success"] = 1;
	        $response["message"] = "Successful Updation.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	} else {
	        // failed to insert row
	        $response["success"] = 0;
	        $response["message"] = "An error occurred.";
	 
	        // echoing JSON response
	        echo json_encode($response);
	    	}

	  	}
	  	
	  	public function city_filter()
	  	{
	  		if(isset($_POST['course'])&&isset($_POST['city']))
	    {
		  	$response = array();

		  	$course=$_POST['course'];
		  	$city=$_POST['city'];
		 
		  	
		  	$result = $this->db->query("SELECT * FROM users where courses_given like '%- $course%' and city='$city'");
			
			if (!empty($result)) 
			{
				 $response["list"]=array();
				foreach($result as $row)
				{ 
				  $list=array();
				  $list["name"]=$row['name'];
				  $list['phone']=$row['phone'];
				  $list['city']=$row['city'];
				  $list['email']=$row['email'];
				 
				  array_push($response["list"], $list);
				  
		          // echoing JSON response
		         
				}
					$response['success']=1;
					 echo json_encode($response);
				  
			}
			else
			{
				$response["success"] = 0;
	            $response["message"] = "User not found";
	 
		        // echo no users JSON
		        echo json_encode($response);
			}
		}
		else
		{
			$response["success"] = 0;
       		$response["message"] = "Required field(s) is missing";
 
	    	// echoing JSON response
	    	echo json_encode($response);
		}
	  	}

	  }
	  
?>