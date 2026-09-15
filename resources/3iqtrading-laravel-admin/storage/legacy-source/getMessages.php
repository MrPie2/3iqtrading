<style>
.notes{
background: red;
color: white;
padding: 10px;
border-radius: 10px;
margin-bottom: 20px;

}
table{

width: 100%;
}
tr{
margin-bottom: 20px;
}
</style>

<?php
session_start();
include('../Connect.php');
$Client_id=$_POST['Client_id'];
$Agent_id=$_SESSION['id'];
$clientpix=$_POST['clientpix'];
$sql3="select * from chats where Relation='$Client_id' order by id asc";
$query3=mysqli_query($Conn, $sql3);
$chats="<table class='tabl'>";
while($row=mysqli_fetch_array($query3, MYSQLI_ASSOC)){
if($row['Receiver']==$Client_id){
$chats.="<tr><td><div style='float: left'><p class='notes'>".$row['Message']." </p></div></td></tr>";
}else{

$chats.="<tr><td><div style='float: right'><p class='notes'>".$row['Message']." <img src='../".$clientpix."' style='border: 3px solid #eee; width: 30px; height: 30px; border-radius: 50%'/></p></div></td></tr>";
}
}
$chats.="</table>";
echo $chats;
?>
