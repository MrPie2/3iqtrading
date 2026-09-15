<style>
li{
list-style: none;
}
</style>
<?php
session_start();
include('../Connect.php');
$Boss_id=$_SESSION['Boss_id'];
 $sql="select Email from investors where Boss_id='$Boss_id'";
$query=mysqli_query($Conn, $sql);
$count=mysqli_num_rows($query);
$sn=0;
if($count>0){
$output="<table class='table'>";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
$sn++;
$output.="<tr><td>".$sn."</td><td> ". $row['Email']." </td><td><input type='checkbox' class='check' value='".$row['Email']."'/></td></tr>";

}
$output.="</table>";
echo $output;
}

echo '<br><h4>Seleted Emails</h4><div class="allchecked"></div>';
 ?>

<script>
SelectEmail();
function SelectEmail(){

$.ajax({
url:'CheckedEmail.php',
method:'GET',
data:{},
success:function(data){
$('.allchecked').html(data);
}

})




}


$(".check").click(function() {
if($(this).prop('checked')==true){
var email=$(this).val();
$.ajax({

url:'AddEmail.php',
method:'post',
data:{email:email},
success:function(response){
if(response==1){
SelectEmail();
}else{
alert("Error Somewhere");

}
}

})

}
 
});



</script>