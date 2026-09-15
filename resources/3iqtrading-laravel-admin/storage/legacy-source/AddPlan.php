<?php include('../Connect.php');

$Plan_Name=$_POST['Plan_Name'];
$Description=$_POST['Description'];
$Minimum=$_POST['Minimum'];
$Maximum=$_POST['Maximum'];
$Percentage=$_POST['Percentage'];
$Duration=$_POST['Duration'];
$Spread=$_POST['Spread'];
$Support="Yes";

	
			// insert into database
			$sql="INSERT INTO investmentplans (Plan_Name, Description, Duration, Minimum, Maximum, Percentage, Spread, Support)values('$Plan_Name', '$Description','$Duration', '$Minimum', '$Maximum', '$Percentage', '$Spread', '$Support')";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 1;
}else{
	echo 0;
}
		
		





?>