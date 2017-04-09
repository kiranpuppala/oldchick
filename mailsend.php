<?php

require_once('starsess.php');
require_once('allvars.php');
require_once('email/class.phpmailer.php');

  include("email/class.smtp.php");

$randnum=$_POST['no'];
$toemail=$_POST['em'];
$check="";

$mail = new PHPMailer();
 $mail->IsSMTP(); 
  $mail->SMTPDebug  = 0;

  $mail->SMTPAuth   = true;  


$mail->SMTPSecure = "ssl";  
  $mail->Host       = "smtp.gmail.com"; 

$mail->Port       = 465;
$mail->Username   = "oldchickworld@gmail.com"; 
$mail->Password   = "flyingtree"; 


$mail->SetFrom('oldchickworld@gmail.com', 'Old Chick'); 
 $mail->Subject    = "Confirmation";






$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME) or die('error connecting');

$query="SELECT emailaddr FROM candidates WHERE emailaddr='$toemail'";


$result=mysqli_query($dbc,$query) or die ('error querying 1');

if(mysqli_num_rows($result)==1){
$check='y';
echo 'y';
}

else{
$check='n';
echo 'n';

$mail->Body = "Your Old Chick confirmation code is $randnum";
  $mail->AddAddress($toemail);


  $mail->Send();

}


?>