<nav class="navbar navbar-expand-lg  bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}"><strong class='text-warning'>Astract</strong><small>admin</small></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        {{-- left side of navbar --}}
        <ul class="navbar-nav mr-auto">

        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a id="navbarDropdown" class="nav-link" href="{{route('user.messages')}}" role="button"  aria-expanded="false" v-pre>
                    Messages
                </a>
            </li>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="dropdown-item">
                        @csrf
                        <a><button type="submit" class="btn btn-block"><strong class="text-danger"> Logout </strong></a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
