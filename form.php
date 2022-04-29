<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$phone = $_POST['phone'];
$status = $_POST['status'];
$address = $_POST['address'];
$country = $_POST['country'];
$postal_code = $_POST['postal_code'];
$ballet_training = $_POST['ballet_training'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'admin@cloudsdanceschool.epizy.com';//<== update the email address
$email_subject = 'New Form submission';
$email_body = "You have received a new message from\nName: $name\n".
    "Email: $visitor_email\n".
    "Phone number: $phone\n".
    "Status: $status\n".
	"Address: $address\n".
	"Country: $country\n".
	"Postal Code: $postal_code\n".
	"Previous ballet training? $ballet_training\n";
    
$to = "cloudsvivien@gmail.com";//<== update the email address
$headers = "From: $email_from\r\n";
$headers .= "Reply-To: $visitor_email\r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. 
//done. redirect to thank you page.
header('Location: registration_thankyou.html');

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 