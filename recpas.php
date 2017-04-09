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

<div id="all_form">
<form id="myform"  onsubmit="return validateForm()">

<input class="emailaddr" id="emailaddr" name="emailaddr" placeholder="Email Address" type="text" ><br>



<a id="first_go" class="first_go" style="text-decoration:none;" href="javascript:checkMail()">Go</a>
<!--<a href="#">
<img  id="loading" style="display:none" src="images/bload.gif" width=15px height=15px ></a>-->


<p style="opacity:.6">Go to <a style="text-decoration:none;color:#16BE48" href="index.php">login</a> page</p>
<input type="text" id="dummy" style="display:none">
</div>

<div style="display:none" id="show_conf">
<p style="opacity:.6">New password has been sent to your mail<br>login <a style="text-decoration:none;color:#16BE48" href="index.php">here</a></p><br>

</div>



<p id="wrong_email"></p>


</form>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>

<script>

function checkMail(){

var num=Math.floor(Math.random() *99999999) + 10000000;
var emaila=document.getElementById("emailaddr").value;
var dataa = 'no='+ num  + '&em='+ emaila;
document.getElementById("dummy").value=num;

document.getElementById('first_go').style.background="#fff";
document.getElementById('first_go').innerHTML='<img  id="loading"  src="images/bload.gif" width=20px height=20px >';
document.getElementById('wrong_email').innerHTML="";

$.ajax({url:'forpass.php',type:'post',data: dataa, success: function(data){


if(data=='y') {

document.getElementById('all_form').style.display='none';
document.getElementById('first_go').style.display='none';
document.getElementById('show_conf').style.display='block';
document.getElementById('wrong_email').innerHTML="";

}

else
{
document.getElementById('wrong_email').innerHTML="Email doesn't exist try again";
document.getElementById('first_go').innerHTML='Go';
document.getElementById('first_go').style.background="#F26522";
document.getElementById('first_go').href="javascript:checkMail()";
}

 } });

document.getElementById('first_go').href="#";

}



</script>



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



.first_go{

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


#wrong_email{
color:#f00;
font-size:14px;
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



