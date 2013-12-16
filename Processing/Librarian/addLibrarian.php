<?php
mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library");

$name=$_POST['name'];
$username=$_POST['username'];
$numIds = mysql_query("SELECT COUNT(l.id) from Librarian l");
$currentId = mysql_fetch_row($numIds);
$id = $currentId[0] + 1;
$query = "INSERT INTO Librarian values ('$id','$name', curdate(), NULL, '$username')";
$result = mysql_query($query);
error_log(print_r($_REQUEST,true));

if($result){
    echo "Success";
}
else{
    echo "Error in sending your user";
      	echo "could not insert into Librarian table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

   header("Location: ../../App_Index.php");
   exit();
?>
