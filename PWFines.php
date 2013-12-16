<?php
    $host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";					
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        foreach($_POST['check'] as $fineNo){
        
        $fineData=mysql_query("Select * From Fine Where fineNo='$fineNo'");  
        
        while($row=mysql_fetch_assoc($fineData))
        {
           $pay=$_POST['payment'];
           $payment=intval($pay);
           $wave=$_POST['waive'];
           $balance=$row['balance'];
           $bal=$balance-$pay-$wave;
            if($bal<0)
            { $bal=0;}
            
           $result=mysql_query("Update Fine Set balance='$bal', amountPaid='$payment', amountWaived='$wave' Where fineNo='$fineNo'");
            error_log(print_r($_REQUEST,true));
            if($result){
    echo "Success";
}
else{
    echo "Error in sending your user";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}


            $lId=$_POST['Handled'];
            $date=date('Y-m-d');
            mysql_query("Insert Into Fine_Updated_By Values(fineNo='$fineNo', libId='$lId', dateUpdated=$date");
            
        }}
        
        header("Location: PatronInformation.php");
        
?> 
       
