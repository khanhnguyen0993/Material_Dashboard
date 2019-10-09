  <div class="logo d-flex justify-content-center">
    <a class="navbar-brand " href="{{ url('/') }}">
      <img class="img-fluid w-50" src="https://www.envisionfinancial.com.au/wp-content/uploads/2017/11/Talking-Canberra.gif-300x164.png" alt="URL is down">
      <img class="img-fluid w-50" src="https://media.info/i/lv/2ca/1472261688/6332.png" alt="URL is down">
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <span><i class="material-icons">dashboard</i></span>
            &nbsp; &nbsp;<span class="sidebar-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a id="adminToggle" class="accordion-toggle collapsed toggle-switch nav-link" data-toggle="collapse" href="#competitionManagement">
            <span class="sidebar-icon"><i class="fa fa-star"></i></span>
            &nbsp; &nbsp;<span class="sidebar-title">Competitions</span>
          </a>
          <ul id="competitionManagement" class="panel-collapse collapse panel-switch" role="menu">
            <li>
              <a class="nav-link" href="{{route('competitions.index')}}">
                &nbsp; &nbsp; Manage Competitions
              </a>
            </li>
            <li>
              <a class="nav-link" href="{{route('competitions.create')}}">
                &nbsp; &nbsp; Add New</span>
              </a>
            </li>
          </ul>
      </li>

      <li class="nav-item">
        <a class="accordion-toggle collapsed toggle-switch nav-link" data-toggle="collapse" href="#listenerManagement">
          <span class="sidebar-icon"><i class="fa fa-users"></i></span>
          &nbsp; &nbsp;<span class="sidebar-title">Listeners Management</span>
        </a>
        <ul id="listenerManagement" class="panel-collapse collapse panel-switch" role="menu">
          <li>
            <a class="nav-link" href="{{route('listeners.index')}}">
              &nbsp; &nbsp; Listeners
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{route('listeners.create')}}">
              &nbsp; &nbsp; Create Listener</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a id="adminToggle" class="accordion-toggle collapsed toggle-switch nav-link" data-toggle="collapse" href="#adminManagement">
        <span class="sidebar-icon"><i class="fa fa-user-circle"></i></span>
        &nbsp; &nbsp;<span class="sidebar-title">Admins Management</span>
        </a>
        <ul id="adminManagement" class="panel-collapse collapse panel-switch" role="menu">
          <li>
            <a class="nav-link" href="{{route('users.index')}}">
              &nbsp; &nbsp; Admins
            </a>
          </li>
          @if(auth()->user()->type==3)
          <li>
            <a class="nav-link" href="{{route('users.create')}}">
              &nbsp; &nbsp; Create Admins</span>
            </a>
          </li>
          @endif
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span class="sidebar-icon"><i class="fa fa-sign-out"></i></span>
          &nbsp; &nbsp;<span class="sidebar-title">{{ __('Logout') }}</span>
        </a>
      </li>
    </ul>
</div>
