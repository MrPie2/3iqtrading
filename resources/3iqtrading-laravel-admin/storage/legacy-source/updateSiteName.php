<?php 
include('../Connect.php');
$newname=$_POST['newname'];
$id=$_POST['id'];
$sql="Update sitename set sitename='$newname' where id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "Site name updated successfully";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>