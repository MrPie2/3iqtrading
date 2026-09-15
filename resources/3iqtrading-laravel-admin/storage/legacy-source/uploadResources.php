<?php 
include('../Connect.php');

$File_Name=basename($_FILES['mainFile']['name']);
$target="../Resources/".basename($_FILES['mainFile']['name']);
$type = explode('.', $_FILES['mainFile']['name']);
	$type = $type[count($type) - 1];
$File_Path=$_FILES['mainFile']['name'];


if(move_uploaded_file($_FILES['mainFile']['tmp_name'], $target)){
	echo 1;
    $sql="INSERT INTO resources (File_Name, File_Path, File_Format)VALUES('$File_Path','$File_Name','$type')";
    $query=mysqli_query($Conn, $sql);

}else{
	echo 0;
}

	
?>