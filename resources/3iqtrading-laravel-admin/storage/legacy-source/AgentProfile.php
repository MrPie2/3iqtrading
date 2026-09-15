<!DOCTYPE html>
<?php include('../Connect.php');?>
<html>
<header>
  <title>Agent's Desk</title>
  
  <style>
  .panel label{
	  float: left;
	  color: #fff;
  }
  .inactive{
	  display: none;
  }
.Starter > li {
	list-style: none;
	padding: 10px;
}
.Starter > li > a {
	border: none;
	border-radius: 0px;
	font-size: 14pt;
}
  </style>
</header>
<?php include('Header.php');?>

<div class="container" style="margin-top: 2cm; padding: 50px">
<div class="header" align="center">
<h1 class="h1">Agent Profile</h1>
</div>

<div class="Starter" align="center" >

<?php 
if(isset($_SESSION['Agent_id'])){
$id=$_SESSION['id'];
$Agent_id=$_SESSION['Agent_id'];
}else{
	
}
$sql="SELECT * FROM agent WHERE id='$id'";
$query=mysqli_query($Conn, $sql);
$output="<table>";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$output= "<tr><th>Agent Name</th> <td>".$row['Agent_Name']."</td><tr>";
}
$output.="</table>";
echo $output;

?>

</div>

</div>



  

</html>
<?php include('Footer.php')?>
  