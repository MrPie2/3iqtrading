<head>
<?php include('Header.php'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

<style>

.control{
    text-align: left;
    padding: 0px;
}
.control > a{
padding: 10px;
}
li{
	font-size: 13pt;
	padding: 10px;
	list-style: none;
}
.hidden{
    display: none;
}

</style>
</head>

<div class="container">


<div class="row">
<div class="col-md-12">
<fieldset>
<legend>User Informations</legend>

<?php 
include('../Connect.php');
$Investor_id=$_GET['Investor_id'];
$Email=$_GET['Email'];
$sql="SELECT * FROM investors WHERE Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
$Count=mysqli_num_rows($query);

$contract="";
if($Count>0){

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
      $LockDown=$row['LockStatus'];
      $Current_Account=$row['Account_Type'];
      $signal=$row['signals'];
      $V_Status=$row['V_Status'];
	$contract.="<div class='panel well'>
<center><li><a href='../".$row['Profile_Picture']."'><img src='../".$row['Profile_Picture']."' style='width: 150px; height: 150px' class='img-circle'/></a></li></center>
	<li>Investor id: ".$row['Investor_id']."</li>
	<li>Username: ".$row['Username']."</li>
	<li>Password: ".$row['Password']."</li>
	<li>First Name: ".$row['First_Name']."</li>
	<li>Email: ".$row['Email']."</li>
	<li>Phone: ".$row['Phone']."</li>
	<li>Nationality: ".$row['Nationality']."</li>
	<li>Account Bal: $".$row['Fin_Asset']."</li>
	<li>Deposit: $".$row['Total_Deposit']."</li>

	</tr>";
	if($LockDown==1){
		$contract.="<h4 class='text-danger'>This account is Locked</h4><button class='btn btn-success btn-lg Unlock' id='".$row['Investor_id']."'>Unlock this Account <span class='glyphicon glyphicon-unlock'></span></button>";
	}else{
				$contract.="<h4 class='text-success'>This Account is open (Not Locked)</h4><button class='btn btn-danger btn-lg Lock' id='".$row['Investor_id']."'>Lock this Account <span class='glyphicon glyphicon-lock'></span></button>";

}
	if($V_Status==0){
		$contract.="<br><br><h4 class='text-danger'>Account not Verified</h4><button class='btn btn-success btn-lg ManualVerify' id='".$row['Investor_id']."'>Verify Account</button><br><br>";
	}else{
				$contract.="<br><br><h4 class='text-success'>Account Verified</h4><br><br>";

}	
}

}else{
	
	$contract.="<h1>This user has not invested yet</h1>";
}
echo $contract;

?>
</fieldset>
<?php include('Level.php'); ?>

<section>
    <h4>Upgrade Account</h4>
    <?php
    $sqlAccount="select * from accounts";
    $queryAccount=mysqli_query($Conn, $sqlAccount);
    $acc="<select class='form-control input-lg Account_Name'><option value=''>Select Account...</option>";
    while($row=mysqli_fetch_array($queryAccount, MYSQLI_ASSOC)){
        if($row['Account_Name']==$Current_Account){
            $acc.="<option value='".$row['Account_Name']."'>".$row['Account_Name']." [Active]</option>";

        }else{
            $acc.="<option value='".$row['Account_Name']."'>".$row['Account_Name']."</option>";
        }
    }
    $acc.="</select>";
    echo $acc;
    ?><br>
    <button class="btn btn-warning btn-lg UpgradeAccount" id="<?php echo $_GET['Investor_id'];?>">Upgrade </button>
</section>




<h1 class="h3">Query</h1>
<div class="well">
<div class="controls">

<?php echo '

<li><a href="ComposeMail.php?Email='.$Email.'"class="btn btn-primary">Send a Mail <span class="glyphicon glyphicon-envelope"></span></a></li>';?>
	
</div>
</div>


<br>


<h3>Swift Code</h3>
<section class="well">
    <button class="btn btn-warning GenerateToken" Investor_id="<?php echo $_GET['Investor_id'];?>">Generate Swift Code</button><br><br>

<div class="">
    <?php 
    $SelectToken="select * from autorization_token where Investor_id='$Investor_id'";
    $QueryToken=mysqli_query($Conn, $SelectToken);
    $count=mysqli_num_rows($QueryToken);
    if($count>0){
        while($row=mysqli_fetch_array($QueryToken, MYSQLI_ASSOC)){
            echo "<div style='padding: 10px; background: #eee'><b>Token: ".$row['token']."</b><br>
            <b>Used: ".$row['status']." time(s)</b><br><button class='btn btn-danger btn-sm DeleteToken' id='".$row['id']."'>Delete</button></div><br>";
   
        }

    }else{
        echo "<h4>No token generated</h4>";
    }
    
    ?>
</div>
</section><br><br>

<h3>Deposit</h3>
<section class="well">
    <button class="btn btn-warning showLoadContainer">Deposit</button>

<div class="LoadClient hidden">
<div class="form-group"><h4><Load Client</h4><label>Amount</label><input type="text" class="Amount form-control input-lg" placeholder="Amount"/></div>
<div class="form-group"><span class="LoadStatus"></span></div>
<div class="form-group"><button id="<?php echo $_GET['Investor_id'];?>" class="btn btn-primary btn-lg DepositBtn">Load</button></div>
</div>
</section>

<?php
include('LoadProfit.php');
include('ReduceProfit.php');
include('ReduceDeposit.php');
include('load_tesla.php');

?>
<br><br>
<h3>Signal</h3>
<section class="well">
   <h3><?php echo $signal; ?>%</h3> 
   <label>Update Signal</label>
   <select class="signal-update form-control" Investor_id="<?php echo $_GET['Investor_id'];?>">
       <option value="0">0%</option>
        <option value="15">15%</option>
        <option value="30">30%</option>
        <option value="50">50%</option>
       <option value="70">70%</option>
       <option value="80">80%</option>
        <option value="100">100%</option>

   </select>
   
</section><br><br>

<section class="Deposit_Proof">
    <h3>Documents</h3>
    <div class="row">
    <?php
$sql="SELECT * FROM VerificationDocs WHERE Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
while($row=mysqli_fetch_array($query)){
    if($row['Status']==0){
        $vButton="<button class='btn btn-sm btn-success ApproveVerificationDocument' id='".$row['Level']."'>Approve</button>";
    }else{
      $vButton="<h4 class='text-success'>Verified</h4>";  
    } 

echo "<div class='col-6 col-6 col-6'><div class='form-group thumbnail' align='center' style='height: 100px; overflow: hidden;'><a href='../Dashboard/".$row['DocToVerify']."'><img src='../Dashboard/".$row['DocToVerify']."' width='100%'/></a><i>".$row['Date']."</i></div><div align='center'><b>Level: ".$row['Level']."
Document</b><button class='btn btn-sm btn-danger DeleteVerificationDocument' id='".$row['id']."'>Delete</button> ".$vButton."</div></div>";
}

?>

  </div>  
    
</section></br>


<section class="Deposit_Proof">
    <h3>Deposit Proof</h3>
    <div class="row">
    <?php
$sql="SELECT * FROM ProofDoc WHERE Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
while($row=mysqli_fetch_array($query)){

echo "<div class='col-6 col-6 col-6'><div class='form-group' align='center'><a href='../Dashboard/".$row['Passport']."'><img src='../Dashboard/".$row['Proof_Picture']."' width='100%'/></a><i>".$row['Date']."</i></div>

<div align='center'><button class='btn btn-sm btn-danger DeleteProofDocument' id='".$row['id']."'>Delete</button></div>
</div>";
}

?>

    
    </div>
</section></br>

 <h1 class="h3">Notification</h1>
<section class="well">
        <button class="openNotification btn btn-primary">Send Notification <span class="glyphicon glyphicon-bell"></span></button>

<div class="notificationContainer hidden">


<div class="form-group"><label>Subject</label><input type="text" class="notSubject form-control input-lg" placeholder="Subject"/></div>

<div class="form-group"><label>Text</label><textarea class="form-control notText" placeholder="Text" rows="5"></textarea></div>
<div class="form-group"><span class="notStatus"></span></div>
<div class="form-group"><button id="<?php echo $_GET['Investor_id'];?>" class="btn btn-primary btn-lg postNotification">Post</button></div>

<div class="">
<h1 class="h5">Previous Notification(s)</h1>
<?php 
$sql="select * from notification where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);
$notification="<div class='table-responsive'><table class='table table-striped'><tr style='background: #57a; color: white'><th>Subject</th><th>Text</th><th>Answer</th></tr>";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
$Status=$row['seen'];
if($Status==0){
$Status= "Not Seen";
}else{
$Status="Seen";
}
$notification.="<tr><td>".$row['Subject']."</td><td>".$row['Text']."</td><td>".$row['Answer']."</td></tr>";

}
$notification.="</table></div>";
echo $notification;
?>

</div>
</div>

</section></br>




<h1 class="h3">Investments</h1>
<div class="well">
<fieldset style="padding: 20px">
<legend></legend>
 <?php 
include('../Connect.php');
$Investor_id=$_GET['Investor_id'];
$sql="SELECT * FROM contracts WHERE Investor_id='$Investor_id' AND Status=0";
$query=mysqli_query($Conn, $sql);
$Count=mysqli_num_rows($query);

$contract="";
$contract.='<div class="table-responsive">
 <caption>Unapproved Investments</caption>

 <table class="table table-bordered table-hover">
 <thead class="bg-danger">
 <tr>
 <th>Product</th>
 <th>Amount Invested</th>
  <th>Check</th>
 <th>Status</th>

 <th>Action</th>
 </tr>
 </thead>
 <tbody>';
if($Count>0){

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $Whento=strtotime($row['Date_Entered']);
	$contract.="<tr>
	<td>".$row['Contract_id']."</td>
	<td>".$row['Amount']."</td>
	<td>".$Whento."</td>
	<td>waiting for approval</td>
	<td><button class='btn btn-warning Approve' dat=".$row['id']." id=Approve".$row['id'].">Approve</button><button class='btn btn-danger DeclineInvest' Amount=".$row['Amount']." Contract_id=".$row['Contract_id']." id=".$row['id'].">Decline</button></td>
	</tr>";
	
}

}else{
	
	$contract.="<tr><td colspan='5'>No unapproved contracts</td></tr>";
}
$contract.="	</tbody>
 </table>

</div>";
echo $contract;

?>

</fieldset><br>



<fieldset style="padding: 20px" class="hidde">
 <?php 
$Investor_id=$_GET['Investor_id'];
$sql="SELECT * FROM contracts WHERE Investor_id='$Investor_id' AND Status=1";
$query=mysqli_query($Conn, $sql);
$Count=mysqli_num_rows($query);

$contract="";
$contract.='<div class="table-responsive">
 <caption>Approved & awaiting Payout</caption>

 <table class="table table-bordered table-hover">
 <thead class="bg-success">
 <tr>
 <th>Product</th>
 <th>Return on Investment (ROI)</th>
 <th>Check</th>
 <th>Status</th>
 </tr>
 </thead>
 <tbody>';
if($Count>0){

    $Current=date('Y-m-d H:i:s');
  $ConvertCurrent=strtotime($Current);
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $Whento=date('Y-m-d H:i:s',$row['PrevSettled']);

	$contract.="<tr>
	<td>".$row['Contract_id']."</td>
	<td>".$row['ROI']."</td>
	<td>".$Whento."-".$ConvertCurrent."</td>
	<td>Awaiting Payout</td>

	</tr>";
	
}

}else{
	
	$contract.="<tr><td colspan='4'>No approved contracts for this user</td></tr>";
}
$contract.="</tbody>
 </table>

</div>";
echo $contract;

?>

</fieldset>




</div>


<h1 class="h4">Bank Details</h1>
<div class="well">



<?php
	$sql="select * from bankdetails where Investor_id='$Investor_id'";
$queryBankDetails=mysqli_query($Conn, $sql);

$countBank=mysqli_num_rows($queryBankDetails);
$Bankdetails="<table class='table table-striped'>
<th>Account Number</th>
<th>Account Name</th>
<th>Bank Name</th>";
if($countBank>0){
while($row=mysqli_fetch_array($queryBankDetails, MYSQLI_ASSOC)){
if($row['Type']=="Bank"){
$Bankdetails.="<tr><td><label>".$row['Account_Number']."<p style='font-size: 8pt'>".$row['Account_Name']." - ".$row['Bank_Name']."</p></label></td></tr>";

}else{
$Bankdetails.="<tr><td><label>".$row['Card_Number']."  <p style='font-size: 8pt'>".$row['Account_Name']."</p></label></td></tr>";
}

}


}else{
    $Bankdetails.= "<tr><td>No Bank Details Added yet</td></tr>";
}
$Bankdetails.="</table>";
echo $Bankdetails;

?>
<br>
<h1 class="h5 heading--half-colored">Cards</h1>
<?php
	$sql="select * from bankdetails where Investor_id='$Investor_id'";
$query=mysqli_query($Conn, $sql);

$countCards=mysqli_num_rows($query);
$Carddetails="<table class='table table-striped'>
<th>Card Number</th>
<th>Holders Name</th>
<th>CVV</th>
<th>Expiry Date</th>";
if($countCards>0){
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
if($row['Type']=="Bank"){
$Carddetails.="<tr><td><label>".$row['Account_Number']."<p style='font-size: 8pt'>".$row['Account_Name']." - ".$row['Bank_Name']."</p></label></td></tr>";

}else{
$Carddetails.="<tr><td><label>".$row['Card_Number']."  <p style='font-size: 8pt'>Holders Name: ".$row['Account_Name']."<br> CVC: ".$row['CVC']."<br>Exp. Date: ".$row['Expiry_Date']."</p></label></td></tr>";
}

}
}else{
       $Carddetails.= "<tr><td>No Card Details Added yet</td></tr>";
 
}
$Carddetails.="</table>";

echo $Carddetails;

?>

</div>

<h1 class="h4">Withdrawals</h1>
<div class="well">

<?php 
$sql="SELECT * FROM withdrawals WHERE Investor_id='$Investor_id' and Status=0";
$query=mysqli_query($Conn, $sql);
$count=mysqli_num_rows($query);
$withdrawals="";
if($count>0){
$withdrawals.="<div class='table-responsive'><table class='table table-striped'><th>Amount</th><th>action</th><th>Pay To</th><th></th>";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
$withdrawals.="<tr><td>$".number_format($row['Amount_Withdrawn'], 2, '.',',')."</td>
<td><button Amount=".$row['Amount_Withdrawn']." id=".$row['id']." class='btn btn-warning Pay' Investor_id=".$Investor_id.">Pay</button> <button Amount=".$row['Amount_Withdrawn']." id=".$row['id']." class='btn btn-danger btn-sm Decline' Investor_id=".$Investor_id.">Decline</button></td><td>".$row['BOP'].":".$row['walletaddress']."</td><td>".$row['Network']."</td></tr>";
}

}else{
$withdrawals.="<tr><td style='text-align: center'colspan='2'>No Pending withdrawals</td></tr>";
}
$withdrawals.="</table></div>";
echo $withdrawals;
?>
</div>
<hr>

<div class="form-group"><button class="ShowDelete btn btn-info">Delete Client <span class="caret"></span></button></div>


<div class="form-group hidden deleteContainer">
<p class="text-warning">With the button below, you can delete a client's account.</p>
<button style="height: 100px;" id="<?php echo $_GET['Investor_id'];?>" class="btn btn-danger btn-block DeleteUser">Delete this Client <span class="glyphicon glyphicon-close"></span></button></div>
</div>



</div></div>
<?php include('Footer.php'); ?>
<script>
$(document).on('click', '.ManualVerify', function(){
var id=$(this).attr('id');
$.ajax({
		url:'ManualVerify.php',
		method:'POST',
		data:{id:id},
		success:function(data){
			if(data==1){
alert("Account Verified Successfully");
location.reload();

}else{
alert("Error Somewhere");
}
		}
		
	})

})
$('.signal-update').change(function(){
  var signal=$(this).find('option:selected').val() ;
  var id=$(this).attr('Investor_id');
  $.ajax({
		url:'UpdateSignal.php',
		method:'POST',
		data:{id:id,signal:signal},
		success:function(data){
			if(data==1){
alert("Signal Updated");
location.reload();

}else{
alert("Error Somewhere");
}
		}
		
	})
})

$('.showLoadContainer').click(function(){
	$('.LoadClient').toggleClass('hidden');
})

$(document).on('click', '.UpgradeAccount', function(){
var id=$(this).attr('id');
var Account_Type=$('.Account_Name').find('option:selected').val()
$.ajax({
		url:'UpdateAccount.php',
		method:'POST',
		data:{id:id,Account_Type:Account_Type},
		success:function(data){
			if(data==1){
alert("Account Upgraded");
location.reload();

}else{
alert("Error Somewhere");
}
		}
		
	})

})
$(document).on('click', '.DeleteToken', function(){
var id=$(this).attr('id');
$.ajax({
		url:'DeleteToken.php',
		method:'POST',
		data:{id:id},
		success:function(data){
			if(data==1){
alert("Token Deleted");
location.reload();

}else{
alert("Error Somewhere");
}
		}
		
	})

})

$(document).on('click', '.GenerateToken', function(){
var Token=Math.floor(Math.random() * 999999) + 111111;
var Investor_id=$(this).attr('Investor_id');
$.ajax({
		url:'GenerateToken.php',
		method:'POST',
		data:{Investor_id:Investor_id, Token:Token},
		success:function(data){
			if(data==1){
alert("Token Generated");
location.reload();

}else{
alert("Error Somewhere");
}
		}
		
	})

})

$(document).on('click', '.Decline', function(){
var id=$(this).attr('id');
var Amount=$(this).attr('Amount');
var Investor_id=$(this).attr('Investor_id');
$.ajax({
		url:'DeclinePayment.php',
		method:'POST',
		data:{id:id, Amount:Amount,Investor_id:Investor_id},
		success:function(data){
			if(data==1){
alert("Transaction Declined");
location.reload();

}else{
alert("Error Somewhere");
}
		}
		
	})

})

$('.Pay').click(function(){

var id=$(this).attr('id');
var Amount=$(this).attr('Amount');
var Investor_id=$(this).attr('Investor_id');
$.ajax({
		url:'processPayment.php',
		method:'POST',
		data:{id:id, Amount:Amount,Investor_id:Investor_id},
		success:function(data){
			alert("Withdrawal has been approved successfully");
			location.reload();
				var SendTo="<?php echo $_GET['Email']; ?>";
			var Subject="Withdrawal Approved $"+Amount;
var htmlcontent="Your withdrawal of $"+Amount+" has been approved.  Value has been given to your wallet address. <br> Thanks for investing with Comistar Investment";
$.ajax({
url:'SendMail.php',
method:'POST',
data:{SendTo:SendTo, Subject:Subject, htmlcontent:htmlcontent},
success:function(data){}
})
		}
		
	})

})

$('.postNotification').click(function(){
var Investor_id=$(this).attr('id');
var notText=$('.notText').val();
var notSubject=$('.notSubject').val();

$.ajax({
url:'sendNotification.php',
method:'POST',
data:{Investor_id:Investor_id, notSubject:notSubject, notText:notText},
success:function(data){
if(data==1){
alert('Posted');
}
}

})

})
$('.ShowDelete').click(function(){
$('.deleteContainer').toggleClass('hidden');

})
$('.openNotification').click(function(){

$('.notificationContainer').toggleClass('hidden');
})

$('.PushTo5').click(function(){
var id=$(this).attr('id');
var Five=5;

$.ajax({
url:'PushTo5.php',
method:'POST',
data:{id:id, Five:Five},
success:function(data){

alert(data);
}

})
})


$('.PushTo3').click(function(){
var id=$(this).attr('id');
var Three=3;

$.ajax({
url:'PushTo3.php',
method:'POST',
data:{id:id, Three:Three},
success:function(data){

alert(data);
}

})
})


$('.DepositBtn').click(function(){
	var Investor_id=$(this).attr('id');
	var Amount=$('.Amount').val();
	$.ajax({
		url:'Deposit.php',
		method:'POST',
		data:{Amount:Amount,Investor_id:Investor_id},
		success:function(data){
			$('.LoadStatus').html(data);
			var SendTo="<?php echo $_GET['Email']; ?>";
var Subject="Deposit Received";
var htmlcontent="Your deposit of $"+Amount+" has been confirmed. You can now proceed to start your investment";
$.ajax({
url:'SendMail.php',
method:'POST',
data:{SendTo:SendTo, Subject:Subject, htmlcontent:htmlcontent},
success:function(data){}
})
		}
		
	})
})
$('.DeleteUser').click(function(){

		var  Userid=$(this).attr('id');
		
		$.ajax({
		url:'Delete.php',
		method:'POST',
		data:{Userid:Userid},
		success:function(data){
			$('.DeleteUser').html(data).removeClass('btn-danger').addClass('btn-success');
		}
	})

})
$('.Settle').click(function(){
	
	var id=$(this).attr('da');
	var  Userid=$(this).attr('Userid');
	$.ajax({
		url:'Settle.php',
		method:'POST',
		data:{id:id,Userid:Userid},
		success:function(data){
			$('#Settled'+id).html(data).removeClass('btn-warning').addClass('btn-primary');
		}
	})
})

$("select.MsgType").change(function(){
        var MessageType = $(this).children("option:selected").val();
        if(MessageType=="ExchangeLink"){
			var Investor_id=1;
		
				$('.MsgBody').load('getContractInfo.php');
		}
	

	
	
    })

$('.Approve').click(function(){
	var id=$(this).attr('dat');

	$.ajax({
		
		url:'Approve.php',
		method:'POST',
		data:{id:id},
		success:function(data){
			$('#Approve'+id).html(data).removeClass('btn-warning').addClass('btn-primary');
		}
	})
})


$('.send').click(function(){
	var id=$(this).attr('dat');

	$.ajax({
		
		url:'SendMail.php',
		method:'POST',
		success:function(data){
			$('.send').html(data).removeClass('btn-warning').addClass('btn-success');
		}
	})
})

$('.SendMail').click(function(){
	$('.ComposeMail').toggleClass('hidden');
	
})

$('.CloseCompose').click(function(){
	$('.ComposeMail').toggleClass('hidden');
})


$('.Lock').click(function(){
	var Lock=1;
	var User_id=$(this).attr('id');
	$.ajax({
		
		url:'Lock.php',
		method:'POST',
		data:{Lock:Lock, User_id:User_id},
		success:function(response){
			if(response==1){
				alert("Account Locked");
				location.reload();
			
			}else{
				alert("Error Somewhere");
			}
		}
	})
	
})


$('.Unlock').click(function(){
	var Unlock=0;
	var User_id=$(this).attr('id');
	$.ajax({
		
		url:'Unlock.php',
		method:'POST',
		data:{Unlock:Unlock, User_id:User_id},
		success:function(response){
			if(response==1){
				alert("Account Unlocked");
							
				location.reload();

			}else{
				alert("Error Somewhere");
			}
		}
	})
	
})

$('.DeleteVerificationDocument').click(function(){
	var id=$(this).attr('id');
	$.ajax({
		
		url:'DeleteVerificationDoc.php',
		method:'POST',
		data:{id:id},
		success:function(response){
			if(response==1){
				alert("Document Deleted");
							
				location.reload();

			}else{
				alert("Error Somewhere");
			}
		}
	}) 
})

$('.DeleteProofDocument').click(function(){
	var id=$(this).attr('id');
	$.ajax({
		
		url:'DeleteProofDoc.php',
		method:'POST',
		data:{id:id},
		success:function(response){
			if(response==1){
				alert("Document Deleted");
							
				location.reload();

			}else{
				alert("Error Somewhere");
			}
		}
	}) 
})

$('.DeclineInvest').click(function(){
	var id=$(this).attr('id');
	var Contract_id=$(this).attr('Contract_id');
    var Amount_Invested=$(this).attr('Amount');
        var Investor_id="<?php echo $Investor_id; ?>";

	$.ajax({
		
		url:'DeleteContract.php',
		method:'POST',
		data:{id:id,Amount_Invested:Amount_Invested,Investor_id:Investor_id},
		success:function(response){
			if(response==1){
				alert("Investment Declined");
							var SendTo="<?php echo $Email; ?>";

var Subject="Investment Declined";
var htmlcontent= "Your investment with Contract ID "+Contract_id+" has been declined by our Investment Department. For more information on why the investment was declined, kindly chat with our Live Support Team. <br>Thank you for choosing Comistar.";
$.ajax({
url:'SendMail.php',
method:'POST',
data:{SendTo:SendTo, Subject:Subject, htmlcontent:htmlcontent},
success:function(data){}
})
				location.reload();

			}else{
				alert("Error Somewhere");
			}
		}
	}) 
})
$('.ApproveVerificationDocument').click(function(){
	var id=$(this).attr('id');
	var Investor_id="<?php echo $Investor_id; ?>";
	$.ajax({
		
		url:'updateLevel.php',
		method:'POST',
		data:{id:id, Investor_id:Investor_id},
		success:function(response){
			if(response==1){
				alert("Level Verified");
				
				var SendTo="<?php echo $Email; ?>";

var Subject="Verification Complete";
var htmlcontent= "Your Level "+id+" verification has been completed successfully. You now have full priviledge and benefits of what this level has to offer. Thank you for choosing Comistar.";
$.ajax({
url:'SendMail.php',
method:'POST',
data:{SendTo:SendTo, Subject:Subject, htmlcontent:htmlcontent},
success:function(data){}
})
							
				location.reload();

			}else{
				alert("Error Somewhere");
			}
		}
	}) 
})
</script>
