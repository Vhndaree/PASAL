@extends('layouts.app')

@section('content')
<div class=" ml-sm-auto col-lg-9 px-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
            <div class="col-md-8">
            @include('inc.message')
            <div class="card">
                <div class="card-header">{{ __('Sales entry') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{action('SaleController@update',$id)}}" aria-label="{{ __('Sales enty') }}">
                        <input name="_method" type="hidden" value="patch"/> 
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Item name') }}</label>

                            <div class="col-md-6">                                
                                @if($data=DB::table('stocks')->join('items','stocks.item_id','=','items.id')->join('vendors','stocks.vendor_id','=','vendors.id')->distinct()->select('items.name as item_name','stocks.item_id')->get())
                                  <select name="item_name" class="form-control">
                                    @foreach($data as $d)
                                      <option value='{{$d->item_id}}' @if($new->item_id==$d->item_id) selected @endif>{{$d->item_name}}</option>
                                    @endforeach
                                  </select>
                                @endif                                                       
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vendor" class="col-md-4 col-form-label text-md-right">{{ __('Vendor name') }}</label>    
                            <div class="col-md-6">
                              @if($data=DB::table('stocks')->join('items','stocks.item_id','=','items.id')->join('vendors','stocks.vendor_id','=','vendors.id')->distinct()->select('vendors.name as vendor_name','stocks.vendor_id')->get())
                                <select name="vendor_name" class="form-control">
                                  @foreach($data as $d)
                                    <option value='{{$d->vendor_id}}' @if($new->vendor_id==$d->vendor_id) selected @endif>{{$d->vendor_name}}</option>
                                  @endforeach
                                </select>
                              @endif                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="quantity" value="{!!isset($new->quantity)?$new->quantity:old('quantity')!!}" required>                                
                            </div>
                        </div>                             
                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
