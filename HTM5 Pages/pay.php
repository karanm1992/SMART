  <?php
           @  session_start();
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
                        
                        
                         <form  action="index1.php" method = "post" autocomplete="on"> 
                                <h1>Credit Card Payment</h1>                                                                                               
                                                                 
                                <p> 
                                    <label for="cardno" class="cardno" data-icon="N" >Card Number</label>
                                    <input id="cardno" name="cardno" required="required" type="text" placeholder="eg. 1111-2222-3333-4444"/>
                                </p>
                                <p> 
                                    <label for="name" class="name" data-icon="u">Name on Card</label>
                                    <input id="name" name="name" required="required" type="text" placeholder="eg. JOHN CARTER" /> 
                                </p>
                                <p> 
                                        <label for="exdate" class="exdate" data-icon="D">Expiry Date</label>
                                     <input type="month" name="expirydate" required="required">
                                 </p>
                                <p> 
                                        <label for="cvv" class="cvv" data-icon="p">CVV</label>
                                     <input type="password" name="cvv" required="required" placeholder="3-digit code behind your card">
                                 </p>                                 
                                                                 
                                                                   <p>
                                                        <input type="hidden" name="mobile" value="<?php echo $mobile; ?>"><br>
						   </p>                                                 
                                                    
                                                    <p>
                                                        <input type="hidden" name="tag" value="done"><br>
						   </p>                                                 
                                                   <p class = "route button">
							<input type="submit" value="Make Payment"/>
                                                    </p> 
									<!--<a href="#tologin" class="to_register"> </a>-->							
                                             
                                             
                                         
                                   </form>
                                </div>

                        </body>