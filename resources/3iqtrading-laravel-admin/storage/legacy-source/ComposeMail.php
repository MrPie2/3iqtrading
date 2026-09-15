<!DOCTYPE html>
<html ng-app="myApp">

<head>
   <meta name="viewport" content="width=device-width, user-scalable=no"/>

<style>

</style>
    <link rel="stylesheet" href="textAngular.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.0/spectrum.min.css" />
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link  rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<div class="container">

<div class="col-md-12">

<?php

if(isset($_GET['BulkEmail'])){

echo '<form id="myBulkForm" enctype="multipart/form-data">
<h1>Send Bulk Mails - to </h1><input type="text" class="form-control" name="SendTo" value="'.$_GET['BulkEmail'].'"/>
<div class="form-group"><label>Subject</label><input class="form-control"type="text" placeholder="Subject" name="Subject"/></div>

<div ng-controller="myCtrl">
    <div text-angular ng-model="html"></div>
    <div class="form-group"><textarea style="border: none" ng-bind="html" name="htmlcontent" class="htmlcontent form-control white-box ng-binding"></textarea></div>
</div>
<div class="form-group"><input name="publish" value="Send"type="submit"class="btn btn-success PublishBulk"></div>';
}else{

echo '<form id="myForm" enctype="multipart/form-data">
<h1>Send Mail - to </h1><input type="text" class="form-control" name="SendTo" value="'.$_GET['Email'].'"/>
<div class="form-group"><label>Subject</label><input class="form-control"type="text" placeholder="Subject" name="Subject"/></div>

<div ng-controller="myCtrl">
    <div text-angular ng-model="html"></div>
    <div class="form-group"><textarea style="border: none" ng-bind="html" name="htmlcontent" class="htmlcontent form-control white-box ng-binding"></textarea></div>
</div>
	<div class="form-group"><input name="publish" value="Send"type="submit"class="btn btn-primary Publish"></div>';

}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.7.0/spectrum.min.js"></script>
<script src="angular-spectrum-colorpicker.min.js"></script>
<script src="textAngular-dropdownToggle.js"></script>
<script src="textAngular-rangy.min.js"></script>
<script src='textAngular-sanitize.min.js'></script>
<script src="textAngularSetup.js"></script>
<script src='textAngular.min.js'></script>


<script src="script.js"></script>
</form>
</div>

</div>
</html>
<script>
$(document).ready(function(){
	
$("#myForm").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
	
	
    $.ajax({
        url: 'SendMail.php',
        type: 'POST',
        data: formData,
        success: function(data) {
		alert('Email Sent Successfully');       
		},
        cache: false,
        contentType: false,
        processData: false
    });
});




$("#myBulkForm").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
	
	
    $.ajax({
        url: 'SendBulkMail.php',
        type: 'POST',
        data: formData,
        success: function(data) {
            if(data==1){
                		alert('All Emails Sent Successfully');       

            }else{
                                		alert('Error somewhere, Could not send  emails');       

            }
		},
        cache: false,
        contentType: false,
        processData: false
    });
});

})
</script>



