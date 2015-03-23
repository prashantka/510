<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">-->

<!-- Optional theme 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> */-->
<style>
#header {
    background-color:#2ADEC9;
    color:white;
    text-align:center;
    padding:5px;
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:900px;
    width:100px;
    float:left;
    padding:5px;          
}
#section {
    width:550px;          
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;          
}
</style>
</head>
<body>
<div id="header">
<h1>Nothing to do!</h1>
</div>
<div id="nav">

</div>
<div id="section">
<form method=post name=Puttable>
                  <center style="margin-top: 2cm;">I want to  &nbsp;&nbsp;&nbsp;&nbsp;  
                  <input style="display:inline;" type="text" name="search_activity">
                  <input style="display:inline;" type="submit" name="GO" value="GO"></center>
                </form> 
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
</body>
</html>
