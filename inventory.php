<!--<?php //include "App_Index.php"?>-->

<!--Script to generate main page and dialog pages to add and modify items in the library
// Gaby Comeau, Nov. 21, 2013
// Quick note that this function inherits Javascript and CSS libraries from App_Index.php-->	
	
	<p>Use this form to add a new item</p>
	<form>
		<div id="radio1" class="radioset">
			<input type="radio" id="add1" name="radio1" /><label for="add1">Book</label>
			<input type="radio" id="add2" name="radio1" /><label for="add2">Audio</label>
			<input type="radio" id="add3" name="radio1" /><label for="add3">Video</label>
			<input type="radio" id="add4" name="radio1" /><label for="add4">Magazine</label>
			<input type="radio" id="add5" name="radio1" /><label for="add5">Newspaper</label>
		</div>
	</form><br><br>
	
	<p>Use this form to return an item</p>
	<button id="returnBtn" name="returnBtn"> Return Item</button><br><br><br>
	
	<p>Use this form to modify an item or copy of an item</p>
	<form>
		<div id="radio2" class="radioset">
			<input type="radio" id="update1" name="radio2" /><label for="update1">Modify Item</label>
			<input type="radio" id="update2" name="radio2" /><label for="update2">Modify Item Instance</label>
		</div>
	</form><br><br>
	
	<p>Use this form to delete an item or item instance</p>
	<form>
		<div id="radio3" class="radioset">
			<input type="radio" id="delete1" name="radio3" /><label for="delete1">Delete Item</label>
			<input type="radio" id="delete2" name="radio3"/><label for="delete2">Delete Item Instance</label>
		</div>
	</form><br><br>

<script>
	$( "button" ).button();
	$(function() {
		$( ".radioset").buttonset();
	});
</script>

	<div id="dialog" title="Add New Book">
		<form id="bookForm" action="Processing/addBook.php" method="post">
			<!--Add new item information in the form below:-->
			<?php
			echo "<label for=\"name\">Title: </label>";
			echo "<input type =\"text\" name=\"name\" id=\"name\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"ISBN\">ISBN: </label>";
			echo "<input type =\"text\" name=\"ISBN\" id=\"ISBN\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"authorName\">Author: </label>";
			echo "<input type =\"text\" name=\"authorName\" id=\"authorName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner\">Release Year: </label>";
			echo "<input id=\"spinner\" name=\"spinner\" value=\"2013\" /><br><br>";
			echo "<label for=\"genre\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre\" id=\"genre\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience\">Audience: </label>";
			echo "<select id=\"audience\" name=\"audience\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Pre-Teens\">Pre-Teens</option>";
				echo "<option value=\"Young Adults\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
				echo "<option value=\"All Ages\">All Ages</option>"; 
			echo "</select><br><br>";	
			echo "<label for=\"location\">Location: </label>";
			echo "<input type =\"text\" name=\"location\" id=\"location\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"copies\">Number of copies: </label>";
			echo "<input id=\"copies\" name=\"copies\" value=\"1\" /><br><br>";
			echo "<input type=\"checkbox\" id=\"check\" name=\"isReference\"><label for=\"check\">Check for Reference Item</label><br><br>";	
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";?>
		</form>
		<script>
		$( "#spinner" ).spinner({
			min: 1700,
			max: 2100,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$( "#copies" ).spinner({
			min: 1,
			max: 500,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#check" ).button();
		});
		</script>	
	</div>
	<?php
	//new audio item form
	echo "<div id=\"dialog2\" title=\"Add New Audio Item\">";
		echo "<form action =\"Processing/addAudio.php\" method =\"post\">";
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
				echo "<option value=\"Pre-Teens\">Pre-Teens</option>";
				echo "<option value=\"Young Adults\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
				echo "<option value=\"All Ages\">All Ages</option>"; 
			echo "</select><br><br>";
			echo "<label for=\"location1\">Location: </label>";
			echo "<input type =\"text\" name=\"location1\" id=\"location1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"copies1\">Number of copies: </label>";
			echo "<input id=\"copies1\" name=\"copies1\" value=\"1\" /><br><br>";	
			echo "<input type=\"checkbox\" id=\"check1\" name=\"isReference1\"><label for=\"check\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner2" ).spinner({
			min: 1700,
			max: 2100,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$( "#copies1" ).spinner({
			min: 1,
			max: 500,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#check1" ).button();
		});
		</script>	
	<?php	
	echo "</div>";
	
	//new video item form
	echo "<div id=\"dialog3\" title=\"Add New Video Item\">";
		echo "<form action = \"Processing/addVideo.php\" method = \"post\">";
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
			echo "<select id=\"audience2\" name=\"audience2\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Pre-Teens\">Pre-Teens</option>";
				echo "<option value=\"Young Adults\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
				echo "<option value=\"All Ages\">All Ages</option>"; 
			echo "</select><br><br>";			
			echo "<label for=\"location2\">Location: </label>";
			echo "<input type =\"text\" name=\"location2\" id=\"location2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"copies2\">Number of copies: </label>";
			echo "<input id=\"copies2\" name=\"copies2\" value=\"1\" /><br><br>";;
			echo "<input type=\"checkbox\" id=\"check2\" name=\"isReference2\"><label for=\"check2\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner3" ).spinner({
			min: 1700,
			max: 2100,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$( "#copies2" ).spinner({
			min: 1,
			max: 500,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#check2" ).button();
		});
		</script>
	<?php
	echo "</div>";
	
	//new magazine
	echo "<div id=\"dialog4\" title=\"Add New Magazine\">";
		echo "<form action = \"Processing/addMagazine.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name3\">Title: </label>";
			echo "<input type =\"text\" name=\"name3\" id=\"name3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"subName\">Subtitle: </label>";
			echo "<input type =\"text\" name=\"subName\" id=\"subName\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner4\">Release Year: </label>";
			echo "<input id=\"spinner4\" name=\"spinner3\" value=\"2013\" /><br>";
			echo "<p> Issue: <input type=\"text\" id=\"datepicker1\" name =\"datepicker1\" /></p>";
			echo "<label for=\"pubName2\">Publisher: </label>";
			echo "<input type =\"text\" name=\"pubName2\" id=\"pubName2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre3\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre3\" id=\"genre3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience3\">Audience: </label>";
			echo "<select id=\"audience3\" name=\"audience3\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Pre-Teens\">Pre-Teens</option>";
				echo "<option value=\"Young Adults\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
				echo "<option value=\"All Ages\">All Ages</option>"; 
			echo "</select><br><br>";
			echo "<label for=\"location3\">Location:</label>";
			echo "<input type =\"text\" name=\"location3\" id=\"location3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"copies3\">Number of copies: </label>";
			echo "<input id=\"copies3\" name=\"copies3\" value=\"1\" /><br><br>";
			echo "<input type=\"checkbox\" id=\"check3\" name=\"isReference3\"><label for=\"check3\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner4" ).spinner({
			min: 1700,
			max: 2100,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#datepicker1" ).datepicker({
				changeMonth: true,
				changeYear: true
			}).bind("keydown", function (event) {
    		event.preventDefault();
			});
		});
		$( "#copies3" ).spinner({
			min: 1,
			max: 500,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#check3" ).button();
		});
		</script>
	<?php
	echo "</div>";
	
	//new newspaper
	echo "<div id=\"dialog5\" title=\"Add New Newspaper\">";
		echo "<form action = \"Processing/addNewspaper.php\" method = \"post\">";
			echo "<!--Add new item information in the form below:-->";
			echo "<label for=\"name4\">Title: </label>";
			echo "<input type =\"text\" name=\"name4\" id=\"name4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"spinner5\">Release Year: </label>";
			echo "<input id=\"spinner5\" name=\"spinner4\" value=\"2013\" /><br>";
			echo "<p> Issue: <input type=\"text\" id=\"datepicker\" name =\"datepicker\" /></p>";
			echo "<label for=\"pubName3\">Publisher: </label>";
			echo "<input type =\"text\" name=\"pubName3\" id=\"pubName3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"genre4\">Genre: </label>";
			echo "<input type =\"text\" name=\"genre4\" id=\"genre4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"audience4\">Audience: </label>";
			echo "<select id=\"audience4\" name=\"audience4\">";
				echo "<option value=\"\">Select Type</option>";
				echo "<option value=\"Early Childhood\">Early Childhood</option>";
				echo "<option value=\"Children\">Children</option>";
				echo "<option value=\"Pre-Teens\">Pre-Teens</option>";
				echo "<option value=\"Young Adults\">Teens/Young Adults</option>";
				echo "<option value=\"Adults\">Adults</option>";
				echo "<option value=\"All Ages\">All Ages</option>"; 
			echo "</select><br><br>";
			echo "<label for=\"location4\">Location: </label>";
			echo "<input type =\"text\" name=\"location4\" id=\"location4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"copies4\">Number of copies: </label>";
			echo "<input id=\"copies4\" name=\"copies4\" value=\"1\" /><br><br>";;
			echo "<input type=\"checkbox\" id=\"check4\" name=\"isReference4\"><label for=\"check4\">Check for Reference Item</label><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
		?>
		<script>
		$( "#spinner5" ).spinner({
			min: 1700,
			max: 2100,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true
			}).bind("keydown", function (event) {
    		event.preventDefault();
			});
		});
		$( "#copies4" ).spinner({
			min: 1,
			max: 500,
			step: 1
		}).bind("keydown", function (event) {
    		event.preventDefault();
		});
		$(function() {
			$( "#check4" ).button();
		});
		</script>
	<?php
	echo "</div>";
	
	//modify item instance
	echo "<div id=\"dialog7\" title=\"Modify Copy\">";
		echo "<form id = \"modifyCopy\" action=\"Processing/modifyInstance.php\" method=\"post\">";
			echo "<!--Modify info in the form below:-->";
			echo "<label for=\"lCode1\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode1\" id=\"lCode1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"stockNum1\">Stock Number: </label>";
			echo "<input type =\"text\" name=\"stockNum1\" id=\"stockNum1\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"status1\">Status: </label>";
			echo "<select id=\"status1\" name=\"status1\">";
				echo "<option value=\"\">Select Status</option>";
				echo "<option value=\"available\">In Circulation</option>";
				echo "<option value=\"missing\">Missing</option>"; 
				echo "<option value=\"damaged\">Damaged</option>"; 
			echo "</select><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
	echo "</div>";
	
	//delete item instance
	echo "<div id=\"dialog8\" title=\"Delete Copy\">";
		echo "<form action = \"Processing/deleteCopy.php\" method = \"post\">";
			echo "<!--Details on the instance to be deleted:-->";
			echo "<label for=\"lCode2\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode2\" id=\"lCode2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<label for=\"stockNum2\">Stock Number: </label>";
			echo "<input type =\"text\" name=\"stockNum2\" id=\"stockNum2\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
	echo "</div>";
	
	//delete item
	echo "<div id=\"dialog9\" title=\"Delete Item\">";
		echo "<form action=\"Processing/deleteItem.php\" method = \"post\">";
			echo "<!--Info on the item to be deleted:-->";
			echo "<label for=\"lCode3\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode3\" id=\"lCode3\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";
		echo "</form>";
	echo "</div>";
	
	//modify item
	echo "<div id=\"dialog10\" title=\"Modify\">";
		echo "<form id = \"modify\" name = \"modify\" action=\"Processing/modifyItem.php\" method=\"post\">";
			echo "<!--Modify info in the form below:-->";
			echo "<label for=\"lCode4\">Library Code: </label>";
			echo "<input type =\"text\" name=\"lCode4\" id=\"lCode4\" class=\"text ui-widget-content ui-corner-all\" /><br><br>";
			echo "<button type=\"button\" id=\"getItem\" name=\"getItem\">Get Item Info</button>";
			echo "</form>";
			//Fun with Ajax goes here!
			?>
			<script type="text/javascript">
			
			$("#getItem").click(function getItem(){
				var id = document.getElementById("lCode4").value;
				if (id =="") {
  					alert("You must enter an id!");
  					
  				}
  				else {
 					xmlhttp=new XMLHttpRequest();
					xmlhttp.onreadystatechange=function(){
  						if (xmlhttp.readyState==4 && xmlhttp.status==200){
    							document.getElementById("modify").innerHTML=xmlhttp.responseText;
								// trigger an artificial click event
    							$("#modify").click(function initNewElements(){
    								$( "#spinner6" ).spinner({
										min: 1700,
										max: 2100,
										step: 1
									}).bind("keydown", function (event) {
    									event.preventDefault();
									});
									$(function() {
										$( "#datepicker2" ).datepicker({
											changeMonth: true,
											changeYear: true
										}).bind("keydown", function (event) {
 			   							event.preventDefault();
										});
									});
									$( "#copies5" ).spinner({
										min: 1,
										max: 500,
										step: 1
									}).bind("keydown", function (event) {
  		 								event.preventDefault();
									});
									$(function() {
										$( "#check5" ).button();
									});
    						});
    						$("#modify").trigger("click");
    					}
  					}
					xmlhttp.open("GET","Processing/getItem.php?libID="+id,true);
					xmlhttp.send();
				}
			});	
			</script>
		<?php 	
		
	echo "</div>";
	?>
	<div id="return" title="Return Loaned Item" class="ui-widget">
            <form id="returnForm" method="post" action="Processing/Loans/returnItem.php">
                
                    <label for="returrnedLibraryCode"> Library Code: </label>
                    <input id="returnedLibraryCode" name="libraryCode"> <br/>
                    <label for="stock"> Stock# </label>
                    <input id="stocknum" name="stocknum" type="text"><br/>
                    
                    <label for="state">Action </label>
                    <select id="state" name="state">
                        <option value="OK"> Return Item</option>
                        <option value="Damaged"> Return & Mark as Damaged</option>
                        <option value="Discard"> Return & Mark as Discard</option>
                    </select>
            </form>
        </div>

<script type="text/javascript">
	$( "#dialog" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 500
	});	
	$( "#add1" ).click(function() {
		$( "#dialog" ).dialog( "open" );
	});
	$( "#dialog2" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 500
	});	
	$( "#add2" ).click(function() {
		$( "#dialog2" ).dialog( "open" );
	});
	$( "#dialog3" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 500
	});	
	$( "#add3" ).click(function() {
		$( "#dialog3" ).dialog( "open" );
	});
	$( "#dialog4" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 500
	});	
	$( "#add4" ).click(function() {
		$( "#dialog4" ).dialog( "open" );
	});
	$( "#dialog5" ).dialog({ 
		autoOpen: false, 
		modal: true,
		width: 500
	});
	$( "#add5" ).click(function() {
		$( "#dialog5" ).dialog( "open" );
	});
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
	$("#return").dialog({
     	autoOpen: false,
		height: 250,
		width: 800,
		modal: true,
		buttons: {
			"Return Item and Keep Window Open": function() {
				$("form#returnForm").submit();
			},
			"Return Item and Close": function(){
				$("form#returnForm").submit();
				$(this).dialog("close");
                            
			},
			"Close Window": function() {
				$(this).dialog("close");
			}
		}
	});
	$("#returnBtn").button().click(function(){
		$("#return").dialog("open");
	});

</script>
