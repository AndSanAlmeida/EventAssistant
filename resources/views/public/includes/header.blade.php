<nav id="gtco-header-navbar" class="navbar navbar-expand-lg py-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/" title="Home">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header" aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar-nav-header">
            @if (Route::has('login'))
                @auth   
                    <div class="navbar-nav ml-auto">      
                        <div class="dropdown">
                            <div class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle mr-2" width="40" height="40" src="{{ Auth::user()->profileImage() }}" alt="Profile Image">
                                {{ Auth::user()->name}}
                            </div>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            @hasRole('user')
                                <a href="{{ route('public.dashboard') }}" class="dropdown-item" title="Dashboard">
                                    <i class="fas fa-user-cog"></i>
                                    Dashboard
                                </a>
                                <a href="{{ route('public.user.show', Auth::user()) }}" class="dropdown-item" title="View Profile">
                                    <i class="fas fa-user"></i>
                                    View Profile
                                </a>
                            @endhasRole

                            @hasRole('admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item" title="BackOffice">
                                    <i class="fas fa-cogs"></i>
                                    BackOffice
                                </a>
                            @endhasRole
                                <div class="dropdown-divider"></div>

                                <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    {{ __('Logout') }}
                                </a>                                

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link" title="Login">{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link" title="Sign Up">{{ __('Sign Up') }}</a>
                            </li>
                        @endif
                    </ul>
                @endif                
            @endif
        </div>
    </div>

</nav>