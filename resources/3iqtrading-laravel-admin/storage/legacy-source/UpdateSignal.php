<?php
include('../Connect.php');
$Investor_id=$_POST['id'];
$signal=$_POST['signal'];
$sql="update investors SET signals='$signal' where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
if($query){
    echo 1;
}else{
    echo 0;
}

?>