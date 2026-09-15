<?php
include('../Connect.php');
$sql="TRUNCATE email";
$query=mysqli_query($Conn, $sql);
if($query){
echo 1;
}else{
echo 0;
}


?>