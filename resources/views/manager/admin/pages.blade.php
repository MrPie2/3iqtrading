@extends('manager.layouts.admin')
@section('content')

<div class="container">
        
        <div class="row">
           
            <div class="col-md-12">
                <div class="form-group" style="padding: 20px"><h1>Site Pages</h1></div>
                
                <div class="form-group"><a href="/create-page" class="btn btn-primary btn-lg">Create New Page</a>
</div>

<div class="pages_container"></div>
             
            </div>
        </div>
    </div>
    

@endsection
    <script>
        
        $(document).on('click', '.DeletePage', function(){
            var id=$(this).attr('id');
            $.ajax({
                
                url:'DeletePage.php',
                method: 'POST',
                data:{id:id},
                success:function(data){
                    if(data==1){
                        alert("Page Deleted");
                        location.reload();
                    }else{
                        alert("Error Somewhere");
                    }
                }
            })
        })


    </script>