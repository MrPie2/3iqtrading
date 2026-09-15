<?php 
include('../Connect.php');
$text=$_POST['text'];
$id=$_POST['id'];
$sql="Update investmentplans set Description='$text' where id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "Description updated successfully";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>