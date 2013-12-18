<?php
/*
 * Page Created by Rhianne Hadfield
 */
       $server = mysql_connect("localhost", "ubuntu", "stephen123");
       $db = mysql_select_db("library", $server);
       $bookList= mysql_query("Select * From Hold Where expiryDate = CURDATE()");
     
        while($row=mysql_fetch_assoc($bookList)){
              $accountNo = $row['pAccount'];
              $itemCode = $row['libraryCode'];
              $countFines=mysql_query("Select fineNo From Fine Where pAccout='$accountNo' And libraryCode='$itemCode' and Not balance='0'");
              if(mysql_num_rows($countFines)>0)
              {
                  $existingFines=mysql_query("Select fineNo From Fine Where pAccout='$accountNo' And libraryCode='$itemCode' and Not balance='0'");
                  while ($row1 = mysql_fetch_assoc($existingFines)) {
                      echo 1;
                      $fineNo=$row1['fineNo'];
                      $balance=$row1['balance'];
                      $bal=$balance+1;
                      mysql("Update Fine set balance='$bal' Where fineNo='$fineNo'");
                  }
              }
              else{
                  mysql_query("Insert Into Fine (pAccount, libraryCode, reason, dateFined, amountPaid, amountWaived, balance) Values('$accountNo','$itemCode', 'Hold', CURDATE(),'0', '0', '1')");   
                  }
              
        }
        //checks for overdue loans
        $loanlist = mysql_query("Select * FROM Loan Where dateDue < CURDATE()");
        
        while ($row = mysql_fetch_array($loanlist)) {
            
             $accountNo = $row['pAccount'];
             $itemCode = $row['libraryCode'];
             $stock = $row['stocknum'];
             $finecount=mysql_query("Select fineNo From Fine Where pAccount='$accountNo' And libraryCode='$itemCode' and stocknum='$stock' and Not balance='0'");
             
             if(mysql_num_rows($finecount)>0)
              {
                 
                 $existingFines=mysql_query("Select * From Fine Where pAccount='$accountNo' And libraryCode='$itemCode' and stocknum='$stock' and Not balance='0'");
                 echo 1;
                 while ($row1 = mysql_fetch_assoc($existingFines)) {
                      $fineNo=$row1['fineNo'];
                      $balance=$row1['balance'];
                      $bal=$balance+1;
                      mysql_query("Update Fine Set balance='$bal' Where fineNo='$fineNo'");
                 }
                
              }
              else{
                     
                     mysql_query("Insert Into Fine (pAccount, libraryCode, stocknum, reason, dateFined, amountPaid, amountWaived, balance) Values('$accountNo','$itemCode', '$stock','Loan', CURDATE(),'0', '0', '1')"); 
                     
              }
        }
        $true=true;
        mysql_query("Update Patron Set membershipExpired='$true' Where membershipExpiryDate < CURDATE()");
        header("Location: ../App_Index.php");
        
        ?>