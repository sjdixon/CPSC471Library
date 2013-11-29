<script>
$(function() {
$( "#selected" ).buttonset();
});
</script>

<div id="selected">
<input type="checkbox" id="check1">
</div>

<div>
    <input type="text" name="inlineSeact" id="iSearch" value="" class="text ui-widget-content ui-corner-all">
    <Button id="filter" title="Search">Search</button>
    <button id="add" tilte="Add">Add</button>
    <button id="Remove" tilte="Remove">Remove</button>
</div>
<div id="users-contain" class="ui-widget">
<h1></h1>
<table id="users" class="ui-widget ui-widget-content">
<thead>
<tr class="ui-widget-header ">
<th></th>
<th>AccountNo</th>
<th>Name</th>
<th>Expires</th>
<th>User Profile</th>
</tr>
</thead>
<tbody>
<tr>
<td><div id="selected">
     <input type="checkbox" id="check1">
    </div>
</td>
<td>""</td>
<td>""</td>
<td>""</td>
<td>
    <a href="PatronInformation.php"><button>View</button></a>
</td>
</tr>
</tbody>
</table>
</div>
