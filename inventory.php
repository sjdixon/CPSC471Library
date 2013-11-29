
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
		echo "<form>";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">ISBN: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Author: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Publisher: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Edition: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";	
			echo "<label for=\"spinner\">Release Year: </label>";
			echo "<input id=\"spinner\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"amount\">Audience: </label>";
			echo "<input type=\"text\" id=\"amount\" style=\"border: 0; color: #f6931f; background-color: #eeeeee; font-weight: bold;\" />";
			echo "<div id=\"slider-range\"></div><br><br>";
			echo "<label for=\"location\">Location: </label>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";		
		echo "</form>";
		?>
		<script>
		$( "#spinner" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#slider-range" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [15, 23],
				slide: function( event, ui ) {
					$( "#amount" ).val( ui.values[ 0 ] +  " - " +  ui.values[ 1 ] );
				}
			});
			$( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
		});
		</script>
	<?php	
	echo "</div>";
	
	//new audio item form
	echo "<div id=\"dialog2\" title=\"Add New Audio Item\">";
		echo "<form>";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Creator: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner2\">Release Year: </label>";
			echo "<input id=\"spinner2\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"name\">UPC: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Media Type: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Production Company: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"amount\">Audience: </label>";
			echo "<input type=\"text\" id=\"amount1\" style=\"border: 0; color: #f6931f; background-color: #eeeeee; font-weight: bold;\" />";
			echo "<div id=\"slider-range1\"></div><br><br>";
			echo "<label for=\"location\">Location: </label>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";	
		echo "</form>";
		?>
		<script>
		$( "#spinner2" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#slider-range1" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [15, 23],
				slide: function( event, ui ) {
					$( "#amount1" ).val( ui.values[ 0 ] +  " - " +  ui.values[ 1 ] );
				}
			});
			$( "#amount1" ).val($( "#slider-range1" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
		});
		</script>
	<?php
	echo "</div>";
	
	//new video item form
	echo "<div id=\"dialog3\" title=\"Add New Video Item\">";
		echo "<form>";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">UPC: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Media Type: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Production Company: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner3\">Release Year: </label>";
			echo "<input id=\"spinner3\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"amount2\">Audience: </label>";
			echo "<input type=\"text\" id=\"amount2\" style=\"border: 0; color: #f6931f; background-color: #eeeeee; font-weight: bold;\" />";
			echo "<div id=\"slider-range2\"></div><br><br>";
			echo "<label for=\"location\">Location: </label>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
		echo "</form>";
		?>
		<script>
		$( "#spinner3" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#slider-range2" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [15, 23],
				slide: function( event, ui ) {
					$( "#amount2" ).val( ui.values[ 0 ] +  " - " +  ui.values[ 1 ] );
				}
			});
			$( "#amount2" ).val($( "#slider-range2" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
		});
		</script>
	<?php
	echo "</div>";
	
	//new magazine
	echo "<div id=\"dialog4\" title=\"Add New Magazine\">";
		echo "<form>";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Subtitle: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner4\">Release Year: </label>";
			echo "<input id=\"spinner4\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"name\">Issue: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"name\">Publisher: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"amount3\">Audience:</label>";
			echo "<input type=\"text\" id=\"amount3\" style=\"border: 0; color: #f6931f; background-color: #eeeeee; font-weight: bold;\" />";
			echo "<div id=\"slider-range3\"></div>";
			echo "<p>Date: <input type=\"text\" id=\"datepicker1\" /></p><br>";
			echo "<label for=\"location\">Location</label><br>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
			
		echo "</form>";
		?>
		<script>
		$( "#spinner4" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#slider-range3" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [15, 23],
				slide: function( event, ui ) {
					$( "#amount3" ).val( ui.values[ 0 ] +  " - " +  ui.values[ 1 ] );
				}
			});
			$( "#amount3" ).val($( "#slider-range3" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
		});
		$(function() {
			$( "#datepicker1" ).datepicker({
				changeMonth: true,
				changeYear: true
			});
		})
		</script>
	<?php
	echo "</div>";
	
	//new newspaper
	echo "<div id=\"dialog5\" title=\"Add New Newspaper\">";
		echo "<form>";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner5\">Release Year: </label>";
			echo "<input id=\"spinner5\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"amount4\">Audience: </label>";
			echo "<input type=\"text\" id=\"amount4\" style=\"border: 0; color: #f6931f; background-color: #eeeeee; font-weight: bold;\" />";
			echo "<div id=\"slider-range4\"></div>";
			echo "<p>Date: <input type=\"text\" id=\"datepicker\" /></p><br>";
			echo "<label for=\"location\">Location: </label>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br><br>";
		echo "</form>";
		?>
		<script>
		$( "#spinner5" ).spinner({
			min: 1900,
			max: 2100,
			step: 1
		});
		$(function() {
			$( "#slider-range4" ).slider({
				range: true,
				min: 0,
				max: 30,
				values: [15, 23],
				slide: function( event, ui ) {
					$( "#amount4" ).val( ui.values[ 0 ] +  " - " +  ui.values[ 1 ] );
				}
			});
			$( "#amount4" ).val($( "#slider-range4" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
		});
		 $(function() {
			$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true
			});
		})
		</script>
	<?php
	echo "</div>";
	
	//new item instance
	echo "<div id=\"dialog6\" title=\"Add Item Instance\">";
		echo "<form>";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name\">Stock Number: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"year\">Library Code: </label>";
			echo "<input type =\"text\" name=\"year\" id=\"year\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre\">Status: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
		echo "</form>";
	echo "</div>";

?>
<script>
	$( "#dialog" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400,
		buttons:{ "OK": function(){
				$( this ).dialog( "close" );
		}}});
	$( "#add1" ).click(function() {
		$( "#dialog" ).dialog( "open" );
	});
	$( "#dialog2" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400,
		buttons:{ "OK": function(){
				$( this ).dialog( "close" );
		}}});
	$( "#add2" ).click(function() {
		$( "#dialog2" ).dialog( "open" );
	});
	$( "#dialog3" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400,
		buttons:{ "OK": function(){
				$( this ).dialog( "close" );
		}}});
	$( "#add3" ).click(function() {
		$( "#dialog3" ).dialog( "open" );
	});
	$( "#dialog4" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400,
		buttons:{ "OK": function(){
				$( this ).dialog( "close" );
		}}});
	$( "#add4" ).click(function() {
		$( "#dialog4" ).dialog( "open" );
	});
	$( "#dialog5" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400,
		buttons:{ "OK": function(){
				$( this ).dialog( "close" );
		}}});
	$( "#add5" ).click(function() {
		$( "#dialog5" ).dialog( "open" );
	})
	$( "#dialog6" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 400,
		buttons:{ "OK": function(){
				$( this ).dialog( "close" );
		}}});
	$( "#update2" ).click(function() {
		$( "#dialog6" ).dialog( "open" );
	});
</script>
