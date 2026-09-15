<?php include('../Connect.php');
$id=$_POST['id'];
$Amount=$_POST['Amount_Invested'];
$Investor_id=$_POST['Investor_id'];

$sql="update  contracts set Status='3' WHERE  id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
	echo 1;
	
$UserDet="select Total_Deposit from investors where Investor_id='$Investor_id'";
$bind=mysqli_query($Conn, $UserDet);
$row=mysqli_fetch_array($bind, MYSQLI_ASSOC);
$currentBal=$row['Total_Deposit'];
$newBal=$currentBal+$Amount;
$Refund="update investors set Total_Deposit='$newBal' where Investor_id='$Investor_id'";
$bind2=mysqli_query($Conn, $Refund);
}else{
	echo 0;
}


?>

