@extends('layouts.app')

@section('content')
<div class=" ml-sm-auto col-lg-9 px-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
            <div class="col-md-8">
            @include('inc.message')
            <div class="card">
                <div class="card-header">{{ __('Vendor entry') }}</div>
                <div class="card-body">
                    <form method="POST" action="/posts/vendor">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Vendor Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id='name' type="text" class="form-control" name="address" required>                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="contact" value="{{ (isset($new)) ? $new->contact_no : old('contact_no') }}" required>                                
                            </div>
                        </div>               
                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    Submit
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
