<?php include('Header.php');?>
<header>
<style>
.mis{
padding: 20px;
}
</style>
</header>
<body>
<section>
<div class="container">
<h3>Bulk Mailer</h3>



<div class="SelectEmail"></div>
<div class="mis form-group">
<button class="btn btn-danger ClearAll">Clear All</button>
</div>
<h3>Add Email</h3>
<div class="form-group"><label>Email</label>
<input type="text" class="form-control Email" placeholder="Email"/>
</div>
<div class="form-group"><button class="btn btn-primary Add">Add</button></div>

</div>
<section>

<section>
<div class="container">
<div clasd="row">
<div class="col-md-12">
<button class="btn btn-primary btn-lg Compose">Compose Mail</button>
</div>
</div>
</div>
</section>
</body>
<script>

LoadAddresses();

function LoadAddresses(){
$.ajax({
url:'SelectEmail.php',
method:'GET',
data:{},
success:function(data){
$('.SelectEmail').html(data);
}

})
}

$('.Add').click(function(){
var email=$('.email').val();
$.ajax({

url:'AddEmail.php',
method:'post',
data:{email:email},
success:function(response){
if(response==1){
$('.SelectEmail').load('SelectEmail.php');

}else{
alert("Error Somewhere");

}
}

})

})
$('.ClearAll').click(function(){

$.ajax({
url:'ClearAll.php',
method:'POST',
data:{},
success:function(response){
if(response==1){
$('.SelectEmail').load('SelectEmail.php');
}else{
alert("Error Somewhere"+response);
}
}

})
})


$('.Compose').click(function(){

$.ajax({
url:'AllEmail.php',
method:'get',
data:{},
success:function(data){
var Email=data;
window.location.href="ComposeMail.php?BulkEmail="+Email;
}
})
})
</script>