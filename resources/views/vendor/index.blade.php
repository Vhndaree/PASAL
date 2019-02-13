@extends('layouts.app')

@section('content')
<div class=" ml-sm-auto col-lg-10 px-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
        <div class="col-md-12">
            <table class="table table-hover table-sm table-responsive-sm" id="itemTable">
                    <thead class="thead-light">
                      <tr>
                        <th>S. NO.</th>
                        <th>Vendor name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($vendor)>0)
                        @foreach($vendor as $post)                    
                          <tr>
                            <td>{{$loop->index+1}}</td>
                            <td><a href ="/posts/item/{{$post->id}}"> {{$post->name}} </a></td>
                            <td>{{$post->address}}</td>
                            <td>{{$post->contact_no}}</td>
                            @if(auth()->user()->id==$post->user_id)
                                <td style="line-height: 3em;">                          
                                  <a href="{{action('VendorController@edit',$post['id'])}}" class="btn btn-outline-primary d-block d-sm-inline mr-2" title='UPDATE'><i class="fa fa-edit"></i></button></a>
                                  <form onsubmit="return confirm('Are you sure to delete?')" method="post" action="{{ action('VendorController@destroy', $post->id) }}" aria-label="{{__('Item deleted')}}" class="d-inline">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></button>
                                  </form>
                                </td>
                            @else
                               <td>
                                   <span style='color:red' class= 'btn' title='This entry is not belongs to you.'>not allowed</span>
                               </td>
                            @endif
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
    </div>
</div>
@endsection
