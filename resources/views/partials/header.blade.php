<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-3">
        <a class="navbar-brand mr-0" href="{{ url('/') }}">
            <img src="{{ url('assets/img/vanguard-logo.png') }}" height="35" alt="{{ settings('app_name') }}">
        </a>
      </div>
      <div class="col-9">
         <ul class="navbar-nav bd-navbar-nav flex-row my-2 my-lg-0 pull-right">
           
                    
           @if(auth()->user())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#"
                   id="navbarDropdown"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false" style="
                   margin-top: -12px;
               ">
                   Welcome,  {{ auth()->user()->present()->nameOrEmail }} 
                    <img src="{{ auth()->user()->present()->avatar }}"
                         width="50"
                         height="50"
                         class="rounded-circle img-thumbnail img-responsive">
                        
                </a>

                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fas fa-user text-muted mr-2"></i>
                        @lang('app.my_profile')
                    </a>
                    <a class="dropdown-item" href="{{ url('/dashboard') }}">
                    <i class="fas fa-desktop"></i>
                    View Dashboard
                    </a>
                    
                    <div class="dropdown-divider"></div>
                    @if(auth()->user()->role_id ==1)

                    <a class="dropdown-item" href="{{ url('/dashboard')}}">
                      Admin Dashboard
                    </a>
                    @endif

                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                        @lang('app.logout')
                    </a>
                </div>
            </li>
            @else
            <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Login</a></li>
            @endif
        </ul>
      </div>
    </div>
  </div>
</header>