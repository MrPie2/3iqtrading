<?php



?>
<h4>Load Profit</h4>
<div class="well">
<div class="form-group"><button class="btn btn-primary ShowLoadCont">Load Profit</button>
</div>
<div class="loadContainer hidden">

<div class="form-group"><label>Amount</label>
<input type="text"  class="form-control ProfitText" placeholder="Amount"/>
</div>

<div class="form-group"><button class="btn btn-success LoadProfit" id="<?php echo $_GET['Investor_id']; ?>">Load</button></div>
</div>

</div>
<script>
$('.ShowLoadCont').click(function(){
$('.loadContainer').toggleClass('hidden');

})


$('.LoadProfit').click(function(){
	var Investor_id=$(this).attr('id');
	var Amount=$('.ProfitText').val();
	$.ajax({
		url:'ProfitLoader.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id},
		success:function(response){

if(response==1){
alert("Account Loaded Successfully");
$('.ProfitText').val("");
}else{
alert("Error Somewhere");
}
	
		}
		
	})
})

</script>