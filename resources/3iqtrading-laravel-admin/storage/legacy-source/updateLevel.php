<?php 
include('../Connect.php');
$newLevel=$_POST['newLevel'];
$newLevel=$_POST['id'];

$Investor_id=$_POST['Investor_id'];
$sql="Update investors set V_Status='$newLevel' where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);

if($query){
    $sql="Update VerificationDocs set Status='1' where Investor_id='$Investor_id' and Level='$newLevel'";
$query=mysqli_query($Conn, $sql);
echo 1;
}else{
echo 0;
}



?>