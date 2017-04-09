<HTML>
<HEAD>
</HEAD>
<BODY>
<CENTER>
<h2>APSSDC Email Code</h2><br>
<?php

  require_once('email/class.phpmailer.php');
  include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded		
		
  $mail = new PHPMailer();
  $mail->IsSMTP(); // telling the class to use SMTP
  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "YOUR GMAIL ID";  // GMAIL username
  $mail->Password   = "YOUR GMAIL PASSWORD ";            // GMAIL password

  $mail->SetFrom('YOUR EMAIL ID', 'APSSDC, SRKREC'); // Change the name as you want
  $mail->Subject    = "APSSDC Project Details";
  $mail->Body = "This is the test mail sent from code!\n~APSSDC Project Team";
  $mail->AddAddress("RECIEVER EMAIL ID");

  $mail->Send();

  echo "<br><br><font color='green' size='3'><b>Email has been Successfully Sent!</b></font></center>"; 	  

  ?>
</BODY>
</HTML>
