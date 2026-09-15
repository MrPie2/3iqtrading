<section>
        
   <div id="ClientSearchModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" style="color: white; background: red">
            <h4 class="modal-title">Search Result</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      
      </div>
      <div class="modal-body SearchResult">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <div class="input-group"><input class="form-control ClientDetails" placeholder="Search by Username or Email"type="text"/><span class="input-group-btn "><button class="btn btn-md btn-red SearchClient">Search</button></span></div>
    
</section>
<br>


<script>
    $('.SearchClient').click(function(){
        var ClientDetail=$('.ClientDetails').val();
        
        $.ajax({
         url:'SearchClient.php',
         method:'POST',
         data:{ClientDetail:ClientDetail},
         success:function(data){
             $('.SearchResult').html(data);
            $('#ClientSearchModal').modal('show');
             
         }
        })
       
    })
</script>