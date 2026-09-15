<?php include('../Connect.php'); 

$id=$_POST['id'];
$Content=mysqli_real_escape_string($Conn, $_POST['Content']);
$link=$_POST['link'];
$icon=$_POST['icon'];
$page_name=$_POST['page_name'];
$Cover_Photo=$_POST['Cover_Photo'];
$Description=mysqli_real_escape_string($Conn, $_POST['Description']);
$css=mysqli_real_escape_string($Conn, $_POST['css']);
$target=$_POST['target'];
$js=mysqli_real_escape_string($Conn, $_POST['js']);

$child_of=$_POST['child_of'];
$Status=0;
$type=$_POST['type'];

$sql="update pages set Page_Name='$page_name', Page_Contents='$Content', link='$link', icon='$icon', parent='$child_of', Cover_Photo='$Cover_Photo', Description='$Description', type='$type', styles_css='$css', script_js='$js', Status='$Status', target='$target' where id='$id'";
$query=mysqli_query($Conn, $sql);
if($query){
    echo 1;
}else{
    echo 0;
    echo mysqli_error($Conn);
}



?>