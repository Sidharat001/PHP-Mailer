<?php
require('smtp/PHPMailerAutoload.php');
	if(isset($_POST['submit'])){
	    if(isset($_POST['name']) && !empty($_POST['email']) && isset($_POST['number']) && !empty($_POST['last_name'])){
		    $name = $_POST['name'];
    		$last_name = $_POST['last_name'];
    		$email = $_POST['email'];
    		$number = $_POST['number'];
    		$message = $_POST['message'];
    		date_default_timezone_set("Canada/Eastern");
    		$datetime = date('Y-m-d H:i:s');
    		$sender_ip=$_SERVER["REMOTE_ADDR"];
    		$subject="New Lead : $name $last_name";
    		$headers='From: Toronto Assignments <noreply@exmplegmail.com>' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n" . 'MIME-Version: 1.0' . "\r\n";
    		$to="testing@gmail.com";
    		$message_body="Hi, <br/><br/>
    
    		You received an enquiry from your website .Detail are given below:<br/><br/>
    		<b>First Name:</b> $name<br/><br/>
    		<b>Last Name:</b> $last_name<br/><br/>
    		<b>Email:</b> $email<br/><br/>
    		<b>Phone:</b> $number<br/><br/>
    		<b>Message:</b> $message<br/><br/>
    		<b>Project:</b> Assignment Lead <br/><br/>
    		<b>Page URL:</b>https://exmple.com<br/><br/>
    		<b>Sender IP:</b> $sender_ip<br/><br/>";

			if(isset($message_body)){
			    echo $message_body;
				echo smtp_mailer($email ,$subject,$message_body);
				
			}
	    }   
	}elseif(isset($_POST['save'])){
	   // echo 'working';
	   // die;
        $name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $project = $_POST['project'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $subject = "You Have Received A New Enquiry For project By " . $email;
        // $message = $_POST['message'];
        $message_body="Hi, <br/><br/>
    		You received an enquiry from your website .Detail are given below:<br/><br/>
    		<b>First Name:</b> $name<br/><br/>
    		<b>Last Name:</b> $last_name <br/><br/>
    		<b>Email:</b> $email <br/><br/>
    		<b>Phone:</b> $phone <br/><br/>
    		<b>Project:</b> $project<br/><br/>
    		<b>Page URL:</b>https://exmple.com<br/><br/>";
    // 		<b>Sender IP:</b> $sender_ip<br/><br/>
    // 		<b>Message:</b> $message<br/><br/>
    		

        if($message_body){
            // echo '<pre>';
            // print_r($message_body);
            // echo '</pre>';
            // die;
            echo smtp_mailer($email ,$subject,$message_body);
        }
	}
	else{
		header('Location: /error');
		exit();
	}

function smtp_mailer($email,$subject, $message_body){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug=1;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.hostinger.com";
	$mail->Port = "587"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "Self_mail";
	$mail->Password = 'Password';

	

	
	$mail->setFrom("Self_mail" , "Indeed");
	$mail->Subject = $subject;
	$mail->Body = $message_body;
    $mail->addAddress('alter@gmail.com');
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		header('location: www.google.com');
		exit();
	}
}
?>