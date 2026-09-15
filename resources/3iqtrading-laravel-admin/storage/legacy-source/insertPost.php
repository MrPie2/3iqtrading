<?php 
include('../Connect.php');
if($_POST['Post']){
$Title=mysqli_real_escape_string($Conn, $_POST['Title']);
$Subject=mysqli_real_escape_string($Conn, $_POST['Subject']);
$htmlcontent=mysqli_real_escape_string($Conn, $_POST['Post_Content']);
$Cover_Photo=mysqli_real_escape_string($Conn, $_POST['Cover_Photo']);
$Status=1;
$Date= date("l d F Y ");

$sql="INSERT INTO posts (Post_Subject, Post_Topic, Post_Content, Cover_Photo, Date)VALUES('$Subject', '$Title', '$htmlcontent', '$Cover_Photo', '$Date')";
$query=mysqli_query($Conn, $sql);
if($query){
	echo 1;
}else{
		echo 0;
		echo mysqli_error($Conn);

}
	
}else{
  $Page_Name=$_POST['Page_Name'];
  $Page_Contents=mysqli_real_escape_string($Conn, $_POST['Post_Content']);
$Status=0;


$insert="INSERT INTO pages (Page_Name, Page_Contents, Status) VALUES ('$Page_Name','$Page_Contents','$Status')";
$query=mysqli_query($Conn, $insert);
if($query){
		echo 1;
}else{
	echo 0;
}  
    
    
}



?>