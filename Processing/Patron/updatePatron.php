<?php
    $host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";		
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
    $pId=$_POST['id'];
    $name=$_POST['name'];
    $addr=$_POST['addr'];
    $pNo=$_POST['phone'];
    $email=$_POST['email'];
    $query="Update Patron set name='$name', address='$addr', email='$email', phone='$pNo' Where pAccount='$pId'";
    
    $result=mysql_query($query);
    error_log(print_r($_REQUEST,true));

if($result){
    echo "Your comment has been sent";
}
else{
    echo "Error in sending your comment";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

    header("Location: ../../PatronInformation.php");
?> 