<!DOCTYPE html>
<?php include('../Connect.php'); 

?>
<html>
<header>
  <title>Agent's Desk</title>
  
  <style>
  table{
	  table-layout: fixed;

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

<div class="container" style="">
<div class="header" align="center">
<h1 class="h1">Investment Plans </h1>
</div>
<?php 
if(isset($_SESSION['Boss_id'])){
$Boss_id=$_SESSION['Boss_id'];
}else{
	
}


?>
<div class="Starter">



</div>
<form id="AddPlanForm" enctype="multipart/form-data">
<div class="form-group" align="center"><button  Class="ShowContainer btn btn-primary btn-lg ">Add New Plan</button></div>
<div class="hidden AddWalletContainer">
<div class="form-group"><label>Plan Title</label><input type="text" placeholder="Title"class="form-control Plan_Name" name="Plan_Name"/></div>
<div class="form-group"><textarea class="form-control description" placeholder="Description" name="Description"></textarea></div>

<div class="form-group"><label>Minimum</label><input type="text" class="form-control Minimum" placeholder="Minimum" name="Minimum"/></div>


<div class="form-group"><label>Maximum</label><input type="text" class="form-control Maximum" Placeholder="Maximum" name="Maximum"/></div>


<div class="form-group"><label>Duration</label><input type="text" class="form-control Duration" placeholder="Duration" name="Duration"/></div>


<div class="form-group"><label>Percentage</label><input type="text" class="form-control Percentage" placeholder="Percentage" name="Percentage"/></div>
<div class="form-group"><label>Spread</label><input type="text" class="form-control Spread" placeholder="Spread" name="Spread"/></div>


<div class="form-group Status" align="center"></div>
<div class="form-group" align="center"><button id="<?php echo $id; ?>" class="btn-lg btn btn-success Add">Add</button></div>

</div>
</div>

</form>



  

</html>
<?php include('Footer.php')?>
<script>
$.ajax({
		url:'SelectInvestmentPlans.php',
		method:'POST',
		data:{},
		success:function(data){
			$('.Starter').html(data);
		}
	})


$('.ShowContainer').click(function(){
	$('.AddWalletContainer').slideToggle().removeClass('hidden');
})

$("#AddPlanForm").unbind('submit').bind('submit', function() {

				var form = $(this);
				var formData = new FormData($(this)[0]);

				$.ajax({
					url: 'AddPlan.php',
					type: 'POST',
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					async: false,
					success:function(response) {
						if(response== 1) {
							alert('Investment Plan Added Successfully');
					
						}
						else if(response==0){
							alert('Error Somewhere');
						}
					}

				});
return false;
	
			});
</script>
              