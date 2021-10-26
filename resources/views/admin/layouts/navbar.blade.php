<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/admin') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/company') }}">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/employee') }}">Employee</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="adminDropdown" onclick="myFunction()" class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                        </a>
                        <div id="adDropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                            <a href="{{url('admin')}}" class="dropdown-item">Dashboard</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
