<?php
session_start();
include('../Connect.php');
$Client_id=$_POST['Client_id'];
$Text_message=$_POST['text_message'];
$Agent_id=$_SESSION['id'];
$insert="insert into chats (Sender, Receiver, Message, Relation) value ('$Agent_id',  '$Client_id', '$Text_message','$Client_id')";
$query=mysqli_query($Conn, $insert);
?>
