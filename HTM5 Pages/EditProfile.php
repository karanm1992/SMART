<?php
session_start();
$con=mysql_connect("fdb7.runhosting.com","1670938_api","nishikant123");
$db_select = mysql_select_db("1670938_api",$con);
        
      
        ?>
<html>        
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


//include 'index1.php';
//require_once 'index1.php';
//$no = new index1();

//$mob = $no->getMob();

//$mobileno = $_POST['input'];
//$_SESSION[user]= $_get[username];
$mobile = $_SESSION["sess_username"];
//echo "reached";
//echo $mobile;

//echo $mob;


$result = mysql_query("SELECT * FROM `users` where `mobileno` = $mobile; ",$con) or die(mysql_error());
while($result2 = mysql_fetch_assoc($result))
$res[]=$result2;

//<? echo "<input type = "."text"." value = ".$result2[0]['name'];


$name = $res[0]['name']; 
$mobileno = $res[0]['mobileno'];
$em = $res[0]['email'];
$add = $res[0]['addr'];
$city = $res[0]['city'];
$state = $res[0]['state'];
$coun = $res[0]['cntry'];
$dob = $res[0]['birthd'];


//mysql_close($con);
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
                            <form  action="index1.php" method="post" autocomplete="on"> 
                                <h1>Edit Profile</h1> 															
				
				
                               
                                <p> 									
																		
                                    <label for="username" class="uname" data-icon="u" > Name: </label>
                                    <input id="username" name="username" required="required" type="text" value = "<?php echo $name; ?>" >
                                </p>
                             
                                <p> 									
																		
                                    
                                    <input id="mobile" name="mobile" required="required" type="hidden" value = "<?php echo $mobileno; ?>">
                                </p>
                             
                                <p> 
                                    <label for="usermail" class="umail" data-icon="e" > E-mail</label>
                                    <input id="usermail" name="usermail" required="required" type="text" value = "<?php echo $em; ?>">
                                </p>
                           
								<p>
								<label for="addr" class="addrs" data-icon="A" > Your address</label>
								<input id="Your address" name="useraddress" required="required" type="address" value = "<?php echo $add; ?>"> 
                                </p>
								<p> 
                                    <label for="usercity" class="ucity" data-icon="A" > City</label>
                                    <input id="usercity" name="usercity" required="required" type="text" value = "<?php echo $city; ?>">
                                </p>
								<p> 
                                    <label for="userstate" class="ustate" data-icon="A" > State</label>
                                    <input id="userstate" name="userstate" required="required" type="text" value = "<?php echo $state; ?>">
                                </p>
								<p> 
                                    <label for="usercountry" class="ucountry" data-icon="A" > Country</label>
                                    <input id="usercountry" name="usercountry" required="required" type="text" value = "<?php echo $coun; ?>">
                                 </p>
								<p> 
                                    <label for="userdob" class="udob" data-icon="u" > Date of Birth</label>
                                    <input id="userdob" name="userdob" required="required" type="text" value = "<?php echo $dob; ?>">
                                </p>
								<p>
                                                                <input type="hidden" name="tag" value="update"><br>
								</p>
                                <p class="edit button"> 
									<input type="submit" value="Make Changes"/>
									<!--<a href="#tologin" class="to_register"> </a>-->							
								</p>
                            </form>
                        </div>
					</div>									
                </div>  
            </section>
        </div>
    </body>
</html>