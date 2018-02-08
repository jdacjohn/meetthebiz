<?php
require_once('recaptchalib.php');
$privatekey = "6Lfzst4SAAAAAOE4NV0bkYzZNUm6MtJB0ue6ito1";
$resp = recaptcha_check_answer ($privatekey,
$_SERVER["REMOTE_ADDR"],
$_POST["recaptcha_challenge_field"],
$_POST["recaptcha_response_field"]);
if (!$resp->is_valid) {
die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
"(reCAPTCHA said: " . $resp->error . ")");
}

$to = $_REQUEST['sendto'] ;
$from = $_REQUEST['email'] ;
$name = $_REQUEST['name'] ;
$headers = "From: $from";
$subject = "Email From Meet The Biz Website";

$fields = array();
$fields{"name"} = "name";
$fields{"email"} = "email";
$fields{"message"} = "message";


$body = "Someone sent you an email from the Meet The Biz website. Check it out.:\n\n"; foreach($fields as $a => $b){ $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }

$headers2 = "From: info@meetthebiz.net";
$subject2 = "Thank you for e-mailing Meet The Biz!";
$autoreply = "Thank you for your e-mail to Meet The Biz.
We will get back to you as soon as possible.
";

if($from == '') {print "You have not entered an email, please go back and try again";}
else {
if($name == '') {print "You have not entered a name, please go back and try again";}
else {
$send = mail($to, $subject, $body, $headers);
$send2 = mail($from, $subject2, $autoreply, $headers2);
if($send)
{header( "Location: http://www.meetthebiz.biz/contact_thankyou.php" );}
else
{print "We encountered an error sending your mail, please notify info@goddessdesignonline.com"; }
}
}
