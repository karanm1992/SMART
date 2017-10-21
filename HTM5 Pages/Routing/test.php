<?php
                session_start();
		require_once 'include/DB_Functions.php';
		$db = new DB_Functions();
			
			
		$dtime = $_POST['utime'];
		$mno = $_POST['mobile'];
		//$cost = $_POST['cost'];
		//$dtime = "17:00:00";
		//$cost = 13;
		//$mno = 9921899779;
		
		
		
		$cost = $db->calc_cost($mno);
		
		if ($cost != false) 
		{
			 $cost1=$cost["cost"];
		}
		$a = 'PT' . $cost1 . 'M';
		
		$dt = DateTime::createFromFormat('H:i:s', $dtime);
		
		$dt->add(new DateInterval($a)); 
	
		$arr = $dt->format('H:i:s');
		$user = $db->chng_time($dtime,$arr,$mno);
	
                header("Location: http://metropune.atwebpages.com/pay.php");	
		/*$user = $db->display();
		
		if ($user != false) 
		{
            $response["user"]["one"] = $user[0];
            $response["user"]["two"] = $user[1];
			$response["user"]["three"] = $user[2];
			$response["user"]["four"] = $user[3];
			$response["user"]["five"] = $user[4];
			$response["user"]["six"] = $user[5];
			$response["user"]["seven"] = $user[6];
			
            echo json_encode($response);
        } */

	?>