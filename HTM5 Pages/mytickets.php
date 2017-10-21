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
         
         $user = $db->showcount($mobile);
//echo $user["count"];
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
                        
                        
                                <form  action="phpqrcode/new.php" method = "post" autocomplete="on"> 
                                <h1>My Tickets</h1>                                                                                                                                  
                                                                                                                                           

                                        <a href="http://metropune.atwebpages.com/App_Main.html" id="home">HOME</a><br/>
                                
                                                            <?php 
                                                            $tickarr = array();
                                                            for($k = 0; $k<$user["count"];$k++) { 

                                                                    $tickarr[$k+1] = $k+1;
                                                                    //echo $tickarr[$k+1];
                                                            } ?>

                                                 <select name = "tino">        
                                                 <?php foreach($tickarr as $value) : ?>
                                                <option value="<?php echo $value; ?>" >Ticket <?php echo $value ?></option>
                                                <?php endforeach; ?>
                                                          
                                                 </select>
                                                     <p>
                                                        <input type="hidden" name="mobile" value="<?php echo $mobile; ?>"><br>
						   </p>              
                                                    <p>
                                                        <input type="hidden" name="tag" value="done"><br>
						   </p>                                                 
                                                   
                                                    <p class="route button"> 
							<input type="submit" value="Proceed"/>
                                                    </p> 
                                                    <p>
                                                    
                                                    </p>

									<!--<a href="#tologin" class="to_register"> </a>-->							
                                             
                                             
                                         
                                   </form>
                                   
                                <div id="main" class="animate form">
                                        <form  action="index1.php" method = "post" autocomplete="on"> 
                                                
                                                   <p>
                                                        <input type="hidden" name="mobile" value="<?php echo $mobile; ?>"><br>
						   </p> 
                                                   
                                                   <p>
                                                        <input type="hidden" name="tag" value="delete"><br>
						   </p>                                                 
                                                   
                                                   <p class="route button"> 
							<input type="submit" value="delete"/>
                                                   </p> 
                                        </form>
                                 
                                </div>
                                </div>
                            </div>

                </body>