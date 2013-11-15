<!DOCTYPE html>
<html>
<head>
	
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<link href="jquery-ui-1.10.3.custom/css/start/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
	<style>
	h1 {font-family: Verdana,Arial,sans-serif; color: #ffffff;}
	a {font-family: Verdana,Arial,sans-serif;}
	body {background-color: #2191c0;}
	div > div > table {border-collapse:collapse;}
	td {padding:3px 30px 3px 3px;}
    </style>
    
	<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
</head> 
<body>
<h1>Library Home</h1>
<div id = "tabs">
	<ul>
		<li> <a href="#tabs-1">Catalog Search</a></li>
		<li> <a href="#tabs-2">Patrons</a></li>
		<li> <a href="#tabs-3">Inventory</a></li>
		<li> <a href="#tabs-4">Add Loans/Holds</a></li>
	</ul>
	<div id="tabs-1">
	</div>
	<div id="tabs-2">
	</div>
	<div id="tabs-3">
	</div>
	<div id ="tabs-4>
	</div>
</div>
</body>
</html>
	