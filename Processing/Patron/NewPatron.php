 <?php 
    $host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";			
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        
    $id=$_POST['pid'];
    $name=$_POST['name']; 
    $email=$_POST['email']; 
    $address=$_POST['address']; 
    $phone=$_POST['phone'];   
    $u="SELECT * FROM PATRON WHERE pAccount='$id'";
    $uni=mysql_fetch_row($u);
    if($uni!=0)
    {
    header("Location: ../../App_Index.php");
    exit();
    }
    else{
    //Creates the expire date
    
    $expireDate=date('Y-m-d', strtotime("+365 day"));
    $q="INSERT INTO Patron values ('$id', NULL, '$expireDate' ,false, '$name', '$address', '$phone', '$email')";
    $result = mysql_query($q);
error_log(print_r($_REQUEST,true));

if($result){
    echo "Your comment has been sent";
}
else{
    echo "Error in sending your comment";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

    
   header("Location: ../../App_Index.php");
   exit();
    }
    ?>
