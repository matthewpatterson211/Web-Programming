function formValidation()
{
var uid = document.registration.username;
var passid = document.registration.password;
var repeatpassid = document.registration.repeatpassword;
var firstname = document.registration.firstname;
var lastname = document.registration.lastname;
var add1 = document.registration.address1;
var add2 = document.registration.address2;
var city = document.registration.city; 
var state = document.registration.state;
var zip = document.registration.zipcode;
if(!userid_validation(uid))
{
	return false;
}
if(!passid_validation(passid))
{
	return false;
}
if(!repeat_passid_validation(passid,repeatpassid))
{
	return false;
}
if(!firstnamevalidation(firstname))
{
	return false;
}
if(!lastnamevalidation(lastname))
{
	return false;
}
if(!address1validation(add1))
{
	return false;
}
if(!address2validation(add2))
{
	return false;
}
if(!cityvalidation(city))
{
	return false;
}
if (!statevalidation(state))
{
	return false;
}
if (!zipvalidation(zip))
{
	return false;
}
if (!phonenumbervalidation(document.registration.phonenumber))
{
	return false;
}
if (!emailvalidation(document.registration.email))
{
	return false;
}
if (!gendervalidation(document.registration.gender))
{
	return false;
}
if (!maritalvalidation(document.registration.maritalstatus))
{
	return false;
}
if (!datevalidation(document.registration.datepicker))
{
	return false;
}

}
function userid_validation(uid)
{
var uid_len = uid.value.length;
if (uid_len > 50 || uid_len < 6)
{
alert("Username length must be between 6 to 50");
username.style.borderColor = "red";
uid.focus();
return false;
}
username.removeAttribute("style")
return true;
}
function passid_validation(passid)
{
var passid_len = passid.value.length;
var uppercase = /[A-Z]/;
var lowercase = /[a-z]/;
var numbers = /[0-9]/;
var specialchar = /\W/;
if (!numbers.test(passid.value))
{
	alert("Password must contain a number!");
	passid.style.borderColor = "red";
	passid.focus();
	return false;
}
if (!uppercase.test(passid.value))
{
	alert("Password must contain an capital letter!");
	passid.style.borderColor = "red";
	passid.focus();
	return false;
}
if (!lowercase.test(passid.value))
{
	alert("Password must contain a lowercase letter!");
	passid.style.borderColor = "red";
	passid.focus();
	return false;
}
if (!specialchar.test(passid.value))
{
	alert("Password must contain a special character!");
	passid.style.borderColor = "red";
	passid.focus();
	return false;
}
if (passid_len > 50 || passid_len < 8)
{
	alert("Password must be between 8 to 50 characters!");
	passid.style.borderColor = "red";
	passid.focus();
	return false;
}
	passid.removeAttribute("style")
	return true;
}

function repeat_passid_validation(pass, repeatpass)
{
	var passid_len = repeatpass.value.length;
	var uppercase = /[A-Z]/;
	var lowercase = /[a-z]/;
	var numbers = /[0-9]/;
	var specialchar = /\W/;
	if (!numbers.test(repeatpass.value))
	{
		alert("Repeat Password must contain a number!");
		repeatpass.style.borderColor = "red";
		repeatpass.focus();
		return false;
	}
	if (!uppercase.test(repeatpass.value))
	{
		alert(" Repeat Password must contain an capital letter!");
		repeatpass.style.borderColor = "red";
		repeatpass.focus();
		return false;
	}
	if (!lowercase.test(repeatpass.value))
	{
		alert("Repeat Password must contain a lowercase letter!");
		repeatpass.style.borderColor = "red";
		repeatpass.focus();
		return false;
	}
	if (!specialchar.test(repeatpass.value))
	{
		alert("Repeat Password must contain a special character!");
		repeatpass.style.borderColor = "red";
		repeatpass.focus();
		return false;
	}	
	if (passid_len > 50 || passid_len < 8)
	{
		alert("Repeat Password must be between 8 to 50 characters!");
		repeatpass.style.borderColor = "red";
		repeatpass.focus();
		return false;
	}
	if (pass.value != repeatpass.value)
	{
		alert("Passwords don't match!")
		repeatpass.style.borderColor = "red";
		repeatpass.focus();
		return false;
	}
	repeatpass.removeAttribute("style")
	return true;
	}

function firstnamevalidation(firstname)
{
	var firstnamelen = firstname.value.length;
	if(firstnamelen > 50)
	{
		alert ("First Name is greater than 50 characters!");
		firstname.style.borderColor = "red";
		firstname.focus();
		return false;
	}
	firstname.removeAttribute("style")
	return true;
}

function lastnamevalidation(lastname)
{
	var lastnamelen = lastname.value.length;
	if(lastnamelen > 50)
	{
		alert ("Last Name is greater than 50 characters!");
		lastname.style.borderColor = "red";
		lastname.focus();
		return false;
	}
	firstname.removeAttribute("style")
	return true;
}

function address1validation(add1)
{
	var add1len = add1.value.length;
	if(add1len > 100)
	{
		alert ("Address 1 must be less than 100 characters!");
		add1.style.borderColor = "red";
		add1.focus();
		return false;
	}
	add1.removeAttribute("style")
	return true;
}

function address2validation(add2)
{
	var add2len = add2.value.length;
	if(add2len > 100)
	{
		alert ("Address 2 must be less than 100 characters!");
		add2.style.borderColor = "red";
		add2.focus();
		return false;
	}
	add2.removeAttribute("style")
	return true;
}

function cityvalidation(city)
{
	var citylen = city.value.length;
	if(citylen > 50)
	{
		alert ("City must be less than 50 characters!");
		city.style.borderColor = "red";
		city.focus();
		return false;
	}
	city.removeAttribute("style")
	return true;
}

function statevalidation(state)
{
	var statelen = state.value.length;
	if(statelen > 52)
	{
		alert ("State must be less than 52 characters!");
		state.style.borderColor = "red";
		state.focus();
		return false;
	}
	state.removeAttribute("style")
	return true;
}

function zipvalidation(zip)
{
	var ziplen = zip.value.length;
	if (ziplen >10 | ziplen < 5)
	{
		alert ("Zipcode must be between 10 and 5 digits!");
		zip.style.borderColor = "red";
		zip.focus();
		return false;
	}
	var validatezip = /(^\d{5}$)|(^\d{5}-\d{4}$)/;
	if (!validatezip.test(zip.value))
	{
		alert ("Zipcode must be in XXXXX-XXXX format");
		zip.style.borderColor = "red";
		zip.focus();
		return false;
	}
	zip.removeAttribute("style")
	return true;
}

function phonenumbervalidation(phonenumber)
{
	if (phonenumber.value.length > 12)
	{
		alert ("Phone number must be less than or equal to 12 digits!");
		phonenumber.style.borderColor = "red";
		phonenumber.focus();
		return false;
	}
	var validatephonenumber = /(^\d{3}-\d{3}-\d{4}$)/;
	if (!validatephonenumber.test(phonenumber.value))
	{
		alert ("Phonenumber must be in XXX-XXX-XXXX format");
		phonenumber.style.borderColor = "red";
		phonenumber.focus();
		return false;
	}
	phonenumber.removeAttribute("style")
	return true;
}

function emailvalidation(email)
{
		if (email.value.length > 255)
		{
			alert ("E-mail max length is 255!");
			email.style.borderColor = "red";
			email.focus();
			return false;
		}
		var emailvalidate = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		if (!emailvalidate.test(email.value))
		{
			alert ("Not a valid email!");
			email.style.borderColor = "red";
			email.focus();
			return false;
		}
		email.removeAttribute("style")
		return true;
}

function gendervalidation(gender)
{
	if (gender.value.length > 50)
	{
		alert ("Gender max length is 50");
		gender.focus();
		return false;
	}
	return true;
}

function maritalvalidation(maritalstatus)
{
	if (maritalstatus.value.length > 50)
	{
		alert ("Marital status max length is 50");
		maritalstatus.focus();
		return false;
	}
	return true;
}

  $(document).ready(function () {
    $( "#datepicker" ).datepicker({
		inline: true,
      showOtherMonths: true,
      dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	});
  });
  
  function datevalidation(date)
  {
	  var datevalidator = /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/ ;
	  if(!(datevalidator.test(date.value)))
	  {
		  alert ("Date must be in MM/DD/YYYY format!");
		  date.style.borderColor = "red";
		  date.focus();
		  return false;
	  }
	  date.removeAttribute("style")
	  return true;
  }