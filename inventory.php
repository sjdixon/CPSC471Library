<?php
		echo "<p>Use this form to add a new item</p>";
		echo "<button type=\"button\" id = \"b1\" >Add New Item</button><br><br><br>";
		echo "<p>Use this form to add another copy of an already existing item</p>";
		echo "<button type=\"button\">Add Item Instance</button>";
		?>
		<script>
			$( "button" ).button();
		</script>
		<div id="dialog" title="Add New Item">HTML to add new item will go here</div>
		<script>
		$( "#dialog" ).dialog({ autoOpen: false, modal: true });
		$( "#b1" ).click(function() {
			$( "#dialog" ).dialog( "open" );
		});
