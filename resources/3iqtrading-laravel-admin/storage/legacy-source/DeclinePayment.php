<?php 
include('../Connect.php');

$AmountToWithdraw=$_POST['Amount'];
$Investor_id=$_POST['Investor_id'];
$id=$_POST['id'];
$Status=2;
$Date= date(" l d F Y ");

 $sql="SELECT * FROM withdrawals WHERE id='$id' AND Amount_Withdrawn='$AmountToWithdraw' ";
 $query=mysqli_query($Conn, $sql);
 $row=mysqli_fetch_array($query, MYSQLI_ASSOC);

if($query){

	  $Dec="update withdrawals set Status='3', Date='$Date' where Investor_id='$Investor_id' AND id='$id'";
	  $query2=mysqli_query($Conn, $Dec);
		 
if($query2){
echo 1;
$UserDet="select Fin_Asset from investors where Investor_id='$Investor_id'";
$bind=mysqli_query($Conn, $UserDet);
$row=mysqli_fetch_array($bind, MYSQLI_ASSOC);
$currentBal=$row['Fin_Asset'];
$newBal=$currentBal+$AmountToWithdraw;
$Refund="update investors set Fin_Asset='$newBal' where Investor_id='$Investor_id' AND Investor_id='$Investor_id'";
$bind2=mysqli_query($Conn, $Refund);
}else{
echo 0;
}
	  }

?>