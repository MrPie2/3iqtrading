<?php 
include('../Connect.php');
$Token=$_POST['Token'];
$Investor_id=$_POST['Investor_id'];
$Status=0;
$insert="INSERT INTO autorization_token (Investor_id, token, status) VALUES ('$Investor_id','$Token', '$Status')";
$query=mysqli_query($Conn, $insert);
if($query){
		echo 1;
}else{
	echo 0;
}

?>