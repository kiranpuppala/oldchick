<?php
require_once('allvars.php');
require_once('starsess.php');
$error_image=false;


if(isset($_SESSION['userid'])){
$userid=$_SESSION['userid'];
if(isset($_POST['submit'])){

$output_form = false;

$itemname=$_POST['itemname'];
$category=$_POST['category'];

$price=$_POST['price'];

$primage=$_FILES['primage']['name'];
$tmp=$_FILES['primage']['tmp_name'];
$target=SALE_IMAGE_PATH.$primage;
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
    $exif = @exif_read_data($target);
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
        }//switch close

        imagejpeg($image, $target, 90);
    }//exif orientation close
}
/// jpeg check close


$query="INSERT INTO placedsales (placerid,itemname,price,primage,category,date) VALUES ('$userid','$itemname','$price','$primage','$category',NOW())";
$result=mysqli_query($dbc,$query)
or die('Error querying database.');


mysqli_close($dbc);
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/oldstuff.php';
header('Location: ' . $home_url);
echo 'sale has been placed';

}// total image check close

else{
$output_form=true;
$error_image=true;
}


}

else{
$output_form= true;
}

if ($output_form) {
?>

<!DOCTYPE html>
<head>
<title>Sell item</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="screen.css" type="text/css" media="screen"/>



<script>
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

   <li><a class="home" href="oldstuff.php"> <img src="images/homeicon.png" width="16px" height="13px" > Home</a></li>
  <li><a class="pad" href="placedsales.php"><img src="images/pad.png" width="15.3px" height="14px" > Placed Sales</a></li>
  <li ><a class="tag"  style="color:yellow;" href="sellitem.php"><img src="images/tag.png" width="19.18px" height="14px" > Sellitem</a></li>
  <li><a  class="material" href="viewfiles.php"><img src="images/material.png" width="19.97px" height="14px" >  Files</a></li>
<li><a class="myaccount" href="myaccount.php"> <img src="images/account.png" width="20px" height="15.3px" > My account</a></li>
<li><a class="logout" href="logout.php"><img src="images/logout.png" width="13px" height="14px"> Log out</a></li>
<li class="icon">
        <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()"><span style="font-size:20px;">≡</span></a>
  </li>
</ul>

<div class="empty_space"></div>

<div class="total col-5">
<div class="edit_prof">

<p>Your sale has been placed successfully.<br>Go to <a style="color:#2BBE48" href="placedsales.php">placed sales</a> to check or remove sale.</p>


</div>
</div>


</body>





<script>
function validateForm() {

if(document.getElementById("itemname").value.length<3){
document.getElementById("citemname").innerHTML="enter atleast 3 characters";
document.getElementById("citemname").style="color:#ff0000";
return false;
}
else if(document.getElementById("itemname").value.length>30){
document.getElementById("citemname").innerHTML="not more than 30 characters";
document.getElementById("citemname").style="color:#ff0000";
return false;
}
else
document.getElementById("citemname").innerHTML="";


if(document.getElementById("category").value.length<3){
document.getElementById("ccategory").innerHTML="select category";
document.getElementById("ccategory").style="color:#ff0000";
return false;
}
else{
document.getElementById("ccategory").innerHTML="";
}

if(document.getElementById("price").value.length<1){
document.getElementById("cprice").innerHTML="specify price";
document.getElementById("cprice").style="color:#ff0000";
return false;
}
else{
document.getElementById("cprice").innerHTML="";
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
body{
margin:0;padding:0

//background:#DAE5F3;
background:#DFE7F4;
font-family: Segoe UI Emoji,Century Gothic;
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

.category{
opacity:.5;
width:90%;
border-style:ridge;
border-width:1px;
border-opacity:.1;
padding:10px;
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
}


.edit_prof img {
width:100px;
height:100px;
border-radius:1000px;
margin:auto;
display:block;
}


input{
//width:100%;
padding:12px 20px;
margin:8px 0;
box-sizing:border-box;

}

input[type="text"]{
width:90%;
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
