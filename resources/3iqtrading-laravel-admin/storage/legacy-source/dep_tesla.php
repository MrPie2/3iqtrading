<?php 
include('../Connect.php');

$Amount=$_POST['Amount'];
$Investor_id=$_POST['Investor_id'];
$Status=1;
$Date= date(" l d F Y ");
$asset_name=$_POST['asset_name'];

$sql0="select * from investors where Investor_id='$Investor_id'";
$query0=mysqli_query($Conn, $sql0);
$row=mysqli_fetch_array($query0, MYSQLI_ASSOC);


$sqlsel="select * from assets where Investor_id='$Investor_id'";
$querysel=mysqli_query($Conn, $sqlsel);
$countsel=mysqli_num_rows($querysel);
$rowsel=mysqli_fetch_assoc($querysel);



if($countsel>0 && $rowsel['asset_name']==$asset_name){
    
    $asset_amount=$rowsel['amount'];
$newBalance=$asset_amount+$Amount;
$update="update assets set amount='$newBalance' where Investor_id='$Investor_id' AND asset_name='$asset_name'";
$query=mysqli_query($Conn, $update);
    
}else{
    $sql="insert into  assets (Investor_id, asset_name, amount) values ('$Investor_id', '$asset_name', '$Amount')";
$query=mysqli_query($Conn, $sql);

}





if($query){
    echo 1;
}else{
    echo 0;
echo mysqli_error($Conn);
}


?>