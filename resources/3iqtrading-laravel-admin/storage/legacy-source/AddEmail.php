<?php
include('../Connect.php');

$email=$_POST['email'];
$Status=0;
$sql="insert into email (email, Status) Values ('$email', $Status)";
$query=mysqli_query($Conn, $sql);
if($query){
echo 1;
}else{
echo 0;
}

?>