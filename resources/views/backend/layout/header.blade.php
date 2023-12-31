<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>       
    </ul>
    </form>
    <ul class="navbar-nav navbar-right">         
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @auth
                <img alt="image" src="{{ asset(Auth::user()->profile) }}" class="rounded-circle mr-1">
            @else  
                <img alt="image" src="{{ asset('vendor/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            @endauth
            
            <div class="d-sm-none d-lg-inline-block">Hi, 
                @if (Auth::check())
                    {{Auth::user()->name}}      
                @endif
                @if (Auth::guard('dpls')->check())
                    {{Auth::guard('dpls')->user()->name}}
                @endif
                @if (Auth::guard('pamongs')->check())
                    {{Auth::guard('pamongs')->user()->name}}
                @endif
                @if (Auth::guard('operators')->check())
                    {{Auth::guard('operators')->user()->name}}
                @endif
                    
            </div></a>
            <div class="dropdown-menu dropdown-menu-right">        
            <a href="{{Route('profile.index')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>                
            <a onclick="return confirm('apakah anda yakin ingin keluar dari sistem ?')" href="{{Route('auth.logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            </div>
        </li>
    </ul>
</nav>