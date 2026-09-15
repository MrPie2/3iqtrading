<?php

include('../Connect.php');
$id=$_POST['id'];
$sql="delete from verification where id='$id'";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 1;
}else{
	echo "error".mysali_error($Conn);
}
?>