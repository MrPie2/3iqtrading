<?php include('../Connect.php'); include('Header.php'); ?>
<head>
    
    <?php
		$link=$_GET['link'];
				    $sqlContent="select * from pages where link='$link'";
				    $queryContent=mysqli_query($Conn, $sqlContent);
				    $rowContent=mysqli_fetch_array($queryContent, MYSQLI_ASSOC);

				    ?>
	<meta charset="utf-8">
	<title>TD Bank Content Creator</title>
	<script src="ckeditor/ckeditor.js"></script>

	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
.hidden{
    display: none;
}
.form-group{
    margin-bottom: 20px;
}
    
    @media screen and (min-width: 600px){
       .Preview_Cont{
           
       width: 100%;
         overflow: scroll;  
       } 
    }
</style>
</head>

<body>
 <div class="container-fluid">
     <div align="center" style="margin-top: 30px"><h1>Page Editor <br><small style="font-size: 12pt">Use this section to create or modify existing pages on you site</small></h1></div>
     <div class="row" style="padding: 30px">
         <div class="col-md-6">
             <div class="form-group"><label>Page Name</label><input type="text" class="form-control page_name" placeholder="About Us" value="<?php echo $rowContent['Page_Name']; ?>"></div>
            <div class="form-group"><label>Link</label><input type="text" class="form-control link" placeholder="e.g.  about_Us" value="<?php echo $rowContent['link']; ?>"></div>
            <div class="form-group"><label>Icon</label><input type="text" class="form-control icon"placeholder="e.g.  fa fa-home" value="<?php echo $rowContent['icon']; ?>"></div>
             <div class="form-group"><label>Type</label><input type="text" class="form-control type" value="<?php echo $rowContent['type']; ?>" placeholder="e.g.  page"/></div>
                          <div class="form-group"><label>Cover Photo</label><input type="text" class="form-control Cover_Photo" value="<?php echo $rowContent['Cover_Photo']; ?>" placeholder="e.g.  https://www.3iqtrading.org/picsname.jpg"/></div>
                          <div class="form-group"><label>Description</label><input type="text" class="form-control Description" value="<?php echo $rowContent['Description']; ?>" placeholder="e.g. Write a short note about this page"/></div>
 <div class="form-group"><label>Target Folder</label><select class="form-control target">
     <option value="">Choose folder.....</option>
	      <option value="en">Home</option>
	      <option value="Dashboard">Dashboard</option>
            </select></div>
            <div class="form-group"><label>Child of</label><select class="form-control Child_Of">
            <?php
		
				    $sql="select * from pages";
				    $query=mysqli_query($Conn, $sql);
				    $opt="<option value='0'>Parent</option>";
				    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
				    $opt.="<option value='".$row['id']."'>".$row['Page_Name']."</option>";
				    }
				echo $opt;
				    ?>

            </select></div>
            
				  <textarea id="editor1" rows="200" style=""><?php echo $rowContent['Page_Contents']; ?> </textarea>  
		     <script>
		     CKEDITOR.dtd.$removeEmpty={};
    CKEDITOR.replace( 'editor1', { allowedContent: true, extraAllowedContent: '*[*]{*}(*)', extraPlugins: 'sourcearea', disallowedContent:'', enterMode: CKEDITOR.ENTER_BR});
</script>
<div class="mb-3">
<label>CSS Codes</label>
<style><?php echo $rowContent['styles_css']; ?></style>
	<textarea id="css" class="form-control css"rows="10"> <?php echo $rowContent['styles_css']; ?></textarea> 
	</div>
	
	<div class="mb-3">
<label>Javascript Codes</label>
	<textarea id="js" class="form-control js" rows="10"> <?php echo $rowContent['script_js']; ?></textarea> 
	</div>

     </div>
     <div class="col-md-6">
         <div style="padding: 20px; text-align: center;"><button class="btn btn-lg btn-warning PreviewEdit">Preview</button>

             <button class="btn btn-lg btn-primary Update" id="<?php echo $rowContent['id']; ?>" style="margin-left: 20px" Status="<?php echo $rowContent['Status']; ?>">Update</button></div>
         
         <div class="Preview_Cont" style=" padding-top: 60px; margin-top: 2cm; background: #eee"><div class="Preview" style="width: 1000px"></div></div>
         
     </div>
    </div> 
    
    </div>
  <script>
	initSample();
</script>
  <script>
  
 
                var data = CKEDITOR.instances.editor1.getData();
                $('.Preview').html(data);


      

      $('.Update').click(function(){
          var id=$(this).attr('id');
            var Content = CKEDITOR.instances.editor1.getData();
            var link=$('.link').val();
            var page_name=$('.page_name').val();
            var icon=$('.icon').val();
            var child_of=$('.Child_Of').val();
            var css=$('.css').val();
            var js=$('.js').val();
            var phpserver=$('.php').val();
            var Status=$(this).attr('Status');
            var Cover_Photo=$('.Cover_Photo').val();
            var Description=$('.Description').val();

            var type=$('.type').val();

            var target=$('.target').val();


          $.ajax({
              url:"UpdatePage.php",
              method:"POST",
              data:{id:id,Content:Content,link:link,page_name:page_name,icon:icon,child_of:child_of, css:css, type:type, js:js,Cover_Photo:Cover_Photo, Description:Description, target:target},
              success:function(data){
                  if(data==1){
                      alert("Page Updated");
                      location.reload();
                  }else{
                      alert("Error Somewhere"+data);
                  }
              }
          })
      })
      
      
      
         $('.UpdateRaw').click(function(){
          var id=$(this).attr('id');
            var Content = $('.RawHtml').val();
            var link=$('.link').val();
            var page_name=$('.page_name').val();
            var icon=$('.icon').val();
            var child_of=$('.Child_Of').val();
            var cssstyle=$('.css').val();
            var jsscript=$('.js').val();
            var phpserver=$('.php').val();
            var Status=$('this').attr('Status');
            var type=$('.type').val();


          $.ajax({
              url:"UpdatePage.php",
              method:"POST",
              data:{id:id,Content:Content,link:link,page_name:page_name,icon:icon,child_of:child_of, type:type,cssstyle:cssstyle,jsscript:jsscript,phpserver:phpserver},
              success:function(data){
                  if(data==1){
                      alert("Page Updated");
                      location.reload();
                  }else{
                      alert("Error Somewhere");
                  }
              }
          })
      })
      
  </script>
</body>

