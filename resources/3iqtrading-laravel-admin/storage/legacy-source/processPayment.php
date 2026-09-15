<?php 
include('../Connect.php');

$AmountToWithdraw=$_POST['Amount'];
$Investor_id=$_POST['Investor_id'];
$id=$_POST['id'];
$Status=2;
$Date= date(" l d F Y ");

 $sql="SELECT * FROM withdrawals WHERE Investor_id='$Investor_id' AND Amount_Withdrawn='$AmountToWithdraw' ";
 $query=mysqli_query($Conn, $sql);
 $row=mysqli_fetch_array($query, MYSQLI_ASSOC);

if($query){

	  $Pay="update withdrawals set Status='2', Date='$Date' where Investor_id='$Investor_id' AND Amount_Withdrawn='$AmountToWithdraw'";
	  $query2=mysqli_query($Conn, $Pay);
		 


	  }

?>