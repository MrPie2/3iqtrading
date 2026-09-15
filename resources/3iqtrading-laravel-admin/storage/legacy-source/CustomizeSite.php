
<?php include('Header.php'); 
include('../Connect.php');
 ?>
<header>
<style>



</style>

</header>

<div class="container">

<div class="" style="margin-top: 1cm">

<div align="center"><h2>Customize Site</h2></div>
<div class="panel-group" id="accordion">  



 <div class="panel panel-default">    
 <div class="panel-heading">       <h4 class="panel-title"> 
        <a data-toggle="collapse" data-parent="#accordion"            href="#collapseSeven">  Site Name     </a>       </h4>     </div>     <div id="collapseSeven" class="panel-collapse collapse">       <div class="panel-body">        <?php

$sql="SELECT * FROM sitename";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$sitename=$row['sitename'];
$id=$row['id'];

				echo '<b>'.$sitename.'</b><a class="pull-right Edit">Edit</a>';

?>
<div class="hidden EditSiteName">
<div class="form-group">
<input type="text" class="newname form-control" placeholder="Site Name"/>
</div>

<div class="form-group"><button id="<?php echo $id; ?>"class="btn btn-primary updateSiteName">Update</button></div>
</div>


  </div>     </div>   </div>  

<div class="panel panel-default"> 
<div class="panel-heading">       <h4 class="panel-title">         <a data-toggle="collapse" data-parent="#accordion"            href="#collapseThree"> Site Address         </a>       </h4>     </div>     <div id="collapseThree" class="panel-collapse collapse">       <div class="panel-body">    

<?php

$sql="select * from siteaddress";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$siteaddress=$row['address'];
$ID=$row['id'];
echo '<addr>'.$siteaddress.'</addr>'; 

?>
<br>
<div class="form-group"><a href="#" class="EditSiteAddress">Edit</a></div>
<div class="updateSiteAdd hidden">
<div class="form-group">
<input type="text" class="form-control siteAddressText"/></div>
<div cpass="form-group"><button class="btn btn-primary updateAddress" id="<?php echo $ID; ?>">Update</button></div>
</div>
 </div>     </div>   </div>


<div class="panel panel-default">     <div class="panel-heading">       <h4 class="panel-title">         

<a data-toggle="collapse" data-parent="#accordion"            href="#collapseFive"> About Us </a>
       </h4>     </div>     

<div id="collapseFive" class="panel-collapse collapse">       <div class="panel-body">         
<?php

$sql="select * from aboutus";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$AboutUs=$row['aboutus'];
$aID=$row['id'];
echo '<p>'.$AboutUs.'</p>'; 

?>
<br>
<a href="#" class="EditAboutUs">Edit</a>      
<div class="hidden UpdateAboutUs">

<div class="form-group"><textarea class="form-control newContent" placeholder="About Us" rows="8" value="<?php echo $AboutUs ;?>"></textarea></div>

<div class="form-group"><button id="<?php echo $aID; ?>" class="btn btn-primary updateAbout">Update</button></div>
</div>

</div>     </div>   </div> 


<div class="panel panel-default">     <div class="panel-heading">       <h4 class="panel-title">         
<?php

$sql="select * from others";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$other1=$row['other1'];
$Heading=$row['Heading'];
$aID=$row['id'];
?>
<a data-toggle="collapse" data-parent="#accordion"            href="#collapseOne"> <?php echo $Heading; ?>   </a>
       </h4>     </div>     

<div id="collapseOne" class="panel-collapse collapse">       <div class="panel-body">
<?php

echo '<p>'.$other1.'</p>'; 

?>
</div>     </div>   </div> 

 

  

<div class="panel panel-default">    
 <div class="panel-heading">       <h4 class="panel-title"> 
        <a data-toggle="collapse" data-parent="#accordion"            href="#collapseTwo">  Welcome Note       </a>       </h4>     </div>     <div id="collapseTwo" class="panel-collapse collapse">       <div class="panel-body"> 

<?php

$sql="select * from welcomenote";
$query=mysqli_query($Conn, $sql);
$row=mysqli_fetch_array($query, MYSQLI_ASSOC);
$WelcomeNote=$row['note'];
$iD=$row['id'];
echo '<p>'.$WelcomeNote.'</p>'; 

?>

       
<div class="form-group"><a href="#" class="EditWelcome">Edit</a></div>

<div class="EditWelcomeNote hidden">
<div class="form-group"><input type="text" class="form-control newNote"/></div>
<div class="form-group"><button class="btn btn-primary updateWelcomeNote" id="<?php echo $iD; ?>">Update</button></div>

</div>



 </div>     </div>   </div>   





 <div class="panel panel-default">     <div class="panel-heading">       <h4 class="panel-title">         

<a data-toggle="collapse" data-parent="#accordion"            href="#collapseFour"> Hurry to Invest       </a>
       </h4>     </div>     

<div id="collapseFour" class="panel-collapse collapse">       <div class="panel-body">         Nihil anim keffiyeh helvetica, craft beer labore wes anderson          cred nesciunt sapiente ea proident. Ad vegan excepteur butcher          vice lomo.       </div>     </div>   </div> 



 


 <div class="panel panel-default">     <div class="panel-heading">       <h4 class="panel-title">         

<a data-toggle="collapse" data-parent="#accordion"            href="#collapseSix"> Policies   </a>
       </h4>     </div>     

<div id="collapseSix" class="panel-collapse collapse">       <div class="panel-body"> 
<div class="form-group"><input type="checkbox"/> <label>Enable Privacy Policy</label></div>

<div class="form-group"><input type="checkbox"/> <label>Enable Cookies Policy</label></div>

<div class="form-group"><input type="checkbox"/> <label>Enable Acknowledgement Policy</label></div>
<div class="form-group"><button class="btn btn-primary">Update</button></div>

  </div>     </div>   </div> 




 </div> </div>

</div>


<script>

$('.EditAboutUs').click(function(){
$('.UpdateAboutUs').toggleClass('hidden');
})

$('.updateSiteName').click(function(){
var id=$(this).attr('id');
var newname=$('.newname').val();
$.ajax({
url:'updateSiteName.php',
method:'POST',
data:{id:id,newname:newname},
success:function(data){
alert(data);
}
})


})

$('.updateAbout').click(function(){
var id=$(this).attr('id');
var newContent=$('.newContent').val();
$.ajax({
url:'updateAboutUs.php',
method:'POST',
data:{id:id,newContent:newContent},
success:function(data){
$('.newContent').val("");
alert(data);
}
})


})


$('.updateWelcomeNote').click(function(){
var id=$(this).attr('id');
var newNote=$('.newNote').val();
$.ajax({
url:'updateWelcomeNote.php',
method:'POST',
data:{id:id,newNote:newNote},
success:function(data){
$('.newNote').val("");
alert(data);
}
})


})


$('.Edit').click(function(){

$('.EditSiteName').toggleClass('hidden');



})


$('.EditSiteAddress').click(function(){

$('.updateSiteAdd').toggleClass('hidden');



})
$('.EditWelcome').click(function(){

$('.EditWelcomeNote').toggleClass('hidden');



})


$('.updateAddress').click(function(){


var id=$(this).attr('id');
var siteAddressText=$('.siteAddressText').val();
$.ajax({
url:'updateSiteAddress.php',
method:'POST',
data:{id:id,siteAddressText:siteAddressText},
success:function(data){
$('.siteAddressText').val("");
alert(data);
}
})


})
</script>