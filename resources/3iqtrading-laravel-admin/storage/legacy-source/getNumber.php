<?php
session_start();
include('../Connect.php');
$Boss_id=$_SESSION['Boss_id'];
$sql="select Phone from WhatsApp";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);

$Phone=$row['Phone'];
echo $Phone;

?>