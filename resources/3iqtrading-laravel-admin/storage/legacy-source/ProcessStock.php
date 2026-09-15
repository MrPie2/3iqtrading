<?php include('../Connect.php'); 

    $sql="select * from stock";
    $query=mysqli_query($Conn, $sql);
    $date=date('d');
    $Day=date('D');
    echo $Day;
    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $id=$row['id'];
        $dayToLoad=$row['dayToLoad'];
        $Spread=$row['Spread'];
        

        if($dayToLoad!=$date && $Day!='Sun' && $Day!='Sat' && $row['Trend']==1){
            $newSpread=$Spread+=0.0001;

            $updateDate="update stock set dayToLoad='$date', Spread='$newSpread' where id='$id'";
            $checkUpdate=mysqli_query($Conn, $updateDate);
        }else if($dayToLoad!=$date && $Day!='Sun' && $Day!='Sat' && $row['Trend']==0){
            $newSpread-$Spread-=0.0001;

            $updateDate="update stock set dayToLoad='$date', Spread='$newSpread' where id='$id'";
            $checkUpdate=mysqli_query($Conn, $updateDate);
        }
        
        
    }





?>