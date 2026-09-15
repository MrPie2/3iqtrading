<!DOCTYPE html>
<?php include('../Connect.php');include('LoginModal.html');?>
<html>
<header>
  <title>Agent's Desk</title>
  
  <style>
  table{
	  table-layout: fixed;
  }
  .panel label{
	  float: left;
	  color: #fff;
  }
  .inactive{
	  display: none;
  }
.Starter > li {
	list-style: none;
	padding: 10px;
}
.Starter > li > a {
	border: none;
	border-radius: 0px;
	font-size: 14pt;
}
  </style>
</header>
<?php include('Header.php');?>

<div class="container" style="">
<div class="header" align="center">
<h1 class="h1">FAQ</h1>
</div>
<?php 
if(isset($_SESSION['Boss_id'])){
$Boss_id=$_SESSION['Boss_id'];
}else{
	
}


?>
<div class="Starter">



</div>
<div class="form-group" align="center"><a href="#" Class="ShowContainer btn btn-primary btn-lg ">Add FAQ</a></div>
<div class="well hidden AddFaqContainer">

<div class="form-group"><label>Question</label><input type="text" placeholder="Question" class="form-control Question"/></div>

<div class="form-group">

<label>Answer</label><textarea class="Answer  form-control"></textarea>


</div>
<div class="form-group Status" align="center"></div>
<div class="form-group" align="center"><a href="#" class="btn-lg btn btn-success Add">Add</a></div>

</div>
</div>





  

</html>
<?php include('Footer.php')?>
<script>
var id="<?php echo $Boss_id; ?>";
$.ajax({
		url:'SelectFaq.php',
		method:'POST',
		data:{id:id},
		success:function(data){
			$('.Starter').html(data);
		}
	})


$('.ShowContainer').click(function(){
	$('.AddFaqContainer').slideToggle().removeClass('hidden');
})

$('.Add').click(function(){


	if($('.Question').val().trim()==""){
		$('.Question').attr('placeholder','Input Question').addClass('HasError');
	}else{
		$('.Question').removeClass('HasError');
	};


	if($('.Answer').val().trim()==""){
		$('.Answer').attr('placeholder','Input Answer').addClass('HasError');
	}else{
		$('.Answer').removeClass('HasError');
	};



	if($('.Question').val().trim()!="" || $('.Answer').val().trim()!=""){

	var Question=$('.Question').val();
	var Answer=$('.Answer').val();
	$.ajax({
		
		
		url:'insertFAQ.php',
		method:'POST',
		data:{Question:Question, Answer:Answer},
		success:function(data){
			$('.Status').html(data).fadeOut(3000);
$('.Question').val("");
$('.Answer').val("");
			$('.Starter').load('SelectFaq.php');
		}
	})	
	}else{
		
	}

})
</script>
              