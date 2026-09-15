<?php 

include('../Connect.php');
$Post_id=$_POST['Post_id']; 
$sql="SELECT * FROM menuitems WHERE HasChildren=0";
$query=mysqli_query($Conn, $sql);
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){

	$output= '<option style="padding: 10px;" value="'.$row['Menu'].'">'.$row['Menu'].'</option>';
		echo $output;


}

?>

