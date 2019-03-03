<?php
$cityErr = $costErr = "";
$errcheck =1;
$s1 =  $s2 = $s3 = $s4 = $s5 =$s6 = "temp";
$sort = "";
$hospitals = "";
$ctm = "";
function test_input($data) {
  $data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST["action"]))
{	
	if(!empty($_POST["csort"]) && !empty($_POST["esort"]))
	{
		$ctype = $_POST["csort"];
		$etype = $_POST["esort"];
		$sort = " , cost $ctype , experience $etype";
	}
	else if (!empty($_POST["csort"]))
	{
		$ctype = $_POST["csort"];
		$sort = " , cost $ctype ";
	
	}
	else if (!empty($_POST["esort"]))
	{
		$etype = $_POST["esort"];
		$sort = " , experience $etype ";
	
	}
	if(!empty(test_input($_POST["hospitals"])))
	{	
		$hspname = test_input($_POST["hospitals"]) ;
		$hospitals = "and hospital = '$hspname'" ;
	}
	
	if(!empty(test_input($_POST["min"])) && !empty(test_input($_POST["max"])))
	{
		if((int)$_POST["min"] > (int)$_POST["max"])
		{
			$costErr = "min should be less than max";
			$errcheck =0;
		}
		else 
		{
			$min = (int) $_POST["min"] ;
			$max = (int) $_POST["max"] ;
			$ctm = " and cost >". $min." and cost <".$max;
		}
	}
	else if (!empty(test_input($_POST["min"])))
	{
		$min = (int) $_POST["min"] ;
		$ctm = " and cost >".$min ;
	}
	else if (!empty(test_input($_POST["max"])))
	{
		$max = (int) $_POST["max"] ;
		$ctm = " and cost < ".$max ;
	}
	if(!empty($_POST["spe1"]))
		$s1 = $_POST["spe1"];
	if(!empty($_POST["spe2"]))
		$s2 = $_POST["spe2"];
	if(!empty($_POST["spe3"]))
		$s3 = $_POST["spe3"];
	if(!empty($_POST["spe4"]))
		$s4 = $_POST["spe4"];	
	if(!empty($_POST["spe5"]))
		$s5 = $_POST["spe5"];
	if(!empty($_POST["spe6"]))
		$s6 = $_POST["spe6"];	
	if(empty($_POST["city"])){
		$cityErr = "please select a city";
		$errcheck =0;
		}
	if($errcheck){
			$op = "";
			$bt = "<a href = 'book.php'><input type = 'button' class='sana' value =  'Book Appointment' ></a>";
			$city = $_POST["city"];
			$servername = "localhost";
    		$username = "root";
			$password = "iiits@123";
			$dbname = "itproject";   
			try
		{
			$conn = new mysqli($servername, $username, $password, $dbname);
			$sql = "SELECT * FROM doctors WHERE city = '$city' and speciality in ('$s1','$s2','$s3','$s4','$s5','$s6')".$hospitals. $ctm." 
			order by speciality asc".$sort;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$op = "<input type='text' style = 'width:400px' id='myInput' onkeyup='myFunction()' placeholder='Search for names'>
				<table width = '700' id = 'out' style= 'margin-left:40px' > ";
				$op.= "<tr style = ''> <th width = 40%  style = 'padding-left:40px'>"."Name"."</th> <th width = 40%>"."Qualification"." </th> <th>"."Experience"."<br> </th></tr></tr><tr><td colspan = 3><br></td></tr>
					<tr style = 'padding-left:40px'><th style = 'padding-left:40px'>"."City"."</th><th>"."Hospital"."</th><th>"."Speciality". "</th></tr></tr><tr><td colspan = 3><br></td></tr><tr><th style = 'padding-left:40px'>"."Fee".
					"</th><th>"."Mobile"."</th><th>"."Appointment"."</th></tr><tr><td colspan = 3><br><hr></th></tr>";
				while($row = mysqli_fetch_array($result))
				{
					$op .= " <tr> <td width = 40%  style = 'padding-left:40px'>".$row['name']."</td> <td width = 40%>".$row['qualification']." </td> <td>".$row['experience']." </td></tr><tr><td colspan = 3><br></td></tr>
					<tr style = 'padding-left:40px'><td style = 'padding-left:40px'>".$row['city']."</td><td>".$row['hospital']."</td><td>".$row['speciality']. "</td></tr><tr><td colspan = 3><br></td></tr><tr><td style = 'padding-left:40px'>".$row['cost'].
					"</td><td>".$row['mobile']."</td><td>".$bt."</td></tr><tr><td colspan = 3><br><hr></td></tr>";
				}
				$op .= "</table>";
			}
			else
				$op = "sorry no output.";
		}
		catch(Exception $e)
    	{
			   		echo  $e->getMessage();
    	}   	
	}
}

?>	

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hospito</title>
	<link rel="stylesheet" type="text/css" href="find1.css">
	<script src="jquery-3.2.1.js"></script>
	<script type="text/javascript" src="script1.js"></script>
	
	</head>
<body onload = "func()">
		<div>
			<div>
				<img id="logo"  class="spin" src="logo.png">
			</div>
			<center>
				<img src="name.png" height="120px">
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
		<div class="san">
		<section class="parallax">
			<div class="parallax-inner">
			</div>
		</section>
		
		<h1 id="h1_1">Find Doctors  </h1>
		
		<p class="heading_find"><big class="font" ><b><big>&emsp;Never wait in line, ever again.<br>&emsp;Get well.Online or at Clinic.</big><b></big>
		</p>
		
		<p>&emsp;<big>Here, you can find doctors near you based on your location. We are present only in selected cities... yet</big></p><br><br>
		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="find_padding">
		<img src="find.png" style = "height:400px; width:400px;padding-right:200px;padding-top:80px;" class="find_doc">
		<table>
			<tr >
				<td class="find_city font">City :</td> 
				<td><input type = "radio" name = "city" value = "delhi" selected> Delhi<br>
					<input type = "radio" name = "city" value = "mumbai"> Mumbai<br>
					<input type = "radio" name = "city" value = "Chennai"> Chennai<br>
					<input type = "radio" name = "city" value = "kolkata"> kolkata<br><br>
				</td>	
			</tr>		
			<tr>
				<td class="find_city font">Speciality :</td>
				<td>
					<input type = "checkbox" name = "spe1" value = "cardiologist" selected><i> cardiologist<br>
					<input type = "checkbox" name = "spe4" value = "dentist"> dentist<br>
					<input type = "checkbox" name = "spe2" value = "neuroligist"> neuroligist<br>
					<input type = "checkbox" name = "spe6" value = "orthopedic"> orthopedic<br>
					<input type = "checkbox" name = "spe3" value = "physician"> physician<br>
					<input type = "checkbox" name = "spe5" value = "psychiatrist"> psychiatrist <br><br>
				</td>
			</tr>

			<tr> 
				<td class="find_city font">Cost :</td>			
				<td><input type = "radio" name = "csort" value = "asc"> low to high<br>
					<input type = "radio" name = "csort" value = "desc"> high to low<br><br>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="font">Min Cost :<input type = "number" min = "0" name = "min" max = "9000" ></td><td style="padding:80px"></td>	
				<td colspan="2" class="font">Max Cost :<input type = "number" min = "50" max = "10000" name = "max"></td>
			</tr>	
			<tr>	
				<td class="find_city font">Experience :</td>
				<td><input type = "radio" name = "esort" value = "asc"> low to high<br>
					<input type = "radio" name = "esort" value = "desc"> high to low <br><br></td>
			</tr>	 
			<tr>	
				<td class="font">hospital :</td>
				<td><input list="hospitals" name = "hospitals">
		  		<datalist id="hospitals" name = "hospitals">
					<option value="apollo">
					<option value="aims">
					<option value="medipoint">
					<option value="ruby">
		  		</datalist></td>
		  	</tr>
		  	<tr>		
				<td colspan="2"><input type = "submit" name = "action" value = "Find Doctors" width="10px" class="button" <br> <br><br><br> </td>
			</tr>
		</table>		
	</form>
	<?php echo $op ?>
</div>
</body>
</html>
