<?php
$passErr = $emailErr = "";
$errcheck = 1;
$redir = "";
if (isset($_POST["action"]))
{
	if (empty (test_input($_POST["email"])))
	{
		$emailErr = "*Email is required";
		$errcheck = 0;
    }
    else
    {
    	$email = test_input($_POST["email"]); 
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		 {
  			$emailErr = "Invalid email format";
  			$errcheck = 0;
		}  
    }
    if (empty (test_input($_POST["pass"])))
  	{
    	$passErr = "*Password is required";
    	$errcheck = 0;
    }
	else
    	$pass = $_POST["pass"]; 
	if($errcheck)
      	{
			$servername = "localhost";
    		$username = "root";
			$password = "iiits@123";
			$dbname = "itproject";   
			try
		{
			$conn = new mysqli($servername, $username, $password, $dbname);
			$sql = "SELECT password FROM registerinfo WHERE email = '$email'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$row = $result->fetch_assoc();
				if($row["password"]!=$pass){
					$x = "please check your password";
					}
				else
				{
					$sql = "DELETE FROM registerinfo WHERE email = '$email'";
					$conn->query($sql);
					$email = "";
					$x = "<span style = 'color:green;sixe = 50;'>Success </span>";
				}
			}
			else
				$x = "please check your email";
		}
		catch(Exception $e)
    	{
			   		echo  $e->getMessage();
    	}   	
      	
      	}

}
function test_input($data) 
{
  //$data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function redirect($url){
	ob_start();
	header ('location: '.$url);
	ob_end_flush();
	die();
}
?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="login.css" >
		<title> Delete </title>
	</head>
	<body>
	<img class="login_image" src="logo1.png">
	<img class="i5" src="name.png">
	

	  
	  <div class="f1" id="parent">
	  	<h2 id="h1_1"> Delete</h2>
	   <span class = "error"><?php echo $x ?></span><br>	
       <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
       <div>
       <table>
       <tr>
       <td id = "f3">Email Id :</td>
		<td><input type = "text" name = "email"  placeholder="email*" autofocus value = "<?php echo $email;?>"></td><br>
		</tr>
		<tr>
		<td id = "f3">Password:</td>
		<td><input type = "password" autofocus placeholder="password*" name = "pass"></td><br>
		</tr>
		</table>
			<span class = "error"> <?php echo $emailErr ?> </span><br>
			<span class = "error"> <?php echo $passErr ?> </span><br><br>
		</div>
			<input name = "action" type = "submit" class="button" value = "delete">
			</form>
				
				<br>
				<a href = "register.php"><input type = "button" class="button" value = "new user"> 
			<br><br>
				<a href = "login.php"><input type = "button" class="button" value = "login"> 
	  </div>
	  

	</body>
</html>
