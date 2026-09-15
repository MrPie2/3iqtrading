<?php include('../Connect.php');
$id=$_POST['id'];
$sql="DELETE  FROM email WHERE  id='$id' ";
$query=mysqli_query($Conn, $sql);

if($query){
echo 1;
}else{
	echo 0;
}


?>

