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
           $payment=$_POST['payment'];
           $waive=$_POST['waive'];
           $balance=$row['balance'];
           $bal=$balance-$payment-$waive;
          
            if($bal<0)
            { $bal=0;}
            
            mysql_query("Update Fine Set balance='$bal' Where fineNo='$fineNo'");

            $lId=$_POST['Handled'];
            $date=date('Y-m-d');
            mysql_query("Insert Into Fine_Updated_By Values(fineNo='$fineNo', libId='$lId', dateUpdated=$date");
            
        }}
        
       
        
?> 
       
