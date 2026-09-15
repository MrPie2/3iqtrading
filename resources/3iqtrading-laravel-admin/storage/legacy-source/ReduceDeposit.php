<?php



?>
<h3>Reduce Deposit Balance</h3>
<div class="well">
<div class="form-group"><button class="btn btn-primary ShowReduceDepositCont">Reduce Deposit</button>
</div>
<div class="ReduDepositContainer hidden">

<div class="form-group"><label>Amount</label>
<input type="text"  class="form-control ReduceDepositText" placeholder="Amount"/>
</div>

<div class="form-group"><button class="btn btn-success ReduceDeposit" id="<?php echo $_GET['Investor_id']; ?>">Reduce Deposit</button></div>
</div>

</div>
<script>
$('.ShowReduceDepositCont').click(function(){
$('.ReduDepositContainer').toggleClass('hidden');

})


$('.ReduceDeposit').click(function(){
	var Investor_id=$(this).attr('id');
	var Amount=$('.ReduceDepositText').val();
	$.ajax({
		url:'ReduceDepositLoader.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id},
		success:function(response){

if(response==1){
alert("Deposit Reduced Successfully");
$('.ProfitText').val("");
location.reload();
}else{
alert("Error Somewhere");
}
	
		}
		
	})
})

</script>