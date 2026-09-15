<?php 
include('../Connect.php');
//$Investor_id=$_GET['Investor_id'];
$sql="SELECT * FROM contracts WHERE Investor_id=1 AND Status=0";
$query=mysqli_query($Conn, $sql);
$Count=mysqli_num_rows($query);

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
echo "Hello Isreal

We received your application to invest through our Bitcoin Trading Platform

Contract ID: ".$row['Contract_id']."

Your Exchange Link is:
9742984iouo479234ouiurwe7394. 

You are to pay $".$row['Amount']." worth of bitcoin to your Exchange Link and send a copy of your payment receipt to your agent for Approval.

Note: You are not entitled to any profits until this contract has been approved by your Agent

Thanks for investing with us";
	
}
?>