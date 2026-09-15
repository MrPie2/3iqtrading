<?php



?>
<h4>Load Tesla Profit</h4>
<div class="well">
<div class="form-group"><button class="btn btn-primary ShowteslaLoadCont">Load Tesla Balance</button>
</div>
<div class="loadteslaContainer hidden">
<div class="form-group"><label>Asset Name</label>
<input type="text"  class="form-control AssetText" placeholder="Tesla Plan"/>
</div>
<div class="form-group"><label>Amount</label>
<input type="number"  class="form-control AmountText" placeholder="Amount"/>
</div>

<div class="form-group"><button class="btn btn-success LoadTesla" id="<?php echo $_GET['Investor_id']; ?>">Load</button></div>
</div>

</div>
<script>
$('.ShowteslaLoadCont').click(function(){
$('.loadteslaContainer').toggleClass('hidden');

})


$('.LoadTesla').click(function(){
    
	var Investor_id=$(this).attr('id');
	var Amount=$('.AmountText').val();
	var asset_name=$('.AssetText').val();
	$.ajax({
		url:'dep_tesla.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id,asset_name:asset_name},
		success:function(response){

if(response==1){
alert("Asset Updated Successfully");
$('.ProfitText').val("");
}else{
alert("Error Somewhere"+response);
}
	
		}
		
	})
})

</script>