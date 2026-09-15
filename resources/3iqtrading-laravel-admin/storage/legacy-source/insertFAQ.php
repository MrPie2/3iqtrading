<?php 
include('../Connect.php');
$Question=$_POST['Question'];
$Answer=$_POST['Answer'];
$insert="INSERT INTO faq (Question, Answer) VALUES ('$Question','$Answer')";
$query=mysqli_query($Conn, $insert);
if($query){
		echo "<label class='text-success'>Inserted Successfully</label>";
}else{
	echo "<label class='text-danger'>Error somewher</label>".mysqli_error($Conn);
}

?>