<div class="header-container container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="javascript:void(0)">Logo</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="javascript:void(0)">Disabled</a>
                </li>
            </ul>
                @if(!auth()->check())
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        Actions
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('auth.login.index')}}">Login</a>
                        <a class="dropdown-item" href="{{route('auth.register.customers.index')}}">Register</a>
                    </div>
                </div>
                @else
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        {{auth()->user()->name}}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('profile.index')}}">Profile</a>
                        @if(auth()->user()->is_admin())
                            <a class="dropdown-item" href="{{route('request-suppliers.index')}}">Requests management</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        @if(auth()->check())
                            <a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a>
                        @endif
                    </div>
                </div>
                @endif
        </div>
    </nav>
</div>
