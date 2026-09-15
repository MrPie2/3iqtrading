<?php

$Investor_id=$_GET['Investor_id'];

?>
<h3>Referrals</h3>
<div class="well">
    <?php
   $sql="select * from refferals where Refferer='$Investor_id'";
   $query=mysqli_query($Conn, $sql);
   $sn=1;
   $table="<table class='table'>
   <thead><th>S|No</th><th>Name</th><th>Earnings</th><th>Action</th></thead>";
   while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
       if($row['Status']==0){
           $loadbonus="<button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#flipFlop".$row['id']."'>Load Bonus</button>";
       }
       $table.='<tr><td>'.$sn++.'</td><td>'.$row['Name'].'</td><td>'.$row['Refferal_Earnings'].'</td><td>'.$loadbonus.'</td></tr>';
  
  
  $table.='<!-- The modal -->
<div class="modal fade" id="flipFlop'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="modalLabel">'.$row['Name'].'</h4>

<button type="button" class="close" data-dismiss="modal" aria-label="Close">

</button>
</div>
<div class="modal-body">
<div class="form-group"><input type="amount" placeholder="Amount" class="form-control RefBonusText'.$row['id'].'"/></div>
<div class="result"></div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary LoadReferral" id="'.$row['id'].'" Investor_id="'.$row['Investor_id'].'">Load</button>

<button type="button" class="btn btn-secondary CloseModal" data-dismiss="modal">Close</button>
</div>
</div>
</div>';
   }
   $table.="</table>";
   echo $table;
    
    ?>


</div>
<script>
$('.CloseModal').click(function(){
location.reload();
})


$('.LoadReferral').click(function(){
	var Investor_id=$(this).attr('Investor_id');
	var id=$(this).attr('id');
	var Amount=$('.RefBonusText'+id).val();
	$.ajax({
		url:'LoadReferral.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id, id:id},
		success:function(response){

if(response==1){
$('.result').html("Bonus Loaded Successfully").addClass('alert alert-success');
$('.LoadReferral').addClass('hidden');
$('.RefBonusText'+id).props('disabled');

}else{
alert("Error Somewhere");
}
	
		}
		
	})
})

</script>