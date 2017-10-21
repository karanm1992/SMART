<?php

	$mobile=$_POST['mobile'];
	$tno=$_POST['tino'];
	require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	//require_once 'index.php';
	
	
	require_once 'index.php';
	//$mobile=9921899779;
	//echo $mobile;
	$user = $db->qrcode($mobile,$tno);

	if ($user != false) {
            // user found
            // echo json with success = 1
            $response["success"] = 1;
            
            $response["user"]["uni_id"] = $user["uni_id"];
			 $response["user"]["src"] = $user["src"];
			$response["user"]["destn"] = $user["dest"];
           
            $response["user"]["depttime"] = $user["depttime"];
            $response["user"]["arrtime"] = $user["arrtime"];
			$response["user"]["route_no"] = $user["route_no"];
            $response["user"]["cost"] = $user["cost"];
            //echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Can't Generate QR Code";
            echo json_encode($response);
        }

        $user1 = $db->mydetails($mobile,$tno);  
//$mno = $_POST['mobile'];
//$no = $_POST['tno'];
		
		
		
	