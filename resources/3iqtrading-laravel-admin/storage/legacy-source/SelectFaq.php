<style>
.red{
color: #c00;
}
</style>

<?php
session_start();
include('../Connect.php');


$sql="SELECT * FROM faq";
$query=mysqli_query($Conn, $sql);
$output='<div class="panel-group" id="accordion">';

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
$output.='<div class="panel panel-default"><div class="panel-heading">  <h4 class="panel-title">         <a data-toggle="collapse" data-parent="#accordion"            href="#collapse'.$row['id'].'">'.$row['Question'].' </a> <a class="pull-right Delete" id="'.$row['id'].'"><span class="glyphicon glyphicon-minus-sign red"></span></a>      </h4>     </div>     <div id="collapse'.$row['id'].'" class="panel-collapse collapse in">       <div class="panel-body"> '.$row['Answer'].' </div>     </div>   </div>';

}

$output.='</div>';
echo $output;



?> 

<script>

$(document).on('click','.Delete', function(){
var FaqID=$(this).attr('id');

$.ajax({
url:'DeleteFaq.php',
method:'POST',
data:{FaqID:FaqID},
success:function(data){
$('.Starter').load('SelectFaq.php');
}


})

})

</script>
