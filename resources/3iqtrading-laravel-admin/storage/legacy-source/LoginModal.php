<?php include('Header.php'); 
include('SettleDueInvestments.php');


?>
<style>
.red{
color: <?php echo $Background; ?>;

}

: : placeholder {

background: red;
opacity: 1;
}

.btn-red{

background: <?php echo $Background; ?>;
color: white;
}

</style>
   
     
         <div class="" style="padding: 30px;" > <div align="center"> 
          
            <h2 class="red" id="myModalLabel"> 
               Login 
            </h2> 
         </div> 
         <div class="modal-body"> 
		 <div class="response"></div>
            <div class="form-group"><label class="red">Username</label><input type="text" class="form-control Username" placeholder="Username"/></div>
                <div class="form-group"><label class="mbr-text mbr-fonts-style display-7 red">Password</label><input type="password" class="Password form-control" placeholder="Password"/></div>
            <div class="form-group"><label class="mbr-text mbr-fonts-style display-7 red">Remember me </label> <input type="checkbox"/></div>
		 </div> 
         <div class="" align="center"> 
          
            <button id="Login" type="button" class="btn btn-red Login btn-md"> 
              Login 
            </button> 
         </div> 
      </div>

<?php include('Footer.php'); ?>

<script>
$('#Login').click(function(e){
var Username="";
var Password="";

if($('.Username').val().trim()==""){
$('.Username').attr('placeholder',"Username Required");
$('.Username').addClass('hasError');
}else{
$('.Username').removeClass('hasError');

}

if($('.Password').val().trim()==""){
$('.Password').attr('placeholder',"Password Required");
$('.Password').addClass('hasError');
}else{
$('.Password').removeClass('hasError');
}

if($('.Username').val()!="" || $('.Password').val()!=""){
var Username=$('.Username').val();
var Password=$('.Password').val();
$.ajax({
url:'Login.php',
method:'POST',
data:{Username:Username,Password:Password},
success:function(response){
if(response==1){
window.location.href="index.php";
}else{
$('.response').html(response);
}
}
})
}

})

</script> 
