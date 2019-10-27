<header id="header"><a href="{{ url('/') }}" class="logo"><strong>{{ config('app.name') }}</strong></a>
	@if (Route::has('login'))
        <div class="top-right links">
            @auth
                Welcome, {{ Auth::user()->name}}
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
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