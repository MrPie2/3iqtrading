<?php include('../Connect.php');
$id=$_POST['id'];
$table=$_POST['table'];
$sql="DELETE  FROM $table WHERE  Post_id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
	echo 1;
}else{
	echo 0;
}


?>

