<?php include('Header.php'); include('../Connect.php'); ?>
<head>
        <meta name="viewport" content="initial-scale=1,width=device-width, user-scalable=no">

</head>
<div class="container-fluid">
   <div class="row">
    
    <div class="col-md-12">
    
    <div class="stock-header" style="margin-top: 1cm"><h4>My Stocks</h4><a href="AddStock.php" class="btn btn-primary btn-md" style="float: right; margin-bottom: 30px">Add New Stock</a></div>
    <?php
    $sql="select * from stock";
    $query=mysqli_query($Conn, $sql);
    $sn=1;
    $table="<div class='table-responsive'>
    <table class='table table-striped'>
    <thead>
    <th>S|No</th>
    <th>Company Name</th>
    <th>Market Cap</th>
    <th>Spread</th>

    <th>Action</th>


    </thead>";
    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
        if($row['Trend']==0){
            $Color="text-danger";
            $arith="-";

        }else{
            $Color="text-success";
            $arith="+";
 
        }
      $action="<a href='Manipulate.php?Stock_id=".$row['id']."' class='btn btn-warning btn-md'>Manipulate</a>";
           $delete="<button class='btn btn-danger btn-md Delete' id='".$row['id']."'>Delete</button>";
      $table.="<tr><td>".$sn++."</td><td>".$row['CompanyName']."</td><td class='".$Color."'>".$arith.$row['MarketCap']."%</td><td class='".$Color."'>".$arith.$row['Spread']."</td><td>".$action." ".$delete."</td></tr>"  ;
    }
    
    $table.="</table></div>";
    echo $table;
    ?>
</div>
</div> 
    
</div>
<script>
    $(document).on('click', '.Delete', function(){
	var id=$(this).attr('id');
	$.ajax({
		
		url:'DeleteStock.php',
		method:'POST',
		data:{id:id},
		success:function(response){
			if(response==1){
				alert("Stock Deleted");
				location.reload();

			}else{
				alert("Error Somewhere");
			}
		}
	})     })
</script>