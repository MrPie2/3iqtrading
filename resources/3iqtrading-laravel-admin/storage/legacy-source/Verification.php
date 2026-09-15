<?php
include('Header.php');
include('../Connect.php');

?>
<html>
<header>

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<style>
input[type=radio]{
	border: 0px;
	height: 20px;
	width: 20px;
}
.hidden{
    display: none;
}
</style>
</header>
<section>
<div class="container box">
<div class="" style="margin-top: 1cm"><h4>Verification & Limits</h4></div><br>
<div class="row">
<div class="col-md-12">
<?php 
$sql="select * from verification order by Level asc";
$query=mysqli_query($Conn, $sql);

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
	echo "<div class='panel panel-default'>
	<div class='panel-heading'>	<h4>Level: ".$row['Level']."</h4>
	<div class='panel-body'>
<ul class='list-group'><li class='list-item'>Maximum Deposit: $".$row['Deposit_Limit']."</li>
	<li class='list-item'>Maximum Withdrawal: $".$row['Withdrawal_Limit']."</li>
	<li class='list-item'>Requirement: <label class='text-danger'>".$row['Requirement']."</label></li>
</ul>
	</div>
	<div class='panel-footer'><button class='btn btn-danger DeleteVerification' id=".$row['id'].">Delete</button></div>
</div>
	
	</div><br>";
}


?>

</div>
</div>

<div class="row">

<div class="col-md-12">
<div claSS="verification_header form-group">
<button class="btn btn-success btn-lg showVerificationContainer">Add Verification and Limit</button>
</div>

<div class="verification_limitContainer hidden">
<div class="form-group"><label>Level</label><input type="number" class="form-control input-lg Level"> <span class="level_input_result"></span></div>

<div class="form-group"><label>Deposit Limit</label><input type="number" class="form-control input-lg Max_Deposit"><span class="deposit_input_result"></span></div>
<div class="form-group"><label>Withdrawal Limit</label><input type="number" class="form-control input-lg Max_Withdrawal"><span class="withdrawal_input_result"></span></div>
<div class="form-group"><label>Requirements for Upgrade</label><textarea  class="form-control input-lg requirement_text"></textarea><span class="requirement_input_result"></span></div>
<div class="form-group"><label>Controls</label><br>What information do you want to retrieve 

<br><input type="radio"  class="retval_info" name="retval_info" value="1"/> <label>Upload a File</label> 

<br><input type="radio"  name="retval_info" class="retval_info" value="2"/> <label>Regular Data</label> 


</div>

<div class="form-group"><button  class="btn btn-success btn-lg Publish">Publish</button></div>

</div>
</div>

</div>
</div>
</section>

</html>

<script>
$('.showVerificationContainer').click(function(){
	$('.verification_limitContainer').toggleClass('hidden');
})

$('.Publish').click(function(){
	
	if($('.Level').val().trim()==""){
		$('.level_input_result').html("Level Required").css({"color":"red"});
	}
	
	
	if($('.Max_Deposit').val().trim()==""){
		$('.deposit_input_result').html("Maximum Deposit Required").css({"color":"red"});
	}
	
	if($('.Max_Withdrawal').val().trim()==""){
		$('.withdrawal_input_result').html("Maximum Withdrawal Required").css({"color":"red"});
	}
	
	if($('.requirement_text').val().trim()==""){
		$('.requirement_input_result').html("Requirements cannot be empty").css({"color":"red"});
	}
	
	
	if($('.Level').val().trim()!="" || $('.Max_Deposit').val().trim()!="" || $('.Max_Withdrawal').val().trim()!="" || $('.requirement_text').val().trim()!=""){
		var Level=$('.Level').val();
		var Max_Deposit=$('.Max_Deposit').val();
		var Max_Withdrawal=$('.Max_Withdrawal').val();
		var Requirement_Text=$('.requirement_text').val();
		var Controls=$("input[name='retval_info']:checked").val();
		
	
		$.ajax({
			
			url:'AddVerificationLevel.php',
			method:'POST',
			data:{Level:Level, Max_Deposit:Max_Deposit, Max_Withdrawal:Max_Withdrawal, Requirement_Text:Requirement_Text, Controls:Controls},
			beforeSend:function(){
				$('.Publish').html("Adding New Limit Please Wait.....");
			},
			success:function(data){
				if(data==1){
					alert("New Verification Added");
						window.location.href="Verification.php";
			
				}else{
					alert("Error Somewhere");
				}
			}
			
		})

	}
})

$('.DeleteVerification').click(function(){
	var id=$(this).attr('id');
	$.ajax({
		
		url:'DeleteVerification.php',
		method:'POST',
		data:{id:id},
		success:function(data){
			if(data==1){
				alert("Deleted Successfully");
			}else{
				alert(data)
			}
		}
	});
	
	
	
})
</script>