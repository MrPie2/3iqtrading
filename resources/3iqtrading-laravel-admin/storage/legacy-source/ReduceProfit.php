<?php



?>
<h4>Reduce Account Balance</h4>
<div class="well">
<div class="form-group"><button class="btn btn-primary ShowReduceCont">Reduce Profit</button>
</div>
<div class="ReduContainer hidden">

<div class="form-group"><label>Amount</label>
<input type="text"  class="form-control ReduceText" placeholder="Amount"/>
</div>

<div class="form-group"><button class="btn btn-success ReduceProfit" id="<?php echo $_GET['Investor_id']; ?>">Reduce</button></div>
</div>

</div>
<script>
$('.ShowReduceCont').click(function(){
$('.ReduContainer').toggleClass('hidden');

})


$('.ReduceProfit').click(function(){
	var Investor_id=$(this).attr('id');
	var Amount=$('.ReduceText').val();
	$.ajax({
		url:'ReduceProfitLoader.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id},
		success:function(response){

if(response==1){
alert("Account Reduced Successfully");
$('.ProfitText').val("");
}else{
alert("Error Somewhere");
}
	
		}
		
	})
})

</script>