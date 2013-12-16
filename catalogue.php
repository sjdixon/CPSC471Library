
<body>
<a href="MainPage.php">Logout</a>
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

