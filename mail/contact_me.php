<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = 'service@itservzweb.appspotmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
// $headers = "From: noreply@itservz.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $headers .= "Reply-To: $email_address";
$headers = "From: Persone<" . strip_tags("noreply@itservz.com") . "> \r\n";
$headers .= "Reply-To: ". $email_address . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//mail($to,$email_subject,$email_body,$headers);
return true;


use google\appengine\api\mail\Message;
try {
    $message = new Message();
    $message->setSender($email_address);
    $message->addTo($to);
    $message->setSubject($email_subject);
    $message->setTextBody($email_body);
    //$message->headers($headers)
    $message->send();
    echo 'Your message has been sent.'
} catch (InvalidArgumentException $e) {
    echo 'There was an error';
}
?>
