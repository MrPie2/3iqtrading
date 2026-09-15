<?php
include('../Connect.php');
$ClientDetail=$_POST['ClientDetail'];
$sql="select * from investors WHERE Email LIKE '%{$ClientDetail}%' OR Username LIKE '%{$ClientDetail}%' OR First_Name LIKE '%{$ClientDetail}%' order by Investor_id";
$query=mysqli_query($Conn, $sql);
$Count=mysqli_num_rows($query);

if($Count>0){

    
    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
              $output='<div class="panel panel-default"><div class="panel-heading" style="background: #e00; color: white;">'.$row['First_Name'].'</div>
              <div class="panel-body"><a href="action.php?Investor_id='.$row['Investor_id'].'&&Email='.$row['Email'].'" style="color: red; text-decoration: none"><p class="lead text-primary" style="font-size: 10pt;">Username: '.$row['Username'].'<br>Email: '.$row['Email'].'<br>Net Worth: $'.number_format($row['Fin_Asset'], 2, '.',',').'<br>Deposit: $'.number_format($row['Total_Deposit'], 2, '.',',').'</p></a></div></div>';
echo $output;

    }
    


}else{
        $output='<div class="panel panel-default"><div class="panel-heading" style="background: #e00; color: white;">No matching results</div><div class="panel-body"><p class="text-danger"> We coul not find any results matching your keyword. Trying searching another keyword(s)</p></div></div>'; 
        echo $output;


}


?>