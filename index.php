
<html><head>
<title>Nothing to do!</title>
<link href="css/template.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="header">
  <div class="topstrip">
  
     <div class="tabs">
    <ul>
      <li><a class="current" href="#">Home</a></li>
      <li><a href="#">About Us</a></li>
    </ul>
  </div>

  </div>
    <div class="logo"><img src="logo.png"> </div>
  <div class="imageslide">
    <div class="overlay">
      <div class="overlaycontent">
        <div class="container">
          <h1 style="text-align: center;">Tell us what you are planning to do.</h1>
          <div style="margin-top: 30px; margin-left:17%; ">
		  	<form method=post name=Puttable>
                  <input class="task-name" type="text" name="search_activity" placeholder="e.g watch Star Wars" size="60">
                  <input class="greenbutton" type="submit" name="GO" value="Submit"></center>
			</form> 

					
			
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="spacer"></div>
 
</div>
<div class="maincontent"> 

<?php
        IF(isset($_POST['search_activity'])){
        $search_activity= $_POST['search_activity'];
        //getstatus from sentiment analysis
        $status=".17";
        echo "<br>Our rating for  <b>" .$search_activity. "</b>  is ".$status;    
        echo "<br><br><br><br>Other stuff you can do instead <br><br>";    
        saveLocationDetails($search_activity);
        }
        
        function saveLocationDetails($search_activity){
            $clientip = $_SERVER['REMOTE_ADDR'];  
            $clientlocation = @unserialize(file_get_contents('http://ip-api.com/php/'.$clientip));
                $country=null;
                $city=null;
                $zip=null;
                $state=null;
                $ip=null;
				echo $clientlocation['status'];
            if($clientlocation['status'] == 'success')
            {
                $country=$clientlocation['country'];
                $city=$clientlocation['city'];
                $zip=$clientlocation['zip'];
                $state=$clientlocation['region'];
                $ip=$clientlocation['query'];
            }
            /*echo    $country."<br>"; 
            echo    $city."<br>";
            echo    $zip."<br>";
            echo    $state."<br>";
            echo    $ip."<br>";*/
            $sql="insert into visitor_activity (search_activity,ip,country,city,state,zip)
            values('$search_activity','$ip','$country','$city','$state','$zip');"; 
            RunSQL($sql);
            }
        
        function RunSQL($script)
        {
            $con= mysqli_connect("sql204.byethost33.com","b33_15996708","mis510","b33_15996708_Mining");
            if (mysqli_connect_errno())    {
              echo "Failed to connect to Database: " . mysqli_connect_error();
              return 0;
            }
            $result = mysqli_query($con,$script)  or die("Error in the query.." . mysqli_error($con));
            $con->close();
            return $result;
        }
        
?>



</div>
<footer>
  <div class="upperfooter">
  </div>
  <div class="lowerfooter">
	<div>Nothing to do! © 2013-2014 - All rights reserved</div>
  </div>
</footer>

</body></html>