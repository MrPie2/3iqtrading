<?php include('../Connect.php');
$Faq_id=$_POST['FaqID'];
$sql="DELETE  FROM faq WHERE  id='$Faq_id'";
$query=mysqli_query($Conn, $sql);

if($query){
	echo "Deleted successfully";
}else{
	echo "Could not delete user".mysqli_error($Conn);
}


?>

