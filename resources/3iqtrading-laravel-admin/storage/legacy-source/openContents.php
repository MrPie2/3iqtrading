<?php include('Header.php'); ?> 
    <meta name="viewport" content="width=device-width, user-scalable=no">

<style>
th {
  background-color: #57e;
  color: white;
}

tr:hover {
	background-color: #eee;}
	
	tr:nth-child(even):hover {
		background-color: #eee;
color: #666;
}
tr:nth-child(even) {background-color: #ffc;
color: #666;
}

</style>
<?php include('NavBar.php');?>

<div class="container">
    <div class="row" >
        <div class="col-12" align="center" style="padding: 20px">
        <p>To make a new Blog Post click the button Below <br><a href="NewPost.php" class="btn btn-primary btn-lg">Make a New Post</a></p>
        </div>
    </div>
<div class="row">
<div class="col-md-12" style="padding: 0">

<?php
include('../Connect.php');
if(isset($_GET['table'])){
	$table=$_GET['table'];
}else{
    $table="posts";
}

if($table=="files"){
	
	echo "<center><h1><big>Files</big></h1></center>";

$sql="SELECT * FROM $table";
$query=mysqli_query($Conn, $sql);
$output='<div class="table-responsive"> 
   <table class="table"> 
      <thead> 
         <tr> 
            <th>File id</th> 
            <th>Song Title</th>
            <th>Artist Name</th>
            <th>Category</th> 
			<th>Cover Photo</th>
			<th>Post Content</th>
            <th>File Name</th>
            <th>Status</th> 
			<th>Date</th> 
            <th>Time</th> 
            <th>Action</th> 


			
         </tr> 
      </thead> 
      <tbody>';
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
	$string=substr($row['Post_Content'], 0, 500);
	$dot="...";
	$newString=$string.$dot;
 
	$output.= '
         <tr> 
            <td>'.$row['File_id'].'</td> 
            <td style="position: sticky; left: 0">'.$row['Song_Title'].'</td> 
            <td >'.$row['Artist_Name'].'</td>
            <td>'.$row['Category'].'</td>
            <td><a href="'.$row['Cover_Photo'].'"><img src="'.$row['Cover_Photo'].'" width="50px" height="50px"/></a></td>
			<td><textarea style="background: transparent; border: 0px; font-size: 12pt; resize: none; overflow: hidden"class="Contents lead">'.$newString.'</textarea></td>
            <td>'.$row['File_Path'].'</td>
            <td>'.$row['Status'].'</td> 
			<td>'.$row['Date'].'</td> 
            <td>'.$row['Time'].'</td> 
            <td><button class="btn btn-danger btn-block Delete" id="File_id">Delete</button>
			<a id="'.$row['File_id'].'"class="Edit btn btn-primary btn-block" href="EditPost.php?File_id='.$row['File_id'].' && table=files " >Edit</a>
			</td> 			
         </tr>
		 
		 
		 
		 ';
      
   
}
$output.='</tbody> 
   </table></div> ';
echo $output;
}else{
	echo "<center><h3><big>Blog Posts</big></h3></center>";
	
$sql="SELECT * FROM $table";
$query=mysqli_query($Conn, $sql);
$output='<div class="table-responsive"> 
   <table class="table"> 
      <thead> 
         <tr> 
            <th>S/No</th> 
            <th>Post Subject</th>
            <th>Post Topic</th>
			<th>Cover Photo</th>
			<th>Post Content</th>
			<th>Date</th> 
            <th>Time</th> 
            <th>Action</th> 


			
         </tr> 
      </thead> 
      <tbody>';
      $sn=0;
while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $sn++;
	$string=substr($row['Post_Content'], 0, 1000);
	$dot="...";
	$newString=$string.$dot;
 
	$output.= '
         <tr> 
            <td>'.$sn.'</td> 
			<td>'.$row['Post_Topic'].'</td>
			<td>'.$row['Post_Subject'].'</td> 
            <td><a href="'.$row['Cover_Photo'].'"><img src="'.$row['Cover_Photo'].'" width="50px" height="50px"/></a></td>
			<td><textarea style="background: transparent; border: 0px; font-size: 12pt; resize: none; overflow: hidden"class="Contents lead">'.$newString.'</textarea></td>
			<td>'.$row['Date'].'</td> 
            <td>'.$row['Time'].'</td> 
            <td><button class="DeletePost btn btn-danger btn-block" table="'.$table.'" id="'.$row['Post_id'].'">Delete</button>
			</td> 			
         </tr>
		 
		 
		 
		 ';
      
   
}
$output.='</tbody> 
   </table></div> ';
echo $output;
	
}
?>
</div>

</div>
</div>

<script>
$(document).on('click','.DeletePost', function(){
	var table=$(this).attr('table');
var id=$(this).attr('id');
$.ajax({

url:'DeletePost.php',
method:'POST',
data:{table:table, id:id},
success:function(data){
if(data==1){
    alert("Post Deleted Successfully");
    location.reload();
}else{
    alert("Error Somewhere");
}
}

})
})


$(document).on('click','.DeleteBook', function(){
	var table=$(this).attr('table');
var id=$(this).attr('id');
$.ajax({

url:'DeleteBook.php',
method:'POST',
data:{table:table, id:id},
success:function(data){
if(data==1){
    alert("Book Deleted Successfully");
    location.reload();
}else{
    alert("Error Somewhere");
}
}

})
})
</script>
