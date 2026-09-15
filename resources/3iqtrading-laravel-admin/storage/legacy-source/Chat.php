<?php

include('../Connect.php');
include('Header.php');
$Client_id=$_GET['Client_id'];
$sql="select * from investors where Investor_id='$Client_id'";
$query1=mysqli_query($Conn, $sql);
$userinfo=mysqli_fetch_array($query1, MYSQLI_ASSOC);
?>
<html>
<style>

.message{
padding-bottom: 3cm;
overflow-y: scroll;

}
.row{
padding: 30px 20px 10px 10px;

}
.chat_box{

position: fixed;
bottom: 0px;
width: 100%;
padding: 20px;
background: red;

}
</style>
<section>
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="message"></div>


</div>

</div>

</div>
</section>

<section>
<div class="chat_box col-xs-12">
<div class="input-group">
<input class="form-control chat_text" type="text" placeholder="Message"/><span class="input-group-btn"><button class="btn btn-primary Send">Send</button></span></div>

</div>
</section>
</html>

<script>
var counter = 0; 

var interval = setInterval(function() { 

counter++; 
/*document.getElementById("timer").innerHTML=counter;*/
// Display 'counter' wherever you want to display it. 

if (counter == 4) {

getChatMessages();

clearTimeout(counter=0, 800);

}
}, 200);



$('.Send').click(function(){
var Client_id="<?php echo $_GET['Client_id']; ?>";
var text_message=$('.chat_text').val();
$.ajax({
url:'sendChat.php',
method:'post',
data:{Client_id:Client_id, text_message:text_message},
success:function(data){
getChatMessages();
$('.chat_text').val("");
}

})

})


function getChatMessages(){
var Client_id="<?php echo $_GET['Client_id']; ?>"
var clientpix="<?php echo $userinfo['Profile_Picture']; ?>";

$.ajax({
url:'getMessages.php',
method:'post',
data:{Client_id:Client_id, clientpix:clientpix},
success:function(data){
$('.message').html(data);

}

})

}


</script>
