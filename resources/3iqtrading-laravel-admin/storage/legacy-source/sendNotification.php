<?php
session_start();
include('../Connect.php');
$Investor_id=$_POST['Investor_id'];
$seen=0;
$Text=$_POST['notText'];
$Subject=$_POST['notSubject'];
$sql="insert into notification (Investor_id, seen, Subject, Text) values('$Investor_id', '$seen', '$Subject', '$Text')";
$query=mysqli_query($Conn, $sql);
if($query){
echo 1;
}else{
echo 0;

}

?>