<?php include('../Connect.php'); include('Header.php'); ?>
<header>
<meta name="viewport" content="width=device-width, user-scalable=no">

<script src="../Jquery-3.5.1.js"></script>
    <script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css"/>

</header>
<?php include('NavBar.php'); ?>
<body>
    <div class="container"><br>
<div align="center"><h3>Upload Resources <br><small class="lead" style="font-size: 12pt">These resources will be re-used when making contents</small></h3>
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">Upload Resources</button>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog"  
   aria-labelledby="myModalLabel" aria-hidden="true"> 
   <div class="modal-dialog">    
      <div class="modal-content"> 
         <div class="modal-header bg-primary"> 
            <button type="button" class="close"  
               data-dismiss="modal" aria-hidden="true"> 
                  &times; 
            </button> 
            <h4 class="modal-title" id="myModalLabel"> 
               Upload Resources
            </h4> 
         </div> 
         <div class="modal-body">
<form id="uploadResourcesForm" enctype="multipart/form-data">		 
			

			<div class="form-group"><label>Choose Resources</label><input name="mainFile" type="file" id="imgInp" class="form-control"/> </div>

		 <div class="preview hidden">
		     
<img class="thumbnail img-responsive"id="blah" src="#" />
<div class="progress" style="height: 20px;">
              <div class="progress-bar progress-bar-primary" id='progress-bar' role="progressbar" style="width:0%;" ></div>
            </div>
</div>



			
         </div>

		 
         <div class="modal-footer"> 
            <button type="button" class="btn btn-default"  
               data-dismiss="modal">Close 
            </button> 
            <button type="submit" id="submitButton" class="Upload btn btn-primary"> 
               Upload 
            </button> 
         </div>
</form>		 
      </div><!-- /.modal-content --> 
</div></div><!-- /.modal --> 
<br><br>
<section>
<div class="form-group">
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
        $preview="<img style='width: 50px' src='../Resources/".$row['File_Path']."' />";

    }
    $resources.="<tr><td>".$sn++."</td><td>".$row['File_Name']."</td><td><a href='../Resources/".$row['File_Path']."'>".$preview."</a></td><td><button class='btn btn-danger btn-sm Delete' id='".$row['id']."'>Delete</button></td><tr>";
}
}else{
    $resources.="<tr><td colspan='5'>No files uploaded</td></tr>";
}
$resources.="</table></div>";
echo $resources;
    ?>
</div>

</section>
</div>
</body>
<script>
$("#uploadResourcesForm").submit(function(e){
					e.preventDefault();
					var frm=new FormData(this);
					$.ajax({
						xhr:function(){ //Callback for creating the XMLHttpRequest object
							var httpReq=new XMLHttpRequest();//monitor an upload's progress. //amount of progress
							httpReq.upload.addEventListener("progress",function(ele){
								 if (ele.lengthComputable) {//property is a boolean flag indicating if the resource concerned by the ProgressEvent has a length that can be calculated.
									var percentage=((ele.loaded / ele.total) * 100); 
									$("#progress-bar").css("width",percentage+"%");
									$("#progress-bar").html(Math.round(percentage)+"%");
								 }
							});
							return httpReq;
						},
                        url: 'uploadResources.php',
						type:"POST",
						contentType: false,
						processData: false,//If you want to send a DOMDocument, or other non-processed data, set this option to false.
						data:frm,
						beforeSend:function(){
							$("#progress-bar").css("width","0%");
							$("#progress-bar").html("0%");
						},
						success:function(res){
						    if(res==1){
							$("#progress-bar").html("Completed");
							$("#progress-bar").addClass("progress-bar-success").removeClass("progress-bar-primary");
							setTimeout(function(){
							    location.reload();
							}, 400);

						    }
						},
						error:function(xhr){
						alert("Upload Failed : "+xhr.statusText);
						}
					});
				});

/*
$("#uploadResourcesForm").unbind('submit').bind('submit', function() {

var form = $(this);
var formData = new FormData($(this)[0]);

$.ajax({
    
    xhr:function(){ //Callback for creating the XMLHttpRequest object
              var httpReq=new XMLHttpRequest();//monitor an upload's progress. //amount of progress
              httpReq.upload.addEventListener("progress",function(ele){
                 if (ele.lengthComputable) {//property is a boolean flag indicating if the resource concerned by the ProgressEvent has a length that can be calculated.
                  var percentage=((ele.loaded / ele.total) * 100); 
                  $("#progress-bar").css("width",percentage+"%");
                  $("#progress-bar").html(Math.round(percentage)+"%");
                 }else{
                   var percentage=((ele.loaded / ele.total) * 100); 
                  $("#progress-bar").css("width",percentage+"%");
                  $("#progress-bar").html(Math.round(percentage)+"%");  
                 }
              });
              return httpReq;
            },
    url: 'uploadResources.php',
    type: 'POST',
    data: formData,
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    timeout: 86400000,
beforeSend:function(){
              $("#progress-bar").css("width","0%");
              $("#progress-bar").html("0%");
            },

    success:function(response) {
        if(response== 1) {
            alert('Resources Upload Successfully');
location.reload();
        }
        else if(response==0){
            alert('Error Somewhere');
        }
    }

});


})
*/

    $(document).on('click', '.Delete', function(){

        var id=$(this).attr('id');
        $.ajax({
            url:'deleteResources.php',
            method:'POST',
            data:{id:id},
            success:function(data){
                if(data==1){
alert("Resource Deleted Successfully");
location.reload();
                }else{
                    alert("Error Somewhere");
                }
            }
        })
    })

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#vid').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
		$('.preview').removeClass("hidden");
    }
}

$("#imgInp").change(function(){
    readURL(this);
});


</script>