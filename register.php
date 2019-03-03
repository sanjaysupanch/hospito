<?php
$fnameErr =  $lnameErr = $emailErr = $passErr = $repassErr = "";
$chpass = "";
$errcheck = 1;
if (isset($_POST["action"]))
	{
    	if (empty(test_input($_POST["fname"]))) 
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
  		if (empty(test_input($_POST["lname"])))
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
  		if (empty (test_input($_POST["email"]))) 
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
  		if (empty (test_input($_POST["pass"])))
  		{
    		$passErr = "*password is required";
    		$errcheck = 0;
    	}
   		else{
    		$pass = test_input($_POST["pass"]);
    		if  (strlen($pass) < 3 )
    		{
    			$passErr = "*password too short";
    			$errcheck = 0;
    		}
    		
    			
    		}	
    	if (empty (test_input($_POST["repass"]))) 
    	{
    		$repassErr = "*Retype Password is required";
    		$errcheck = 0;
    	}
   		else 
    		$repass = $_POST["repass"];   		
         if (($_POST["pass"] !=$_POST["repass"]) && $errcheck)
        	$chpass = "please type password correctly";
        else if ($errcheck)
        {
        	$servername = "localhost";
    		$username = "root";
		    $password = "iiits@123";
		    $dbname = "itproject";
			try{
    			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$sql = "INSERT INTO registerinfo (fname, lname, email, password)
    			VALUES ('$fname', '$lname', '$email', '$pass')";
    			$conn->exec($sql);
    			$z =  "<span style = 'color:green;'> New record created successfully</span>";
    			$fname = $lname = $email = $pass = "";
    		}
    		catch(PDOException $e)
    		{
    			$x = $e->getMessage();
    			$y = "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '$email' for key 'email'";
    			if($x==$y)
    				$z ="This email id is taken. please use another email id"; 	
    			else
    				echo $x;
    		}
    			$conn = null;
        }
    }
    
function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>

<html>
     <head>
  	      <link href="login.css" rel="stylesheet" type="text/css">
          <title>Register</title>
	</head>
    <body>
    	<img class="login_image" src="logo1.png">
		<img class="i5" src="name.png">
    
  
  	   
      <div class="f1" id="parent" >
         <h3>Register for free</h3><h3>It's free and always will be.</h3>
      		<br><br>
      		  <span class="error"><?php echo $z ?></span>
      		    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      		    <div>
      		   	 <table>
      				<tr>
      				<td id = "f3">First Name:</td>
      		<td><input name = "fname" type = "text" autofocus  placeholder="first name*" value="<?php echo $fname;?>" maxlength="30"></td> 
        		</tr>
        			<tr>
        			<td id = "f3">Last Name:</td>
        		<td><input name = "lname" type = "text" autofocus  placeholder="last name*" value="<?php echo $lname;?>" maxlength ="30"></td>
				</tr>
				<tr>
				<td id = "f3">Email Id :</td>
				<td><input name = "email" type = "text" autofocus placeholder="email*" value="<?php echo $email;?>" maxlength ="50"></td>
				</tr>
				<tr>
				<td id = "f3">Password :</td>
				
				<td><input  name = "pass" autofocus  type = "password" maxlength ="20"></td>
				</tr>
				<tr>
				<td id = "f3">Retype Password:</td>
				<td><input name = "repass" type = "password" maxlength ="20"></td>
				</tr>
				</table>
				<td><span class="error"> <?php echo $fnameErr;?></span><br></td>
				<td><span class="error"> <?php echo $lnameErr;?>   </span><br></td>
				<td><span class="error"> <?php echo $emailErr;?></span><br></td>
				<td><span class="error"><?php echo $passErr;?></span><br></td>
				<td><span class="error"> <?php echo $repassErr;?></span><br></td>
				<span class="error"><?php echo $chpass;?></span><br>
       		    <input name="action" type="submit"  class="button" value="Register"> 
      	      </form>
      	  		<br>
      	      <br><a href = "login.php"><input type = "button" class="button" value = "login"> </a>
      </div>
      
  </body>
</html>
