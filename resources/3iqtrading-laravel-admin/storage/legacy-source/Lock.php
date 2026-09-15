<?php
include('../Connect.php');
$User_id=$_POST['User_id']; 
$Lock=$_POST['Lock'];
$sql="update investors set LockStatus='$Lock' where Investor_id='$User_id'";
$query=mysqli_query($Conn, $sql);
if($query){
echo 1;
}else{
echo 0;
}


?>