<?php 
include('Header.php'); 
?>
<html>
<header>
  <title>Agent's Desk</title>
  <script src="../Jquery-3.5.1.js"></script>
<link href="../bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

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
<div class="container" style="">
    <h1 class="h3">My Active Wallets </h1>

<div class="header" align="center">

</div>
<?php 
if(isset($_SESSION['Boss_id'])){
$Boss_id=$_SESSION['Boss_id'];
}else{
	
}


?>
<div class="well">
<div class="Starter" align="center">



</div>
</div>
<div class="form-group" align="center"><button Class="ShowContainer btn btn-primary btn-lg ">Add New Wallet</button></div>
<div class="well hidden AddWalletContainer">
<div class="form-group"><label>Wallet Address</label><input type="text" placeholder="Wallet Address"class="form-control WalletAddress"/></div>

<div class="form-group"><label>Wallet Type</label><select class="BOP form-control"/>
<option value="Bitcoin">Bitcoin</option>
<option value="LiteCoin">Lite Coin</option>
<option value="Ethereum">Ethereum</option>
<option value="USDT">USDT</option>
<option value="BNB">BNB</option>

<select>


</div>
<div class="form-group Net"></div>
<div class="form-group Status" align="center"></div>
<div class="form-group" align="center"><a id="<?php echo $id; ?>"href="#" class="btn-lg btn btn-success Add">Add</a></div>

</div>
</div>





  

</html>

<script>
var id="<?php echo $Boss_id; ?>";
var Investor_id="<?php echo $_GET['Investor_id']; ?>";
$.ajax({
		url:'SelectWallet.php',
		method:'POST',
		data:{id:id, Investor_id:Investor_id},
		success:function(data){
			$('.Starter').html(data);
		}
	})


$('.BOP').change(function(){
    var BOP=$(this).val();
    if(BOP=="BNB"){
    $('.Net').html("<label>Network</label><input type='text' class='Network form-control' placeholder='BNB Network'/>"); 

    }else if(BOP=="USDT"){
       $('.Net').html("<label>Network</label><input type='text' class='Network form-control' placeholder='USDT Network'/>"); 
    }
})

$('.ShowContainer').click(function(){
	$('.AddWalletContainer').slideToggle().removeClass('hidden');
})

$('.Add').click(function(){
    
	if($('.WalletAddress').val().trim()==""){
		$('.WalletAddress').attr('placeholder','Input Address').addClass('HasError');
	}else{
		$('.WalletAddress').removeClass('HasError');
	};
	if($('.WalletAddress').val().trim()!=""){
	
	var id="<?php echo $Boss_id; ?>";
var Investor_id="<?php echo $Investor_id; ?>";
	var WalletAddress=$('.WalletAddress').val();
	var BOP=$('.BOP').val();
	var Network=$('.Network').val();
	$.ajax({
		
		
		url:'AddWallet.php',
		method:'POST',
		data:{id:id, WalletAddress:WalletAddress, BOP:BOP, Investor_id:Investor_id, Network:Network},
		success:function(data){
			alert(data);
			location.reload();
		}
	})	
	}else{
		
	}

})
</script>
              