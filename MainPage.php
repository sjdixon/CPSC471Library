<!DOCTYPE html>
<html>
    <head>
        <!--Main page of our web application. Contains the tab framework and script files needed for the rest of the app-->
        <!--Gaby Comeau, November 22, 2013-->
        <title>Book-a-Book</title>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!--script type="text/javascript" src="jquery-1.10.2.min.js"></script-->
        <script type="text/javascript" src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
        <link href="jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
        <!--Other CSS elements to style headers and links not included in the JQuery CSS page-->
        <style>
            h1 {font-family: Verdana,Arial,sans-serif; color: #1C94C4}
            a {font-family: Verdana,Arial,sans-serif;}
            div > div > table {border-collapse:collapse;}
            td {padding:3px 30px 3px 3px;}
            p {font-family: Verdana,Arial,sans-serif; color: #115B79}
            select {font-family: Verdana,Arial,sans-serif; color: #115B79}
        </style>

    </head>
    <body>
    <a href="Login/Login.php">Login</a>
    <p>Fill in the fields below to search the library catalogue</p>
    
    <select id="combobox" name="itemType">
    	<option value="">Select Type</option>
    	<option value="Book">Book</option>
    	<option value="Audio">Audio</option>
    	<option value="Video">Video</option>
    	<option value="Newspaper">Newspaper</option>
    	<option value="Magazine">Magazine</option>
    </select>
    <input  type="text" id="searchString" name="searchString" size = "50"/>
    <select id="combobox1" name="searchType">
    	<option value="">Select one...</option>
    	<option value="Title">Title</option>
    	<option value="year">Year</option>
    	<option value="Genre">Genre</option>
    	<option value="libraryId">Book Code</option>
    </select>
    <button type="button" id="Search" name="Search">Search</button>
    <script type="text/javascript">
    	$("#Search").click(function search(){
    		var string = document.getElementById("searchString").value;
    		var type = document.getElementById("combobox").value;
    		var checkString = document.getElementById("combobox1").value;
    		xmlreq = new XMLHttpRequest();
    		xmlreq.onreadystatechange=function(){
    			console.log(xmlreq.readyState);
     			if (xmlreq.readyState==4 && xmlreq.status==200){
       				document.getElementById("searchResults").innerHTML=xmlreq.responseText;
     			}
    		}
    		xmlreq.open("GET","Processing/search.php?type="+type+"&string="+string+"&sType="+checkString,true);
    		xmlreq.send();
    		});	
    	</script>	
    </form>	
    <div id="searchResults"></div>
    
    <script>
    	$( "button" ).button();
    </script> 
    </body>
