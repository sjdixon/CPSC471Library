
<a Href=" " <label> Login </label> </a> 


<div id="parent">
	<p>Catalogue</p>
	<select id="combobox">
		<option value="">Type</option>
		<option value="Book">Book</option>
		<option value="Audio">Audio</option>
		<option value="Video">Video</option>
		<option value="Newspaper">Newspaper</option>
		<option value="Magazine">Magazine</option>
	</select>
    <input  id="Search" value1=""/>
    <select id="combobox">
		<option value1="">Select one...</option>
		<option value1="Title">Title</option>
		<option value1="year">Year</option>
		<option value1="Asp">Genre</option>
		<option value1="libraryId">Book Code</option>
	</select>
	<button type = "button" id="Search">Search</button>
</div>

<script>
	$( "button" ).button();
	$(function() {
		$( ".radioset").buttonset();
	});
</script> 