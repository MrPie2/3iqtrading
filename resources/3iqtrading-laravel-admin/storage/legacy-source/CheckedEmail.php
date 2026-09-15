<style>
li{
list-style: none;
}
</style>
<?php
include('../Connect.php');
$Boss_id=$_SESSION['Boss_id'];
 $sql="select * from email";
$query=mysqli_query($Conn, $sql);
$count=mysqli_num_rows($query);
$sn=0;
if($count>0){
$output="<table class='table table-striped'>";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
$sn++;
$output.="<tr><td>".$sn."</td><td> ". $row['email']." </td><td> <button href='#' id='".$row['id']."' class='DeleteEmail btn btn-sm btn-danger'>Delete</button>  </td></tr>";

}
$output.="</table>";
echo $output;
}
 ?>


<script>
$(document).on('click','.DeleteEmail', function(){
var id=$(this).attr('id');
$.ajax({
url:'DeleteMail.php',
method:'post',
data:{id:id},
success:function(data){
if(data==1){
location.reload();

}else{
alert('error somewhere'+data);
}

}

})

})

</script>

