<?php

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Welcome to weltenraum</title>
<script language="JavaScript" type="text/javascript" src="/wr/jquery-1.3.1.min.js"></script>
<style type="text/css">
*{
	font-size:1em;
	margin: 0px;
	padding:0px;
	border: none;
	list-style: none;
	}
body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}
.clear{
	clear:both
}
h1{
	font-size: 1.5em;
}
h3{
	font-size: 1.2em;
}
input{border: 1px solid #000000;padding:3px;}
#pagemargin{
	margin:0 auto;
	width:800px;
	/*height:100%;*/
	min-height:300px;
	background-color: #eee;
	padding: 10px;
}
#header{width: 800px; border-bottom:3px solid #000080;}
#menu{
	width: 150px;
	float:left;
	margin: 0px;
	padding: 0px;
}
#footer{
	border-top:3px solid #000080;
	margin-top:2em;
	width:800px;
	float:left;
}
#dashboard dl{ width:200px; float:left;}
#dashboard dt{ width:100px; float:left;}
#dashboard dd{ width:100px; float:left;}

#buildings td{ width: 80px; text-align: left;}
#buildings th{ width: 80px; text-align: left;}
.number{ text-align: right; color: #008080;}
</style>
<script type="text/javascript">
$(document).ready(function(){
//--------------------------
<?php if ( $this->cl_auth->isValidUser() ) { ?>
	$('#menu').load('/wr/index.php/menu',{ajax:'menu'},function(){
		$('#menu a').click(function(){
			$('#content').load('/wr/index.php/content',{ajax:'content',id:$(this).attr('href')},
			function(){
				 	$('a.command').click(function(){
						$('#content').load('/wr/index.php/content',{ajax:'content',id:$(this).attr('href'),cmd:$(this).attr('alt')});
							return false;
						})

			});
				return false;
			})
 	});
// Startseite laden
 	$('#content').load('/wr/index.php/content',{ajax:'content',id:0});
<?php }?>
//--------------------------
});
</script>
</head>
<body>
<div id="pagemargin">
<div id="header"><h1>Sternenschreiter</h1></div>
<div id="menu"></div>
<div id="rightcolumn">
	<div id="info"></div>
	<div id="content">




