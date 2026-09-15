<?php
session_start();
include("../Connect.php");
$id=1;

$Phonenumber=$_POST['What'];

$sql="update whatsapp set Phone='$Phonenumber' where id='$id'";
$query=mysqli_query($Conn, $sql);
if($query){
   echo 1; 
}else{
    echo 0;
}

?>