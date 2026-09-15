<?php 
include('../Connect.php');
$Three=$_POST['Three'];
$id=$_POST['id'];
$sql="Update investors set V_Status='$Three' where Investor_id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "Success";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>