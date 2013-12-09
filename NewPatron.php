 <?php 
    $host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        
    $id=$_POST['pid']; $name=$_POST['name']; $email=$_POST['email']; $address=$_POST['address']; $phone=$_POST['phone'];   
    //$id=1030112311;
    $u="SELECT COUNT(*) FROM PATRON WHERE pAccount='$id'";
    $unique=mysql_query($u);
    $uni=mysql_fetch_row($unique);
    $unique=$uni[0]; 
    if($unique!=0)
    {
        header("Location: PatronTab.php");
    exit();
    }
    else{
    //Creates the expire date
    $t=time();
    $date=date_create(date("y-m-d", $t));
    $date=date_add($date,date_interval_create_from_date_string("1 year"));
    $expireDate=$date->format('Y-m-d H:i:s');
   
    
    $q="INSERT INTO Patron
    values ('$id', NULL, '$expireDate',false, '$name', '$address', '$phone', '$email')";
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

    
    header("Location: PatronTab.php");
    exit();
    }
    ?>
