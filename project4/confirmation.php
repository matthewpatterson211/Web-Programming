<! DOCTYPE html>
<!-- Adding comments! -->
<html>
	<head>
		<title>Bo Lau's True Believers</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="mystyle.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

	<?php
	session_start();
	$servername = "localhost";
	$dbname = "project";
	$username = "root";
	$password = "";
	
	try {
		$last_id = $_SESSION["last_id"];
		//echo "<br/>ID: $last_id<br/>";
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT userName, password, firstName, lastName,
			address1, address2, city, state, zipCode, phone, email, gender, maritalStatus, dateOfBirth".
		" FROM registration WHERE id = '$last_id'");
		$stmt ->bindParam(':last_id', $last_id);
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		//var_dump($stmt->fetchAll()[0]);
		$assocArray = $stmt->fetchAll()[0];
		$name = $assocArray["userName"];
		$password = $assocArray["password"];
		$firstname = $assocArray["firstName"];
		$lastname = $assocArray["lastName"];
		$address1 = $assocArray["address1"];
		$address2 = $assocArray["address2"];
		$city = $assocArray["city"];
		$state = $assocArray["state"];
		$zipcode = $assocArray["zipCode"];
		$phone = $assocArray["phone"];
		$email = $assocArray["email"];
		$gender = $assocArray["gender"];
		$maritalstatus = $assocArray["maritalStatus"];
		$date = $assocArray["dateOfBirth"];
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	$conn = null;
	?>
	
<div class="header-image"> </div>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 sidenav">
      <ul>
				  <li><a href="bolau.html">Home</a></li>
				  <li><a href="registration.php">Registration</a></li>
				  <li><a href="animations.html">Animations</a></li>
	  </ul>
    </div>
    <div class="col-sm-10 text-left"> 
      <p><img src="IntenseBo.jpg" alt="IntenseBo"/><br>
			  Registration Complete! <br><br>
	  </p>
      <hr>
	  <div class="row">
		<p><span class="error">* required field</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return formValidation()">
		<div class="col-sm-12 col-md-6 col-md-6 col-lg-6">
		<p>
			 <label for="username">User Name:</label> <br>
			  <input disabled type="text" name="username" id="username" value="<?php echo $name; ?>" maxlength="50"/> <br>

			  <label for="password">Password:</label> <br>
			  <input disabled type="text" name="password" id="password" value="<?php echo $password; ?>" maxlength="50"/> <br>

			  <label for="repeatpassword">Repeat Password:</label> <br>
			  <input disabled type="text" name="repeatpassword" id="repeatpassword" value="<?php echo $password; ?>" maxlength="50"/> <br>
	
			  <label for="firstname">First Name:</label><br>
			  <input disabled type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" maxlength="50"/> <br>
	
			  <label for="lastname">Last Name:</label><br>
			  <input disabled type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" maxlength="50"/> <br>

			  <label for="address1">Address Line 1:</label>	<br>
			  <input disabled type="text" name="address1" id="address1" value="<?php echo $address1; ?>" maxlength="100"/> <br>
			
			  <label for="address2">Address Line 2:</label>	<br>
			  <input disabled type="text" name="address2" id="address2" value="<?php echo $address2; ?>" maxlength="100"/> <br>
		
			  <label for="city">City:</label>	<br>
			  <input disabled type="text" name="city" id="city" value="<?php echo $city; ?>" maxlength="50"/> <br>
			  
			  <label for="state">State:</label>	<br>
			  <input disabled type="text" id="state" name="state" value="<?php echo $state; ?>" maxlength="52"/> <br>	
				
			  
			</p>
		</div>
		<div class="col-sm-12 col-md-6 col-md-6 col-lg-6">
		<p>
			<label for="zipcode">Zip Code:</label>
				<input disabled type="text" name="zipcode" id="zipcode" value="<?php echo $zipcode; ?>" maxlength="10"/><br>
				
			  <label for="E-mail">E-mail:</label>
				<input disabled type="text" name="email" id="email" value="<?php echo $email; ?>" maxlength="255"/>
				<br>
			  Gender:  <br>
			  <label for="male">Male</label> 
			  <input disabled type="radio" name="gender" id="male" 
			  <?php if (isset($gender) && $gender=="male") echo "checked";?>
			  value="male"/><br>
			  
			  <label for="female">Female</label> 
			  <input disabled type="radio" name="gender" id="female"
			  <?php if (isset($gender) && $gender=="female") echo "checked";?>
			  value="female"/><br>
			  
			  Marital Status:  <br>
			  <label for="single">Single</label> 
			  <input disabled type="radio" name="maritalstatus" id="single" 
			  <?php if (isset($maritalstatus) && $maritalstatus=="single") echo "checked";?>
			  value="single"/><br>
			  
			  <label for="married">Married</label> 
			  <input disabled type="radio" name="maritalstatus" id="married"
			  <?php if (isset($maritalstatus) && $maritalstatus=="married") echo "checked";?>
			  value="married"/> <br>
			  Date of Birth: <input disabled type="text" id="datepicker" name="date" value="<?php echo $date; ?>">
			  <br>
			  <label for="phonenumber">Phone Number: </label>
			  <input disabled type="text" name="phonenumber" id="phonenumber" value="<?php echo $phone; ?>" maxlength="12"/> <br>
			   <button type="button" class="button" disabled>Submit</button>
			  <button type="reset" class="button" value="Reset" disabled>Reset</button><br>
			 </form>
		</p>
		</div>
		</div>
    </div>

    </div>
  </div>
</div>
		
		<footer class="container-fluid text-center">
  <div class="col-sm-4">
	  <li><a href="https://www.shopnsave.com/" target="_blank">Shop N Save</a></li>
	  <li><a href="https://www.allkpop.com/" target="_blank">Kpop</a></li>
	  <li><a href="http://www.crunchyroll.com/"	  target="_blank">Anime</a></li>
	</div>
	<div class="col-sm-4">
      <li><a href="https://www.reddit.com/" target="_blank">Reddit</a></li>
      <li><a href="https://www.Rathergood.com" target="_blank">Rathergood</a></li>
      <li><a href="https://www.olympic.org/" target="_blank">PyeongChang 2018</a></li>
    </div>
	<div class="col-sm-4">
      <li><a href="https://www.creepypasta.com/" target="_blank">Creepypasta</a></li>
      <li><a href="https://www.fiveacresanimalshelter.org/" target="_blank">Five Acres Animal Shelter</a></li>
      <li><a href="http://www.seoultaco.com/" target="_blank">Seoul Taco</a></li>
    </div>
</footer>
		
	</body>
</html>