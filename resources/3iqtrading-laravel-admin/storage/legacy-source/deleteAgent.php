<?php include('../Connect.php');
$id=$_POST['id'];
$sql="DELETE  FROM agent WHERE  id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
	echo "Agent deleted";
}else{
	echo "Could not delete user".mysqli_error($Conn);
}


?>

