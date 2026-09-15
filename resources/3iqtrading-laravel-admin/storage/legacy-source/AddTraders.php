<?php include('../Connect.php');

$name=$_POST['traders_name'];
$username=$_POST['username'];
$trader_id="3iq-trader/123";
$minimum_deposit=$_POST['minimum_deposit'];
$percentage=$_POST['percentage'];
$total_investors=$_POST['total_investors'];
$copy_fees=$_POST['copy_fees'];
	$type = explode('.', $_FILES['cover_photo']['name']);
	$type = $type[count($type) - 1];
$profile_photo = 'Resources/'.uniqid(rand()) . '.' . $type;

			if(move_uploaded_file($_FILES['cover_photo']['tmp_name'], $profile_photo)){
				// insert into database
			$sql="INSERT INTO copy_traders (trader_id, username, name,  profile_photo, minimum_deposit, return_on_copying, total_investors, fees)values('$trader_id', '$username', '$name', '$profile_photo', '$minimum_deposit', '$percentage', '$total_investors', '$copy_fees')";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 1;
}else{
	echo 0;
}
		
		
			}else{
			    echo 3;
			}

		




?>