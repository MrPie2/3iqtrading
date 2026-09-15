<?php session_start();
if(isset($_SESSION['Boss_id'])){
	session_destroy();
	header("Location:index.php");
}
?>