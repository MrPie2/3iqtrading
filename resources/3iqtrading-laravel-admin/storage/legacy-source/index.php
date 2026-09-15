<?php session_start(); ?>
<!DOCTYPE html>
<?php include('Header.php');
include('signupModal.html');
include('SiteConfig.php');

?>
<html>

<header>
  <title>Boss's Desk</title>
  
  <style>
.red{

color: <?php echo $Background; ?>;
}
.btn-red{
color: white;
background: <?php echo $Background; ?>;
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


<div class="container" style=" padding: 20px;">
<div class="header" align="center">
  
<h1 class="h2 red">Manager's Desk</h1>
</div>

<div class="Starter" align="center" style="padding: 30px">

<?php
if(isset($_SESSION['Boss_id'])){

$Boss_id=$_SESSION['Boss_id'];
}else{
	
}

if(isset($_SESSION['Boss_id'])){
$links='<li><a href="MyAgents.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-user"></span> My Agents</a></li>
	
	

<li><a href="InvestmentPlan.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> Investment Plans</a></li>
<li><a href="MyWallets.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> My Wallets</a></li>
<li><a href="BulkMail.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> Bulk Email</a></li>
<li><a href="Verification.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> Verification & Limits</a></li>
<li><a href="MyStocks.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> My Stocks</a></li>

<li><a href="MyTraders.php" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> Copy Traders</a></li>
<li><a href="Resources.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> Resources</a></li>

<li><a href="openContents.php?Boss_id='.$Boss_id.'" class="btn btn-block btn-red"><span class="glyphicon glyphicon-hourglass"></span> Blog Posts</a></li>


<li><a href="FaqContainer.php" class="btn btn-block btn-red"><span class="glyphicon glyphicon-question-sign"></span> FAQs</a></li>

<li><a href="CustomizeSite.php" class="btn btn-block btn-red"><span class="glyphicon glyphicon-pencil"></span> Customize Site</a></li>

<li><a href="Pages.php" class="btn btn-block btn-red"><span class="glyphicon glyphicon-pencil"></span> Site Pages</a></li>

<li><a onclick="popup()" class="btn btn-block btn-red" id="WhatsApp"><span class="glyphicon glyphicon-phone"></span> WhatsApp Line <p ><span class="ViewNumber"></span><p style="font-size: 7pt">Click to Change your WhatsApp Number </p></p></a></li>
<script>
function popup(){
   var z=prompt("Change WhatsApp Number");
   if(z != null){
   var What=z;
   $.ajax({
      url:"updateWhatsApp.php",
      method:"POST",
      data:{What:What},
      success:function(response){
      if(response==1){
          
                    alert("Your WhatsApp Number has been changed to: "+z);
      }else{
                     alert("Error Somewhere");
      }
      
      }
       
       
   })
   }
}
</script>

	<li><a href="Logout.php" class="btn btn-block btn-red"><span class="glyphicon glyphicon-off"></span> Logout</a></li>';

}else{
	echo '<li><a href="LoginModal.php" class="btn btn-lg btn-red"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
	
}
echo $links;
?>

</div>

<?php

if(isset($_SESSION['Boss_id'])){
$id=$_SESSION['Boss_id'];
echo "<center><h1 class='h2 red'><small>You are logged in as </small><br>".$_SESSION['Boss_Name']." <br><small style='font-size: 20pt'>OG Boss</small></h1></center>";
}else{
	
}
?>

</div>



  

</html>
<?php include('Footer.php');?>

<script>
    getNumber();
    
    function getNumber(){
        $.ajax({
            url:"getNumber.php",
            method:"GET",
            success:function(data){
                $('.ViewNumber').html(data);
            }
        })
    }
    
</script>
