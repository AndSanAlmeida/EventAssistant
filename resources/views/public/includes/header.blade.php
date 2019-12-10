<nav id="gtco-header-navbar" class="navbar navbar-expand-lg py-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/" title="Home">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav-header">
            <ul class="navbar-nav ml-auto">

                {{-- HOME --}}
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{ url('/') }}" title="Home">Home</a>
                </li>

                @if (Route::has('login'))
                    @auth
                        {{-- Dropdown   --}}
                        <li class="nav-item mr-4"> 
                            <div class="navbar-nav ml-auto">      
                                <div class="dropdown">
                                    <div class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="rounded-circle mr-2" width="40" height="40" src="{{ Auth::user()->profileImage() }}" alt="Profile Image"><b>{{ Auth::user()->name}}</b>
                                    </div>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    
                                    @hasRole('user')
                                        <a href="{{ route('public.dashboard') }}" class="dropdown-item" title="Dashboard">
                                            <i class="fas fa-user-cog mr-3"></i>
                                            Dashboard
                                        </a>
                                        <a href="{{ route('public.user.show', Auth::user()) }}" class="dropdown-item" title="View Profile">
                                            <i class="fas fa-user mr-4"></i>
                                            Profile
                                        </a>
                                    @endhasRole

                                    @hasRole('admin')
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item" title="BackOffice">
                                            <i class="fas fa-cogs mr-3"></i>
                                            BackOffice
                                        </a>
                                    @endhasRole
                                        <div class="dropdown-divider"></div>

                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();" title="Logout">
                                            <i class="fas fa-sign-out-alt mr-4"></i>
                                            {{ __('Logout') }}
                                        </a>                                

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    @else

                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link" title="Login"><b>{{ __('Login') }}</b></a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link" title="Sign Up"><b>{{ __('Sign Up') }}</b></a>
                            </li>
                        @endif
                        
                    @endif                
                @endif
            </ul>
        </div>
    </div>

</nav>