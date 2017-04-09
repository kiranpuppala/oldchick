 <?php
require_once('allvars.php');
require_once('starsess.php');

$userid='';
$login_wrong=false;
if(!isset($_SESSION['userid'])){
if(isset($_POST['submit'])){
$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME)
or die('Error connecting to MySQL server.');
$emailaddr=     $_POST['emailaddr'];                                                    //mysqli_real_escape_string($dbc,trim($_POST['email']));
$password=  $_POST['password'];                                                //mysqli_real_escape_string($dbc,trim($_POST['password']));

if(!empty($emailaddr)&&!empty($password)){
$query="SELECT userid,uname FROM candidates WHERE emailaddr='$emailaddr' AND password=SHA('$password') ";
$data=mysqli_query($dbc,$query);
$rowss=mysqli_num_rows($data);

if(mysqli_num_rows($data)==1){


$row=mysqli_fetch_array($data);
$_SESSION['userid']=$row['userid'];
$userid=$_SESSION['userid'];
$_SESSION['uname']=$row['uname'];

setcookie('userid',$row['userid'],time() + (60 * 60 * 24 * 30));
setcookie('uname',$row['uname'],time() + (60 * 60 * 24 * 30));

$query="INSERT INTO chat (userid) VALUES ('$userid')";
$result=mysqli_query($dbc,$query) or die('error chat');



mysqli_close($dbc);
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/oldstuff.php';
header('Location: ' . $home_url);
}//num of rows
else{
$login_wrong=true;
}
}// not empty user name
}//is set post submit
?>
 <!DOCTYPE html>
<head>
<title>log in</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="screen.css" type="text/css" media="screen"/>
</head>
<body>



<div class="empty_space"></div>



<div class="total col-5">
<div class="edit_prof">

<img  style="margin-top:10px" src="images/loginoldchick.png" alt="no image" width="100px" height="60px">
<hr>

<form  name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  onsubmit="return validateForm()">

<input class="emailaddr" name="emailaddr" placeholder="Email Address" type="text" value="<?php if(!empty($emailaddr)) echo $emailaddr; ?>"><br>

<input class="pw" name="password"  placeholder="Password" type="password"><br>
<p><?php if($login_wrong) echo 'email or password is wrong'; ?></p>
<a style="text-decoration:none;color:#16BE48;font-size:14px;" href="recpas.php">forgot password?</a><br>

<input class="submit" type="submit" value="login" name="submit" >
<p style="opacity:.6">Not a member yet? Click <a style="text-decoration:none;color:#16BE48" href="signup.php">here</a> to signup</p>


<div class="footer">
<p> &nbsp&copy &nbsp2016-2017 Old Chick, Platter Inc.   </p>
<ul>
<li><a href="#">about</a></li>
<li><a href="http://www.facebook.com/platterpeople">contact</a></li>
<li><a href="#">app</a>
</ul>
</div>

</div>






</div>



</body>
<style>
body{
font-family: Segoe UI Emoji,Century Gothic;
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
background-color:#F26522;;
color:#fff;
border-radius:3px;
border:0px;
font-weight:bold;
padding:10px;
}

.column5{
float:left;
background:#F26522;
height:120px;
opacity:.7;
}


.footer{
background:#757575;
height:60px;
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

/*for desktop*/
@media only screen and (min-width: 680px) {
body{
background:#DFE7F4;
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

.empty_space{
height:150px;
}

}
/*mobiles*/
@media only screen and (max-width: 680px) {
    body {
font-family: Segoe UI Emoji,Century Gothic;

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
else{
header("Location:oldstuff.php");
}
?>


