<?php
include('../Connect.php');
$Ref_id=$_POST['Investor_id'];
$User_id=$_POST['Investor_id'];
$Refferal_Earnings=$_POST['Amount'];
$Name=$_POST['Name'];

$Status=1;
$insert="insert into refferals (Refferer,  User_toLoad, Name, Refferal_Earnings, Status) values ('$Ref_id', '$User_id', '$Name', '$Refferal_Earnings', '$Status')";
$check=mysqli_query($Conn, $insert);
if($check){
    echo 1;
}else{
    echo 0;
}





?>