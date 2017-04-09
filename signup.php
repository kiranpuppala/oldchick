<?php
require_once('allvars.php');
$already_exist=false;
$not_image=false;
if(isset($_POST['submit'])){
$output_form = false;
$already_exist=false;
$not_image=false;
$uname=$_POST['uname'];
$place=$_POST['place'];
$regdno=$_POST['regdno'];
$classname=$_POST['classname'];
$mobile=$_POST['mobile'];
$emailaddr=$_POST['emailaddr'];
$password=$_POST['password'];
$primage=$_FILES['primage']['name'];
$tmp=$_FILES['primage']['tmp_name'];
$target=IMAGE_PATH.$primage;
$filesize=$_FILES['primage']['size'];

if ((($_FILES["primage"]["type"] == "image/gif")
|| ($_FILES["primage"]["type"] == "image/jpeg")
|| ($_FILES["primage"]["type"] == "image/jpg")
|| ($_FILES["primage"]["type"] == "image/pjpeg")
|| ($_FILES["primage"]["type"] == "image/x-png")
|| ($_FILES["primage"]["type"] == "image/png"))){


if(move_uploaded_file($tmp,$target)){

if ($_FILES["primage"]["type"] == "image/jpeg"){
$exif = exif_read_data($target);
    if (!empty($exif['Orientation'])) {

        $image = imagecreatefromjpeg($target);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $target, 90);
    }
}


$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME)
or die('Error connecting to MySQL server.');

$query="SELECT emailaddr FROM candidates";
$result=mysqli_query($dbc,$query) or die('error 0');

while($row=mysqli_fetch_array($result)){
if($emailaddr==$row['emailaddr']){
$already_exist=true;
break;
}
}

if(!$already_exist){
$query1="INSERT INTO candidates (uname,place,regdno,mobile,classname,emailaddr,password,primage,regdate)".
"VALUES ('$uname','$place','$regdno','$mobile','$classname','$emailaddr',SHA('$password'),'$primage',NOW())";
$result1=mysqli_query($dbc,$query1)
or die('Error querying database.');
mysqli_close($dbc);

header("Location:signsuccess.html");
}
else { 
$output_form = true;
}

}
else { 
$output_form = true;

}

}///////////////if to check image file or any other file
else { 
$output_form = true;
$not_image=true;

}///////////////if to check image file or any other file

}
else{
$output_form= true;
}

if ($output_form) {
?>
<!DOCTYPE html>
<head>
<title>sign up</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="screen.css" type="text/css" media="screen"/>
</head>
<script>



</script>

<body>

<div class="empty_space"></div>

<div class="total col-5">
<div class="edit_prof">


<img  style="margin-top:10px" src="images/loginoldchick.png" alt="no image" width="100px" height="60px">
<hr>

<div id="all_form" >
<form id="formmy" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  onsubmit="return allcheck();" >

<input id="uname" placeholder="Name"  type="text" name="uname" value="<?php if(!empty($uname)) echo $uname; ?>"><br>
<p id="cuname"> </p><br>



<input id="place" type="text" placeholder="Your Location" name="place" value="<?php if(!empty($place)) echo $place; ?>"><br>
<p id="cplace"> </p><br>


<input id="regdno" placeholder="Regd no. Ex:- 313175712222" type="text" name="regdno" value="<?php if(!empty($regdno)) echo $regdno; ?>"><br>
<p id="cregdno"> </p><br>

<select id="classname" name="classname" class="category">
<option selected="selected"  value="<?php if(!empty($classname)) echo  $classname; ?>">
<?php if(!empty($classname)) echo  $classname; else echo "Class name"?></option>
<option   value="1/4 ECE I sem">1/4 ECE I sem</option>
<option  value="1/4 ECE II sem">1/4 ECE II sem</option>
<option value="2/4 ECE I sem">2/4 ECE I sem</option>
<option value="2/4 ECE II sem">2/4 ECE II sem</option>
<option value="3/4 ECE I sem">3/4 ECE I sem</option>
<option value="3/4 ECE II sem">3/4 ECE II sem</option>
<option value="4/4 ECE I sem">4/4 ECE I sem</option>
<option value="4/4 ECE II sem">4/4 ECE II sem</option>


<option   value="1/4 EEE I sem">1/4 EEE I sem</option>
<option  value="1/4 EEE II sem">1/4 EEE II sem</option>
<option value="2/4 EEE I sem">2/4 ECE I sem</option>
<option value="2/4 EEE II sem">2/4 EEE II sem</option>
<option value="3/4 EEE I sem">3/4 EEE I sem</option>
<option value="3/4 EEE II sem">3/4 EEE II sem</option>
<option value="4/4 EEE I sem">4/4 EEE I sem</option>
<option value="4/4 EEE II sem">4/4 EEE II sem</option>

<option   value="1/4 CSE I sem">1/4 CSE I sem</option>
<option  value="1/4 CSE II sem">1/4 CSE II sem</option>
<option value="2/4 CSE I sem">2/4 CSE I sem</option>
<option value="2/4 CSE II sem">2/4 CSE II sem</option>
<option value="3/4 CSE I sem">3/4 CSE I sem</option>
<option value="3/4 CSE II sem">3/4 CSE II sem</option>
<option value="4/4 CSE I sem">4/4 CSE I sem</option>
<option value="4/4 CSE II sem">4/4 CSE II sem</option>

<option   value="1/4 IT I sem">1/4 IT  I sem</option>
<option  value="1/4 IT  II sem">1/4 IT  II sem</option>
<option value="2/4 IT  I sem">2/4 IT  I sem</option>
<option value="2/4 IT  II sem">2/4 IT  II sem</option>
<option value="3/4 IT  I sem">3/4 IT  I sem</option>
<option value="3/4 IT  II sem">3/4 IT  II sem</option>
<option value="4/4 IT  I sem">4/4 IT  I sem</option>
<option value="4/4 IT  II sem">4/4 IT  II sem</option>

<option   value="1/4 Civil I sem">1/4 Civil I sem</option>
<option  value="1/4 Civil II sem">1/4 Civil II sem</option>
<option value="2/4 Civil I sem">2/4 Civil I sem</option>
<option value="2/4 Civil II sem">2/4 Civil II sem</option>
<option value="3/4 Civil I sem">3/4 Civil I sem</option>
<option value="3/4 Civil II sem">3/4 Civil II sem</option>
<option value="4/4 Civil I sem">4/4 Civil I sem</option>
<option value="4/4 Civil II sem">4/4 Civil II sem</option>

<option   value="1/4 Mech I sem">1/4 Mech I sem</option>
<option  value="1/4 Mech II sem">1/4 Mech II sem</option>
<option value="2/4 Mech I sem">2/4 Mech I sem</option>
<option value="2/4 Mech II sem">2/4 Mech II sem</option>
<option value="3/4 Mech I sem">3/4 Mech I sem</option>
<option value="3/4 Mech II sem">3/4 Mech II sem</option>
<option value="4/4 Mech I sem">4/4 Mech I sem</option>
<option value="4/4 Mech II sem">4/4 Mech II sem</option>


</select>

<p id="cclassname"> </p><br>

<input id="mobile" type="text" placeholder="Mobile number" name="mobile" value="<?php if(!empty($mobile)) echo $mobile; ?>"><br>
<p id="cmobile"> </p><br>


<input id="emailaddr"  type="text" placeholder="Email Address" name="emailaddr" value="<?php if(!empty($emailaddr)) echo $emailaddr; ?>"<br><div id="al"></div>
<p id="cemailaddr"> </p><br>
<p style="color:#ff0000"><?php if($already_exist) echo 'Email address already exist'; ?></p>

<input id="password" placeholder="Password"  type="password" name="password"><br>
<p id="cpassword"> </p><br>

<input id="conpassword" placeholder="Confirm Password" type="password" name="conpassword"><br>
<p id="cconpassword"> </p><br>

<label for="primage" style="opacity:.6" >Upload your image</label>
<input id="primage" name="primage" type="file" /><br/>

<p style="color:#f00"><?php if($not_image) echo 'select proper image format'; ?></p>

<p id="cprimage"> </p><br>

<a class="con_butt" id="con_butt" href="javascript:showhide('watch')">Confirm email</a>
</div>

<div id="watch" style="display:none">
<input id="ccode" placeholder="Confirmation code" type="text" name="ccode"><br>
<p id="cccode"> </p><br>
<p id="wrong_code" style="display:none">wrong confirmation code <a href="javascript:sendCode()">resend?</a></p>
</div>




<input id="dummy" type="text" style="display:none">
<input id="dummy_ret" type="text" style="display:none">

<div id="show_sub" style="display:none">
<input id="submit" type="submit" name="submit" value="signup">
</div>


</form>

<p style="opacity:.6;font-weight:bold">To go to login page click <a style="text-decoration:none;color:#16BE48" href="index.php">here</a></p>


<div class="footer">
<p> &nbsp&copy Old Chick, Platter Inc.   &nbsp2016-2017</p>
<ul>
<li><a href="#">about</a></li>
<li><a href="http://www.facebook.com/platterpeople">contact</a></li>
<li><a href="#">app</a>
</ul>
</div>



</div>
</div>
</body>
<script src="jquery.min.js">
</script>
<script>
 function showhide(id) {

if(validateForm()){
   
document.getElementById("con_butt").innerHTML='<img  id="loading"  src="images/bload.gif" width=20px height=20px >';
document.getElementById("con_butt").style.background="#fff";
var num=Math.floor(Math.random() *99999) + 10000;
var emaila=document.getElementById("emailaddr").value;
var dataa = 'no='+ num  + '&em='+ emaila;

$.ajax({url:'mailsend.php',type:'post',data: dataa, success: function(data){

if(data=='y'){
document.getElementById("all_form").style.display= 'block';
document.getElementById("cemailaddr").innerHTML="email address already exist";
document.getElementById("cemailaddr").style.color= 'red';
document.getElementById(id).style.display='none';

document.getElementById("con_butt").innerHTML="Confirm email";
document.getElementById("con_butt").style.background="#F26522";

}

if(data=='n'){

document.getElementById("all_form").style.display= 'none';
document.getElementById(id).style.display='block';

    document.getElementById("show_sub").style.display='block';

}



}});

document.getElementById("dummy").value=num;
}


 }


function sendCode(){

var w =document.getElementById("wrong_code");
w.style.display= 'none';
var num=Math.floor(Math.random() *99999) + 10000;
var emaila=document.getElementById("emailaddr").value;
var dataa = 'no='+ num  + '&em='+ emaila;

$.ajax({url:'mailsend.php',type:'post',data: dataa});

document.getElementById("dummy").value=num;


}


function confirmCheck(){

var usercode=document.getElementById("ccode").value;
var originalcode=document.getElementById("dummy").value;


if((usercode==originalcode)&&(originalcode!="")){

document.getElementById("watch").style.display= 'none';

document.getElementById("show_sub").style.display= 'block';
}
else{

document.getElementById("wrong_code").style.display='block';

}


}

function allcheck(){

var usercode=document.getElementById("ccode").value;
var originalcode=document.getElementById("dummy").value;


if((usercode==originalcode)&&(originalcode!="")){

document.getElementById("watch").style.display= 'none';

document.getElementById("show_sub").style.display= 'block';
document.getElementById("dummy_ret").value="";

return true;
}
else{

document.getElementById("wrong_code").style.display='block';

return false;
}

}

function validateForm() {

if(document.getElementById("uname").value.length<3){
document.getElementById("cuname").innerHTML="enter atleast 3 characters";
document.getElementById("cuname").style="color:#ff0000";
return false;
}
else if(document.getElementById("uname").value.length>20){
document.getElementById("cuname").innerHTML="not more than 15 characters";
document.getElementById("cuname").style="color:#ff0000";
return false;
}
else{
document.getElementById("cuname").innerHTML="";
}





if(document.getElementById("place").value.length<3){
document.getElementById("cplace").innerHTML="specify precise village name";
document.getElementById("cplace").style="color:#ff0000";
return false;
}
else{
document.getElementById("cplace").innerHTML="";
}


var regno=document.getElementById("regdno").value;

if(regno.length!=12||isNaN(regno)){
document.getElementById("cregdno").innerHTML="specify precise regd no";
document.getElementById("cregdno").style="color:#ff0000";
return false;
}
else{
document.getElementById("cregdno").innerHTML="";
}


if(document.getElementById("classname").value.length<3){
document.getElementById("cclassname").innerHTML="select your class";
document.getElementById("cclassname").style="color:#ff0000";
return false;
}
else{
document.getElementById("cclassname").innerHTML="";
}


var mobno=document.getElementById("mobile").value;

if(mobno.length!=10||isNaN(mobno)){
document.getElementById("cmobile").innerHTML="specify mobile no";
document.getElementById("cmobile").style="color:#ff0000";
return false;
}
else{
document.getElementById("cmobile").innerHTML="";
}




if(document.getElementById("emailaddr").value.length<10){
document.getElementById("cemailaddr").innerHTML="specify valid email";
document.getElementById("cemailaddr").style="color:#ff0000";
return false;
}
else{
document.getElementById("cemailaddr").innerHTML="";
}


var password=document.getElementById("password").value;

if(document.getElementById("password").value.length<8){
document.getElementById("cpassword").innerHTML="atleast be 8 characters";
document.getElementById("cpassword").style="color:#ff0000";
return false;
}
else{
document.getElementById("cpassword").innerHTML="";
}

var password=document.getElementById("password").value;
var conpassword=document.getElementById("conpassword").value;

if(!(password==conpassword)){
document.getElementById("cconpassword").innerHTML="passwords do not match";
document.getElementById("cconpassword").style="color:#ff0000";
return false;
}
else{
document.getElementById("cconpassword").innerHTML="";
}

if(document.getElementById("primage").value.length<1){
document.getElementById("cprimage").innerHTML="select profile picture";
document.getElementById("cprimage").style="color:#ff0000";
return false;
}
else{
document.getElementById("cprimage").innerHTML="";
return true;
}

}
</script>








<style>


body{
background:#DFE7F4;
font-family: Segoe UI Emoji,Century Gothic;

margin:0;
padding:0;
}


.con_butt{

text-decoration:none;
background:#F26522;
color:#fff;
border:0;
font-size:12px;
padding-top:8px;
padding-bottom:8px;
padding-left:20px;
padding-right:20px;
border-radius:2px;
font-weight:bold;
}

hr{
width:70%;
height:1px;
background:#000;
clear:both;
opacity:.1;
border:0px;
}

.total {
  margin-left: auto ;
  margin-right: auto ;
}

.edit_prof{
background:#fff;
margin-top:0px;

width:100%;
border-radius:2px;
text-align:center;
}

.edit_prof p{
line-height:180%;
}


.category{

width:60%;
border-style:ridge;
border-width:1px;
border-opacity:.1;
padding:10px;
}


.column5{
float:left;
background:#F26522;
height:120px;
opacity:.7;
}


img {
    max-width: 100%;
    height: auto;
}

input{
padding:12px 20px;
margin:8px 0;
box-sizing:border-box;
}

input[type="text"]{
width:60%;
color:#000;
border-style:ridge;
border-width:1px;
border-opacity:.5;
}

input[type="password"]{
width:60%;
color:#000;
border-style:ridge;
border-width:1px;
border-opacity:.5;
}

input[type="submit"]{
background-color:#F26522;
color:#fff;
border-radius:3px;
border:0px;
font-weight:bold;
padding:10px;
}

.footer{
background:#757575;
height:60px;
font-weight:bold;
}

.footer p{
color:#fff;
font-size:12px;
float:left;
}

.footer ul li{
display:inline;
padding-left:5px;
}
.footer ul{
margin-left:50%;
padding-top:10px;

}

.footer a{
text-decoration:none;
color:#fff;
font-size:12px;
}

.first_but{
background:#F26522;
color:#fff;
border:0;
border-radius:2px;
font-weight:bold;
}

.check_code{
text-decoration:none;
background:#F26522;
color:#fff;
border:0;
font-size:12px;
padding:10px;
border-radius:2px;
font-weight:bold;

}


/*for desktop*/
@media only screen and (min-width: 500px) {


.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}

.empty_space{
height:70px;
}
.enter_all_info {font-size:20px;width:350px;height:auto;border-bottom:10px solid #F26522;}
}


/*mobiles*/
@media only screen and (max-width: 680px) {
    body {


background:#DFE7F4;
margin:0;
padding:0;
    }

    [class*="col-"] {
        width: 100%;
    }

.empty_space{
height:0px;
}
.total{
width:100%;
}

.footer{
height:90px;
}

.footer p{
text-align:center;
width:100%;
}

.footer ul{

text-align:center;
margin-left:0;
padding-top:0;padding-left:5px;
}

.footer ul li{
margin-left:10px;
}


}
  


</style>
</html>
<?php
}
?>
