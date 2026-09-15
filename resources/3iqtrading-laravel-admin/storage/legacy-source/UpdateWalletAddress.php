<?php include('../Connect.php');
$Billing=$_POST['Billing'];
$WalletAddress=$_POST['WalletAddress'];
if($Billing==1){
$sql="UPDATE walletaddress SET WalletAddress='$WalletAddress'WHERE Billing=1";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 'Updated Successfully';
}else{
		echo 'Error somewhere'.mysqli_error();

}
	
}elseif($Billing==2){
$sql="UPDATE walletaddress SET WalletAddress='$WalletAddress' WHERE Billing=2";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 'Updated Successfully';
}else{
		echo 'Error somewhere'.mysqli_error();

}
	
}

?>