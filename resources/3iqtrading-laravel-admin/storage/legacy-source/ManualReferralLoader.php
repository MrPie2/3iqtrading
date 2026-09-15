
<h4>Load Referral Bonus</h4>
<div class="well">
<div class="form-group"><button class="btn btn-primary ShowRefBonusCont">Load Referral Bonus</button>
</div>
<div class="RefBonusContainer hidden">
<div class="form-group"><label>Name</label>
<input type="text"  class="form-control RefNameText" placeholder="Name"/>
</div>
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
	var Name=$('.RefNameText').val();
	$.ajax({
		url:'ManualLoadReferral.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id,Name:Name},
		success:function(response){

if(response==1){
alert("Bonus Loaded Successfully");

	
var SendTo="<?php echo $Email; ?>";

var Subject="Refferal Bonus";
var htmlcontent= "You have earned a refferal bonus of $"+Amount+". You can proceed to withdraw your bonus. Thank you for choosing Comistar.";
$.ajax({
url:'SendMail.php',
method:'POST',
data:{SendTo:SendTo, Subject:Subject, htmlcontent:htmlcontent},
success:function(data){}
})
$('.ProfitText').val("");
location.reload();
}else{
alert("Error Somewhere");
}
	
		}
		
	})
}
})

</script>