<?php 
include('../Connect.php');
$target="Resources/".basename($_FILES['File']['name']);

$File=$_FILES['File']['name'];
$Testifier_Name=$_POST['Testifier_Name'];
$Short_Note=$_POST['Short_Note'];
$File_Format=$_POST['File_Format'];


if(move_uploaded_file($_FILES['File']['tmp_name'],$target)){
	
$sql="INSERT INTO testimonials (FilePath, Testifier_Name, Short_Note, File_Format) VALUES ('$File','$Testifier_Name', '$Short_Note','$File_Format')";
$query=mysqli_query($Conn, $sql);
	echo "Testimonial uploaded successfully";
}else{
	echo "Could not upload file(s)".mysqli_error($Conn);
	
}

?>