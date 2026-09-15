<?php
include('Header.php');
include('../Connect.php');
$Stock_id=$_GET['Stock_id'];
    $sql="select * from stock where id='$Stock_id'";
    $query=mysqli_query($Conn, $sql);
    $sn=1;
    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
        if($row['Trend']==0){
            $Color="text-danger";
            $arith="-";

        }else{
            $Color="text-success";
            $arith="+";
 
        }
      $manipulate='<div class="col-md-12 col-sm-12">
            <div class="head push-down"><h1>Manipulate Stock Data</h1></div>
            <div class="form-group"><label>Company Name</label><input type="text" class="form-control CompanyName" placeholder="Company Name" value="'.$row['CompanyName'].'" disabled/></div>
            <div class="form-group NameStatus"></div>
                        <div class="form-group"><label>Company Logo</label><input type="text" class="form-control Logo" placeholder="www.comistar.online/Resources/Pic1.jpf" value="'.$row['Logo'].'" /></div>
                                    <div class="form-group LogoStatus"></div>

                    <div class="form-group"><label>Amount per Stock</label><input type="text" class="form-control Unit" placeholder="e.g. 0.50" value="'.$row['Unit'].'"/></div>
                                <div class="form-group AmountStatus"></div>


                <div class="form-group"><label>Spread</label><input type="text" class="form-control Spread" placeholder="e.g. 0.00001" value="'.$row['Spread'].'"/></div>
                        <div class="form-group SpreadStatus"></div>

                <div class="form-group"><label>Timeframe</label><input type="text" class="form-control TimeFrame" placeholder="e.g 2" value="'.$row['timeframe'].'"/><span>2000 = 2 seconds</span></div>
                        <div class="form-group TframeStatus"></div>

              
                <div class="form-group"><label>Market Cap</label><input type="text" class="form-control MarketCap" placeholder="Market Cap" value="'.$row['MarketCap'].'"/></div>
                        <div class="form-group McapStatus"></div>

                
                 <div class="form-group"><label>TradingView Symbol</label><input type="text" class="form-control TradingView" placeholder="e.g. USDFCB" value="'.$row['tradingview'].'" disabled/></div>
                    <div class="form-group TViewStatus"></div>

                 
                 <div class="form-group"><label>Trend</label><input type="text" class="form-control Trend" placeholder="e.g. USDFCB" value="'.$row['Trend'].'" /><span>Trend means the direction of the market 0 = Downtrend and 1 = Uptrend</span></div>
                        <div class="form-group TrendStatus"></div>

                 
                  <div class="form-group"><label>About this Stock</label><div ng-controller="myCtrl">
    <div text-angular ng-model="html"></div>
    <div class="form-group "><label>Content</label>
	<textarea ng-bind="html" class="white-box ng-binding form-control Description" name="Description">'.$row['description'].'</textarea></div>
</div></div>

 <div class="form-group" align="center"><button class="btn btn-lg btn-primary AddStock" id="'.$row['id'].'"> Update</button></div>
        

        </div>'  ;
    }
    
    echo $manipulate;
    ?>
    
    <script>
        $(document).on('click', '.AddStock', function(){
              
                var Stock_id=$(this).attr('id');
                var CompanyName=$('.CompanyName').val();
                var Logo=$('.Logo').val();
                var Unit=$('.Unit').val();
                var Spread=$('.Spread').val();
                var MarketCap=$('.MarketCap').val();
                var TimeFrame=$('.TimeFrame').val();
                var TradingView=$('.TradingView').val();
                var Trend=$('.Trend').val();
                var Description=$('.Description').val();
                $.ajax({
                    url:'UpdateStock.php',
                    method:'POST',
                    data:{Stock_id:Stock_id,CompanyName:CompanyName, Logo:Logo,Unit:Unit,Spread:Spread,MarketCap:MarketCap,TimeFrame:TimeFrame,TradingView:TradingView,Trend:Trend,Description:Description},
                    success:function(data){
                        if(data==1){
                            alert("Stock Updated Successfully");
                        }else{
                            alert("Error Somewhere");
                        }
                    }
                })

            
        })
    </script>