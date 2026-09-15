<?php
include('../Connect.php');
$id=$_POST['id'];
$User_id=$_POST['Investor_id'];
$Refferal_Earnings=$_POST['Amount'];
$Status=1;
$insert="update refferals SET Refferal_Earnings='$Refferal_Earnings', Status='$Status' where id='$id'";
$check=mysqli_query($Conn, $insert);
if($check){
    echo 1;
}else{
    echo 0;
}





?>