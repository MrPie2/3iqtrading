<?php include('../Connect.php');
$id=$_POST['id'];
$BOP=$_POST['BOP'];
$sql="UPDATE walletaddress SET Priority=1 WHERE id='$id'";
$query=mysqli_query($Conn, $sql);
if($query){
	$sql1="UPDATE walletaddress SET Priority=0 WHERE id!='$id' AND Wallet_Type='$BOP'";
$query2=mysqli_query($Conn, $sql1);
}else{
}


?>