<?php
require_once('starsess.php');
require_once('allvars.php');
if(isset($_SESSION['userid'])){
?>
<!DOCTYPE html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="screen.css" type="text/css" media="screen"/>


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



</head>

<body>


<ul class="topnav" id="myTopnav">
 
<li><img  style="margin-top:10px" src="images/oldchick.png" alt="no image" width="100px" height="60px"></li>
<li style="visibility:hidden">Hidden field for space only for space some sme some </li>

   <li><a class="home" style="color:yellow" href="oldstuff.php"> <img src="images/homeicon.png" width="16px" height="13px" > Home</a></li>
  <li><a class="friends" href="placedsales.php"><img src="images/pad.png" width="15.3px" height="14px" > Placed Sales</a></li>
  <li><a class="inbox" href="sellitem.php"><img src="images/tag.png" width="19.18px" height="14px" > Sellitem</a></li>
  <li><a href="viewfiles.php"><img src="images/material.png" width="19.97px" height="14px" >  Files</a></li>
<li><a class="myaccount" href="myaccount.php"> <img src="images/account.png" width="20px" height="15.3px" >My account</a></li>
<li><a class="logout" href="logout.php"><img src="images/logout.png" width="13px" height="14px"> Log out</a></li>

<li class="icon">
        <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()"><span style="font-size:20px;">≡</span></a>
  </li>
</ul>

<div class="empty_space"></div>

<div class="total col-7">
<!-- start of second column-->

<div class="findfrien">
<form  action="oldstuff.php" method="post">
<input name="searitem" type="text" placeholder="Search for an item">

<input type="submit" class="fa-fa" value="&#128269;">





<select id="category" name="category" class="category"  onChange="window.location.href=this.value">
<option selected="selected"  value="">Category</option>
<option  value="oldstuff.php?c=st">Stationary</option>
<option  value="oldstuff.php?c=bo">Books</option>
<option value="oldstuff.php?c=sm">Study materials</option>
<option value="oldstuff.php?c=mo">Mobiles</option>
<option value="oldstuff.php?c=eg">Electronic gadgets</option>
<option value="oldstuff.php?c=sp">Sports</option>
<option value="oldstuff.php?c=ot">Others</option>
</select>

<select id="sortby" name="sortby" class="category" onChange="window.location.href=this.value">
<option selected="selected"  value="">Sort by</option>
<option  value="oldstuff.php?s=plh&c=<?php  if(isset($_GET['c'])) echo $_GET['c']  ?>">Price low to high</option>
<option  value="oldstuff.php?s=phl&c=<?php  if(isset($_GET['c'])) echo $_GET['c']  ?>">Price high to low</option>

</select>


</div>



<div class="sear_results">


<?php
$searitem="";
$placerid="";
$no_of_rows=0;
$sortby="";
$cat="";


$req_status="";

$userid=$_SESSION['userid'];
if(isset($_POST['searitem'])){
$searitem=$_POST['searitem'];
}
else{
$searitem="";
}

if(isset($_GET['rowno']))
$no_of_rows=$_GET['rowno'];
else
$no_of_rows=20;

if(isset($_GET['s'])){
$sortby=$_GET['s'];
}
else{
$sortby="";
}

if(isset($_GET['c'])){
$cat=$_GET['c'];
}
else{
$cat="";
}


$dbc=mysqli_connect(DB_ADDR,DB_USER,DB_PASS,DB_NAME) or die('error connecting');



if(empty($sortby))
$query="SELECT * FROM placedsales WHERE itemname LIKE '%$searitem%' ORDER BY date DESC LIMIT $no_of_rows";

if(isset($sortby)&&isset($cat)){
if(($sortby=="phl"))
$query="SELECT * FROM placedsales WHERE itemname LIKE '%$searitem%' AND category LIKE '%$cat%' ORDER BY price DESC LIMIT $no_of_rows";

if($sortby=="plh")
$query="SELECT * FROM placedsales WHERE itemname LIKE '%$searitem%' AND category LIKE '%$cat%' ORDER BY price ASC LIMIT $no_of_rows";
}

if(empty($sortby)&&($cat!="")){

$query="SELECT * FROM placedsales WHERE itemname LIKE '%$searitem%' AND category LIKE '%$cat%' ORDER BY date DESC LIMIT $no_of_rows";

}



$result=mysqli_query($dbc,$query) or die ('error querying 1');

if(mysqli_num_rows($result)==0){
echo '<p>No results found</p>';
}

else{

while($row=mysqli_fetch_array($result)){

$placerid=$row['placerid'];

$query2="SELECT uname,classname FROM candidates WHERE userid='$placerid' ";
$result2=mysqli_query($dbc,$query2) or die ('error querying 2');

$row2=mysqli_fetch_array($result2);

echo '<div class=single_product>';
echo '<img class="uploader_pic" src="saleimages/'.$row['primage'].'" alt="no image">';
echo '<p class="friend_name">'.$row['itemname'].'<br>
<br><span style="font-weight:bold;opacity:.7">'.$row2['uname'].',&nbsp'.$row2['classname'].'
</span><br><br><span style="color:#16BE48">₹ '.$row['price'].'</span></p>';
echo '<div class="send_reque">';
echo '<a href="buyproduct.php?pid='.$row['rowid'].'&sid='.$row['placerid'].'"><span style="color:#F26522">&#10004&nbsp</span>Buy</a>';
echo '</div>';
echo '</div>';
echo '<hr>';



}//end of else for no results
}

echo '<div class="show_more_posts">
<a class="sell_item"  href="sellitem.php">sell item</a>
<a class="show_more" href="oldstuff.php?rowno='.($no_of_rows+20).'&s='.$sortby.'&c='.$cat.'">show more</a></div>';


mysqli_close($dbc);
?>





</div>

<!--end of second column-->


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
font-family: Segoe UI Emoji,Century Gothic;
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





.findfrien{
background:#fff;
margin-top:0px;
padding:10px;
float:left;
width:100%;
border-radius:2px;
}

.sear_results{
background:#fff;
margin-top:7px;
padding:10px;
float:left;
width:100%;
border-radius:1px;
line-height:100%;
}

.category{
opacity:.5;
width:15%;
border-style:ridge;
border-width:1px;
border-opacity:.1;
padding:10px;
}

.sear_results img.uploader_pic{
width:100px;
height:100px;
float:left;
display:block;
}

.sear_results img.uploaded_pic{
float:left;
margin:auto;
display:block;
}


.sear_results p.friend_name{
float:left;
padding-left:20px;
}

.sear_results hr{
margin-top:110px;
height:1px;
background:#000;
clear:both;
opacity:.1;
border:0px;
}



.send_reque{
margin-top:30px;
margin-right:5%;
float:right;

}

.send_reque  a{
text-decoration:none;
background:#4670B7;
color:#fff;
//width:100%;

padding:10px;
margin-left:5px;
font-size:14px;
border-radius:3px;
transition: .3s;
}

.send_reque a:hover{

}

.send_req_icon:before{ content:"\271A";color:#F26522;}
.decline_icon:before{content:"\2718";color:#F26522;}


input{
//width:100%;
padding:12px 20px;
margin:8px 0;
box-sizing:border-box;
font-family:"Century Gothic";
}

input[type="text"]{
width:100%;

font-weight:bold;
border-style:ridge;
border-width:1px;
border-opacity:.5;
}

.findfrien input[type="text"]{
width:60%;

font-weight:bold;
border-style:ridge;
border-width:1px;
border-opacity:.5;
}

input[type="submit"]{
background-color:#FF9F00;
color:#fff;
border:0px;
border-radius:3px;
transition:.3s;
font-weight:bold;
}
input[type="submit"]:hover{
//box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
//opacity:.5;
}


//.post:after,.new_event:after,.profile_details:after,picture_edit_list:after
//{content:"";display:table;clear:both}







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

//ul.topnav li a:hover {border-bottom:4px solid green}

ul.topnav li.icon {display: none;}


img {
    max-width: 100%;
   
}

.sear_results hr{
clear:both;
}

.single_product{
padding-top:20px;
padding-bottom:20px;
}


.show_more_posts a{
background:#FF9F00;
margin-right:5%;
text-decoration:none;
color:#fff;
padding:10px;
margin-left:5px;
font-size:14px;
transition:.3s;
border-radius:3px;
}


.show_more{float:right;}
.sell_item{float:left;}




/************************************************************/
/*for desktop*/
@media only screen and (min-width: 680px) {
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


@media screen and (max-width:680px) {
/*
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
*/
body {
margin:0;
padding:0;
    }

    [class*="col-"] {
        width: 100%;
    }


.category{
width:40%;
padding:3px;
}


.findfrien input[type="text"]{
width:80%;
}

  //ul.topnav li:not(.icon,.main_logo) {display: none;}
  
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
.findfrien{box-shadow:0 0px 0px 0 rgba(0,0,0,0),0 0px 0px 0 rgba(0,0,0,0);padding:0px;}


.sear_results{
box-shadow:0 0px 0px 0 rgba(0,0,0,0),0 0px 0px 0 rgba(0,0,0,0);
margin-top:7px;
padding:0px;
border-radius:0px;
line-height:70%;
}

.sear_results img.uploader_pic{
width:50px;
height:50px;
}

.sear_results img.uploaded_pic{
float:left;
margin:auto;
display:block;
}



.sear_results p.friend_name{
float:left;
color:#434343;
font-weight:bold;
margin-top:0px;
padding-left:20px;
}

.sear_results hr{
margin-top:120px;
clear:both;
}

.send_reque{
margin-top:30px;
float:left;
}

.send_reque  a{
padding:5px;
margin-left:5px;
font-size:14px;
float:right;
}

.sear_results p.friend_name{
line-height:90%;
width:60%;
word-wrap: break-word; 

}


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
////////end of mobile



</style>
</html>
<?php
}
else{
header("Location:index.php");
}
?>
