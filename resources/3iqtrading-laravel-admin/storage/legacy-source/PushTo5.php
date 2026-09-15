<?php 
include('../Connect.php');
$Five=$_POST['Five'];
$id=$_POST['id'];
$sql="Update investors set V_Status='$Five' where Investor_id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "Level 2 Verified";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>