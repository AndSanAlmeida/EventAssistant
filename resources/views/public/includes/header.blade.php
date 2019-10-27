<header id="header"><a href="{{ url('/') }}" class="logo"><strong>{{ config('app.name') }}</strong></a>
    @if (Route::has('login'))
        <nav>
            <ul class="links">   
                @auth         
                    <li class="submenu">
                        <a href="#" title="">                            
                            Welcome, {{ Auth::user()->name}}
                            <i class="fas fa-angle-down" style="vertical-align: middle;"></i>
                        </a>
                        <ul class="dropdown">
                            <li><a href="#" title="">Running</a></li>
                         </ul>
                    </li>
                @else
                    <li><a href="#" title="">Login</a></li>

                    @if (Route::has('register'))
                        <li><a href="#" title="">Sign Up</a></li>
                    @endif
                @endif                
            </ul>
        </nav>
    @endif


	{{-- @if (Route::has('login'))
        <div class="links">
            @auth
                Welcome, {{ Auth::user()->name}}
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}
    <!-- <nav><a href="#menu">Menu</a></nav> -->
</header>

<!-- <nav id="menu">
    <ul class="links">
        <li><a href="index.html">Home</a></li>
        <li><a href="generic.html">Generic</a></li>
        <li><a href="elements.html">Elements</a></li>
    </ul>
    <ul class="actions stacked">
        <li><a href="#" class="button primary fit">Sign Up</a></li>
        <li><a href="#" class="button fit">Log In</a></li>
    </ul>
    <a href="#menu" class="close"></a>
</nav> -->