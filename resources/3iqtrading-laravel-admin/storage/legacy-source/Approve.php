<?php 
include('../Connect.php');

$id=$_POST['id'];
$sql="UPDATE contracts set Status=1 WHERE id=$id";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 'Approved';
}else{
	echo "error somewher".mysqli_error();
}


?>