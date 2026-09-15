<!DOCTYPE html>
<?php include('../Connect.php'); include('SiteConfig.php'); ?>
<html>
<header>
  <title>Agent's Desk</title>
  
  <style>
.red{
color: #c00;
}

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
    color: #fff;
}
  </style>
</header>
<?php include('Header.php');?>

<div class="container" style="margin-top: 1cm;">
<div class="header" align="center">
<h1 class="h1">Agents</h1>
</div>

<div class="Starter" align="center" >

<?php 
$Boss_id=$_GET['Boss_id'];
$sql="SELECT * FROM agent WHERE Agent='$Boss_id'";
$query=mysqli_query($Conn, $sql);
$output="<table class='table table-striped table-hover'>
<thead class='bg-lemon'>
<th>Agent Name</th>
<th>Agent ID</th>
<th style='text-align: center'>Delete</th>
<thead> 
";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$output.= "<tr><td><a href='MyClients.php?Agent_id=".$row['id']."&&Agent_Name=".$row['Agent_Name']."'>".$row['Agent_Name']."</a></td><td>".$row['Agent_id']."</td><td style='text-align: center'><a href='#' class='DeleteAgent btn btn-sm btn-danger' id=".$row['id'].">Delete <span class='glyphicon glyphicon-minus-sign'></span></td></a></td></tr>";
}
$output.="</table>";
echo $output;

?>

</div>

</div>



  

</html>
<?php include('Footer.php')?>

<script>
    
    $(document).on('click', '.DeleteAgent', function(){
var id=$(this).attr('id');

$.ajax({
url:'deleteAgent.php',
method:'POST',
data:{id:id},
success:function(data){
alert(data);

}

})
    })
</script>
  
