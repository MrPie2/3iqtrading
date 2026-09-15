<?php 
include('../Connect.php');
$newContent=$_POST['newContent'];
$id=$_POST['id'];
$sql="Update aboutus set aboutus='$newContent' where id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "About us updated successfully";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>