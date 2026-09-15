<?php 
include('../Connect.php');
$newLevel=1;
$Investor_id=$_POST['id'];
$sql="Update investors set V_Status='$newLevel' where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);

if($query){
  
echo 1;
}else{
echo 0;
}



?>