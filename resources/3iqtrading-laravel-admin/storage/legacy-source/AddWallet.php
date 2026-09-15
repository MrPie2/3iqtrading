<?php 
session_start();
include('../Connect.php');

$WalletAddress=$_POST['WalletAddress'];
$id=$_POST['id'];
$BOP=$_POST['BOP'];
$Network=$_POST['Network'];
$Investor_id=$_POST['Investor_id'];
$sql="INSERT INTO walletaddress (WalletAddress, Network, Wallet_Type)values('$WalletAddress', '$Network','$BOP')";
$query=mysqli_query($Conn, $sql);
if($query){
	echo "Wallet Address added successfully";
}else{
	echo "Could not add wallet";
}


?>