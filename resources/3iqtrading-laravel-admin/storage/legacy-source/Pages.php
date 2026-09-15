<?php include('../Connect.php'); 
include('Header.php');







?>


<div class="container">
        
        <div class="row">
           
            <div class="col-md-12">
                <div class="form-group" style="padding: 20px"><h1>Site Pages</h1></div>
                
                <div class="form-group"><a href="MyEditor.php" class="btn btn-primary btn-lg">Create New Page</a>
</div>
             <?php
             
             $sql="select * from pages";
             $query=mysqli_query($Conn, $sql);
             $Count=mysqli_num_rows($query);
             $table="<div class='table-responsive'><table class='table table-striped'><thead><th>S|No</th><th>Page Name</th><th>Child Of</th><th>Link</th><th>Icon</th><th></th><th><th></thead>";
             $sn=1;
             if($Count>0){
                 
                 
             while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
                 if($row['parent']==0){
                     $child="Parent";
                 }else{
                    $child="Child"; 
                 }
                 $table.="<tr><td>".$sn++."</td><td>".$row['Page_Name']."</td><td>".$child."</td><td>".$row['link']."</td><td>".$row['icon']."</td><td><a href='EditContent.php?link=".$row['link']."' class='btn btn-sm btn-warning'>Edit Page</a> <button  class='btn btn-sm btn-danger DeletePage' id='".$row['id']."'>Delete Page</button></td><td><a href='https://www.universetd.com/en/account.php?page_id=".$row['link']."' class='btn btn-sm btn-success'>Preview Page</a></td></tr>";
             }
             }else{
                 
                 
             }
             $table.="</table></div>";
             echo $table;
             ?>
            </div>
        </div>
    </div>
    
    <script>
        
        $(document).on('click', '.DeletePage', function(){
            var id=$(this).attr('id');
            $.ajax({
                
                url:'DeletePage.php',
                method: 'POST',
                data:{id:id},
                success:function(data){
                    if(data==1){
                        alert("Page Deleted");
                        location.reload();
                    }else{
                        alert("Error Somewhere");
                    }
                }
            })
        })
    </script>