<?php
include('../Connect.php');
$Investor_id=$_POST['id'];
$Account_Type=$_POST['Account_Type'];
$sql="update investors SET Account_Type='$Account_Type' where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
if($query){
    echo 1;
}else{
    echo 0;
}

?>