<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bo Lau Fan Club Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="test.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="mystyle.css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php
	session_start();
	$servername = "localhost";
	$dbname = "project";
	$username = "root";
	$password = "";
// define variables and set to empty values
$nameerror = $passerror = $repeatpasserror = $firstnameerror = $lastnameerror = $address1error = $address2error = $cityerror = $stateerror = $zipcodeerror = $emailerror = $gendererror = $maritalstatuserror = $dateerror = $phoneerror = "";
$uname = $pword = $repeatpassword = $firstname = $lastname = $address1 = $address2 = $city = $state = $zipcode = $email = $gender = $maritalstatus = $date = $phone = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {			//If the form successfully submits then start php form checking
    if (empty($_POST["username"])) {				//Validation for the username
		$nameerror = "Name is required";
  } else {
	  $uname = test_input($_POST["username"]);
	  if (strlen($uname) < 6)
		$nameerror = "Minimum name length is 6";
	  if (strlen($uname) > 50)
		$nameerror = "Maximum name length is 50";
	  }
  
	
	if (empty($_POST["password"]))					//password must contain one number, one lowercase letter, one uppercase letter, and a special symbol
		$passerror = "Password required";
	else
	{
		$pword = test_input($_POST["password"]);
		if (strlen($pword) < 8)
			$passerror = "Minimum password length is 8";
		if (strlen($pword) > 50)
			$passerror = "Maximum password length is 50";
		$uppercase = preg_match("/[A-Z]/", $pword);
		$lowercase = preg_match("/[a-z]/", $pword);
		$number = preg_match("/[0-9]/", $pword);
		$specialchar = preg_match("/\W/", $pword);
		if (!$uppercase)
			$passerror = "Password must contain a capital letter";
		if (!$lowercase)
			$passerror = "Password must contain a lowercase letter";
		if (!$number)
			$passerror = "Password must contain a number";
		if (!$specialchar)
			$passerror = "Password must contain a special character";
	}
	
	if (empty($_POST["repeatpassword"]))
		$repeatpasserror = "Password required";
	else
	{
		$repeatpassword = test_input($_POST["repeatpassword"]);
		if (strlen($repeatpassword) < 8)
			$repeatpasserror = "Minimum password length is 8";
		if (strlen($repeatpassword) > 50)
			$repeatpasserror = "Maximum password length is 50";
		$uppercase = preg_match("/[A-Z]/", $repeatpassword);
		$lowercase = preg_match("/[a-z]/", $repeatpassword);
		$number = preg_match("/[0-9]/", $repeatpassword);
		$specialchar = preg_match("/\W/", $repeatpassword);
		$passmatch = strcmp($pword, $repeatpassword);					//Password and repeat password must match
		if (!$uppercase)
			$repeatpasserror = "Password must contain a capital letter";
		if (!$lowercase)
			$repeatpasserror = "Password must contain a lowercase letter";
		if (!$number)
			$repeatpasserror = "Password must contain a number";
		if (!$specialchar)
			$repeatpasserror = "Password must contain a special character";
		if ($pword != $repeatpassword)
			$repeatpasserror = "Passwords dont match";
	}
	
	if (empty($_POST["firstname"]))											//first name, max 50 chars
		$firstnameerror = "First name required";
	else
	{
		$firstname = test_input($_POST["firstname"]);
		if (strlen($firstname) > 50)
			$firstnameerror = "Maximum first name length is 50";
	}
	
	if (empty($_POST["lastname"]))											//last name, same as the first
		$lastnameerror = "Last name required";
	else
	{
		$lastname = test_input($_POST["lastname"]);
		if (strlen($lastname) > 50)
			$lastnameerror = "Maximum last name length is 50";
	}
	
	if (empty($_POST["address1"]))											//address 1 has a max of 100 characters
		$address1error = "Address required";
	else
	{
		$address1 = test_input($_POST["address1"]);
		if (strlen($address1) > 100)
			$address1error = "Maximum address length is 100";
	}
	
	if (!empty($_POST["address2"]))											//this one is optional, at the end of the php it checks for errors, it doesnt check this one because he is optional
	{
		$address1 = test_input($_POST["address2"]);
		if (strlen($address2) > 100)
			$address2error = "Maximum address length is 100";
	}
	
	if (empty($_POST["city"]))												//php city validation, population 50 characters
		$cityerror = "City name required";
	else
	{
		$city = test_input($_POST["city"]);
		if (strlen($city) > 50)
			$cityerror = "Maximum city name length is 50";
	}
	
	if (empty($_POST["state"]))												//state validation, Rhode island makes the max 52
		$stateerror = "State name required";
	else
	{
		$state = test_input($_POST["state"]);
		if (strlen($state) > 52)
			$stateerror = "Maximum State name length is 52";
	}
	
	if (empty($_POST["zipcode"]))											//zip code validation, used a regular expression to check if its valid, it works if you use 5 digits or if you do the full 9 with a dash in the middle
		$zipcodeerror = "Zip code required";
	else
	{
		$zipcode = test_input($_POST["zipcode"]);
		$zipformat = preg_match("/(^\d{5}$)|(^\d{5}-\d{4}$)/", $zipcode);
		if (!$zipformat)
			$zipcodeerror = "Zipcode must be in XXXXX-XXXX format";
		if (strlen($zipcode) > 10)
			$zipcodeerror = "Maximum zip code length is 10";
		if (strlen($zipcode) < 5)
			$zipcodeerror = "Minumum zip code length is 5";
	}
	
	if (empty($_POST["phonenumber"]))										//phone number validation, the regular expression says it must have 3 digits, then a dash, then 3 digits, then 4 digits
		$phoneerror = "Phone number required";
	else
	{
		$phone = test_input($_POST["phonenumber"]);
		$phoneformat = preg_match("/(^\d{3}-\d{3}-\d{4}$)/", $phone);
		if (!$phoneformat)
			$phoneerror = "Phone number must be in XXX-XXX-XXXX format";
		if (strlen($phone) > 12)
			$phoneerror = "Maximum phone number length is 12";
	}
	
	if (empty($_POST["email"]))												//email validation
		$emailerror = "Email required";
	else
	{
		$email = test_input($_POST["email"]);
		$emailformat = preg_match("/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/", $email);
		if (!$emailformat)
			$emailerror = "Not a valid email";
		if (strlen($email) > 255)
			$emailerror = "Maximum email length is 255";
	}
	
	if (empty($_POST["gender"]))											//gender validation, just in case your a hacker and hack in a third gender
		$gendererror = "Gender is required";
	else
	{
		$gender = test_input($_POST["gender"]);
		if (strlen($gender) > 50)
			$gendererror = "Maximum gender length is 50";
	}
	
	if (empty($_POST["maritalstatus"]))										//marital status, its complicated
		$maritalstatuserror = "Marital status is required";
	else
	{
		$maritalstatus = test_input($_POST["maritalstatus"]);
		if (strlen($maritalstatus) > 50)									//or actually it was pretty easy
			$maritalstatuserror = "Maximum marital status length is 50";
	}
	
	if (empty($_POST["date"]))												//date validation
		$dateerror = "Date is required";
	else
	{
		$date = test_input($_POST["date"]);
		$dateformat = explode('/', $date);
		if (!checkdate($dateformat[0], $dateformat[1], $dateformat[2]))		//check date is a nifty function that take 3 numbers a month, a day, and a year and tells you if its a real date. Makes leap years easier.
			$dateerror = "Date must be in MM/DD/YYYY format";
		else
			$date = $dateformat[2]."-".$dateformat[0]."-".$dateformat[1];
	}
	
	if ($nameerror == "" && $passerror == "" && $repeatpasserror == "" && $firstnameerror == "" && $lastnameerror == "" && $address1error == "" && $cityerror == "" && $stateerror == "" && $zipcodeerror == "" && $emailerror == "" && $gendererror == "" && $maritalstatuserror == "" && $dateerror == "" && $phoneerror == "")
	{
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = $conn->prepare("INSERT INTO registration (userName, password, firstName, lastName,
			address1, address2, city, state, zipCode, phone, email, gender, maritalStatus, dateOfBirth)
			VALUES (:username, :password, :firstname, :lastname, :address1,
			:address2, :city, :state, :zipcode, :phone, :email,
			:gender, :maritalstatus, :date)");
			$sql->bindParam(':username', $uname);
			$sql->bindParam(':password', $pword);
			$sql->bindParam(':firstname', $firstname);
			$sql->bindParam(':lastname', $lastname);
			$sql->bindParam(':address1', $address1);
			$sql->bindParam(':address2', $address2);
			$sql->bindParam(':city', $city);
			$sql->bindParam(':state', $state);
			$sql->bindParam(':zipcode', $zipcode);
			$sql->bindParam(':phone', $phone);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':gender', $gender);
			$sql->bindParam(':maritalstatus', $maritalstatus);
			$sql->bindParam(':date', $date);
			
			
			$sql->execute();

			
			$last_id = $conn->lastInsertId();
			$_SESSION["last_id"] = "$last_id";
			
			header('Location: confirmation.php');								//if none of the validations returned an error than they will all be at their initialization value. If thats the case for all of them you get redirected to the confirmation page. Congrats!
			exit();
		}
		catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	}
	
}

function test_input($data) {												//checking your data to make sure there is no funny business going on
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
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
			  Fan Club Registration <br> <br>
	
			  Welcome to the Bo Lau Fan Club! <br> <br>
	
			  Sign up to get the Bo Lau newsletter to keep updated on Bo's latest cardboard inventions. <br><br>
	  </p>
      <hr>
	  <div class="row">
		<p><span class="error">* required field</span></p>
		<form name="registration" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return formValidation()">
		<div class="col-sm-12 col-md-6 col-md-6 col-lg-6">
		<p>
			 <label for="username">User Name:</label> <br>
			  <input type="text" name="username" id="username" placeholder="BoLover123" maxlength="50"/>
			  <span class="error">* <?php echo $nameerror;?></span> <br>
			  <label for="password">Password:</label> <br>
			  <input type="text" name="password" id="password" placeholder="123Password!" maxlength="50"/>
			  <span class="error">* <?php echo $passerror;?></span><br>
			  <label for="repeatpassword">Repeat Password:</label> <br>
			  <input type="text" name="repeatpassword" id="repeatpassword" placeholder="123Password!" maxlength="50"/>
			  <span class="error">* <?php echo $repeatpasserror;?></span><br>
			  <label for="firstname">First Name:</label><br>
			  <input type="text" name="firstname" id="firstname" placeholder="Bo" maxlength="50"/>
			  <span class="error">* <?php echo $firstnameerror;?></span><br>
			  <label for="lastname">Last Name:</label><br>
			  <input type="text" name="lastname" id="lastname" placeholder="Lau" maxlength="50"/>
			  <span class="error">* <?php echo $lastnameerror;?></span><br>
			  <label for="address1">Address Line 1:</label>	<br>
			  <input type="text" name="address1" id="address1" placeholder="742 Evergreen Terrace" maxlength="100"/>
			  <span class="error">* <?php echo $address1error;?></span><br>
			  <label for="address2">Address Line 2:</label>	<br>
			  <input type="text" name="address2" id="address2" placeholder="(optional)" maxlength="100"/>
			  <span class="error"> <?php echo $address2error;?></span><br>
			  <label for="city">City:</label>	<br>
			  <input type="text" name="city" id="city" placeholder="Springfield" maxlength="50"/>
			  <span class="error">* <?php echo $cityerror;?></span><br>
			  <label for="state">State:</label> <span class="error">* <?php echo $stateerror;?></span>	<br>
			  <select id="state" name="state">	
				<option value="Alabama">Alabama</option>
				<option value="Alaska">Alaska</option>
				<option value="Arizona">Arizona</option>
				<option value="Arkansas">Arkansas</option>
				<option value="California">California</option>
				<option value="Colorado">Colorado</option>
				<option value="Connecticut">Connecticut</option>
				<option value="Delaware">Delaware</option>
				<option value="DC">District Of Columbia</option>
				<option value="Florida">Florida</option>
				<option value="Georgia">Georgia</option>
				<option value="Hawaii">Hawaii</option>
				<option value="Idaho">Idaho</option>
				<option value="Illinois">Illinois</option>
				<option value="Indiana">Indiana</option>
				<option value="Iowa">Iowa</option>
				<option value="Kansas">Kansas</option>
				<option value="Commonwealth of Kentucky">Commonwealth of Kentucky</option>
				<option value="Louisiana">Louisiana</option>
				<option value="Maine">Maine</option>
				<option value="Maryland">Maryland</option>
				<option value="Commonwealth of Massachusetts">Commonwealth of Massachusetts</option>
				<option value="Michigan">Michigan</option>
				<option value="Minnesota">Minnesota</option>
				<option value="Mississippi">Mississippi</option>
				<option value="Missouri">Missouri</option>
				<option value="Montana">Montana</option>
				<option value="Nebraska">Nebraska</option>
				<option value="Nevada">Nevada</option>
				<option value="New Hampshire">New Hampshire</option>
				<option value="New Jersey">New Jersey</option>
				<option value="New Mexico">New Mexico</option>
				<option value="New York">New York</option>
				<option value="North Carolina">North Carolina</option>
				<option value="North Dakota">North Dakota</option>
				<option value="Ohio">Ohio</option>
				<option value="Oklahoma">Oklahoma</option>
				<option value="Oregon">Oregon</option>
				<option value="Commonwealth of Pennsylvania">Commonwealth of Pennsylvania</option>
				<option value="State of Rhode Island and Providence Plantations">State of Rhode Island and Providence Plantations</option>
				<option value="South Carolina">South Carolina</option>
				<option value="South Dakota">South Dakota</option>
				<option value="Tennessee">Tennessee</option>
				<option value="Texas">Texas</option>
				<option value="Utah">Utah</option>
				<option value="Vermont">Vermont</option>
				<option value="Commonwealth of Virginia">Commonwealth of Virginia</option>
				<option value="State of Washington">State of Washington</option>
				<option value="West Virginia">West Virginia</option>
				<option value="Wisconsin">Wisconsin</option>
				<option value="Wyoming">Wyoming</option>
			  </select>
			  
			</p>
		</div>
		<div class="col-sm-12 col-md-6 col-md-6 col-lg-6">
		<p>
			<label for="zipcode">Zip Code:</label>
				<input type="text" name="zipcode" id="zipcode" placeholder="XXXXX-XXXX" maxlength="10"/>
				<span class="error">* <?php echo $zipcodeerror;?></span><br>
			  <label for="E-mail">E-mail:</label>
				<input type="text" name="email" id="email" placeholder="example@gmail.com" maxlength="255"/>
				<span class="error">* <?php echo $emailerror;?></span><br>
			  Gender: <span class="error">* <?php echo $gendererror;?></span> <br>
			  <label for="male">Male</label> 
			  <input type="radio" name="gender" id="male" value="male" checked/><br>
			  <label for="female">Female</label> 
			  <input type="radio" name="gender" id="female" value="female"/><br>
			  
			  Marital Status: <span class="error">* <?php echo $maritalstatuserror;?></span> <br>
			  <label for="single">Single</label> 
			  <input type="radio" name="maritalstatus" id="single" value="single" checked/><br>
			  <label for="married">Married</label> 
			  <input type="radio" name="maritalstatus" id="married" value="married"/> <br>
			  Date of Birth: <input type="text" id="datepicker" name="date">
			  <span class="error">* <?php echo $dateerror;?></span><br>
			  <label for="phonenumber">Phone Number: </label>
			  <input type="text" name="phonenumber" id="phonenumber" placeholder="xxx-xxx-xxxx" maxlength="12"/> <span class="error">* <?php echo $phoneerror;?></span> <br>
			   <input type="submit" class="button" name="submit" value="Submit" onClick="formValidation(this)"/>
			  <button type="reset" class="button" value="Reset">Reset</button><br>
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
