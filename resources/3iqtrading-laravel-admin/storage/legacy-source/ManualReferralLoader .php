
<h5>Load Referral Bonus</h5>
<div class="well">
<div class="form-group"><button class="btn btn-primary ShowRefBonusCont">Load Referral Bonus</button>
</div>
<div class="RefBonusContainer hidden">

<div class="form-group"><label>Amount</label>
<input type="number"  class="form-control RefBonusText" placeholder="Amount"/>
</div>

<div class="form-group"><button class="btn btn-success LoadReferral" id="<?php echo $_GET['Investor_id']; ?>">Load Bonus</button></div>
</div>

</div>
<script>
$('.ShowRefBonusCont').click(function(){
$('.RefBonusContainer').toggleClass('hidden');

})


$('.LoadReferral').click(function(){
    if($('.RefBonusText').val().trim()==""){
      $('.RefBonusText').attr('placeholder','Field must not be blank'); 
    }else{
      	var Investor_id=$(this).attr('id');
	var Amount=$('.RefBonusText').val();
	$.ajax({
		url:'LoadReferral.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id},
		success:function(response){

if(response==1){
alert("Bonus Loaded Successfully");
$('.ProfitText').val("");
}else{
alert("Error Somewhere");
}
	
		}
		
	})  
    }

})

</script>