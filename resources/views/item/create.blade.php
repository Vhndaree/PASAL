@extends('layouts.app')

@section('content')
<div class=" ml-sm-auto col-lg-9 px-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-30 col-sm ">
        <div class="col-md-8">
            @include('inc.message')            
            <div class="card">                
                <div class="card-header">{{ __('Item entry') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/posts/item" aria-label="{{ __('Item entered') }}">
                        {{csrf_field()}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Item Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"  required autofocus>                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                                <div class="col-md-6">                                
                                    <select id='name' class='form-control' name='unit'>
                                        <option value='kilogram'>Kilogram</option>
                                        <option value='pieces'>Pieces</option>
                                    </select>                               
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
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
</div>
@endsection
