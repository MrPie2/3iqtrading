<?php session_start();
include('../Connect.php');

$sql="SELECT * FROM investmentplans";
$query=mysqli_query($Conn, $sql);
$output='<div class="panel-group" id="accordion">';
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){

$output.='
<div class="card card-body"> <div class="panel-heading"> <h4 class="panel-title" <a   href="#collapse'.$row['id'].'">'.$row['Plan_Name'].'         </a>       <small>
<a class="pull-right DeletePlan" href="#" id="'.$row['id'].'">Delete</a></small></h4>

</div>
<div id="collapse'.$row['id'].'" class="panel-collapse collapse in">
<div class="panel-body"><b>Description</b><p>'.$row['Description'].' <a href="#" class="showEdit" id="'.$row['id'].'">Edit</a></p><div class="editDescription'.$row['id'].' form-group hidden"><input type="text" class="form-control editText'.$row['id'].'" placeholder="Description"/></br><div class="form-group Status'.$row['id'].'" ></div><button class="updateDesc" id="'.$row['id'].'">Update</button></div><div>
<div class="addPlanCont'.$row['id'].' hidden">
<div class="form-group"><label>Amount</label><input type="text" class="form-control Amount'.$row['id'].'"/></div>

<div class="form-group"><label>Profit</label><input type="text" class="form-control Profit'.$row['id'].'"/></div>


<div class="form-group"><label>Duration</label><input type="text" class="form-control Duration'.$row['id'].'"/></div>
<div class="Status'.$row['id'].'"></div>
<div class="form-group"><button class="btn btn-primary Add" id="'.$row['id'].'">Add</button></div>
</div>


</div> </div>

</div>

</div>'; 

}
$output.='</div>';

echo $output;


?>
<script>
$('.DeletePlan').click(function(){
    var id=$(this).attr('id');
   $.ajax({
       
       url:'deleteAmount.php',
       method:'POST',
       data:{id:id},
       succes:function(data){
           if(data==1){
               alert("Plan Deleted");
           }else{
               alert("Error Somewhere");
           }
       }
   })
})
$('.AddAmount').click(function(){
var id=$(this).attr('id');
$('.addPlanCont'+id).toggleClass('hidden');
})

$('.Add').click(function(){ 
var id=$(this).attr('id');

if($('.Amount'+id).val().trim()==""){
$('.Amount'+id).attr('placeholder','Amount Required').addClass('hasError');

}else{
$('.Amount'+id).removeClass('hasError');
}

if($('.Profit'+id).val().trim()==""){
$('.Profit'+id).attr('placeholder','Profit Required').addClass('hasError');

}else{
$('.Profit'+id).removeClass('hasError');
}


if($('.Duration'+id).val().trim()==""){
$('.Duration'+id).attr('placeholder','Duration Required').addClass('hasError');

}else{
$('.Duration'+id).removeClass('hasError');
}

if($('.Amount'+id).val().trim()!="" && $('.Profit'+id).val().trim()!="" && $('.Duration'+id).val().trim()!="" ){

var Amount=$('.Amount'+id).val();
var Profit=$('.Profit'+id).val();
var Duration=$('.Duration'+id).val();

$.ajax({
url:'AddInvestmentAmount.php',
method:'POST',
data:{id:id, Amount:Amount, Profit:Profit, Duration:Duration},
success:function(data){
$('.Status'+id).html(data).fadeOut(2000);

var Amount=$('.Amount').val("");
var Profit=$('.Profit').val("");
var Duration=$('.Duration').val("");
}

})

}
})

$('.showEdit').click(function(){
var id=$(this).attr('id');
$('.editDescription'+id).toggleClass('hidden');

})

$('.updateDesc').click(function(){
var id=$(this).attr('id');
var text=$('.editText'+id).val();

$.ajax({
url:'updateDesc.php',
method:'POST',
data:{id:id, text:text},
success:function(data){
$('.Status'+id).html(data);
}
});
})
$('.Delete').click(function(){
var id=$(this).attr('id');
$.ajax({
url:'deleteAmount.php',
method: 'POST',
data:{id:id},
success:function(data){
if(data==1){
    alert('Plan deleted successfully');
    location.reload();
}else{
    
}

}
})

})
</script>