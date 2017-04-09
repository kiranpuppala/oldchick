<?php
require_once('starsess.php');
if(isset($_SESSION['userid'])){
?>
<!DOCTYPE html>
<head>
<title>Product Info</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="screen.css" type="text/css" media="screen"/>
</head>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
   x.className += " responsive";
document.getElementById("wh").style.display="block";
document.getElementById("fr").style.display="block";
document.getElementById("ep").style.display="block";
document.getElementById("on").style.display="block";
    } else {
     x.className = "topnav";
document.getElementById("wh").style.display="none";
document.getElementById("fr").style.display="none";
document.getElementById("ep").style.display="none";
document.getElementById("on").style.display="none";
    }
}
window.onresize = displayWindowSize;
    window.onload = displayWindowSize;

    function displayWindowSize() {
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;

if(myWidth>680){
document.getElementById("wh").style.display="none";
document.getElementById("fr").style.display="none";
document.getElementById("ep").style.display="none";
document.getElementById("on").style.display="none";
}

}
</script>

<body>


<ul class="topnav" id="myTopnav">

<li><img  style="margin-top:10px" src="images/oldchick.png" alt="no image" width="100px" height="60px"></li>
<li style="visibility:hidden">Hidden field for space only for space some sme some </li>

 <li><a class="home" href="oldstuff.php"> <img src="images/homeicon.png" width="16px" height="13px" > Home</a></li>
 
  <li><a class="friends" href="placedsales.php"><img src="images/pad.png" width="15.3px" height="14px" > Placed Sales</a></li>
  <li><a class="inbox" href="sellitem.php"><img src="images/tag.png" width="19.18px" height="14px" > Sellitem</a></li>
  <li><a href="viewfiles.php"><img src="images/material.png" width="19.97px" height="14px" >  Files</a></li>
 <li><a class="myaccount" href="myaccount.php"> <img src="images/account.png" width="20px" height="15.3px" > My account</a></li>
<li><a class="logout" href="logout.php"><img src="images/logout.png" width="13px" height="14px"> Log out</a></li>
<li class="icon">
        <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()"><span style="font-size:20px;">≡</span></a>
  </li>
</ul>

<div class="empty_space"></div>

<div class="total col-7">



<?php

require_once('starsess.php');
require_once('allvars.php');
$userid=$_SESSION['userid'];
$pid=$_GET['pid'];
$sid=$_GET['sid'];


$placerid="";
$no_of_rows=0;

if(isset($_GET['rowno']))
$no_of_rows=$_GET['rowno'];

else
$no_of_rows=15;



$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME) or die('error to connect');



$query="SELECT * FROM placedsales WHERE rowid='$pid'";
$result=mysqli_query($dbc,$query) or die ('error to placerid');

$row=mysqli_fetch_array($result);
$placerid=$row['placerid'];
$date=$row['date'];
$full_date=$date;
$date=date('M. j, y', strtotime($date));
$tme = date('h:i A', strtotime($full_date));
//$date=date('F jS, Y', strtotime($date));
//date("M. j, y")


$query1="SELECT uname,primage,place,emailaddr,mobile,classname FROM candidates WHERE  userid='$placerid' ";
$result1=mysqli_query($dbc,$query1) or die ('error for no of likes');
$row1=mysqli_fetch_array($result1);

echo '<div class="public_posts ">';
echo '<p style="font-weight:bold;opacity:.6;text-align:center">Product Info</p>';
echo '<img class="uploader_pic" src="images/'.$row1['primage'].'" alt="no image">';
echo '<p class="poster_name">'.$row1['uname'].'</p>';
echo '<p class="posted_time">'.$date.'</p>';
echo '<hr class="title_hr">';
echo '<p class="post_description">'.$row['itemname'].'</p>';

echo '<img class="uploaded_pic" src="saleimages/'.$row['primage'].'" alt="no image">';
echo '<br>';
echo '<hr>';
echo '<p class="table_heading">Total info:</p>';
echo '<table class="product_info">
<tr><th>Seller name:</th><td>'.$row1['uname'].'</td></tr>
<tr><th>Class:</th><td>'.$row1['classname'].'</td></tr>
<tr><th>Place:</th><td>'.$row1['place'].'</td></tr>
<tr><th>Date placed:</th><td>'.$date.' at '.$tme.'</td></tr>
<tr><th>Price:</th><td>₹ '.$row['price'].'</td></tr>
<tr><th>Seller mobile:</th><td>'.$row1['mobile'].'</td></tr>
<tr><th>Seller Email:</th><td>'.$row1['emailaddr'].'</td></tr>

</table>';



echo '</div>';




?>


</div>




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





</body>



<style>






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
.empty_space{
height:10px;
}


.total {
 margin-left: auto ;
  margin-right: auto ;
}

.yourfriends{
text-align:center;
}

.public_posts{
background:#fff;

margin-top:7px;
margin-left:10px;
padding:10px;
float:left;
width:100%;
border-radius:2px;
font-size:15px;
}

.public_posts img.uploader_pic{
width:70px;
height:70px;
border-radius:1000px;
float:left;
display:block;
}

.public_posts img.uploaded_pic{

margin:auto;

display:block;
width:60%;
}

.public_posts p.posted_time{
float:right;
opacity:.7;
padding-right:20px;
}

.public_posts p.poster_name{
float:left;
color:#000;
padding-left:20px;
opacity:.7;
}


.public_posts p.post_description{

}

hr.title_hr{
margin-top:100px;
height:1px;
background-color:#000;
opacity:.1;
}
hr{
height:1px;
background-color:#000;
opacity:.1;
}



.sender_title{

 clear:both;
}

.sender_title img.uploader_pic{
width:30px;
height:30px;
border-radius:1000px;
float:left;
display:block;
}

.sender_title p.friend_name{
float:left;


padding-left:10px;
margin-top:7px;
width:50%;
}


.product_info{
margin:auto;

}

table td{
color:#38BB38;

}
table th{

}
.table_heading{
text-align:center;
opacity:.7;
}





.loadearlier {
text-align:center;
clear:both;
}
.loadearlier a{
color:#548989;
}



input{
//width:100%;
padding:12px 20px;
margin:8px 0;
box-sizing:border-box;

}

input[type="text"]{
width:100%;
color:#54696d;
font-weight:bold;
border-style:ridge;
border-width:1px;
border-opacity:.5;
}

.findfrien input[type="text"]{
width:90%;
border-style:ridge;
border-width:1px;
border-opacity:.5;
}



//.post:after,.new_event:after,.profile_details:after,picture_edit_list:after
//{content:"";display:table;clear:both}



/*for mobile phones*/
@media only screen and (max-width: 500px) {
    body {
margin:0;
padding:0;
    }

    [class*="col-"] {
        width: 100%;
    }

}
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

/******************************************************************************/





body {margin:0;padding:0}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #4670B7;

}

.topnav img{
margin-left:20px;
}

ul.topnav li {float: left;}

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

//ul.topnav li a:hover {background-color: #fff;color:#54696d;font-weight:bold;font-size:20px;}

ul.topnav li.icon {display: none;}

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



.public_posts{
box-shadow:0 0px 0px 0 rgba(0,0,0,0),0 0px 0px 0 rgba(0,0,0,0);
margin-top:7px;
margin-left:0px;
padding:0px;
float:left;
border-radius:0px;
}

.public_posts img.uploader_pic{
width:50px;
height:50px;
}

.public_posts img.uploaded_pic{
float:left;
margin:auto;
display:block;
width:100%;
}

.public_posts p.posted_time{
float:right;
opacity:.7;
padding-right:20px;
}

.public_posts p.poster_name{
padding-left:15px;
}

hr.title_hr{
margin-top:50px;
clear:both;
}

.sender_title{
 clear:both;
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
else{
header("Location:index.php");
}
?>
