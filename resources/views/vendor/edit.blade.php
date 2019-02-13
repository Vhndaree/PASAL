@extends('layouts.app')
@section('content')
<div class=" ml-sm-auto col-lg-9 px-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
            <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vendor entry') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('VendorController@update',$id) }}" aria-label="{{__('Vendor added')}}">
                        <input name='_method' type='hidden' value='put'/>
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Vendor Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{!! isset($new->name)?$new->name:old('name') !!}"  required autofocus>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                            <input id='name' type="text" class="form-control" name="address" value="{{isset($new->address)?$new->address:old('address')}}" required>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="contact" value="{{isset($new->contact_no)?$new->contact_no:old('contact')}}" required>

                                
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
            <hr>
            @include('inc.message')
        </div>
    </div>
</div>
@endsection
