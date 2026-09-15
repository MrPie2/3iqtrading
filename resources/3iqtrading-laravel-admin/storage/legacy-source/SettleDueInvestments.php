<?php
session_start();
include('../Connect.php');

$investors="select * from investors";
$query_investors=mysqli_query($Conn, $investors);
while($inv=mysqli_fetch_array($query_investors, MYSQLI_ASSOC)){
 $Investor_id=$inv['Investor_id'];
    
}



$sql="select * from contracts where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);


while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    if($row['Status']==1){
    $hour=60*60*24;
    $Duration=$row['Contract_Duration'];
    $EndDate=$hour*$Duration;
    $cid=$row['id'];
    $interest=$row['Interest'];
    $Amount=$row['Amount'];
    $Percentage=$row['Amount']/100*$interest;
    $Start=$row['Contract_Start'];
    $When=$row['PrevSettled'];
    $Rem=$row['Remaining'];
    $Complete=$row['Remaining']*60*60*24;

    $Current=date('Y-m-d H:i:s');
 $ConvertStart=strtotime($Start);
  $ConvertCurrent=strtotime($Current);
 

  
$Future=$ConvertStart+$EndDate;
$Now=$ConvertCurrent;

$Remaining=$Rem-1;
$newDatetoDo=$When+86400;

if($ConvertCurrent>=$When){
    
	    $Settle="update contracts set PrevSettled='$newDatetoDo', Remaining='$Remaining' where Investor_id='$Investor_id' AND id='$cid'";
	    $query=mysqli_query($Conn, $Settle);
	    
if($query){
$sql2="SELECT * FROM investors WHERE Investor_id='$Investor_id'";
$query2=mysqli_query($Conn, $sql2);
$row=mysqli_fetch_array($query2, MYSQLI_ASSOC);
$currentAmount=$row['Fin_Asset'];
$newAmount=$currentAmount+$Percentage;
$sql="UPDATE investors SET Fin_Asset='$newAmount' WHERE Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);

}
    
}else if($ConvertCurrent>=$Future){
     $Settle="update contracts set PrevSettled='0', Remaining='0', Status='2' where Investor_id='$Investor_id' AND id='$cid'";
$query=mysqli_query($Conn, $Settle);

$sql2="SELECT * FROM investors WHERE Investor_id='$Investor_id'";
$query2=mysqli_query($Conn, $sql2);
$row=mysqli_fetch_array($query2, MYSQLI_ASSOC);
$currentAmount=$row['Fin_Asset'];
$newAmount=$currentAmount+$Amount;
$sql="UPDATE investors SET Fin_Asset='$newAmount' WHERE Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
    
}

  
}


}



?>