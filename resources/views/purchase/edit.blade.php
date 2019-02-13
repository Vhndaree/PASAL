@extends('layouts.app')

@section('content')
<div class=" ml-sm-auto col-lg-9 px-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
            <div class="col-md-8">
            @include('inc.message')
            <div class="card">
                <div class="card-header">{{ __('Purchase entry') }}</div> 

                <div class="card-body">
                    <form method="POST" action="{{action('PurchaseController@update',$id)}}" aria-label="{{ __('Update purchase') }}">
                        <input name="_method" type="hidden" value="patch"/>                         
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Item name') }}</label>
                            <div class="col-md-6">
                              @if($data=DB::table('items')->get())
                                <select name="name" class="form-control">
                                  @foreach($data as $d)
                                    <option value='{{$d->id}}' @if($new->item_id==$d->id) selected @endif>{{$d->name}}</option>
                                  @endforeach
                                </select>
                              @endif                              
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="vendor" class="col-md-4 col-form-label text-md-right">{{ __('Vendor name') }}</label>    
                                <div class="col-md-6">
                                  @if($data=DB::table('vendors')->get())
                                    <select name="vendor" class="form-control">
                                      @foreach($data as $d)
                                        <option value='{{$d->id}}' @if($new->vendor_id==$d->id) selected @endif>{{$d->name}}</option>
                                      @endforeach
                                    </select>
                                  @endif                              
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="unitprice" class="col-md-4 col-form-label text-md-right">{{ __('Unit price') }}</label>
                            <div class="col-md-6">
                                <input id='name' type="text" class="form-control" name="unitprice" value="{!! isset($new->unitprice)?$new->unitprice:old('unitprice') !!}" required autofocus>                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="quantity" value='{!! isset($new->quantity)?$new->quantity:old('quantity') !!}' required autofocus>                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mfg_date" class="col-md-4 col-form-label text-md-right">{{ __('Mfg. Date') }}</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="mfg_date" value="{!!isset($new->mfg_date)?$new->mfg_date:old('mfg_date')!!}" placeholder="manufacturing date">                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Validity" class="col-md-4 col-form-label text-md-right">{{ __('Validity (in days)') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="validity" value="{!!isset($new->expiry_date)?(strtotime($new->expiry_date)-strtotime($new->mfg_date))/86400:old('validity')!!}" placeholder='best for days'>                                
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
