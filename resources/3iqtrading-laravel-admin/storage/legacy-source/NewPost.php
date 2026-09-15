<?php include('Header.php'); ?>

<?php include('../Connect.php'); ?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no">

     <link rel="stylesheet" href="textAngular.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.0/spectrum.min.css" />
 
    <link  rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<div class="container-fluid">
<div class="row">
<div class="col-md-7">

<center><h2>Make a new post</h2></center>
<form class="NewContent" id="myForm" enctype="multipart/form-data">
<div class="form-group"><label>What do you want to post</label><select name="table" class="table form-control" ><option>Select table..</option>
<option value="posts">Post</option>
<option value="pages">Page</option>

</select>
</div>



<div class="ArtistName  form-group"></div>

<div class="SongTitle  form-group"></div>
<div class="Quantity  form-group"></div>
<div class="Topic form-group"></div>
<div class="Subject form-group"></div>
<div class="Genre form-group"></div>
<div class="Date_of_Publication form-group"></div>

<div class="form-group MainFile"></div>
<div class="CoverPhoto form-group"></div>

<div ng-controller="myCtrl">
    <div text-angular ng-model="html"></div>
    <div class="form-group "><label>Content</label>
	<textarea ng-bind="html" class="white-box ng-binding form-control Post_Content" name="Post_Content"></textarea></div>
</div>

<div class="form-group ActionButton"></div>

</form>
</div>

<div class="col-md-5">
   <div class="form-group">
    <div align="center"><h3>Local Resources</h3></div>
   <?php 
    $files="select * from resources order by Date Desc limit 10";
$link=mysqli_query($Conn, $files);
$count=mysqli_num_rows($link);
$resources="<div class='table-responsive'><table class='table table-striped'>
<thead>
<th>S/No</th>
<th>File Name</th>
<th>Preview</th>
<th>Action</th>

</thead>";
if($count>0){
    $sn=1;
while($row=mysqli_fetch_array($link, MYSQLI_ASSOC)){
    if($row['File_Format']=="mp4"){
    }else{
        $preview="<img style='width: 50px' src='https://www.macquarie-holding.com/Resources/".$row['File_Path']."' />";

    }
    $resources.="<tr><td>".$sn++."</td><td>".$row['File_Name']."</td><td><a href='https://www.macquarie-holding.com/Resources/".$row['File_Path']."'>".$preview."</a></td><td><button link='https://www.macquarie-holding.com/Resources/".$row['File_Path']."' class='btn btn-sm btn-primary Copy_Link'>Copy Link</button></td></tr>";
}
}else{
    $resources.="<tr><td colspan='5'>No files uploaded</td></tr>";
}
$resources.="</table></div>";
echo $resources;
    ?>
</div> 
    
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.0/spectrum.min.js"></script>
<script src="angular-spectrum-colorpicker.min.js"></script>
<script src="textAngular-dropdownToggle.js"></script>
<script src="textAngular-rangy.min.js"></script>
<script src="textAngular-sanitize.min.js"></script>
<script src="textAngularSetup.js"></script>
<script src="textAngular.min.js"></script>
<script src="script.js"></script>
</html>
<script>

function copyToClipboard(text) {
            if (window.clipboardData && window.clipboardData.setData) {
                // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
                return clipboardData.setData("Text", text);

            } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in Microsoft Edge.
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy"); // Security exception may be thrown by some browsers.
                } catch (ex) {
                    //console.warn("Copy to clipboard failed.", ex);
                    return false;
                } finally {
                    document.body.removeChild(textarea);
                }
            }
        }


$(document).ready(function(){


$("#myForm").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'insertPost.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            if(data==1){
                alert("Post Published Successfully");
                  window.location.href="openContents.php";  
            }else{
                alert('Error Somewhere');
                alert(data);
 
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


	
$("select.table").change(function(){
        var table = $(this).children("option:selected").val();
        if(table=="pages"){
            $('.NewContent').attr('id','myFileForm');
				$('.Topic').html('<label>Page Name</label><input placeholder="Page Name" name="Page_Name"type="text" class="form-control"/>');
				$('.ActionButton').html('<input name="Pages" value="Create Page"type="submit"class="btn btn-primary btn-lg Update">');
		}else{
				//$('.Catt').html('<label>Category</label><select name="Category" class="Category form-control"></select>');
				$('.MainFile').html('')
				            $('.NewContent').attr('id','myPostForm');

				$('.Topic').html('<label>Topic</label><input placeholder="Title" name="Title"type="text" class="form-control"/>')
				$('.Subject').html('<label>Subject</label><input name="Subject"placeholder="Subject"type="text" class="form-control"/>');
				$('.CoverPhoto').html('<label>Cover Photo</label><input name="Cover_Photo"type="text" placeholder="www.comistar.online/Resources/Image.jpg" class="form-control"/>');
				$('.ActionButton').html('<input name="Posts" value="Publish Post"type="submit"class="btn btn-primary btn-lg Update">');
		};
    });
    
    
loadMenu();
function loadMenu(){
$.ajax({

url:'SelectCategory.php',
method:'POST',
success:function(data){
$('.menuitems').html(data);
}

})
}


$(document).on('click', '.Copy_Link', function(){
$(this).html("Copied");
        var link=$(this).attr('link');
        copyToClipboard(link);

       
    })


	});
</script>





