<?php
		echo "<p>Use this form to add a new item</p>";
		echo "<button type=\"button\" id = \"b1\" >Add New Item</button><br><br><br>";
		echo "<p>Use this form to add another copy of an already existing item</p>";
		echo "<button type=\"button\">Add Item Instance</button>";
		?>
		<script>
			$( "button" ).button();
		</script>
		<?php
		echo "<div id=\"dialog\" title=\"Add New Item\">";
		echo "<!--Add new item information in the form below:-->";
		echo "<label for=\"name\">Title</label><br>";
		echo "<label for=\"year\">Release Year</label><br>";
		echo "<label for=\"genre\">Genre</label><br>";
		echo "<label for=\"audience\">Audience</label><br>";
		echo "<label for=\"location\">Location</label><br><br>";
		echo "<button type=\"button\">OK</button>";
		
		
		
		echo "</div>";
		?>
		<script>
		$( "#dialog" ).dialog({ autoOpen: false, modal: true });
		$( "#b1" ).click(function() {
			$( "#dialog" ).dialog( "open" );
		});
		</script>
