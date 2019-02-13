<!--//fro validation error-->
@if(count($errors)>0)
 @foreach($errors->all() as $error)
  <div class='alert alert-danger'>
      {{$error}}
  </div>
 @endforeach
@endif
<!--for session success message-->
@if(session('status'))
<div class='alert alert-success' style="text-align:left;" role="alert">
    {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
 <hr> 
@elseif(session('success'))
 <div class='alert alert-success' style="text-align:left;" role="alert">
    {{session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
 <hr>
@endif
<!--for session failed message-->
@if(session('error'))
 <div class='alert  alert-danger'>
        {{session('error')}}
 </div>
@endif
    

