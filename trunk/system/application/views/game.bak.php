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
h3{
	font-size: 1.5em;
}
#pagemargin{
	margin:0 auto;
	width:800px;
	/*height:100%;*/
	min-height:300px;
	background-color: #eee;
}
#menu{
	width: 150px;
	float:left;
	margin: 0px;
	padding: 0px;
}
#footer{
	border-top:1px solid #000080;
	margin-top:2em;
	width:800px;
	float:left;
}
#dashboard dl{ width:200px; float:left;}
#dashboard dt{ width:100px; float:left;}
#dashboard dd{ width:100px; float:left;}
</style>
<script type="text/javascript">
$(document).ready(function(){
//--------------------------
	$('#menu').load('/wr/index.php/menu',{ajax:'menu'},function(){
		$('#menu a').click(function(){
			$('#content').load('/wr/index.php/content',{ajax:'content',id:$(this).attr('href')});
				return false;
			})
 	});
 	$('#content').load('/wr/index.php/content',{ajax:'content',id:0});

//--------------------------
});
</script>
</head>
<body>
<div id="pagemargin">
<div id="menu"></div>
<div id="rightcolumn">
	<div id="info"></div>
	<div id="content"></div>
	<div id="prop"></div>
</div>
<div id="footer">Weltenraum (c) by <a href="http://www.sternenkaiser.de">Sternenkaiser</a>|<a href="index.php/auth/logout">Abmelden</a></div>
</div>
</body>
</html>