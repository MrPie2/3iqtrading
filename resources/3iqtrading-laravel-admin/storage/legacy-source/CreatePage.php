<?php include('../Connect.php'); 

$Content=mysqli_real_escape_string($Conn, $_POST['Content']);
$Link=$_POST['link'];
$Page_Name=$_POST['page_name'];
$Icon=$_POST['icon'];
$Child_of=$_POST['child_of'];
if($Child_of!=""){
    $hasChild=1;
}else{
    $hasChild="";
}
$Status=0;
$type=$_POST['type'];
$css=mysqli_real_escape_string($Conn, $_POST['css']);
$target=$_POST['target'];
$js=mysqli_real_escape_string($Conn, $_POST['js']);


$Cover_Photo=$_POST['Cover_Photo'];
$Description=mysqli_real_escape_string($Conn, $_POST['Description']);
$Date=date("l d F Y ");



if($target=="en"){
    $concat="$"."link";
  $content="<?php session_start() $concat='".$Link."'; include('Head.php'); include('Navbar.php'); include('page.php'); ?>";  
    
}else{
    $concat="$"."lin";
   $content="<?php $concat='".$Link."'; include('Header.php');  include('page.php'); ?>"; 
    
}
$path=fopen("../".$target."/".$Link.".php", "w");
fwrite($path, $content);


$sql="insert into pages (Page_Name, Page_Contents, link, icon, parent, HasChild, type, Cover_Photo, Description, styles_css, script_js, Status, Date) values ('$Page_Name', '$Content', '$Link', '$Icon', '$Child_of', '$hasChild', '$type', '$Cover_Photo','$Description', '$css', '$js', '$Status', '$Date')";
$query=mysqli_query($Conn, $sql);
if($query){
    echo 1;
}else{
    echo 0;
    echo mysqli_error($Conn);
}



?>