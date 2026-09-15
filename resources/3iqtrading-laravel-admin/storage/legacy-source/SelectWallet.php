<?php
session_start();
include('../Connect.php');
$Boss_id=$_SESSION['Boss_id'];
$Investor_id=$_POST['Investor_id'];
$sql="SELECT * FROM walletaddress";
$query=mysqli_query($Conn, $sql);
$output="
<table class='table table-bordered'>
<thead class='dark'><th>Wallet Address</th><th>Type</th><th>Network</th><th>Action</th></thead>
";
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){

	if($row['Priority']==1){
		$Active= "Active";
		$Color="success";
	}else{
		$Active= "Inactive";
		$Color="";
	}
	$output.= "<tr><td style='word-wrap: break-word'>".$row['WalletAddress']."</td><td>".$row['Wallet_Type']."</td><td>".$row['Network']."</td><td><button class='btn btn-danger btn-sm DeleteWallet' id='".$row['id']."'>Delete</button></td><tr>";
}
$output.="<tbody></table>";
echo $output;



?>
<script>
$('.DeleteWallet').click(function(){
	var id=$(this).attr('id');
		$.ajax({
		url:'DeleteWallet.php',
		method:'POST',
		data:{id:id},
		success:function(data){
		    if(data==1){
		        
		        alert("Wallet Deleted Successfully");
location.reload();
		    }else{
		        alert("Error Somewhere");

		    }


		    
		}
	
	})
})


</script>