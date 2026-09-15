<?php 
session_start();
include('../Connect.php');
$id=$_POST['id'];
$Userid=$_POST['Userid'];
$sql="SELECT * FROM contracts WHERE Investor_id='$Userid' AND id='$id'";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$interest=$row['ROI'];
if($query){
	
$sql2="SELECT * FROM investors WHERE Investor_id='$Userid'";
$query2=mysqli_query($Conn, $sql2);
$row2=mysqli_fetch_array($query2, MYSQLI_ASSOC);
$Fin_Asset=$row2['Fin_Asset'];
$newBalance= $Fin_Asset+$interest;
$update="UPDATE investors SET  Fin_Asset='$newBalance' WHERE Investor_id='$Userid'";
$query2=mysqli_query($Conn, $update);
if($query2){
echo 'Settled';
$delete="UPDATE  contracts SET Status = 2 WHERE  Investor_id='$Userid' AND id='$id'";
$deleted=mysqli_query($Conn, $delete);
}else{
	echo "Could not settle this contract",mysqli_error($Conn);
}
}else{
	echo "Error somewhere";
}
?>