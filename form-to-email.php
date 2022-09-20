<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$cname = $_POST['cname'];
$cemail = $_POST['cemail'];
$message = $_POST['message'];
$cell = $_POST['cell'];

//Validate first
if(empty($fname)||empty($cemail)||empty($lname ))
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($cemail))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'info@q-line.us';//<== update the email address
$email_subject = "New Form submission";
$email_body = "You have received a new message from the website Q-LINE.US \n\n\n
First Name: $fname \n
Last Name:  $lname \n
Company Name: $cname \n
Email:      $cemail \n
Message:    $message \n
Cellphone:  $cell \n\n\n  ".
//Email: $cemail \n
//Here is the message:\n
//$message \n.
//Here is file:\n
//$ephoto \n



$to = "info@qlinelogisticinc.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $cemail \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: index.html');


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
