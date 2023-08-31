<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container py-2">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item @if (request()->routeIs('presence')) active @endif">
                    <a class="nav-link text-white" href="{{ route('presence') }}">{{ __('Record Presence') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ __('Outstanding Work') }}</a>
                </li>
                @role('admin')
                    <li class="nav-item @if (request()->routeIs('attendances.*')) active @endif">
                        <a class="nav-link text-white" href="{{ route('attendances.index') }}">{{ __('Attendance') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">{{ __('Logsheet') }}</a>
                    </li>
                    <li class="nav-item @if (request()->routeIs('users.*')) active @endif">
                        <a class="nav-link text-white" href="{{ route('users.index') }}">{{ __('User') }}</a>
                    </li>
                @endrole
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
