<!Create by Rhianne Hadfield>
<?php

$patronId=$_POST['pAccount'];
setcookie('patronAccount', $patronId, time()+1800);
header("Location: PatronInformation.php");

?>
