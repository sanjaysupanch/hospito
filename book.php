<?php
$fnameErr =  $lnameErr = $ageErr = $genderErr = $probErr = $mobileErr = $emailErr = $dateErr = "";
$errcheck = 1;
function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST["action"]))
	{
    	if (empty( test_input($_POST["fname"]))) 
    	{
    		$fnameErr = "*First Name is required"; 	
    		$errcheck = 0;
    	}	
    	else
    	{
    		$fname = test_input($_POST["fname"]);
    		if (!preg_match("/^[a-zA-Z ]*$/",$fname))
    		{
      			$fnameErr = "*Only letters and white space allowed"; 
      			$errcheck = 0;
      		}
    	}		
  		if (empty( test_input($_POST["lname"])))
  		{
    		$lnameErr = "*Last Name is required";
    		$errcheck = 0;
    	} 		
    	else 
    	{
    		$lname = test_input($_POST["lname"]);
    		if (!preg_match("/^[a-zA-Z ]*$/",$lname)) 
    		{
      			$lnameErr = "*Only letters and white space allowed"; 
   				$errcheck =0;
   			}
    	}
  		if ( empty($_POST["age"]) )
  		{
    		$ageErr = "*age is required";
    		$errcheck = 0;
    	}
   		else
   		{ 
    		$age = $_POST["age"];
    		if(!is_numeric($age))
    		{
				$ageErr= "Please use only numbers";
				$errcheck =0;
			}
   		}	  	    				
  		if (empty( test_input($_POST["gender"])))
  		{
    		$genderErr = "*gender is required";
    		$errcheck = 0;
    	}
   		else
    		$gender = $_POST["gender"];   	
    
    	if (empty( test_input($_POST["mobile"]))) 
    	{
    		$mobileErr = "*mobile is required";
    		$errcheck = 0;
    	}
   		else{ 
    		$mobile = test_input($_POST["mobile"]);
    		if(!is_numeric($mobile))
    		{
				$mobileErr= "Please use only numbers";
				$errcheck =0;
			}
        else if(strlen($mobile) <5 )    
        {
            $mobileErr= "Please enter valid number";
            $errcheck =0;
        }
    	}
    	if (empty ($_POST["dom"]) || empty ($_POST["month"]) || empty ($_POST["year"]) ) 
  		{
    		$dateErr = "*date is required";
    		$errcheck = 0;
    	}
   		else 
   		{
    		$dom = $_POST["dom"]; 
			$month = $_POST["month"]; 
			$year = $_POST["year"];  
			$date = $dom."-".$month."-".$year;
    	}
  		if (empty( test_input($_POST["email"]))) 
  		{
    		$emailErr = "*Email is required";
    		$errcheck = 0;
    	}
   		else 
   		{
    		$email = test_input($_POST["email"]); 
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  				$emailErr = "*Invalid email format";
  				$errcheck = 0;
			}  
    	}
    	if($errcheck) 
    	{
    	 	$servername = "localhost";
    		$username = "root";
		    $password = "iiits@123";
		    $dbname = "itproject";
			try
			{
    			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$sql = "INSERT INTO appointment
    			VALUES ('$fname', '$lname', '$age', '$gender', '$date', '$mobile', '$email')";
    			$conn->exec($sql);
    			$fname = $lname = $age = $gender = $date = $mobile =$email = $dom = $month = $year = "";
    			$z =  "<span style = 'color:green;'> Sent successfully</span>";
    		} 
    		catch(PDOException $e)
    		{
    			$x = $e->getMessage();
    			echo $x;
    		}    
    		$conn = null; 	
    	
    	}  		
    }		

?>

<!DOCTYPE html>
<html>
	<head>
   <!-- <link href="style.css" rel="stylesheet" type="text/css">-->
    <style>
      .head_2_class{font-family: Arial;font-size: 60px;text-align: center;background-color: #66BFFF}
      body{background-color: #f0f0f5}
      .err{color:red;}
      </style>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Hospito</title>
      <link rel="stylesheet" type="text/css" href="book.css">
      <script src="jquery-3.2.1.js"></script>
      <script type="text/javascript" src="script1.js"></script>
	</head>
	<body>
     <div style="background-color: white">
      <div>
        <img id="logo"  class="spin" src="logo.png">
      </div>
      <center>
        <img src="name.png" height="100px">
        <span><p id = "greet"></p>
        <select class = "lst" id="action" onchange="action()">
          <option value="none" selected>Account Action</option>
          <option value="logout">Logout</option>
          <option value="change">Change Password</option>
          <option value="delete">Delete Account</option>
        </select></span>
      </center>
    </div>
    <div id="navbar">
      <div id="nav">
        <ul>
          <li class="opt"><a class="menu" href="home.html">Home</a></li>
          <li class="opt"><a class="menu" href="consult.php">Consult Online</a></li>
          <li class="opt"><a class="menu" href="find.php">Find Doctors</a></li>
          <li class="opt"><a class="menu" href="order.html">Order Medcine</a></li>
          <li class="opt"><a class="menu" href="explore.html"> Articles</a></li>
          <li class="opt"><a class="menu" href="doc.php">Doctor's Area</a></li>
          <li class="opt"><a href="#l6" class="menu">Contact Us</a></li>
        </ul> 
      </div>
    </div>
    <section class="parallax">
      <div class="parallax-inner">
      </div>
    </section>


     <div class="head_2_class">
      <strong>Find and Book<br> Appointments with Doctors</strong> 
      </div>
        		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        		
          			<table id="consult_table">
          			<tr>
          				<td>First Name:</td>
          				<td><input type = "text" name = "fname" value = "<?php echo $fname ?>" autofocus>
          				<span class = "err"><?php echo $fnameErr ?></span></td>
                  <td rowspan="8"><img src="back_image.jpg" style="float:right;"></td>
          			</tr>
          			<tr>
          				<td>Last Name:</td>
          				<td><input type ="text" name = "lname" value = "<?php echo $lname ?>" >
          				<span class = "err"><?php echo $lnameErr ?></span></td>
          			</tr>
          			<tr>
          				<td>Age:</td>
          				<td><input name = "age" type = "number" min = "0" max = "120"  value = "<?php echo $age ?>">
          				<span class = "err"><?php echo $ageErr ?></span></td>
          			</tr>
          			<tr>
          				<td>Gender:</td>
          				<td>
          				    <lable class="container">
          				    <input type = "radio" name ="gender" value = "m">Male<br>
          					<input type = "radio" name ="gender" value = "f">Female<br>
          					<span class = "err"><?php echo $genderErr ?></span>
          					</lable>
          				</td>
          			</tr>	

          			<tr>	
          				<td id="date">Date of Appointment</td>
          				<td><input name = "dom" type = "number" min = "1" max = "31" placeholder="dd" value = "<?php echo $dom ?>">
          				<input name = "month" type = "number" min = "1" max = "12" placeholder="mm" value = "<?php echo $month ?>">
          				<input name = "year" type = "number" min = "2018" max = "2020" placeholder="yyyy" value = "<?php echo $year ?>">
          				<span class = "err"><?php echo $dateErr ?></span></td>
          			</tr>
          			<tr>
          				<td>Mobile:</td>
          				<td><input type = "number" name = "mobile" value = "<?php echo $mobile ?>">
          				<span class = "err"><?php echo $mobileErr ?></span></td>
          			</tr>
          			<tr>	
          				<td>Email id:</td>
          				<td><input type = "text" name = "email" value = "<?php echo $email ?>">
          				<span class = "err"><?php echo $emailErr ?></span></td>
          			</tr>
          			<tr>
          				<td><input type = "submit" name = "action" value="Book Now" class="button"></td>
          			</tr>
          		</table>		
        		</form>	
	</body>
</html>
