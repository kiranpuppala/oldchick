<?php
require_once('allvars.php');
require_once('starsess.php');
if(isset($_SESSION['userid'])){
$userid=$_SESSION['userid'];
if(isset($_POST['submit'])){

$output_form = false;
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

$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME) or die('error to connect');

if ((($_FILES["primage"]["type"] == "image/gif")
|| ($_FILES["primage"]["type"] == "image/jpeg")
|| ($_FILES["primage"]["type"] == "image/jpg")
|| ($_FILES["primage"]["type"] == "image/pjpeg")
|| ($_FILES["primage"]["type"] == "image/x-png")
|| ($_FILES["primage"]["type"] == "image/png"))&&$primage!="")
{
$image_presence=move_uploaded_file($tmp,$target);

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



$query="UPDATE candidates SET  primage='$primage' WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');
}



if($uname!=""){
$query="UPDATE candidates SET uname='$uname' WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database uname.');
}

if($place!=""){
$query="UPDATE candidates SET  place='$place' WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');
}

if($gender!=""){
$query="UPDATE candidates SET  regdno='$regdno' WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');
}

if($date!=""){
$query="UPDATE candidates SET  classname='$classname' WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');
}



if($emailaddr!=""){
$query="UPDATE candidates SET  emailaddr='$emailaddr' WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');
}

if($password!=""){
$query="UPDATE candidates SET password=SHA('$password')  WHERE userid='$userid' ";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');
}



mysqli_close($dbc);
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/myaccount.php';
header('Location: ' . $home_url);

}
else{
$output_form= true;
}

if ($output_form) {
?>

<!DOCTYPE html>
<head>
<title>edit profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




<script>

 function showhide(id) {
    var e = document.getElementById(id);
    e.style.display = (e.style.display == 'block') ? 'none' : 'block';
 }

function myFunction() {

    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
   x.className += " responsive";

    } else {
     x.className = "topnav";
    }
}
</script>






</head>

<body>

<ul class="topnav" id="myTopnav">
 
<li><img  style="margin-top:10px" src="images/oldchick.png" alt="no image" width="100px" height="60px"></li>
<li style="visibility:hidden">Hidden field for space only for space some sme some </li>

   <li><a class="home"  href="oldstuff.php"> <img src="images/homeicon.png" width="16px" height="13px" > Home</a></li>
  <li><a class="friends" href="placedsales.php"><img src="images/pad.png" width="15.3px" height="14px" > Placed Sales</a></li>
  <li><a class="inbox" href="sellitem.php"><img src="images/tag.png" width="19.18px" height="14px" > Sellitem</a></li>
  <li><a  href="viewfiles.php"><img src="images/material.png" width="19.97px" height="14px" >  Files</a></li>
<li><a style="color:yellow" class="myaccount" href="myaccount.php"> <img src="images/account.png" width="20px" height="15.3px" > My account</a></li>
<li><a class="logout" href="logout.php"><img src="images/logout.png" width="13px" height="14px"> Log out</a></li>
<li class="icon">
        <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()"><span style="font-size:20px;">≡</span></a>
  </li>
</ul>

<div class="empty_space"></div>





<?php
$db=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME) or die('error to connect');
$quer="SELECT * FROM candidates WHERE userid='$userid' ";
$info=mysqli_query($db,$quer) or die ('error for details');
$row_info=mysqli_fetch_array($info);

echo '<div class="total col-5">';
echo '<div class="edit_prof">';
echo '<p style="opacity:.7"><b>Your details</b></p>';
echo '<img src="images/'.$row_info['primage'].'">';
echo '<hr>';

echo '<form enctype="multipart/form-data" method="post" action="'.$_SERVER['PHP_SELF'].'" > '; 
echo '<p>'.$row_info['uname'].'<a  style="color:#F26522"  href="javascript:showhide(\'names\')">
edit &#x270E</a></p>';

echo '<div id="names" style="display:none;">';
echo '<label for="uname">Name:</label><br>';
echo '<input id="uname"  type="text" name="uname" ><br>';
echo '<p id="cuname"> </p><br>';
echo '</div>';


echo '<p>'.$row_info['place'].' &nbsp&nbsp<a style="color:#F26522"href="javascript:showhide(\'loc\')">edit &#x270E</a></p>';
echo '<div id="loc" style="display:none">';
echo '<label for="place">Your Location:</label><br>';
echo '<input id="place"  type="text" name="place" ><br>';
echo '<p id="cplace"> </p><br>';
echo '</div>';

echo '<p>'.$row_info['regdno'].' &nbsp&nbsp<a style="color:#F26522"href="javascript:showhide(\'reg\')">edit &#x270E</a></p>';
echo '<div id="reg" style="display:none">';
echo '<label for="regdno">Your regdno:</label><br>';
echo '<input id="regdno"  type="text" name="regdno" ><br>';
echo '<p id="cregdno"> </p><br>';
echo '</div>';


echo '<p>'.$row_info['classname'].' &nbsp&nbsp<a style="color:#F26522"href="javascript:showhide(\'clsnam\')">edit &#x270E</a></p>';
echo '<div id="clsnam" style="display:none">';
echo '<label for="classname">Country:</label>';
echo '<select name="classname">';

echo '

<option selected="selected"  value="">Class Name</option>
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
<option value="4/4 Mech II sem">4/4 Mech II sem</option>';




echo '</select>';
echo '<p id="cclassname"> </p><br>';
echo '</div>';

echo '<p>'.$row_info['mobile'].' &nbsp&nbsp<a style="color:#F26522"href="javascript:showhide(\'mob\')">edit &#x270E</a></p>';
echo '<div id="mob" style="display:none">';
echo '<label for="mobile">Mobile:</label><br>';
echo '<input id="mobile"  type="text" name="mobile"  ?><br><div id="al"></div>';
echo '<p id="cmobile"> </p><br>';
echo '</div>';

echo '<p>'.$row_info['emailaddr'].' &nbsp&nbsp<a style="color:#F26522"href="javascript:showhide(\'emaddr\')">edit &#x270E</a></p>';
echo '<div id="emaddr" style="display:none">';
echo '<label for="emailaddr">Email address:</label><br>';
echo '<input id="emailaddr"  type="text" name="emailaddr"  ?><br><div id="al"></div>';
echo '<p id="cemailaddr"> </p><br>';
echo '</div>';

echo '<p>Change Password &nbsp&nbsp<a style="color:#F26522"href="javascript:showhide(\'pass\')">edit &#x270E</a></p>';
echo '<div id="pass" style="display:none">';
echo '<label for="password">Password:</label><br>';
echo '<input id="password"  type="password" name="password"><br>';
echo '<p id="cpassword"> </p><br>';
echo '</div>';

echo '<p>Change Profile Picture &nbsp&nbsp<a style="color:#F26522" href="javascript:showhide(\'profileim\')">edit &#x270E</a></p>';
echo '<div id="profileim" style="display:none">';
echo '<label for="primage">Upload image file</label>';
echo '<input id="primage" name="primage" type="file" /><br/>';
echo '</div>';


echo '<input id="submit" type="submit" name="submit" value="update" >';




echo '</form>';
echo '</div>';
echo '</div>';

echo '
<div class="footer">
<ul>
<li>&copy 2016-17</li>
<li><img src="images/footicon.png" width="30px" height="29.35px"></li>
<li>Old Chick</li>
<li>Platter,Inc. Bhimavaram</li>
</ul>
</div>

<div class="subfooter">

<div class="link_menu">
<ul >
<li><a class="fb" href="http://www.facebook.com/platterpeople">f</a></li>
<li><a class="gp" href="https://plus.google.com/u/0/107537932943509859076">G+</a></li>
</ul>
</div>

<div class="footer_menu">
<ul >
<li><a href="#">about</a></li>
<li><a href="http://www.facebook.com/platterpeople">contact</a></li>
<li><a href="#">app</a></li>
</ul>
</div>

</div>
';

echo '</body>';

mysqli_close($db);
?>


<script>
function validateForm() {

if(document.getElementById("uname").value.length<3){
document.getElementById("cuname").innerHTML="enter atleast 3 characters";
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


if(document.getElementById("regdno").value.length<12){
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

if(document.getElementById("mobile").value.length!=10){
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
}



}
</script>




<style>

a{

text-decoration:none;
}

.footer{
height:130px;
background:#4670B7;
width:100%;
clear:both;
color:#9CA2AB;
text-align:center;
}

.footer ul{
padding-top:10px;
}


.footer ul li{
list-style-type: none;
text-align:center;
}

.subfooter{
height:50px;
clear:both;
width:100%;
background:#000;
opacity:.3;
margin-top:0;
}

.subfooter ul{
margin-top:0;padding-top:15px;
}
.subfooter ul li{
display:inline;

}
.subfooter ul li a{

text-decoration:none;
color:#fff;
margin-left:30px;
}


.subfooter ul li a.fb{
border-radius:60px;
background:#fff;
color:#52565C;

padding-top:9px;
padding-bottom:9px;
padding-left:17px;
padding-right:17px;
text-align:center;
}

.subfooter ul li a.fb:hover{
color:#fff;
background:#4670B7;
}

.subfooter ul li a.gp{
border-radius:50px;
background:#fff;
color:#52565C;
 padding: 8px; 
text-align:center;
}

.subfooter ul li a.gp:hover{
color:#fff;
background:#f00;
}

.link_menu{
width:60%;float:left;
}

.footer_menu{
width:40%;float:left;
}


@media screen and (max-width:680px) {

.subfooter{
height:100px;
}

.footer ul li{
width:100%;
margin-left:0;
margin-right:0;
}

.link_menu{
width:100%;
text-align:center;
margin:auto;
}

.footer_menu{
width:100%;
text-align:center;
margin:auto;
}
.footer_menu ul li a{
margin-left:10px;
}
.footer_menu ul{
margin-right:40px;
}
.link_menu ul{
margin-right:60px;
}

.footer ul{
margin-right:40px;
}
}








body{
margin:0;padding:0

//background:#DAE5F3;
background:#DFE7F4;
font-family:Segoe UI Emoji,Century Gothic;
color:#000;
 font-weight:bold;
}

hr{
height:1px;
opacity:.2;
}


.empty_space{
height:10px;
}


.total {
  margin-left: auto ;
  margin-right: auto ;
}

.edit_prof{
background:#fff;

margin-top:0px;
margin-left:10px;

padding:20px;
//float:left;
width:100%;
border-radius:2px;
text-align:center;
}

.edit_prof p{
line-height:180%;
opacity:.7;
}


.edit_prof img {
width:100px;
height:100px;
border-radius:1000px;
margin:auto;
display:block;
}

.edit_prof{
margin:0;
padding:0;
}
.edit_prof hr{
width:50%;
}


input{
//width:100%;
padding:12px 20px;
margin:8px 0;
box-sizing:border-box;

}

input[type=text], input[type=password]{
width:30%;
color:#000;

border-style:ridge;
border-width:1px;
border-opacity:.5;
}



input[type="submit"]{
background-color:#4670B7;
color:#fff;
border-radius:3px;
border:0px;
transition:.3s;
font-weight:bold;
padding:10px;
}
input[type="submit"]:hover{
}


ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #4670B7;

}
ul.topnav li {float: left;}

.topnav img{
margin-left:20px;
}

ul.topnav li a {
  display: inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 15px;
margin-top:10px;
}

//ul.topnav li a:hover {border-bottom:4px solid green}

ul.topnav li.icon {display: none;}

//*for mobile phones*/




/************************************************************/
/*for desktop*/
@media only screen and (min-width: 500px) {
body{
margin:0;
padding:0;
}

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
.logo{position:fixed;}
}




/*for mobile phones*/
@media only screen and (max-width: 500px) {
    body {
margin:0;
padding:0;
    }

    [class*="col-"] {
        width: 100%;
    }
input[type=text], input[type=password]{
width:90%;
}


}



@media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
.column1{display:none;}
.column3{display:none;}
.column2{padding-left:0;margin:auto;margin:auto;
display:block;float:none}
.post{margin-left:0}
.public_posts{margin-left:0}
.findfrien{margin-left:0}
.public_posts p.posted_time{float:right;padding-right:0px}
.public_posts p.poster_name{padding-left:5px}
.edit_prof{
box-shadow:0 0px 0px 0 rgba(0,0,0,0),0 0px 0px 0 rgba(0,0,0,0);
margin-top:0px;
margin-left:0px;
padding:0px;
}

}


@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }
}



img {
    max-width: 100%;
 
}
</style>
</html>
<?php
}
}
else{
header("Location:index.php");
}
?>
