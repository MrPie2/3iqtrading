<!DOCTYPE html>
<?php include('../Connect.php'); include('SiteConfig.php'); ?>
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

.bg-lemon{
    background: <?php echo $Background; ?>;
    color: white;
}
  </style>
</header>
<?php include('Header.php');?>

<div class="container-fluid" style="">
<div class="header" align="center" style="padding: 
20px">
<h1 class="h1"><?php echo $_GET['Agent_Name']."'s"; ?> Clients</h1>
</div>
<?php include('SearchModal.php'); ?>
<div class="Starter" align="center" >

<?php

$table="";
$Agent_id=$_GET['Agent_id'];

$sql="SELECT * FROM investors WHERE Relation='$Agent_id'";
$query=mysqli_query($Conn, $sql);
$count=mysqli_num_rows($query);
$table="<table class='table table-striped table-hover'>
<thead class='bg-lemon'>
<th>S|No</th>

<th>Client Name</th>
<th>Net Woth</th>
<thead> 
";
$SN=1;
if($count>0){
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$table.= "<tr><td style='width: 50px'>".$SN++."</td><td><a href='action.php?Investor_id=".$row['Investor_id']."&&Email=".$row['Email']."'>".$row['First_Name']."</a></td><td style='text-align: left'>$".$row['Fin_Asset']."</td><tr>";
}

}else{
$table.="<tr><td colspan='2'>This agent has no clients</td></tr>";    
    
}
$table.="</table>";
echo $table;


?>

</div>

</div>



  

</html>
<?php include('Footer.php')?>
  