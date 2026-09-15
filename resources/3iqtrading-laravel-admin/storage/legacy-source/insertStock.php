<?php 
include('../Connect.php');
$CompanyName=$_POST['CompanyName'];
$Logo=$_POST['Logo'];
$TimeFrame=$_POST['TimeFrame'];
$Trend=$_POST['Trend'];
$Spread=$_POST['Spread'];
$TradingView=$_POST['TradingView'];
$Unit=$_POST['Unit'];
$MarketCap=$_POST['MarketCap'];
$Description=$_POST['Description'];

$insert="INSERT INTO stock (CompanyName, Logo, Unit, MarketCap, Spread, Trend, description, tradingview, timeframe) VALUES ('$CompanyName','$Logo','$Unit','$MarketCap','$Spread','$Trend','$Description','$TradingView','$TimeFrame')";
$query=mysqli_query($Conn, $insert);
if($query){
		echo 1;
}else{
	echo 0;
}

?>