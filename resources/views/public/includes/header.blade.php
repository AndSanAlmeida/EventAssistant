<header id="header"><a href="{{ url('/') }}" class="logo"><strong>{{ config('app.name') }}</strong></a>
    @if (Route::has('login'))
        <nav>
            <ul>   
                @auth         
                    <li class="submenu">
                        <a href="#">
                            <img class="img-profile" src="{{ Auth::user()->profileImage() }}">
                            {{ Auth::user()->name}}
                            <i class="fas fa-angle-down" style="vertical-align: middle;"></i>
                        </a>
                        <ul class="dropdown">

                            @hasRole('user')
                                <li>
                                    <a href="{{ route('public.user.show', Auth::user()) }}" title="View Profile">
                                        <i class="fas fa-user"></i>
                                        View Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('public.dashboard', Auth::user()) }}" title="Dashboard">
                                        <i class="fas fa-user-cog"></i>
                                        Dashboard
                                    </a>
                                </li>
                            @endhasRole

                            @hasRole('admin')
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" title="BackOffice">
                                        <i class="fas fa-cogs"></i>
                                        BackOffice
                                    </a>
                                </li>
                            @endhasRole
                            
                                <li>
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" title="Logout">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>
                                </li>                                   

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                         </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" title="Login">{{ __('Login') }}</a></li>

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" title="Sign Up">{{ __('Sign Up') }}</a></li>
                    @endif
                @endif                
            </ul>
        </nav>
    @endif
</header>