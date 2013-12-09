
<?php
// Script to generate main page and dialog pages to add and modify items in the library
// Gaby Comeau, Nov. 21, 2013
// Quick note that this function inherits Javascript and CSS libraries from App_Index.php	
	
	//add new item
	echo "<p>Use this form to add a new item</p>";
	echo "<form>";
		echo "<div id=\"radio1\" class=\"radioset\">";
			echo "<input type=\"radio\" id=\"add1\" name=\"radio1\" /><label for=\"add1\">Book</label>";
			echo "<input type=\"radio\" id=\"add2\" name=\"radio1\" /><label for=\"add2\">Audio</label>";
			echo "<input type=\"radio\" id=\"add3\" name=\"radio1\" /><label for=\"add3\">Video</label>";
			echo "<input type=\"radio\" id=\"add4\" name=\"radio1\" /><label for=\"add4\">Magazine</label>";
			echo "<input type=\"radio\" id=\"add5\" name=\"radio1\" /><label for=\"add5\">Newspaper</label>";
		echo "</div>";
	echo "</form><br><br>";
	
	//add item instance
	echo "<p>Use this form to add another copy of an already existing item</p>";
	echo "<button type=\"button\" id = \"add_inst\">Add Item Instance</button><br><br><br>";
	
	//modify an item
	echo "<p>Use this form to modify an item or item instance</p>";
	echo "<form>";
		echo "<iv id=\"radio2\" class=\"radioset\">";
			echo "<input type=\"radio\" id=\"update1\" name=\"radio2\" /><label for=\"update1\">Modify Item</label>";
			echo "<input type=\"radio\" id=\"update2\" name=\"radio2\" /><label for=\"update2\">Modify Item Instance</label>";
		echo "</div>";
	echo "</form><br><br><br>";
	
	//delete an item
	echo "<p>Use this form to delete an item or item instance</p>";
	echo "<form>";
		echo "<iv id=\"radio3\" class=\"radioset\">";
			echo "<input type=\"radio\" id=\"delete1\" name=\"radio3\" /><label for=\"delete1\">Delete Item</label>";
			echo "<input type=\"radio\" id=\"delete2\" name=\"radio3\"/><label for=\"delete2\">Delete Item Instance</label>";
		echo "</div>";
	echo "</form><br><br><br>";
?>
<script>
	$( "button" ).button();
	$(function() {
		$( ".radioset").buttonset();
	});
</script>
<?php
	//new book form
	echo "<div id=\"dialog\" title=\"Add New Book\">";
		echo "<form action = \"addBook.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"ISBN\">ISBN: </label>";
			echo "<input type =\"text\" name=\"ISBN\" id=\"ISBN\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"authorName\">Author: </label>";
			echo "<input type =\"text\" name=\"authorName\" id=\"authorName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"pubName\">Publisher: </label>";
			echo "<input type =\"text\" name=\"pubName\" id=\"pubName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"edition\">Edition: </label>";
			echo "<input type =\"text\" name=\"edition\" id=\"edition\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";	
			echo "<label for=\"spinner\">Release Year: </label>";
			echo "<input id=\"spinner\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience\">Audience: </label>";
			echo "<select id=\"audience\" name=\"audience\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Video\">Pre-Teens</option>";
				echo "<option value=\"Newspaper\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
			echo "</select><br><br>";	
			echo "<label for=\"location\">Location: </label>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
			echo "<input type=\"checkbox\" id=\"check\" name=\"isReference\"><label for=\"check\">Check for Reference Item</label><br><br>";	
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";	
		echo "</form>";
		?>
		<script>
		$( "#spinner" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#check" ).button();
		});
		</script>
	<?php	
	echo "</div>";
	
	//new audio item form
	echo "<div id=\"dialog2\" title=\"Add New Audio Item\">";
		echo "<form action = \"addAudio.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name1\">Title: </label>";
			echo "<input type =\"text\" name=\"name1\" id=\"name1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"artistName\">Creator: </label>";
			echo "<input type =\"text\" name=\"artistName\" id=\"artistName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner2\">Release Year: </label>";
			echo "<input id=\"spinner2\" name=\"spinner1\" value=\"2013\" /><br><br>";
			echo "<label for=\"UPC\">UPC: </label>";
			echo "<input type =\"text\" name=\"UPC\" id=\"UPC\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"producerName\">Production Company: </label>";
			echo "<input type =\"text\" name=\"producerName\" id=\"producerName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre1\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre1\" id=\"genre1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience1\">Audience: </label>";
			echo "<select id=\"audience1\" name=\"audience\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Video\">Pre-Teens</option>";
				echo "<option value=\"Newspaper\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
			echo "</select><br><br>";
			echo "<label for=\"location1\">Location: </label>";
			echo "<input type =\"text\" name=\"location1\" id=\"location1\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";	
			echo "<input type=\"checkbox\" id=\"check1\" name=\"isReference1\"><label for=\"check\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner2" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#check1" ).button();
		});
		</script>	
	<?php	
	echo "</div>";
	
	//new video item form
	echo "<div id=\"dialog3\" title=\"Add New Video Item\">";
		echo "<form action = \"addVideo.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name2\">Title: </label>";
			echo "<input type =\"text\" name=\"name2\" id=\"name2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"UPC2\">UPC: </label>";
			echo "<input type =\"text\" name=\"UPC2\" id=\"UPC2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"director\">Director: </label>";
			echo "<input type =\"text\" name=\"director\" id=\"director\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"producerName2\">Production Company: </label>";
			echo "<input type =\"text\" name=\"producerName2\" id=\"prodName2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner3\">Release Year: </label>";
			echo "<input id=\"spinner3\" name=\"spinner2\" value=\"2013\" /><br><br>";
			echo "<label for=\"genre2\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre2\" id=\"genre2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience2\">Audience: </label>";
			echo "<select id=\"audience2\" name=\"audience\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Video\">Pre-Teens</option>";
				echo "<option value=\"Newspaper\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
			echo "</select><br><br>";			
			echo "<label for=\"location2\">Location: </label>";
			echo "<input type =\"text\" name=\"location2\" id=\"location2\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
			echo "<input type=\"checkbox\" id=\"check2\" name=\"isReference2\"><label for=\"check2\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner3" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#check2" ).button();
		});
		</script>
	<?php
	echo "</div>";
	
	//new magazine
	echo "<div id=\"dialog4\" title=\"Add New Magazine\">";
		echo "<form action = \"addMagazine.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name3\">Title: </label>";
			echo "<input type =\"text\" name=\"name3\" id=\"name3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"subName\">Subtitle: </label>";
			echo "<input type =\"text\" name=\"subName\" id=\"subName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner4\">Release Year: </label>";
			echo "<input id=\"spinner4\" name=\"spinner3\" value=\"2013\" /><br><br>";
			echo "<p> Issue: <input type=\"text\" id=\"datepicker1\" name =\"datepicker1\" /></p><br>";
			echo "<label for=\"pubName2\">Publisher: </label>";
			echo "<input type =\"text\" name=\"pubName2\" id=\"pubName2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre3\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre3\" id=\"genre3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience3\">Audience: </label>";
			echo "<select id=\"audience3\" name=\"audience\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Video\">Pre-Teens</option>";
				echo "<option value=\"Newspaper\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
			echo "</select><br><br>";
			echo "<label for=\"location3\">Location:</label>";
			echo "<input type =\"text\" name=\"location3\" id=\"location3\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
			echo "<input type=\"checkbox\" id=\"check3\" name=\"isReference3\"><label for=\"check3\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner4" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#datepicker1" ).datepicker({
				changeMonth: true,
				changeYear: true
			});
		});
		$(function() {
			$( "#check3" ).button();
		});
		</script>
	<?php
	echo "</div>";
	
	//new newspaper
	echo "<div id=\"dialog5\" title=\"Add New Newspaper\">";
		echo "<form action = \"addNewspaper.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name4\">Title: </label>";
			echo "<input type =\"text\" name=\"name4\" id=\"name4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner5\">Release Year: </label>";
			echo "<input id=\"spinner5\" name=\"spinner4\" value=\"2013\" /><br><br>";
			echo "<p> Issue: <input type=\"text\" id=\"datepicker\" name =\"datepicker\" /></p><br>";
			echo "<label for=\"pubName3\">Publisher: </label>";
			echo "<input type =\"text\" name=\"pubName3\" id=\"pubName3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre4\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre4\" id=\"genre4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience4\">Audience: </label>";
			echo "<select id=\"audience4\" name=\"audience\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Video\">Pre-Teens</option>";
				echo "<option value=\"Newspaper\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
			echo "</select><br><br>";
			echo "<label for=\"location4\">Location: </label>";
			echo "<input type =\"text\" name=\"location4\" id=\"location4\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
			echo "<input type=\"checkbox\" id=\"check4\" name=\"isReference4\"><label for=\"check4\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner5" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true
			});
		});
		$(function() {
			$( "#check4" ).button();
		});
		</script>
	<?php
	echo "</div>";
	
	//new item instance
	echo "<div id=\"dialog6\" title=\"Add Item Instance\">";
		echo "<form>";
			echo "<!--Add new item instance information in the form below:-->";
			echo "<label for=\"stockNum\">Stock Number: </label>";
			echo "<input type =\"text\" name=\"stockNum\" id=\"stockNum\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"lCode\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode\" id=\"lCode\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"status\">Status: </label>";
			echo "<input type =\"text\" name=\"status\" id=\"status\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
		echo "</form>";
	echo "</div>";
	
	//modify item instance
	echo "<div id=\"dialog7\" title=\"Modify Item Instance\">";
		echo "<form>";
			echo "<!--Modify info in the form below:-->";
			echo "<label for=\"stockNum1\">Stock Number: </label>";
			echo "<input type =\"text\" name=\"stockNum1\" id=\"stockNum1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"lCode1\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode1\" id=\"lCode1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"status1\">Status: </label>";
			echo "<input type =\"text\" name=\"status1\" id=\"status1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
		echo "</form>";
	echo "</div>";
	
	//delete item instance
	echo "<div id=\"dialog8\" title=\"Delete Item Instance\">";
		echo "<form>";
			echo "<!--Details on the instance to be deleted:-->";
			echo "<label for=\"stockNum2\">Stock Number: </label>";
			echo "<input type =\"text\" name=\"stockNum2\" id=\"stockNum2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"lCode2\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode2\" id=\"lCode2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
		echo "</form>";
	echo "</div>";
	
	//delete item
	echo "<div id=\"dialog9\" title=\"Delete Item\">";
		echo "<form>";
			echo "<!--Info on the item to be deleted:-->";
			echo "<label for=\"lCode3\">Library Code: </label>";
			echo "<input type =\"text\" name=\lCode3\" id=\"lCode3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
		echo "</form>";
	echo "</div>";
	
	//modify item
	echo "<div id=\"dialog10\" title=\"Modify\">";
		echo "<form>";
			echo "<!--Modify info in the form below:-->";
			echo "<label for=\"lCode4\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode4\" id=\"lCode4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
		echo "</form>";
	echo "</div>";

?>
<script type="text/javascript">
	$( "#dialog" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});	
	$( "#add1" ).click(function() {
		$( "#dialog" ).dialog( "open" );
	});
	$( "#dialog2" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});	
	$( "#add2" ).click(function() {
		$( "#dialog2" ).dialog( "open" );
	});
	$( "#dialog3" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});	
	$( "#add3" ).click(function() {
		$( "#dialog3" ).dialog( "open" );
	});
	$( "#dialog4" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});	
	$( "#add4" ).click(function() {
		$( "#dialog4" ).dialog( "open" );
	});
	$( "#dialog5" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});
	$( "#add5" ).click(function() {
		$( "#dialog5" ).dialog( "open" );
	})
	$( "#dialog6" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});
	$( "#add_inst" ).click(function() {
		$( "#dialog6" ).dialog( "open" );
	});
	$( "#dialog7" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});
	$( "#update2" ).click(function() {
		$( "#dialog7" ).dialog( "open" );
	});
	$( "#dialog8" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});
	$( "#delete2" ).click(function() {
		$( "#dialog8" ).dialog( "open" );
	});
	$( "#dialog9" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});
	$( "#delete1" ).click(function() {
		$( "#dialog9" ).dialog( "open" );
	});
	$( "#dialog10" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400
	});
	$( "#update1" ).click(function() {
		$( "#dialog10" ).dialog( "open" );
	});
</script>
