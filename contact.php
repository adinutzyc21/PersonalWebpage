<?php
$field_name = $_POST['name'];
$field_email = $_POST['email'];
$field_message = $_POST['message'];
$field_hidden = $_POST['test_field'];

if(strlen($field_hidden)>0){
		header( "refresh:0;url=index.html" );	
}

else{
	if(empty($field_name)){
		$field_name=$field_email;
	}

	$mail_to = 'adina.stoica@gmail.com';
	$subject = 'Adina\'s page - message from '.$field_name;

	$body_message = 'From: '.$field_name."\n";
	$body_message .= 'E-mail: '.$field_email."\n";
	$body_message .= 'Message: '.$field_message;

	$headers = 'From: '.$field_email."\r\n";
	$headers .= 'Reply-To: '.$field_email."\r\n";

	if(!filter_var($field_email, FILTER_VALIDATE_EMAIL)) {
			echo '<div id="form-submit-alert">The email you entered is incorrect!<br> Please fill the form correctly and try again.<br>Redirecting to the Contact page...</div>'; 
			header( "refresh:2;url=contact.html" );
	}
	else if(strlen($field_message)<=21) {
			echo '<div id="form-submit-alert">The message you entered is too short (less than 20 characters)!<br> Please fill the form correctly and try again.<br>Redirecting to the Contact page...</div>'; 
			header( "refresh:2;url=contact.html" );
	}
	else {
		$mail_status = mail($mail_to, $subject, $body_message, $headers);

		if ($mail_status) { 
			echo '<div id="form-submit-alert">Thank you for the message. I will contact you shortly.</div>'; 
			header( "refresh:2;url=index.html" );
		}
		else { 
			echo '<div id="form-submit-alert">Message failed. Please send an email or contact me through LinkedIn.<br>Redirecting to the Contact page...</div>'; 
			header( "refresh:4;url=contact.html" );
		}
	}
}