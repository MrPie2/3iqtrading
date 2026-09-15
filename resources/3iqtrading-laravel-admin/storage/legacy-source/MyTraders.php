<!DOCTYPE html>
<?php include('../Connect.php'); 

?>
<html>
<header>
  <title>All Stragegies</title>
  
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
<div class="header" align="center" style="margin-top: 1cm;">
<h1 class="h1">All Strategies </h1>
</div>
<?php 
if(isset($_SESSION['Boss_id'])){
$Boss_id=$_SESSION['Boss_id'];
}else{
	
}


?>
<div class="Starter">



</div>
<div class="form-group" align="center"><button  Class="ShowContainer btn btn-primary btn-lg ">Add New Trader</button></div>

<form id="AddForm"  enctype="multipart/form-data">



<div class="hidden AddWalletContainer">
<div class="form-group"><label>Traders Name</label><input type="text" placeholder="TradersName"class="form-control traders_name" name="traders_name"/></div>

<div class="form-group"><label>Username</label><input type="text" placeholder="@sammylion"class="form-control username" name="username"/></div>


<div class="form-group"><label>Minimum Deposit</label><input type="text" class="form-control minimum_deposit" placeholder="Minimum Deposit" name="minimum_deposit"/></div>



<div class="form-group"><label>Return Percentage(%)</label><input type="number" class="form-control percentage" placeholder="Percentage" name="percentage"/></div>


<div class="form-group"><label>Total Investors</label><input type="number" class="form-control total_investors" Placeholder="Total Investors" name="total_investors"/></div>


<div class="form-group"><label>Profile Picture</label><input type="file" name="cover_photo" class="form-control cover_photo" /></div>

<div class="form-group"><label>Copy Fees</label><input type="number" placeholder="Copy Fees" name="copy_fees" class="form-control copy_fees" /></div>



<div class="form-group" align="center"><button id="<?php echo $id; ?>" class="btn-lg btn btn-success " type="submit">Add</button></div>

</div>
</div>

</form>



  

</html>
<?php include('Footer.php')?>
<script>
$.ajax({
		url:'SelectTraders.php',
		method:'POST',
		data:{},
		success:function(data){
			$('.Starter').html(data);
		}
	})


$('.ShowContainer').click(function(){
	$('.AddWalletContainer').slideToggle().removeClass('hidden');
})


$("#AddForm").unbind('submit').bind('submit', function(){

				var form = $(this);
				var formData = new FormData($(this)[0]);

				$.ajax({
					url:'AddTraders.php',
					method:'POST',
					data:formData,
					dataType:'json',
					cache: false,
					contentType:false,
					processData:false,
					async:false,
					success:function(response) {
						if(response== 1) {
							alert('Trader Added Successfully');
					
						}
						else if(response==0){
							alert('Error Somewhere');
						}else if(response==3){
						  	alert('Cannot Upload File');
  
						}
					}

				});
return false;
	
			});
</script>
              