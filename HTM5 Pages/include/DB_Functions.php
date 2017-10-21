<?php

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

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password,$mobileno,$gender,$birthd,$addr,$city,$state,$cntry) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysql_query("INSERT INTO users(unique_id, name ,mobileno ,gender,birthd, addr ,city , state , cntry ,email , encrypted_password, salt,created_at) VALUES('$uuid', '$name','$mobileno' ,'$gender','$birthd','$addr','$city','$state','$cntry ','$email','$encrypted_password', '$salt', NOW())");
        // check for successful store
        if ($result) {
            // get user details 
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM users WHERE uid = $uid");
            // return user details
			header("Location: http://metropune.atwebpages.com/App_Main.html");
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

	public function change_password($mobile,$password,$newpassword)
	{
		$result = mysql_query("SELECT * FROM users WHERE mobileno = '$mobile'") or die(mysql_error());
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) 
        {
        
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
		// check for password equality
            if ($encrypted_password == $hash) 
            {
                // user authentication details are correct
                $hash = $this->hashSSHA($newpassword);
				$encrypted_password = $hash["encrypted"]; // encrypted password
				$salt = $hash["salt"]; // salt
				mysql_query("UPDATE users SET encrypted_password = '$encrypted_password',salt = '$salt' where mobileno='$mobile'")or die(mysql_error());
				
				header("Location: http://metropune.atwebpages.com/Pass_Done.html");	
				
				echo '
				<!DOCTYPE html>
				<html>
				<head>
				<script>
				alert("Password changed succesfully!");
				</script>
				</head>';
			
				
				
                    //return $result;
            }
        } 
        
        else
        {
            // user not found
            return false;
        }
		
}

        public function chck_paid($mno)
	{
		$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		$costt = mysql_query("SELECT `paid` FROM ticket WHERE uni_id = '$uni'") or die(mysql_error());
		$cost1 = mysql_fetch_array($costt);
		$ch = $cost1['paid'];
		
		if($ch == 1)
		{
			$val = "paid";
			return $val;
		}
		else
		{
			mysql_query("DELETE FROM ticket WHERE `uni_id` = '$uni'") or die(mysql_error());
			$val = "notpaid";
			return $val;
		}
	}
        public function mydetails($mno,$no)
	{
		$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		$mysrc = mysql_query("SELECT `src`,`dest`,`depttime` FROM ticket WHERE `uni_id` = '$uni' AND `ticketno` = '$no'") or die(mysql_error());
		$myresult = mysql_fetch_array($mysrc);
		$src = $myresult['src'];
		$des = $myresult['dest'];
		$ans["depttime"] = $myresult['depttime'];
		
		$sr1 = mysql_query("SELECT `station_name` from `station` WHERE `station_id` = '$src'") or die(mysql_error());
		$sr = mysql_fetch_array($sr1);
		$ans["src"]=$sr['station_name'];
		
		$de1 = mysql_query("SELECT `station_name` from `station` WHERE `station_id` = '$des'") or die(mysql_error());
		$de = mysql_fetch_array($de1);
		$ans["dest"]=$de['station_name'];
		
		return $ans;
		
	}
        
        public function deleteall($mno)
	{
		$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		mysql_query("DELETE FROM ticket WHERE `uni_id` = '$uni'") or die(mysql_error());
		
	}
        
        public function showcount($mobile)
	{
		$result = mysql_query("SELECT `unique_id` FROM `users` WHERE `mobileno` = $mobile") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		$costt = mysql_query("SELECT COUNT(*) As count FROM ticket WHERE `uni_id` = '$uni'") or die(mysql_error());
		$cost1 = mysql_fetch_array($costt);
		return $cost1;
		
	}
        
        public function makepayment($mno)
	{
		$result = mysql_query("SELECT `unique_id` FROM users WHERE mobileno = $mno") or die(mysql_error());
		$result1 = mysql_fetch_array($result);
		$uni= $result1['unique_id'];
		
		mysql_query("UPDATE ticket SET `paid` = '1' WHERE `uni_id` = '$uni'") or die(mysql_error());
		
	}
        
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
       
	public function update($name,$email,$addr,$mobileno,$city,$state, $cntry, $birthd)
	{
		$chng = mysql_query("UPDATE `users` SET `name`= '$name',`birthd`='$birthd',`addr`='$addr',`city`='$city',`state`='$state',`cntry`='$cntry',`email`='$email' WHERE `mobileno`=$mobileno") or die(mysql_error());
                //return 1;
                 
                
                           header("Location: http://metropune.atwebpages.com/Edit_Done.html");                                                                                
				echo '
				<!DOCTYPE html>
				<html>
				<head>
				<script>
				alert("Profile Edited Successfully!");
				</script>
				</head>
				<body>
				<!--header("Location: http://metropune.atwebpages.com/App_Main.html");-->
				</body>
                                </html>'; 

             
                         return $chng;
	}
	
    
     // Get user by email and password
     
    public function getUserByEmailAndPassword($mobile, $password) {
        $result = mysql_query("SELECT * FROM users WHERE mobileno = '$mobile'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
				header("Location: http://metropune.atwebpages.com/App_Main.html");
                // user authentication details are correct					
                return $result;
            }
        } else {                                                                                                                                
            // user not found
                /*echo '
				<!DOCTYPE html>
				<html>
				<head>
				<script>
				alert("Incorrect UserID or Password!");
				</script>
				</head>
				<body>                                
				</body>
</html>';*/
                        return false;
        }
    }
	public function route($srcid,$desid,$time)
	
	{
		echo "Reached";
		//$result=mysql_query("Select `Route Name` from `routes` where `RouteStation` = 101 LIMIT 0,30 ") or die(mysql_error());
		//while($row=mysql_fetch_assoc($result)) $output[]=$row
		//print(json_encode($output));
		if($srcid != $desid)
		{
		
			$srcroute = mysql_query("SELECT `Route Name` FROM `routes` WHERE `RouteStation` = $srcid LIMIT 0, 30 ") or die(mysql_error());
		//print_r(mysql_fetch_assoc($srcroute));
		//while($row=mysql_fetch_assoc($srcroute))
		//$srcoutput[]=$row;
		
		//print(json_encode($srcoutput));
		
			$desroute = mysql_query("SELECT `Route Name` FROM `routes` WHERE `RouteStation` = $desid LIMIT 0, 30 ") or die(mysql_error());
		//print_r(mysql_fetch_assoc($desroute));
		//while($row=mysql_fetch_assoc($desroute)) 
		//$desoutput[]=$row;
		//print(json_encode($desoutput));
		
			if($srcroute && $desroute)
			{
				
				echo "\r\nFirst if entered";
				/*
					while ($srow=mysql_fetch_assoc($srcroute))
					{	
						echo "first while entered";
						
						$s[]=$srow;
						echo $s[0]['Route Name'];
						while($drow=mysql_fetch_assoc($desroute))
						{
							echo "second while entered";							
							$d[]=$drow;
							print(json_encode($s));
							print(json_encode($d));
							if($s==$d)
							{
								echo "Same";								
								break 2;
							}
						}
					}*/
					
					
					
					
					$i=0;
					$j=0;
					
					while ($i<4 and $j<4)
					{	
						$srow=mysql_fetch_assoc($srcroute);
						if($srow)
							$s[$i]=$srow;
						//echo $s[$i]['Route Name'];
						$i++;
						
						$drow=mysql_fetch_assoc($desroute);
						if($drow)
							$d[$j]=$drow;
						//echo $d[$j]['Route Name'];
						$j++;

						
					}
					
					echo "COUNT";
					echo count($s);
					echo count ($d);
					
					$flag=0;
					$i=0;					
					while($i<count($s))
					{
						$j=0;
						while($j<count($d))
						{
							//echo $d[$j]['Route Name'];
							//print(json_encode($s));
							//print(json_encode($d));
							if($s[$i]['Route Name'] == $d[$j]['Route Name'])
							{
								echo $s[$i]['Route Name'];
								echo $d[$j]['Route Name'];
								echo $i;
								echo $j;
								echo "    Same    ";
								$flag = 1;								
								$route = "'".$s[$i]['Route Name']."'";
								break 2;
								
							}
							else
							{
								echo $i;
								echo $j;
								echo $s[$i]['Route Name'];
								echo $d[$j]['Route Name'];
								echo "Not same";
								$j++;
							}
				
						}		
						$i++;
					}
					
						if($flag==1)	//same routes
				{
						$srcno = mysql_query("SELECT  `StationNo` from `routes` where `Route Name` = $route AND `RouteStation` = $srcid " ) or die(mysql_error());
						$desno = mysql_query("SELECT  `StationNo` from `routes` where `Route Name` = $route AND `RouteStation` = $desid " ) or die(mysql_error());
						
						$srcnotemp = mysql_fetch_array($srcno);
						$desnotemp = mysql_fetch_array($desno);
						echo $srcnotemp['StationNo'];
						echo $desnotemp['StationNo'];
						echo "Number:";
						echo ($srcnotemp['StationNo'] - $desnotemp['StationNo']);
						echo " \n\r";
					
					
					if(abs($srcnotemp['StationNo'] - $desnotemp['StationNo']) >= 2)
					{
						echo "Same route with a station in the middle";
						$cost = 0;
						
						if($srcnotemp['StationNo'] < $desnotemp['StationNo']){				 //Forward Route
						for($ctr=$srcnotemp['StationNo'] ; $ctr <= $desnotemp['StationNo'] ; $ctr++)
						{
							$fromtemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctr ") or die(mysql_error());
							$from = mysql_fetch_array($fromtemp);
							
							
							$ctrtemp = $ctr+1;
								
							$totemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctrtemp ") or die(mysql_error());
							$to = mysql_fetch_array($totemp);
							
							echo $from['RouteStation'];
							echo $to['RouteStation']; 
							
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
						echo $cost;}
						
						else						 //Reverse Route
						{
							for($ctr=$srcnotemp['StationNo'] ; $ctr >= $desnotemp['StationNo'] ; $ctr--)
						{
							$fromtemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctr ") or die(mysql_error());
							$from = mysql_fetch_array($fromtemp);
							
							
							$ctrtemp = $ctr-1;
								
							$totemp = mysql_query("SELECT `RouteStation` from `routes` where `Route Name` = $route AND `StationNo` = $ctrtemp ") or die(mysql_error());
							$to = mysql_fetch_array($totemp);
							
							echo $from['RouteStation'];
							echo $to['RouteStation']; 
							
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
						echo $cost;
						
					}
					
					$train1 = mysql_query("SELECT  `train_id` FROM  `source` WHERE  `source_id` = $srcid AND `departure` >= '$time' " ) or die(mysql_error());
					//while ($row1=mysql_fetch_assoc($train1)) $output1[]=$row1;
					//print(json_encode($output1));
					
					$train2 =  mysql_query("SELECT `train_id` FROM `destination` where `destination_id` = $desid LIMIT 0,30 ") or die(mysql_error());
					//while ($row2=	mysql_fetch_assoc($train2)) $output2[]=$row2;
					//print(json_encode($output2));
					
					/*while ($t1=mysql_fetch_assoc($train1))
					{	
						echo "first train while entered";
						$a[]=$t1;
						while($t2=mysql_fetch_assoc($train2))
						{
							echo "second train while entered";							
							$b[]=$t2;
							print(json_encode($a));
							print(json_encode($b));
							if($a==$b)
							{
								echo $a[0]['train_id'];
								echo "Same";								
								break 2;
							}
						}
					}	*/

					$i=0;
					$j=0;
					
					while ($i<4 and $j<4)
					{	
						$srow=mysql_fetch_assoc($train1);
						$s[$i]=$srow;
						//echo $s[$i]['train_id'];
						$i++;
						
						$drow=mysql_fetch_assoc($train2);
						$d[$j]=$drow;
						//echo $d[$j]['train_id'];
						$j++;

						
					}
					
					echo "Train Search";
					$i=0;					
					while($i<count($s))
					{
						$j=0;
						while($j<count($d))
						{
							//echo $d[$j]['Route Name'];
							//print(json_encode($s));
							//print(json_encode($d));
							if($s[$i]['train_id'] == $d[$j]['train_id'])
							{
								//echo $s[$i]['train_id'];
								//echo $d[$j]['train_id'];
								//echo $i;
								//echo $j;
								echo "    Same    ";									
								$t=$s[$i]['train_id'];
								break 2;
								
							}
							else
							{
								//echo $i;
								//echo $j;
								//echo $s[$i]['train_id'];
								//echo $d[$j]['train_id'];
								echo "Not same";
								$j++;
							}
				
						}		
						$i++;
					}
					
					
				//$t=$a[0]['train_id'];
					echo $t;
					
					$train = mysql_query("SELECT `train_name` from `train` where `trainid`  = $t ") or die(mysql_error());
					while ($row=mysql_fetch_assoc($train)) $output1[]=$row;
					print(json_encode($output1));
					
					if($cost==0){
					$price = mysql_query("SELECT `cost` from `timecost` WHERE (`from` = $srcid AND `to` = $desid) OR (`from` = $desid AND `to` = $srcid)") or die(mysql_error());
					while ($r=mysql_fetch_assoc($price)) $o[]=$r;
					echo $o[0]['cost'];
					
					$cost = $o[0]['cost'];
					}
					//echo $time;
					
					$reg = $cost+1;
					
					$arrive = mysql_query("SELECT `arrival` from `destination` where `train_id` = $t and `destination_id` = $desid ") or die(mysql_error());
					while ($at=mysql_fetch_assoc($arrive)) $output2[]=$at;
					
					$arr = $output2[0]['arrival'];
					
					//echo $route;
					
					$rno1 = mysql_query("SELECT `RouteNo` from `routemain` where `RouteName` = $route ") or die(mysql_error());
					while($r = mysql_fetch_assoc($rno1))  $output3[]=$r;
					
					$rno = $output3[0]['RouteNo'];
					
					echo $rno;	
					
					
					mysql_query("INSERT INTO `ticket`(`regno`, `src`, `dest`, `depttime`, `arrtime`, `route_no`, `cost`) VALUES
					($reg,
					$srcid,
					$desid,
					'$time',
					'$arr',
					$rno ,
					$cost ) ") or die(mysql_error());
					
					echo "Row Inserted";
					
					$srcid=$sw[0]['StationNo'];
				}
				
				
				} 
				else	//different routes
				{
						
						echo "Different Routes";
						
						$k=0;
						$k2=0;
						$k3=0;
						
						echo "Switches available : ";
						while(1)
						{
							$temp1 = $d[$k2]['Route Name'];
							echo $temp1;
							
							$rno2 = mysql_query("SELECT `RouteNo` from `routemain` where `RouteName` = '$temp1' ") or die(mysql_error());
							while($output3 = mysql_fetch_assoc($rno2))
							{							
								if($output3)
								{	
									//echo "Entered";
									$rno[$k2]=$output3 ;
									//echo $k2;
								}
							}
						
						
						$temp2 = $rno[$k2]['RouteNo'];
						//echo $temp2;
						//echo $k;	
							
							$switch = mysql_query("SELECT `StationNo` FROM `switch` WHERE `RouteTo` = $temp2 ") or die(mysql_error());
								
							$temp3=0;
							
							while($temp3<4)
							{
								$output4 = mysql_fetch_assoc($switch);
								if($output4)
									$sw[$temp3]=$output4;
								$temp3++;
							}
								
								//echo "Switch Count:";
								//echo count($sw);
								//echo "Here";
								//echo $sw[0]['StationNo'];
								//echo $sw[1]['StationNo'];
								
								while($k3<count($sw))								
								{							
									
									echo $sw[$k3]['StationNo'];
									$k3++;
								}
								
								$k++;
									if($k2<(count($d)-1))
										$k2++;
									else
										break ;
								
							}
						} //Different routes end
						
						echo "Calling Again";
						
							$this->route($srcid,$sw[0]['StationNo'],$time);
						//else
							//$this->route($sw[0]['StationNo'],$desid,$time);
						
					
					} //end of source && dest
			}
			else
				{
					echo "Reached!";
					//echo ("Source and Destination are same!");
				}
		
		echo "Reached";
	}
	
	
		
	public function display()
	{
		$result = mysql_query("SELECT `station_name` FROM `station`") or die(mysql_error());
		//$sql=mysql_query("select * from FOOD where FOOD_NAME like 'A%'");
		while($row=mysql_fetch_assoc($result)) $output[]=$row;
		print(json_encode($output));
		//return $result;
		//echo ($result["station_name"]);
		/*$i=0;
		while($row=mysql_fetch_assoc($result))
			{
			$value[$i] = $row["station_name"];
			$i++;
			}
			$j=0;
			
			while($j<$i)
			{
				//echo $value[$j];
				$j++;
			}
			return $value;
			//echo $value;
		//$no_of_rows = mysql_num_rows($result);
		/*if ($no_of_rows > 0)
		{
			$result = mysql_fetch_array($result);
			return $result;
		}*/
		/*$result = mysql_query("SELECT station_name FROM stations");
		$storeArray = Array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
		{
			$storeArray[] =  $row['station_name'];  
		}
		echo $storeArray;*/
	}
    /**
     * Check user is existed or not
     */
	
    public function isUserExisted($mobileno) {
        $result = mysql_query("SELECT `email` from `users` WHERE `mobileno` = '$mobileno'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) 
	{

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>
