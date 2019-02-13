
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/main') }}">
                {{ config('app.name', 'PASAL') }}
            </a>
            @if(auth()->user()->hasAnyRole(['admin','manager']))
            <a class="navbar-brand" href="/posts/item">Item
            </a>
            <a class="navbar-brand" href="/posts/sales">Sales
            </a>
            <a class="navbar-brand" href="/posts/purchase">Purchase
            </a>
            <a class="navbar-brand" href="/posts/vendor">Vendor 
            </a>
            @endif
            <a class='navbar-brand' href='/posts/stock'>stock
            </a>
            <a  href="#"
                onclick="window.open('{{url('/stockCalculator')}}', 'newwindow', 'width=450,height=600'); return false;">
                <span class='btn'>stock Calculator</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->       
                        
                    @guest                    
                    
                    @else              
                  
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                @if(auth()->user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                                <a class="dropdown-item" href="#">{{ __('Profile') }}</a>   
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
