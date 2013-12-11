
<?php
<!Create by Rhianne Hadfield>

$patronId=$_POST['pAccount'];
setcookie('patronAccount', $patronId);
header("Location: patronInformation.php");

?>
