     <?php
           @  session_start();
                $con=mysql_connect("fdb7.runhosting.com","1670938_api","nishikant123");
                $db_select = mysql_select_db("1670938_api",$con);
                
                require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
    ?>
    
    
 <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Pune Metro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
         <link rel="shortcut icon" type="image/x-icon" href="AWT-Train.ico" >
    </head>
    <body>
    <?php 
     $mobile = $_SESSION['sess_username'];
// $timearr = $_SESSION['times'];
//echo "hi";
         echo $mobile;
       ?>
    <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="">
                                    <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>Pune Metro<span></h1>
				
                        <a href="http://metropune.atwebpages.com/Home.html" class="current-demo"></a>
				</nav>
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="tometroschedule"></a>
                    <a class="hiddenanchor" id="tobuyticket"></a>
                    <div id="wrapper">
                        <div id="main" class="animate form">
                        
                        
                         <form  action="routing/test.php" method = "post" autocomplete="on"> 
                                <h1>Times</h1>                               
								<p>	
								<label for="Src_Sel" class="source"> Select Time</label><br>
                                                                 </p>
                                                                
<?php
                $user = $db->showtime($mobile);
		if ($user != false) 
		{
                        // echo "reached";
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
			//$response
			//echo json_encode($finalop[0]);
			$resp["time"] = array();
			array_push($resp["time"], $finalop);
                        //print_r($resp["time"]);
                        //echo "reached";
                        //echo $resp["time"][0]["t"][21];
                        
                }
                        
		else 
		{
            
            $response["error"] = 1;
            $response["error_msg"] = "Error";
                        //echo json_encode($response);
        }
                    ?>
                                                                
                                               <select name = "utime">
                                               <?php foreach($resp["time"][0]["t"] as $value) : ?>
                                                <option value="<?php echo $value; ?>" > <?php echo $value ?></option>
                                                <?php endforeach; ?>
                                                 </select>
                                                  
                                                  <p>
                                                        <input type="hidden" name="mobile" value="<?php echo $mobile; ?>"><br>
						   </p>                                                 
                                                    
                                                   <p class="route button"> 
									<input type="submit" value="Proceed to Pay"/>
									<!--<a href="#tologin" class="to_register"> </a>-->							
                                                    </p>
                                             
                                         </select>
                                   </form>
                                </div>

                        </body>