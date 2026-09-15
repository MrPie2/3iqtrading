<?php 
include('../Connect.php');

?>

<div class="well">
<?php $sql="select * from investors where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$Level=$row['V_Status'];
echo "<h4>Current Level: ".$Level."</h4>";
?>

<div class="form-group"><button class="btn btn-primary showLevelCont">Level Up</button></div>
<div class="levelcontainer hidden">

<div class="form-group">
<div class="input-group"><input type"text" class="form-control LevelControl" disabled/><span class="input-group-btn"><button class="btn btn-primary Add">Add</button><button class="btn btn-primary">Subtract</button></span></div></div>

<div class="form-group"><button class="btn btn-success Update">Update</button></div>

</div>

</div>
<script>
var Level=<?php echo $Level; ?>;
$('.LevelControl').val(Level);

$('.Add').click(function(){
var newLevel=Level+1;
$('.LevelControl').val(newLevel);
})

$('.Update').click(function(){
var newLevel=$('.LevelControl').val();
var Investor_id="<?php echo $Investor_id; ?>";
$.ajax({
url:'updateLevel.php',
method:'POST',
data:{newLevel:newLevel, Investor_id:Investor_id},
success:function(data){
alert(data);
location.reload();
}

})
})

$('.showLevelCont').click(function(){

$('.levelcontainer').toggleClass('hidden');

})

</script>