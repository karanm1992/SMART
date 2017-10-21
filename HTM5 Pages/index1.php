<?php

/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data

  /**
 * check for POST request 
 */
$karan='trial';
//echo $_POST["tag"];

 
if (isset($_POST['tag']) && $_POST['tag'] != '') 
{
    // get tag
    $tag = $_POST['tag'];
	
    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);
    
	if($tag == 'route')
	{
		 $src = $_POST['source'];
		 $dest = $_POST['destination'];
	}
	
	if($tag == 'update')
	{
		$name = $_POST['username'];
                $email = $_POST['usermail'];
                $mob = $_POST['mobile'];
		$addr = $_POST['useraddress'];
		$city = $_POST['usercity'];
		$state = $_POST['userstate'];
		$cntry = $_POST['usercountry'];
		$birthd = $_POST['userdob'];
		//echo "reached";
                //                echo $mob;
                //                echo $name;
                //                echo $cntry;
                $user = $db->update($name,$email,$addr,$mob,$city,$state, $cntry,$birthd);
		if ($user != false) 
		{
			 $response["success"] = 1;
                        //header("Location: http://metropune.atwebpages.com/App_Main.html");
			 //echo json_encode($response);
		}
		else 
		{
            
                    $response["error"] = 1;
                    $response["error_msg"] = "Error";
                        echo json_encode($response); 
                } 
	}
        
        if($tag == 'delete')
	{
		$mno = $_POST['mobile'];
		
		$user = $db->deleteall($mno);
                
                header("Location: http://metropune.atwebpages.com/App_Main.html");
	}
        
        if($tag == 'done')
	{
                
		$mno = $_POST['mobile'];
		
		$user = $db->makepayment($mno);
               
                
                
                // $_SESSION['sess_details'] = $user1;
                //                print_r($user1);
                // print_r($_SESSION['sess_details']);
                          header("Location: http://metropune.atwebpages.com/mytickets.php");
      	}
        
        if($tag == 'count')
	{
		$mno = $_POST['mobile'];
		$user = $db->showcount($mno);
        
                        header("Location: http://metropune.atwebpages.com/mytickets.php");
	}
        
	if($tag == 'chngpass')
	{
		$password = $_POST['oldpass'];
		$mobile = $_POST['userid'];
		$newpassword = $_POST['newpass'];
		$user = $db->change_password($mobile,$password,$newpassword);
		/*if ($user != false) 
		{
			 $response["success"] = 1;
                        //header("Location: http://metropune.atwebpages.com/App_Main.html");
			 //echo json_encode($response);
		}
		else 
		{
            
            $response["error"] = 1;
            $response["error_msg"] = "Error";
            echo json_encode($response);
}*/
}
	if($tag == 'time')
	{
		$mobile = $_POST['mobile'];
		$user = $db->showtime($mobile);
		if ($user != false) 
		{
			 $response["user"]["success"] = 1;
			 $response["user"]["cost"]=$user["cost"];
			 $response["user"]["depttime"]=$user["depttime"];
			// echo json_encode($response);
			
			date_default_timezone_set("Asia/Kolkata");
			$start=$response["user"]["depttime"];
			$end = "22:00:00";
			$cost = $response["user"]["cost"];
			
			$i=0;
			$range=range(strtotime($start),strtotime($end),$cost*60);
			foreach($range as $time)
			{
				$output[$i]= date("H:i:s",$time);
				$i = $i +1;
			}
			
			$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
			$time1 =$date->format('H:i:s');
			
			$t1 = strtotime($time1);
			$k = 0;
			
			for($j=0;$j<$i;$j++)
			{
				$t2 = strtotime($output[$j]);
				
				if($t1-$t2 < 0)
				{
					$finalop["t"][$k] = $output[$j];
					$k = $k +1;
					
				}
			}
			//$responce
			//echo json_encode($finalop[0]);
			$resp["time"] = array();
			array_push($resp["time"], $finalop);
			echo json_encode($resp);
		}
		else 
		{
            
            $response["error"] = 1;
            $response["error_msg"] = "Error";
            echo json_encode($response);
        }
		
	}
	
	//display data
	if($tag == 'data')
	{
		
		
		$user = $db->display();
		
		/*
		$j=0;
		while($j<sizeof($user))
			{
				//echo $user[$j];
				$j++;
			}
		echo json_encode($user);;
		/*for ($x=0; $x<3; $x++)
		{
			
			$response["success"] = 1;
		    $response["user"]["station_name"] = $user["station_name"];
		    echo json_encode($response);
			//echo "The number is: $x <br>";
		} */
		/*if ($user != false) 
		{
			while($row=mysql_fetch_assoc($user));
			{
			echo $row["station_name"];
			}/*$response["success"] = 1;
		   $response["user"]["station_name"] = $user["station_name"];
		   echo json_encode($response);
		}
		  else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Error In Connection";
            echo json_encode($response);
        }*/
	}
    // check for tag type
    if ($tag == 'login') {
	session_start();
	
        // Request type is check Login
        $mobile = $_POST['username'];
            //$mobno = $mobile;
            
 
 
        
            //echo "<form action=".EditProfile.html." method=".post." > ";
            //echo " <input type=".text." name=".input." value=".$mobile.">";      
            //        echo " <input type=".submit." value=".Edit."> ";
            //        echo " </form> ";
           

        $password = $_POST['password'];
		
        // check for user
        $user = $db->getUserByEmailAndPassword($mobile, $password);
        if ($user != false) {
           
           session_regenerate_id();
                //$_SESSION['sess_user_id'] = $userData['id'];
	$_SESSION['sess_username'] = $_POST['username'];
	session_write_close();    
            // user found
            // echo json with success = 1
            $response["success"] = 1;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
			$response["user"]["mobileno"] = $user["mobileno"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            
          

?>

        

<?php 
                echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
                $response["error"] = 1;
                $response["error_msg"] = "Incorrect email or password!";
                header("Location: http://metropune.atwebpages.com/Error_Home.html");
                //echo json_encode($response);                	 
        }
    } else if ($tag == 'register') {
            //echo "reached";
        // Request type is Register new user
        $name = $_POST['username'];
        $email = $_POST['usermail'];
        $password = $_POST['passwordsignup'];
		$cpassword = $_POST['passwordsignup_confirm'];
		$addr = $_POST['useraddress'];
		$mobileno = $_POST['userid'];
		$city = $_POST['usercity'];
		$state = $_POST['userstate'];
		$cntry = $_POST['usercountry'];
		$gender = $_POST['usergender'];
		$birthd = $_POST['userdob'];
		
        // check if user is already existed
        if ($db->isUserExisted($mobileno)) {
            /* user is already existed - error response
            $response["error"] = 2;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);*/
            header("Location: http://metropune.atwebpages.com/Error_Home.html#toregister");
        } else {
            // store user
            $user = $db->storeUser($name,$email,$password,$mobileno,$gender,$birthd,$addr,$city,$state,$cntry);
            if ($user) {
                // user stored successfully
                $response["success"] = 1;
                $response["uid"] = $user["unique_id"];
                $response["user"]["name"] = $user["name"];
                $response["user"]["email"] = $user["email"];
                $response["user"]["created_at"] = $user["created_at"];
                $response["user"]["updated_at"] = $user["updated_at"];
                echo json_encode($response);
                header("Location: http://metropune.atwebpages.com/App_Main.html");
            } else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "Error occured in Registration";
                echo json_encode($response);
            }
        }
    } else {
        echo "Invalid Request";
    }
} else {
	
    echo "Access Denied";

}
?>