<?php 
include('../Connect.php');
$siteAddressText=$_POST['siteAddressText'];
$id=$_POST['id'];
$sql="Update siteaddress set address='$siteAddressText' where id='$id'";
$query=mysqli_query($Conn, $sql);

if($query){
echo "Site address updated successfully";
}else{
echo "Could not update".mysqli_error($Conn);
}



?>