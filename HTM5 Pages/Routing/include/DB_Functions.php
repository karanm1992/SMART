<?php

	$reached = 0;
	$switches = array();
	$counter = 0;
	$counter2 = 0;
class DB_Functions {

		
	
    private $db;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    

   
	
	/*function time_to_sec($time) {
    $t = explode(':', $time);
	$in_sec = $t[0] * 3600 + $t[1] * 60 + $t[2];
    
    return $in_sec;
  }*/
  
  public function showtime($mobile)
	{
		$result = mysql_query("SELECT `unique_id` FROM `users` WHERE `mobileno` = $mobile") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		
		$costt = mysql_query("SELECT `cost`,`depttime` FROM ticket WHERE `uni_id` = '$uni'") or die(mysql_error());
		$cost1 = mysql_fetch_array($costt);
		return $cost1;
		//echo $cost1['cost'];
	}

	public function temp1($src)
	{
		$sr1 = mysql_query("SELECT `station_id` from `station` WHERE `station_name` = '$src'") or die(mysql_error());
		$sr = mysql_fetch_array($sr1);
		return $sr;
	}
	
	public function temp2($des)
	{
		$de1 = mysql_query("SELECT `station_id` from `station` WHERE `station_name` = '$des'") or die(mysql_error());
		$de = mysql_fetch_array($de1);
		return $de;
	}
	
        
        public function calc_cost($mno)
	{
		$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		$mysrc = mysql_query("SELECT `cost` FROM ticket WHERE `uni_id` = '$uni' AND `ticketno` = '1'") or die(mysql_error());
		$myresult = mysql_fetch_array($mysrc);
		return $myresult;
	}
        
	public function chng_time($dtime,$arr,$mno)
	{
		
		
		$result = mysql_query("SELECT `unique_id` FROM `users` WHERE `mobileno` = $mno") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		$costt = mysql_query("SELECT COUNT(*) As count FROM ticket WHERE `uni_id` = '$uni'") or die(mysql_error());
		$cost1 = mysql_fetch_array($costt);
		$cnt = $cost1['count'];
		
		
		for($i=0;$i<$cnt;$i++)
		{
			if($i==0)
			{
				$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
				$result1 = mysql_fetch_array($result);
				$uni= $result1['unique_id'];
		
				mysql_query("UPDATE `ticket` SET `depttime` = '$dtime',`arrtime` = '$arr' WHERE uni_id = '$uni' AND `ticketno` = '1' ")or die(mysql_error());
			}
			if($i>0)
			{
				
				$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
				$result1 = mysql_fetch_array($result);
				$uni= $result1['unique_id'];
				
				//time checking process
				//$dept2 = $arr;
				
				$myno = $i+1;
				
				$mysrc = mysql_query("SELECT `src`,`dest`,`cost` FROM ticket WHERE `uni_id` = '$uni' AND `ticketno` = '$myno'") or die(mysql_error());
				$myresult = mysql_fetch_array($mysrc);
				$sr= $myresult['src'];
				$de= $myresult['dest'];
				$mycost = $myresult['cost'];
				
				
				
				if(($sr == 101 && $de == 102) || ($sr == 102 && $de == 101) || ($sr == 104 && $de == 107) || ($sr == 107 && $de == 104) || ($sr == 104 && $de == 105) || ($sr == 107 && $de == 105))
				{
					$depttime = "06:00:00";
				}
		
				if($sr == 105 && $de == 104) 
				{
					$depttime = "06:11:00";
				}
		
				if(($sr == 105 && $de == 107) || ($sr == 102 && $de == 104) || ($sr == 104 && $de == 102) || ($sr == 102 && $de == 103) || ($sr == 104 && $de == 103) || ($sr == 102 && $de == 105) || ($sr == 105 && $de == 102) ||($sr == 102 && $de == 106) || ($sr == 105 && $de == 106)    ) 
				{
					$depttime = "06:10:00";
				}
				if($sr == 103 && $de == 102) 
				{
					$depttime = "06:13:00";
				}
				if($sr == 103 && $de == 104) 
				{
					$depttime = "06:23:00";
				}
				if(($sr == 106 && $de == 102) || ($sr == 106 && $de == 105) )
				{
					$depttime = "06:16:00";
				}
				
				
				
			date_default_timezone_set("Asia/Kolkata");
			$start = $depttime;
			$end = "24:00:00";
			$cost = $mycost;
			
			$n=0;
			$range=range(strtotime($start),strtotime($end),$cost*60);
			foreach($range as $time)
			{
				$output[$n]= date("H:i:s",$time);
				$n = $n +1;
			}
			
			$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
			$time1 =$date->format('H:i:s');
			
			$t1 = strtotime($time1);
			$k = 0;
			
			for($j=0;$j<$n;$j++)
			{
				$t2 = strtotime($output[$j]);
				
				if($t1-$t2 < 0)
				{
					$finalop["t"][$k] = $output[$j];
					$k = $k +1;
					
				}
			}
			
				$mysrc1 = mysql_query("SELECT `arrtime` FROM ticket WHERE uni_id = '$uni' AND `ticketno` = '$i'") or die(mysql_error());
				$myresult1 = mysql_fetch_array($mysrc1);
				$lastarr= $myresult1['arrtime'];
				
				
				$brk = 1;
				
				$a = 'PT' . $brk . 'M';
		
				$dt = DateTime::createFromFormat('H:i:s', $lastarr);
		
				$dt->add(new DateInterval($a)); 
	
				$arr1 = $dt->format('H:i:s');
				
				$temp3 = strtotime($finalop["t"][0]);
				$temp4 = strtotime($arr1);
				
				$min = 9999999999;
				
				//$newdept = $finalop["t"][0];
				//echo $k;
			for($m=0;$m<$k;$m++)
			{
				$temp3 = strtotime($finalop["t"][$m]);
				
				if(($temp4 - $temp3) == 0)
				{
					$newdept = $finalop["t"][$m];
				}
				else
				{
					$interval1 = abs($temp4 - $temp3);
					if($interval1 < $min && $temp3 > $temp4)
					{
						$min = $interval1;
						$newdept = $finalop["t"][$m];
					}
				}
			}
			
			
				$cost = 13;
				$b = 'PT' . $mycost . 'M';
		
				$dt = DateTime::createFromFormat('H:i:s',$newdept);
		
				$dt->add(new DateInterval($b)); 
	
				$newarr = $dt->format('H:i:s');	
				
				//$newarr = strtotime("+10minutes", strtotime($newdept));
				//$newarr = $dt->format('H:i:s');
				mysql_query("UPDATE `ticket` SET `depttime` = '$newdept',`arrtime` = '$newarr' WHERE uni_id = '$uni' AND `ticketno` = '$myno' ")or die(mysql_error());
                                
		                
                               
			}
		}
		
	}
	
        
	function time_to_sec($time) {
    $t = explode(':', $time);
	$in_sec = $t[0] * 3600 + $t[1] * 60 + $t[2];
    
    return $in_sec;
  }
	public function route($srcid,$desid,$time,$mobile,$rn)
	
	{
		$cost = 0;
		global $counter, $counter2, $reached, $switches, $rno;
		static $tno;
		
		if($srcid != $desid)
		{
		
			
			
			$srcroute = mysql_query("SELECT `Route Name` FROM `routes` WHERE `RouteStation` = $srcid LIMIT 0, 30 ") or die(mysql_error());
		
		
			$desroute = mysql_query("SELECT `Route Name` FROM `routes` WHERE `RouteStation` = $desid LIMIT 0, 30 ") or die(mysql_error());
		
		
			if($srcroute && $desroute)
			{
				
				
					
					$i=0;
					$j=0;
					
					while ($i<4 and $j<4)
					{	
						$srow=mysql_fetch_assoc($srcroute);
						if($srow)
							$s[$i]=$srow;
						
						$i++;
						
						$drow=mysql_fetch_assoc($desroute);
						if($drow)
							$d[$j]=$drow;
						
						$j++;

						
					}
					
					
					$flag=0;
					$i=0;					
					while($i<count($s))
					{
						$j=0;
						while($j<count($d))
						{
							
							if($s[$i]['Route Name'] == $d[$j]['Route Name'])
							{
								
								$flag = 1;								
								$route = "'".$s[$i]['Route Name']."'";
								break 2;
								
							}
							else
							{
								
								$j++;
							}
				
						}		
						$i++;
					}
					
						if($flag==1)	
				{
						$srcno = mysql_query("SELECT  `StationNo` from `routes` where `Route Name` = $route AND `RouteStation` = $srcid " ) or die(mysql_error());
						$desno = mysql_query("SELECT  `StationNo` from `routes` where `Route Name` = $route AND `RouteStation` = $desid " ) or die(mysql_error());
						
						$srcnotemp = mysql_fetch_array($srcno);
						$desnotemp = mysql_fetch_array($desno);
						
					
					
					if(abs($srcnotemp['StationNo'] - $desnotemp['StationNo']) >= 2)
					{
						
						
						
						if($srcnotemp['StationNo'] < $desnotemp['StationNo']){				 //Forward Route
						for($ctr=$srcnotemp['StationNo'] ; $ctr <= $desnotemp['StationNo'] ; $ctr++)
						{
							$fromtemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctr ") or die(mysql_error());
							$from = mysql_fetch_array($fromtemp);
							
							
							$ctrtemp = $ctr+1;
								
							$totemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctrtemp ") or die(mysql_error());
							$to = mysql_fetch_array($totemp);
							
							
							
							$here = $from['RouteStation'];
							$there = $to['RouteStation'];
							
							if($from && $to)
							{
								$pricetemp = mysql_query( "SELECT `cost` FROM `timecost` WHERE
								(`from` = $here AND
								`to` = $there) OR
								(`from` = $there AND 
								`to` =$here )") 
									or die(mysql_error());
							}
						
							$price = mysql_fetch_array($pricetemp);
							$cost = $cost + $price['cost']; 
						
						}
						
					}
						
						else						 
						{
							for($ctr=$srcnotemp['StationNo'] ; $ctr >= $desnotemp['StationNo'] ; $ctr--)
						{
							$fromtemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctr ") or die(mysql_error());
							$from = mysql_fetch_array($fromtemp);
							
							
							$ctrtemp = $ctr-1;
								
							$totemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctrtemp ") or die(mysql_error());
							$to = mysql_fetch_array($totemp);
							
							
							
							$here = $from['RouteStation'];
							$there = $to['RouteStation'];
							
							if($from && $to)
							{
								$pricetemp = mysql_query( "SELECT `cost` FROM `timecost` WHERE
								(`from` = $here AND
								`to` = $there) OR
								(`from` = $there AND 
								`to` =$here )") 
									or die(mysql_error());
							}
						
							$price = mysql_fetch_array($pricetemp);
							$cost = $cost + $price['cost']; 
						}
						
						
					}
				}
					
					$train1 = mysql_query("SELECT  `train_id` FROM  `source` WHERE  `source_id` = $srcid AND `departure` >= '$time' " ) or die(mysql_error());
					
					
					$train2 =  mysql_query("SELECT `train_id` FROM `destination` where `destination_id` = $desid LIMIT 0,30 ") or die(mysql_error());
					

					$i=0;
					$j=0;
					
					while ($i<4 and $j<4)
					{	
						$srow=mysql_fetch_assoc($train1);
						$s[$i]=$srow;
						
						$i++;
						
						$drow=mysql_fetch_assoc($train2);
						$d[$j]=$drow;
						
						$j++;

						
					}
					
					
					$i=0;					
					while($i<count($s))
					{
						$j=0;
						while($j<count($d))
						{
							
							if($s[$i]['train_id'] == $d[$j]['train_id'])
							{
																
								$t=$s[$i]['train_id'];
								break 2;
								
							}
							else
							{
								
								$j++;
							}
				
						}		
						$i++;
					}
					
					
				
					
					if(!$t)
						{}
					
					else{
					$train = mysql_query("SELECT `train_name` from `train` where `trainid`  = $t ") or die(mysql_error());
					while ($row=mysql_fetch_assoc($train)) $output1[]=$row;
					
					
					if($cost==0){
					$price = mysql_query("SELECT `cost` from `timecost` WHERE (`from` = $srcid AND `to` = $desid) OR (`from` = $desid AND `to` = $srcid)") or die(mysql_error());
					while ($r=mysql_fetch_assoc($price)) $o[]=$r;
					
					
					$cost = $o[0]['cost'];
					}
					
					
					$arrive = mysql_query("SELECT `arrival` from `destination` where `train_id` = $t and `destination_id` = $desid ") or die(mysql_error());
					while ($at=mysql_fetch_assoc($arrive)) $output2[]=$at;
					
					$arr = $output2[0]['arrival'];
					
					
					
					$rno1 = mysql_query("SELECT `RouteNo` from `routemain` where `RouteName` = $route ") or die(mysql_error());
					while($r = mysql_fetch_assoc($rno1))  $output3[]=$r;
					
					$rno = $output3[0]['RouteNo'];
					
					
					
					$tno = $tno+1;
					
					$uid = mysql_query("SELECT `unique_id` from `users` where `mobileno` = $mobile ") or die(mysql_error());
					$unique = mysql_fetch_array($uid);
					
					$reg="'".$unique['unique_id']."'";
					
					
					mysql_query("INSERT INTO `ticket`(`ticketno`,`uni_id`, `src`, `dest`, `depttime`, `arrtime`, `route_no`, `cost`,`created_at`,`checked`,`bits`,`paid`) VALUES
					($tno,
					$reg,
					$srcid,
					$desid,
					'$time',
					'$arr',
					$rno ,
					$cost,
					Now(),
					'0',
					'$rn',
					'0') ") or die(mysql_error());
					
					
					
					if($counter != 0)
					{
						
						$nexttime = date('H:i:s', ($cost*60 + $this->time_to_sec($time)));
						
						$counter--;
						$this->route($desid,$switches[$counter],$nexttime,$mobile,$rn);
						
						
					}
					else
						$reached = 1;
						
					
					
				}
				
				
				} 
				else	//different routes
				{
						
						
						
						$k=0;
						$k2=0;
						$k3=0;
						
						
						
						while(1)
						{
							$temp1 = $d[$k2]['Route Name'];
							
							
							$rno2 = mysql_query("SELECT `RouteNo` from `routemain` where `RouteName` = '$temp1' ") or die(mysql_error());
							while($output3 = mysql_fetch_assoc($rno2))
							{							
								if($k2!=0)
								{	if($output3 != $rno[$k2-1] )
									{	
										
										$rno[$k2]=$output3 ;
										
									
									}
								}
								else
								{
										
										$rno[$k2]=$output3;
								}
							}
							
							
						
							$temp2 = $rno[$k2]['RouteNo'];
							
							
							$switch = mysql_query("SELECT `StationNo` FROM `switch` WHERE `RouteTo` = $temp2 AND `StationNo` != $desid  ") or die(mysql_error());
							
							$temp3=0;
							
							while($temp3<4)
							{
								$output4 = mysql_fetch_assoc($switch);
								if($output4)
									$sw[$temp3]=$output4;
								$temp3++;
							}
								
								
								while($k3<count($sw))								
								{							
									
									$k3++;
									
								}
								
								$k++;
									if($k2<(count($d)-1))
									{	
										$k2++;
									}
									else
									{
										
										break ;
									}
								
							}
							//echo "Calling Again";
								
								
								
								$switches[$counter] = $desid;
								$counter++;
								
								$this->route($srcid,$sw[0]['StationNo'],$time,$mobile,$rn);

						} //Different routes end
						
							
						
					
					} //end of source && dest
			}
			else
				{
					////echo "Reached!";
					//echo ("Source and Destination are same!");
				}
		
		//echo "Reached";
	}
	
	
		
	
    

}

?>
