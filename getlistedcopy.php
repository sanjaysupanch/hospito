<?php
function test_input($data) {
  //$data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$errcheck = 1;
$nameErr = $qualErr = $expErr = $hospErr = $specialityErr =$costErr = $cityErr = $mobileErr = "";
if (isset($_POST["action"]))
	{
    	if (empty($_POST["name"])) 
    	{
    		$nameErr = "* Name is required"; 	
    		$errcheck = 0;
    	}	
    	else
    	{
    		$name = test_input($_POST["name"]);
    		if (!preg_match("/^[a-zA-Z ]*$/",$name))
    		{
      			$nameErr = "*Only letters and white space allowed"; 
      			$errcheck = 0;
      		}
    	}
    	if (empty($_POST["qual"])) 
    	{
    		$qualErr = "*qualification is required"; 	
    		$errcheck = 0;
    	}	
    	else
    	{
    		$qual = test_input($_POST["qual"]);
    		if (!preg_match("/^[a-zA-Z ]*$/",$qual))
    		{
      			$qualErr = "*Only letters and white space allowed"; 
      			$errcheck = 0;
      		}
    	}
    	if (empty($_POST["exp"])) 
    	{
    		$expErr = "*experience is required"; 	
    		$errcheck = 0;
    	}	
    	else
    	{
    		$exp = test_input($_POST["exp"]);
    		if(!is_numeric($exp))
    		{
				$expErr= "Please use only numbers";
				$errcheck =0;
	
			}
		}
    	if (empty($_POST["hosp"])) 
    	{
    		$hospErr = "*hospital is required"; 	
    		$errcheck = 0;
    	}	
    	else
    		$hosp = test_input($_POST["hosp"]);
	if (empty($_POST["spe"])) 
    	{
    		$specialityErr = "*speciality is required"; 	
    		$errcheck = 0;
    	}
    else
    	$spe= test_input($_POST["spe"]);
	
	if (empty($_POST["cost"])) 
    	{
    		$costErr = "*cost is required"; 	
    		$errcheck = 0;
    	}
    else
    {
		$cost= test_input($_POST["cost"]);
	  	if(!is_numeric($cost))
    		{
				$costErr= "Please use only numbers";
				$errcheck =0;
			}	
	}
	if (empty($_POST["city"])) 
    	{
    		$cityErr = "*city is required"; 	
    		$errcheck = 0;
    	}		
	else
		$city= test_input($_POST["city"]);
	if (empty($_POST["mobile"])) 
    	{
    		$mobileErr = "*mobile is required"; 	
    		$errcheck = 0;
    	}
    else
    {
		$mobile= test_input($_POST["mobile"]);
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
    			$sql = "INSERT INTO doctors
    			VALUES ('$name', '$qual', '$exp', '$hosp', '$spe','$cost', '$city', '$mobile')";
    			$conn->exec($sql);
    			$name = $qual = $exp = $hosp = $cost = $spe = $mobile =$city ="";
    			$x =  "<span style = 'color:green;'> Sent successfully</span>";
    		} 
    		catch(PDOException $e)
    		{
    			$x = $e->getMessage();
    			$y = "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '$mobile' for key 'mobile'";
    			if($x==$y)
    				$x = "mobile number should be unique";
    			else
    				echo $x;
    		}    
    		$conn = null; 	
    	
    	} 
		
		
	}
?>
<!doctype html>
<html>
<head>
	<title>get listed</title>
</head>
<body>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
	<?php echo $x; ?><br>
	name <input type = "text" name = "name"value = "<?php echo $name ?>"><br>
	qualification <input type = "text" name = "qual" value = "<?php echo $qual ?>"><br>
	experience  <input type = "number" min ="0" max = "80"  name = "exp" value = "<?php echo $exp ?>"><br>
	hospital <input type = "text" name = "hosp" value = "<?php echo $hosp ?>"><br>
	speciality<input type = "radio" name = "spe" value = "cardiologist"> cardiologist
	<input type = "radio" name = "spe" value = "neuroligist"> neuroligist
	<input type = "radio" name = "spe" value = "physician"> physician
	<input type = "radio" name = "spe" value = "dentist"> dentist
	<input type = "radio" name = "spe" value = "psychaitrist"> psychaitrist
	<input type = "radio" name = "spe" value = "orthopedic"> orthopedic<br>
	cost <input type = "number" min ="0" max = "9999"  name = "cost" value = "<?php echo $cost ?>"><br>
	city <input type = "radio" name = "city" value = "delhi"> Delhi
	<input type = "radio" name = "city" value = "mumbai"> Mumbai
	<input type = "radio" name = "city" value = "chennai"> Chennai
	<input type = "radio" name = "city" value = "kolkata"> Kolkata<br>
	mobile <input type = "number" min ="0" name = "mobile" value = "<?php echo $mobile ?>"><br>
	<input type = "submit" value = "get listed " name = "action">
</form>































</body>
</html>

