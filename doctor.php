<?php
function test_input($data) {
  $data = trim($data);
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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>get listed</title>
		<link rel="stylesheet" type="text/css" href="doc_style.css">
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
		</section>
		<p>
        <h2 id="h1_1">Doctor's Area</h2>    
        <p><big><big>Patients are looking for doctors like you.Millions of patients are looking for the right doctor on Hospito.<br> <br>
        Start your digital journey with Hospito Profile<br>
        Create your profile from anywhere, effortlessly!<br></big></big>
        &#10004;Easily add your details<br>
        &#10004;Add information that matters to your patients - fees, city and much more<br>
        </p>

        <div style="background-color: #66BFFF;height: 200px;width: 100%" class="head_style">
           <table align="center" style="text-align: center;">
               <tr>
                   <td>
                        <center><big><strong>
                        <div style="font-size: 60px">GET LISTED<br>
                        <div style="text-align: center;font-family: Times;font-size: 25px;">
                        You can help millions of people all across the country with your skills<br>
                        Get Listed Now!!</div>
                        </big></center></strong>
        
                   </td>
               </tr>
           </table>

        <div style="font-size: 20px;background-color: #f0f0f5">
        <p>
        <img src="illustration.png" style="float:right;">
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
            <?php echo $x; ?><br>
            <table> 
                <tr>  
                    <td>Full Name</td> 
                    <td><input type = "text" name = "name"value = "<?php echo $name ?>"><span style = "color:red"><?php echo $nameErr;?> </span></td>
                </tr>
                <tr>
                    <td>Qualification </td>
                    <td><input type = "text" name = "qual" value = "<?php echo $qual ?>"><span style = "color:red"><?php echo $qualErr;?> </span></td>
                </tr>
                <tr>
                    <td>Experience </td>
                     <td><input type = "number" min ="0" max = "80" name = "exp" value = "<?php echo $exp ?>"><span style = "color:red"><?php echo $expErr;?> </span></td>
                </tr>
                <tr>
                    <td>Hospital</td>
                     <td><input type = "text" name = "hosp" value = "<?php echo $hosp ?>"><span style = "color:red"><?php echo $hospErr;?> </span></td>
                </tr>
                <tr>
                    <td class="vert_align"><br>Choose your speciality:</td>
                    <td><br>
                        <input type = "radio" name = "spe" value = "cardiologist"> Cardiologist<br>
                        <input type = "radio" name = "spe" value = "neuroligist"> Neuroligist<br>
                        <input type = "radio" name = "spe" value = "physician"> Physician<span style = "color:red"><?php echo $specialityErr;?> </span><br>
                        <input type = "radio" name = "spe" value = "dentist"> Dentist<br>
                        <input type = "radio" name = "spe" value = "psychaitrist"> Dsychaitrist<br>
                        <input type = "radio" name = "spe" value = "orthopedic"> Orthopedic
                    </td>
                </tr>
                <tr>
                    <td><br>Cost</td>
                     <td><input type = "number" min ="0" max = "9999"  name = "cost" value = "<?php echo $cost ?>"><span style = "color:red"><?php echo $costErr;?> </span></td>
                </tr>
                <tr>
                    <td class="vert_align"><br>Select your City</td>
                    <td><br>
                        <input type = "radio" name = "city" value = "delhi"> Delhi<br>
                        <input type = "radio" name = "city" value = "mumbai"> Mumbai<span style = "color:red"><?php echo $cityErr;?> </span><br>
                        <input type = "radio" name = "city" value = "chennai"> Chennai<br>
                        <input type = "radio" name = "city" value = "kolkata"> Kolkata<br>
                    </td>
                </tr>
                <tr>
                    <td><br>Mobile</td>
                    <td><input type = "number" min ="0" name = "mobile" value = "<?php echo $mobile ?>"><span style = "color:red"><?php echo $mobileErr;?> </span></td>
                </tr>
               <tr>    
                    <td><br><input type = "submit" class="button" value = "Get Listed" name = "action"></td>
                    <td><em>Note:By clicking this button, you agree that the information provided is true and legal.</em></td>
                </tr>
            </table>
         </form>
        <br>
        </div>
</body>
</html>

