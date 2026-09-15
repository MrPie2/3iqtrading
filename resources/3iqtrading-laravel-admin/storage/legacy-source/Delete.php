<?php include('../Connect.php');
$User_id=$_POST['Userid'];
$sql="DELETE  FROM investors WHERE  Investor_id='$User_id'";
$query=mysqli_query($Conn, $sql);

if($query){
	echo "User deleted";
}else{
	echo "Could not delete user".mysqli_error($Conn);
}


?>

