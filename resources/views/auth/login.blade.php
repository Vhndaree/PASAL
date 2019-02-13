<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="logo.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <!-- Custom styles for sign in page -->
     <link href="/css/custom/signin.css" rel="stylesheet">
</head>
<body>
    
   

    <form method="POST" class="form-signin text-center" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf

        <img class="mb-4" src="logo.png" alt="" width="102" height="102">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Your ID" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
           <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('email') }}</strong>
           </span>
           @endif
           <label for="inputPassword" class="sr-only">Password</label>
           <input type="password" id="inputPassword" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>         
           @if ($errors->has('password'))
           <span class="invalid-feedback" role="alert">
               <strong>{{ $errors->first('password') }}</strong>
           </span>
           @endif
           <div>                     
               <button type="submit" class="btn btn-primary">
                   {{ __('Login') }}
               </button>
               <hr>
               <a class="btn btn-link" href="{{ route('password.request') }}">
                   {{ __('Forgot Your Password?') }}
               </a>               
           </div>                            
   </form>

   
</body>
</html>