<?php include('../Connect.php');

$Parent=$_POST['id'];
$Amount=$_POST['Amount'];
$Profit=$_POST['Profit'];
$Duration=$_POST['Duration'];
$sql="INSERT INTO investmentplans (Amount, Profit, Parent, Duration)values('$Amount', '$Profit', '$Parent','$Duration')";
$query=mysqli_query($Conn, $sql);
if($query){
	echo "<div class='alert alert-success'>Price added successfully</div>";
}else{
	echo "<div class='alert alert-danger'>Could not add plan</div>";
}


?>