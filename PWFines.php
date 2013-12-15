<?php
        $host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        foreach($_POST['fine'] as $fineNo){
        $fineData=mysql_query("Select * From Fine Where fineNo='$fineNo'");  
        
        while($row=mysql_fetch_assoc($fineData))
        {
           $pay=$_POST['pay'];
           $wave=$_POST['waive'];
           $balance=$row['balance'];
           $bal=$balance-$pay-$wave;
            if($balance<0)
            { $balance=0;}
            $result=mysql_query("Update Fine Set balance='$bal', amountPaid='$pay', amountWaived='$wave' Where fineNo='$fineNo'");


            $lId=$_POST['handle'];
            $date=date('Y-m-d');
            mysql_query("Insert Into Fine_Updated_By Values(fineNo='2', libId='10', dateUpdated=$date");
            
        }}
        echo $pay;
        echo $wave;
        echo $bal;
        
?>
