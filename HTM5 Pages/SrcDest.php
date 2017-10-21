    <?php
           @ session_start();
                $con=mysql_connect("fdb7.runhosting.com","1670938_api","nishikant123");
                $db_select = mysql_select_db("1670938_api",$con);
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

/* $result = mysql_query("SELECT * FROM users",$con) or die(mysql_error());
        while($result2 = mysql_fetch_assoc($result))
        $res[]=$result2;
        //<? echo "<input type = "."text"." value = ".$result2[0]['name'];
       
$mob = $res[0]['mobileno'];*/
        $mobile = $_SESSION["sess_username"];
        echo $mobile;
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
                                <form  action="/routing/index.php" method = "post" autocomplete="on"> 
                                <h1>Routes</h1>                               
								<p>	
								<label for="Src_Sel" class="source"> Select Source</label><br>
                                <select name="source">
								<option value="select">Select</option>
								<option value="Camp">Camp</option>
								<option value="LullaNagar">LullaNagar</option>
								<option value="Kondhwa">Kondhwa</option>
								<option value="Katraj">Katraj</option>
								<option value="FC">FC</option>
								<option value="Hadapsar">Hadapsar</option>
								<option value="Kothrud">Kothrud</option>
								</select>
								</p>
								<p>
								<label for="Dest_Sel" class="dest"> Select Destination</label><br>
                                <select name="dest">
								<option value="select">Select</option>
								<option value="Camp">Camp</option>
								<option value="LullaNagar">LullaNagar</option>
								<option value="Kondhwa">Kondhwa</option>
								<option value="Katraj">Katraj</option>
								<option value="FC">FC</option>
								<option value="Hadapsar">Hadapsar</option>
								<option value="Kothrud">Kothrud</option>
								</select>
								</p>
								
								<p>
								<input type="hidden" name="mobile" value="<?php echo $mobile; ?>"><br>
								</p>
								
								<p class="route button"> 
									<input type="submit" value="Proceed"/>
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