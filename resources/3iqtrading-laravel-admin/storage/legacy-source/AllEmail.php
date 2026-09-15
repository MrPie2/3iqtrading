
<?php
include('../Connect.php');
$Boss_id=$_SESSION['Boss_id'];
 $sql="select * from email";
$query=mysqli_query($Conn, $sql);

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
echo $row['email'].',';

}

 ?>

