<?php 
include('../Connect.php');

$Amount=$_POST['Amount'];
$Investor_id=$_POST['Investor_id'];
$sql="SELECT * FROM investors WHERE Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$currentAmount=$row['Fin_Asset'];
$newAmount=$currentAmount+$Amount;
if($query){
	$sql2="UPDATE investors SET Fin_Asset='$newAmount' WHERE Investor_id='$Investor_id'";
	$query2=mysqli_query($Conn, $sql2);
	if($query2){
		echo 1;
	}else{
		echo 0;
	}
}



?>