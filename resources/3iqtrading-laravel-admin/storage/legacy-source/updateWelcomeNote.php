<?php 
include('../Connect.php');
$newNote=$_POST['newNote'];
$id=$_POST['id'];
$sql="Update welcomenote set note='$newNote' where id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "Welcome note updated successfully";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>