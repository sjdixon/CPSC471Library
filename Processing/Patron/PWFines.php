<?php
    
    session_start();
        // If the user is not logged then the user will be set to the main page
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
          if($_SESSION["loggedIn"] !=1)
          {
              header("Location: MainPage.php");
          }
        }
        else{
            header("Location: MainPage.php");
        }

    include '../../Headers/dbConnect.php';
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
            
            $lUser=$_POST['Handled'];
            $libraryId=  mysql_query("Select id from Librarian Where username='$lUser'");
            
            $date=date('Y-m-d');
            while($lId=mysql_fetch_assoc($libraryId)){
                $id=$lId['id'];
                mysql_query("Insert Into Fine_Updated_By Values(fineNo='$fineNo', id='$id', dateUpdated=$date");
                
            }
            
        }}
        header("Location: ../../PatronInformation.php");
       
        
?> 
       
