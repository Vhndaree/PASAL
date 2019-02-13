@extends('layouts.app')

@section('content')

<div class=" ml-sm-auto col-lg-10 px-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
        <div class="col-md-12">           
            <table class="table table-hover table-sm table-responsive-sm" id="itemTable">
                    <thead class="thead-light">
                      <tr>
                        <th>S. NO.</th>
                        <th>Items name</th>
                        <th>Vendors name</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($stock)>0)
                        @foreach($stock as $post)                    
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$post->item_name}}</td>
                            <td>{{$post->vendor_name}}</td>
                            <td>{{$post->quantity}}&nbsp{{$post->unit}}</td>                            
                          </tr>
                        @endforeach
                      @endif
                    </table>
                  </div>
              </div>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            $('#itemTable').DataTable();
            console.log("Log")
          });
        </script>
    </div>
</div>
@endsection
