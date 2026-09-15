<?php 
include('../Connect.php');

$Amount=$_POST['Amount'];
$Investor_id=$_POST['Investor_id'];
$Status=1;
$Date= date(" l d F Y ");
$sql="insert into  deposits (Investor_id, Amount_Deposited, Status, Date) values ('$Investor_id','$Amount','$Status', '$Date')";
$query=mysqli_query($Conn, $sql);

$sql0="select * from investors where Investor_id='$Investor_id'";
$query0=mysqli_query($Conn, $sql0);
$row=mysqli_fetch_array($query0, MYSQLI_ASSOC);

$Total_deposit=$row['Total_Deposit'];
$newBalance=$Total_deposit+$Amount;
$update="update investors set Total_Deposit='$newBalance' where Investor_id='$Investor_id'";
$check=mysqli_query($Conn, $update);

$sql2="select * from refferals where User_toLoad='$Investor_id' and Status=0 ";
$check=mysqli_query($Conn, $sql2);
$row=mysqli_fetch_array($check, MYSQLI_ASSOC);
$Status=$row['Status'];
$Refferer=$row['Refferer'];
$UserToLoad=$row['User_toLoad'];

if($Status==0){
$Percentage=$Amount*10/100;
$update="update refferals set Refferal_Earnings='$Percentage', Status='1' where User_toLoad='$UserToLoad' ";
$done=mysqli_query($Conn, $update);

}

if($query){

echo "Account Loaded Successfully";
}else{
echo "Error somewherr".mysqli_error($Conn);
}


?>