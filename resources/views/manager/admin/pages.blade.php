@extends('manager.layouts.admin')
@section('content')
<body>
 <div class="container-fluid">
     <div align="center" style="margin-top: 30px">
         <h1>Page Maker <br><small style="font-size: 12pt">Use this section to create or modify existing pages on you site</small></h1>
         </div>
            <div class="row" style="padding: 30px">
         <div class="col-md-7">
             <div class="form-group"><label>Page Name</label><input type="text" class="form-control page_name" placeholder="About Us"></div>
            <div class="form-group"><label>Link</label><input type="text" class="form-control link" placeholder="e.g.  about_Us"></div>
            <div class="form-group"><label>Icon</label><input type="text" class="form-control icon"placeholder="e.g.  fa fa-home"></div>
            <div class="form-group"><label>Type</label><input type="text" class="form-control type"placeholder="e.g.  page"></div>
            <div class="form-group"><label>Description</label><textarea type="text" class="form-control Description"placeholder="Description about the page or service"></textarea></div>
            <div class="form-group"><label>Cover_Photo</label><input type="text" class="form-control Cover_Photo"placeholder="https://www.macquarie-holdings.com/Resources/pic.jpg"></div>
            <div class="form-group"><label>Target Folder</label><select class="form-control target">
            <option value="">Choose folder.....</option>
	      <option value="en">Home</option>
	      <option value="Dashboard">Dashboard</option>
            </select></div>
            <div class="form-group"><label>Child of</label><select class="form-control Child_Of">
           

            </select></div>
            
				  <textarea id="editor1" rows="1000"> </textarea>  
     <script>
		  CKEDITOR.dtd.$removeEmpty={};
    CKEDITOR.replace( 'editor1', { allowedContent: true, extraAllowedContent: '*[*]{*}(*)', extraPlugins: 'sourcearea', disallowedContent:'', enterMode: CKEDITOR.ENTER_BR});
</script>
<div class="mb-3">
<label>CSS Codes</label>
	<textarea id="css" class="form-control css"rows="10"> </textarea> 
	</div>
	
	<div class="mb-3">
<label>Javascript Codes</label>
	<textarea id="js" class="form-control js" rows="10"> </textarea> 
	</div>
	
	 
     </div>
     <div class="col-md-5">
         <div style="padding: 20px; text-align: center;"><button class="btn btn-lg btn-warning PreviewEdit">Preview</button>

             <button class="btn btn-lg btn-primary Upload"id="" style="margin-left: 20px">Upload</button></div>
         
         <div class="Preview hidden" style=" padding: 20px; background: #eee"></div>
         
     </div>
    </div> 
    
    </div>
    @endsection('content')
  <script>
	initSample();
</script>
  <script>
  
  $('.PreviewEdit').click(function(){
                //var data = CKEDITOR.instances.editor1.getData();
                //$('.Preview').html(data).removeClass('hidden');


      
  })
      $('.Upload').click(function(){
            var Content = CKEDITOR.instances.editor1.getData();
            var link=$('.link').val();
            var page_name=$('.page_name').val();
            var icon=$('.icon').val();
            var child_of=$('.Child_Of').val();
                        var type=$('.type').val();
                        var Cover_Photo=$('.Cover_Photo').val();
                            var Description=$('.Description').val();
                            var css=$('.css').val();
                            var js=$('.js').val();

var target=$('.target').val();
          $.ajax({
              url:"CreatePage.php",
              method:"POST",
              data:{Content:Content,link:link,page_name:page_name, Cover_Photo:Cover_Photo, Description:Description, icon:icon, type:type,child_of:child_of, css:css,js:js, target:target},
              success:function(data){
                  if(data==1){
                      alert("Page Updated");
                  }else{
                      alert("Error Somewhere");
                  
                  }
              }
          })
      })
      
  </script>
</body>