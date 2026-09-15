<?php 
include('../Connect.php');
session_start();

$Level=$_POST['Level'];
$Max_Deposit=$_POST['Max_Deposit'];
$Max_Withdrawal=$_POST['Max_Withdrawal'];
$Requirements=$_POST['Requirement_Text'];
$Controls=$_POST['Controls'];

$sql="insert into verification (Level, Deposit_Limit, Withdrawal_Limit, Requirement, Controls) values ('$Level', '$Max_Deposit', '$Max_Withdrawal', '$Requirements', '$Controls')";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 1;
}else{
	echo 0;
}

?>