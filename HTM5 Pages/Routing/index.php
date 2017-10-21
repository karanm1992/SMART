<?php
        session_start();
	require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
		$mobile = $_POST['mobile'];
		$src = $_POST['source'];
		$dest = $_POST['dest'];
		
//echo $mobile;
// echo $src;
//echo $dest;
		//$mobile = 9921899770;
		//$sr=107;
		//$de=104;
		
if($src != $dest) {
		$sr1=$db->temp1($src);
		$de1=$db->temp2($dest);
		
// echo $sr1;
// echo $de1;
		$sr=$sr1['station_id'];
		$de=$de1['station_id'];
		
		
		
		if(($sr == 101 && $de == 102) || ($sr == 102 && $de == 101) || ($sr == 104 && $de == 107) || ($sr == 107 && $de == 104) || ($sr == 104 && $de == 105) || ($sr == 107 && $de == 105))
		{
			$depttime = "06:00:00";
		}
		
		else if($sr == 105 && $de == 104) 
		{
			$depttime = "06:11:00";
		}
		
		else if(($sr == 105 && $de == 107) || ($sr == 102 && $de == 104) || ($sr == 104 && $de == 102) || ($sr == 102 && $de == 103) || ($sr == 104 && $de == 103) || ($sr == 102 && $de == 105) || ($sr == 105 && $de == 102) ||($sr == 102 && $de == 106) || ($sr == 105 && $de == 106)    ) 
		{
			$depttime = "06:10:00";
		}
		else if($sr == 103 && $de == 102) 
		{
			$depttime = "06:13:00";
		}
		else if($sr == 103 && $de == 104) 
		{
			$depttime = "06:23:00";
		}
		else if(($sr == 106 && $de == 102) || ($sr == 106 && $de == 105) )
		{
			$depttime = "06:16:00";
		}
		/*else if($sr == 103 && $de == 107) 
		{
			$depttime = "06:22:00";
		}*/
		
		$rn = mt_rand();
                               
//echo $sr;
// echo $de;
//echo $depttime;
//echo $mobile;
                $db->route($sr,$de,$depttime,$mobile,$rn);
		
              header("Location: http://metropune.atwebpages.com/select_time.php");	
}		
else
                
              header("Location: http://metropune.atwebpages.com/App_Main.html");	
                       //array_push($_SESSION['times'],$finalop);
                       
//$_SESSION['times'] = $resp["time"];
			
                        //echo json_encode($resp);
                        //echo $finalop["t"][0];  06:10
                        //echo $resp["time"][0]; Array
                        //echo $_SESSION['times'][1];
                        // print_r($_SESSION['times']);
                        //echo $_SESSION['times']["time"];
                        
                        //foreach($_SESSION['times'] as $key=>$value){ 
                        //        echo $value["time"]; } 
               
	
  
  
  
		
                //echo json_encode($user);
		
		
		//$len = sizeof($user);
		//echo $len;
		//$j=0;
		//while($j<sizeof($user))
		//	{
		//		echo $user[$j];
		//		$j++;
		//	}
		//return $user;
		
		
		/*for ($x=0; $x<3; $x++)
		{
			
			$response["success"] = 1;
		    $response["user"]["station_name"] = $user["station_name"];
		    echo json_encode($response);
			//echo "The number is: $x <br>";
		} */
		
		//trial
		
		//echo "Back";
	?>