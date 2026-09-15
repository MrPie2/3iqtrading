<?php

include('../Connect.php');
$id=$_POST['id'];
$delete="delete from resources where id='$id'";
$query=mysqli_query($Conn, $delete);
if($query){
    echo 1;
}else{
    echo 0;
}

?>