<?php include('../Connect.php');
$id=$_POST['id'];
$sql="DELETE  FROM autorization_token WHERE  id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
	echo 1;
}else{
	echo 0;
}


?>

