<?php

if (isset($_POST['tag']) && $_POST['tag'] != '') 
{
    // get tag
    $tag = $_POST['tag'];
	
    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);
    
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
		
		$user = $db->update($name,$email,$addr,$mobileno,$city,$state, $cntry,$birthd);
		
	}
}

   if($tag == 'ticket')
	{
		$mno = $_POST['mobile'];
		$user = $db->showcount($mno);
                $user1 = $db->chck_paid($mno);
                
                if ($user1 != "paid")
                {
                         header("Location: http://metropune.atwebpages.com/SrcDest.php");
                echo '
				<!DOCTYPE html>
				<html>
				<head>
				<script>
				alert("Unpaid tickets deleted");
				</script>
				</head>
                                ';
                        
                }
                else
                {
                        //echo  "You have active tickets! Go to My Tickets";
 
                        header("Location: http://metropune.atwebpages.com/mytickets.php");
                        /*<!DOCTYPE html>
				<html>
				<head>
				<script>
				alert("You have active tickets! Go to My Tickets");
				</script>
				</head>
';   */
                }
	}
?>     