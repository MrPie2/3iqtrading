<?php include('Header.php'); include('../Connect.php'); ?>

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no">

     <link rel="stylesheet" href="textAngular.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.0/spectrum.min.css" />
 
    <link  rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" />
    
    <style>
    .push-down{
        margin-top: 1cm;
    }
</style>
</head>

<div class="container" ng-app="myApp">
    <div class="row">
        
        <div class="col-md-7 col-sm-7">
            <div class="head push-down"><h1>Stock Market Data</h1></div>
            <div class="form-group"><label>Company Name</label><input type="text" class="form-control CompanyName" placeholder="Company Name"/></div>
            <div class="form-group NameStatus"></div>
                        <div class="form-group"><label>Company Logo</label><input type="text" class="form-control Logo" placeholder="www.comistar.online/Resources/Pic1.jpf"/></div>
                                    <div class="form-group LogoStatus"></div>

                    <div class="form-group"><label>Amount per Stock</label><input type="text" class="form-control Unit" placeholder="e.g. 0.50"/></div>
                                <div class="form-group AmountStatus"></div>


                <div class="form-group"><label>Spread</label><input type="text" class="form-control Spread" placeholder="e.g. 0.00001"/></div>
                        <div class="form-group SpreadStatus"></div>

                <div class="form-group"><label>Timeframe</label><input type="text" class="form-control TimeFrame" placeholder="e.g 2"/><span>2000 = 2 seconds</span></div>
                        <div class="form-group TframeStatus"></div>

              
                <div class="form-group"><label>Market Cap</label><input type="text" class="form-control MarketCap" placeholder="Market Cap"/></div>
                        <div class="form-group McapStatus"></div>

                
                 <div class="form-group"><label>TradingView Symbol</label><input type="text" class="form-control TradingView" placeholder="e.g. USDFCB"/></div>
                    <div class="form-group TViewStatus"></div>

                 
                 <div class="form-group"><label>Trend</label><input type="text" class="form-control Trend" placeholder="e.g. USDFCB"/><span>Trend means the direction of the market 0 = Downtrend and 1 = Uptrend</span></div>
                        <div class="form-group TrendStatus"></div>

                 
                  <div class="form-group"><label>About this Stock</label><div ng-controller="myCtrl">
    <div text-angular ng-model="html"></div>
    <div class="form-group "><label>Content</label>
	<textarea ng-bind="html" class="white-box ng-binding form-control Description" name="Description"></textarea></div>
</div></div>

 <div class="form-group" align="center"><button class="btn btn-lg btn-primary AddStock"> Add Stock</button></div>

                        

        </div>
        
        <div class="col-md-5 col-sm-5">
                <div align="center" class="push-down"><h3>Local Resources</h3></div>
   <?php 
    $files="select * from resources order by Date Desc limit 10";
$link=mysqli_query($Conn, $files);
$count=mysqli_num_rows($link);
$resources="<div class='table-responsive'><table class='table table-striped'>
<thead>
<th>S/No</th>
<th>File Name</th>
<th>Preview</th>
<th>Action</th>

</thead>";
if($count>0){
    $sn=1;
while($row=mysqli_fetch_array($link, MYSQLI_ASSOC)){
    if($row['File_Format']=="mp4"){
    }else{
        $preview="<img style='width: 50px' src='Resources/".$row['File_Path']."' />";

    }
    $resources.="<tr><td>".$sn++."</td><td>".$row['File_Name']."</td><td><a href='Resources/".$row['File_Path']."'>".$preview."</a></td><td><button link='https://www.comistar.online/Resources/".$row['File_Path']."' class='btn btn-sm btn-primary Copy_Link'>Copy Link</button></td></tr>";
}
}else{
    $resources.="<tr><td colspan='5'>No files uploaded</td></tr>";
}
$resources.="</table></div>";
echo $resources;
    ?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.0/spectrum.min.js"></script>
<script src="angular-spectrum-colorpicker.min.js"></script>
<script src="textAngular-dropdownToggle.js"></script>
<script src="textAngular-rangy.min.js"></script>
<script src="textAngular-sanitize.min.js"></script>
<script src="textAngularSetup.js"></script>
<script src="textAngular.min.js"></script>
<script src="script.js"></script>

<script>
    
$(document).on('click', '.Copy_Link', function(){
$(this).html("Copied");
        var link=$(this).attr('link');
        copyToClipboard(link);

       
    })
function copyToClipboard(text) {
            if (window.clipboardData && window.clipboardData.setData) {
                // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
                return clipboardData.setData("Text", text);

            } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in Microsoft Edge.
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy"); // Security exception may be thrown by some browsers.
                } catch (ex) {
                    //console.warn("Copy to clipboard failed.", ex);
                    return false;
                } finally {
                    document.body.removeChild(textarea);
                }
            }
        }
        
        $('.AddStock').click(function(){
            if($('.CompanyName').val().trim()==""){
              $('.NameStatus').html("Company name required").addClass('alert alert-danger');
            }else{
               $('.NameStatus').html("").removeClass('alert alert-danger'); 
            }
            
               if($('.Logo').val().trim()==""){
              $('.LogoStatus').html("Company logo required").addClass('alert alert-danger');
            }else{
               $('.LogoStatus').html("").removeClass('alert alert-danger'); 
            }
            
               if($('.Unit').val().trim()==""){
              $('.AmountStatus').html("Amount per Stock required").addClass('alert alert-danger');
            }else{
               $('.AmountStatus').html("").removeClass('alert alert-danger'); 
            }
            
                    if($('.Spread').val().trim()==""){
              $('.SpreadStatus').html("Spread required").addClass('alert alert-danger');
            }else{
               $('.SpreadStatus').html("").removeClass('alert alert-danger'); 
            }
            
            if($('.MarketCap').val().trim()==""){
              $('.McapStatus').html("Market Cap required").addClass('alert alert-danger');
            }else{
               $('.McapStatus').html("").removeClass('alert alert-danger'); 
            }
            
            if($('.TimeFrame').val().trim()==""){
              $('.TframeStatus').html("Timeframe required").addClass('alert alert-danger');
            }else{
               $('.TframeStatus').html("").removeClass('alert alert-danger'); 
            }
            
              if($('.TradingView').val().trim()==""){
              $('.TviewStatus').html("Trading view symbol required").addClass('alert alert-danger');
            }else{
               $('.TviewStatus').html("").removeClass('alert alert-danger'); 
            }
            
              if($('.Trend').val().trim()==""){
              $('.TrendStatus').html("Trend required").addClass('alert alert-danger');
            }else{
               $('.TrendStatus').html("").removeClass('alert alert-danger'); 
            }
            
            
            if($('.Trend').val().trim()!="" && $('.TradingView').val().trim()!="" && $('.TimeFrame').val().trim()!="" && $('.MarketCap').val().trim()!="" && $('.Spread').val().trim()!="" && $('.Unit').val().trim()!="" && $('.Logo').val().trim()!="" && $('.CompanyName').val().trim()!="" && $('.Trend').val().trim()!=""){
                
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
                    url:'insertStock.php',
                    method:'POST',
                    data:{CompanyName:CompanyName, Logo:Logo,Unit:Unit,Spread:Spread,MarketCap:MarketCap,TimeFrame:TimeFrame,TradingView:TradingView,Trend:Trend,Description:Description},
                    success:function(data){
                        if(data==1){
                            alert("Stock Added Successfully");
                        }else{
                            alert("Error Somewhere");
                        }
                    }
                })

            }
        })
</script>