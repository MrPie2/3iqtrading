<?php
include('../Connect.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
	$Username=mysqli_real_escape_string($Conn, $_POST['Username']);
	$Pass=mysqli_real_escape_string($Conn, $_POST['Password']);
	$sql="SELECT * from og WHERE Username='$Username' AND Password='$Pass'";
	$query=mysqli_query($Conn, $sql);
	
	$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
	//$curLoginCount=$row['LoginCount'];
	//$NewCount=$curLoginCount+1;
	$BossID=$row['id'];
	//$UpdateLoginCount="UPDATE investors SET LoginCount='$NewCount' WHERE Investor_id='$userID'";
	//$checkErr=mysqli_query($Conn, $UpdateLoginCount);
	$Phone=$row['Phone'];
	$Og_Name=$row['Boss_Name'];
	
	if($BossID>0){

		session_start();
		$_SESSION['Boss_id']=$BossID;
		$_SESSION['Phone']=$Phone;
		$_SESSION['Boss_Name']=$Og_Name;
		echo 1;
	}else{
		echo '<div class="alert alert-danger">Phone or Password incorrect</div>';
	}
}


 ?>