<?php
$fnameErr =  $lnameErr = $ageErr = $genderErr = $probErr = $mobileErr = $emailErr = "";
$errcheck = 1;
function test_input($data) {
  //$data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST["action"]))
	{
    	if (empty($_POST["fname"])) 
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
  		if (empty($_POST["lname"]))
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
  		if (empty($_POST["age"])) 
  		{
    		$ageErr = "*age is required";
    		$errcheck = 0;
    	}
   		else
   		{ 
    		$age = test_input($_POST["age"]);
    		if(!is_numeric($age)){
				$ageErr= "Please use only numbers";
				$errcheck =0;
				}
   		}	  	    				
  		if (empty($_POST["gender"]))
  		{
    		$genderErr = "*gender is required";
    		$errcheck = 0;
    	}
   		else
    		$gender = $_POST["gender"];   	
 
    	if (empty($_POST["problem"])) 
    	{
    		$problemErr = "*please type your problem";
    		$errcheck = 0;
    	}
   		else 
    		$problem = test_input($_POST["problem"]);   
    	if (empty($_POST["mobile"])) 
    	{
    		$mobileErr = "*mobile is required";
    		$errcheck = 0;
    	}
   		else{ 
    		$mobile = test_input($_POST["mobile"]);
    		if(!is_numeric($mobile)){
				$mobileErr= "Please use only numbers";
				$errcheck =0;
				}
    		}
  		if (empty($_POST["email"])) 
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
		    $doctor = $_POST["doctor"];
			try
			{
    			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$sql = "INSERT INTO consultonline
    			VALUES ('$fname', '$lname', '$age', '$gender', '$doctor', '$problem', '$mobile', '$email')";
    			$conn->exec($sql);
    			$fname = $lname = $age = $gender = $doctor = $problem = $mobile =$email ="";
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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>consult online</title>
		<link rel="stylesheet" type="text/css" href="homestyleconsult.css">
		<script src="jquery-3.2.1.js"></script>
		<script type="text/javascript" src="script1.js"></script>
	</head>
	<body onload = "func()">
		<div>
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
					<li class="opt"><a class="menu" href="order.html">Order Medicine</a></li>
					<li class="opt"><a class="menu" href="explore.html"> Articles</a></li>
					<li class="opt"><a class="menu" href="doctor.php">Doctor's Area</a></li>
					<li class="opt"><a href="home.html#l6" class="menu">Contact Us</a></li>
				</ul>
			</div>
		</div>
		<section class="parallax">
			<div class="parallax-inner">
			</div>
		</section><div class="a2">
		<h2 id="h1_1">Consult Online</h2>
		<p id="consult_para"><big><big>Beat traffic jams and clinic queues.Ask a doctor from anywhere(home or work)!</big></big><br>
		<big><big>Email any of your questions and queries regarding your problems.</big></big><br>
			&#10004;Verified doctors<br>
			&#10004;Privacy guaranteed
		</p></div>

		<div class="t1_style">
			<h1 style="text-align: center ;font-family: Helvetica">Here's how it works:</h1>
			<table width="100%" style="padding-left:30px ">
				<tr>
					<td>
						<table class="t1 box" align="center" >
							<tr>
							<td class="t4"> 
								<center>1</center>
								</td>
							</tr>					
						</table>
					</td>
					<td>
						<table class="t1 box">
							<tr>
								<td class="t4">
									<center>2</center>
								</td>
							</tr>					
						</table>
					</td>
					<td >
						<table align = "center" class="t1 box">
							<tr>
								<td class="t4">
									<center>3</center>
								</td>
							</tr>					
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<h2 class="head_style" style="text-align:center">Register now !</h2>
						<p class="times" style="text-align:center">Find solutions to all your health problems.<br>Your queries will be answered by the leading doctors in the country</p>
					</td>
					<td>
						<h2 class="head_style">Explain your issue</h2>
						<p class="times" >Describe your medical issue.<br> Don't hold back !</p>
					</td>
					<td>
						<h2 class="head_style" style="text-align:center">Get quick medical advice</h2>
						<p class="times" style="text-align:center">Get personalized advice from<br> concerned doctors regarding your condition</p>
					</td>
				</tr>
			</table>

		<div class="style_2">
			<h2 style="text-align: center;" class="head_style"><big>Get an expert opinion on almost anything!</big></h2>
			<table class="t3" align="center">
				<tr>
					<td>
						<i>&emsp;&emsp;&emsp;&emsp;Need help with frequent urination?</i> 
					</td>
					<td>
						  <i>Having trouble breathing?</i>
					</td>
				</tr>
				<tr>
					<td>
						&emsp;&emsp;&emsp;&emsp;<i>Need some dental advice?</i>
					</td>
					<td>
						<i>Want to get rid of acne scars?</i>
					</td>
					<tr>
						<td>
							<i>&emsp;&emsp;&emsp;&emsp;Stomach pain bothering you?</i>
						</td>
						<td>
							<i>Having questions about headache?</i>
						</td>
					</tr>
				</tr>
			</table>
		</div>

		
		<img src="consult_online.png" id="consult_online_image">
		<form method = "post" action = consult.php>
		
			<table id="consult_table" style="font-size:20px;">
			<tr>
				<td>first name:</td>
				<td><input type = "text" name = "fname" value = "<?php echo $fname ?>" >
				<span class = "err"><?php echo $fnameErr ?></span></td>
			</tr>
			<tr>
				<td>last name:</td>
				<td><input type ="text" name = "lname" value = "<?php echo $lname ?>" >
				<span class = "err"><?php echo $lnameErr ?></span></td>
			</tr>
			<tr>
				<td>age:</td>
				<td><input name = "age" type = "number" min = "0" max = "120"  value = "<?php echo $age ?>">
				<span class = "err"><?php echo $ageErr ?></span></td>
			</tr>
			<tr>
				<td>gender:</td>
				<td>
				    <lable class="container">
				    <input type = "radio" name ="gender" value = "m">male
					<input type = "radio" name ="gender" value = "f">female
					<span class = "err"><?php echo $genderErr ?></span>
					</lable>
				</td>
			</tr>	
			<tr>
				<td>doctor type:</td>
				<td><select id = "doctor"  name = "doctor">
					<option value = "dentist">dentist</option>
					<option value = "physician">physician</option>
					<option value = "psychiatrist">psychiatrist</option>
					<option value = "neurologist">neurologist</option>
					<option value = "cardiologist">cardiologist</option><br>
					</select>
				</td>
			</tr>
			<tr>	
				<td id="desOfProb">description of problem:</td>
				<td><textarea rows = "20" cols = "50" name = "problem"><?php echo $problem ?></textarea>
				<span class = "err"><?php echo $problemErr ?></span></td>
			</tr>
			<tr>
				<td>mobile:</td>
				<td><input type = "number" name = "mobile" value = "<?php echo $mobile ?>">
				<span class = "err"><?php echo $mobileErr ?></span></td>
			</tr>
			<tr>	
				<td>email id:</td>
				<td><input type = "text" name = "email" value = "<?php echo $email ?>">
				<span class = "err"><?php echo $emailErr ?></span></td>
			</tr>
			<tr>
				<td><input type = "submit" class = "button"name = "action" value = "Consult Now"></td>
			</tr>
		</table>		
		</form>	
	</body>
</html>
