<?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    //$mobile=$_POST['mobile'];
	//$mobile=9921899779;
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
    </head>
    <body>

    
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
   
   <?php 
   

				

   echo "<h1>QR Code</h1><hr/>";
   
echo '<h2><a href="http://metropune.atwebpages.com/mytickets.php">BACK </a> </h2>';
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

	//$response["user"]["email"],$response["uid"],$response["user"]["name"];
	//$response;
	//$comma_separated = implode(",", $response);

	//echo $comma_separated;
	

	include "new.php";
    include "qrlib.php";    
	
    $array = array($response["user"]["uni_id"],$response["user"]["src"],$response["user"]["destn"],$response["user"]["depttime"],$response["user"]["arrtime"],$response["user"]["route_no"],$response["user"]["cost"]);
	$value = implode(" , ",$array);
	//echo $value;
	//echo $response["user"]["email"],$response["uid"],$response["user"]["name"];
    //ofcourse we need rights to create temp dir
    
	if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'Q';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize =5;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test.png';
		//'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        //echo 'You can provide data in GET parameter: <a href="?data=">$value</a><hr/>';    
	QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   } 
        
    
        
    //display generated file
   
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="horizontal-align:middle" />'; 
    //config form

     echo '<hr/>';  
        //echo $value;
        echo $user1["src"];
        echo "  To  ";
        echo $user1["dest"];
        echo '<br/>';
        echo "     Departure - ";
        echo $response["user"]["depttime"];
        echo "    Arrival -";
        echo $response["user"]["arrtime"];
     echo '<hr/>';     
     
        echo '<a href="http://metropune.atwebpages.com/App_Main.html">Home </a> ';
    echo '<form action="index.php" method="post"> ';
/*
        Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):$value).'" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
echo '</select>&nbsp; 
echo ' <input type="submit" value="GENERATE"></form><hr/>'; 
        
    // benchmark
QRtools::timeBenchmark();     */

    