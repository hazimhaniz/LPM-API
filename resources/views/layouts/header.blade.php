
<nav class="navbar justify-content-between">
    <a class="navbar-abrand mt-"  href="{{route('console.index')}}">
      @if(!isset($menu))
        <label class="switch m-0">
            <input id="sidebar-toggle" type="checkbox" data-toggle=".container" checked="checked">
            <i class="fa fa-navicon fa-lg txt-primary"></i> 
        </label>
      @endif
      <span class="txt-primary m-0 f-20"><i class="fa fa-cubes"></i> Penyelenggaraan</span>
    </a>
    <div class="nav-right">
      <ul class="nav-menus">
            <li class="onhover-dropdown px-0">
            <span class="media user-header">
                <img class="mr-3 rounded-circle img-35" src="{{asset('assets/images/dashboard/user.png')}}" alt="">
                <span class="media-body">
                <span class="f-12 f-w-600">{{ Auth::user()->name }}</span>
                <span class="f-12 d-block">{{ Auth::user()->roles->pluck('name')->first() ?? '' }}</span>
            </span>
            <ul class="profile-dropdown onhover-show-div">
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-in"></i>{{ __('Log keluar') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
          </ul>
         </li>
        </ul>
    </div>

</nav>
{{-- 

<div class="page-main-header   shadow-sm shadow-showcase">
  <div class="main-header-right">
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm mr-4">
        @if(!isset($menu))
        <label class="switch m-0">
            <input id="sidebar-toggle" type="checkbox" data-toggle=".container" checked="checked">
            <i class="fa fa-navicon fa-lg txt-primary"></i>
        </label>
        @endif
      </div>
    </div>
    
    <div class="main-header-left ml-3">
      <div class="logo-wrapper">
        <a href="{{route('console.index')}}">
            <h4 class="txt-primary m-0"><i class="fa fa-cubes"></i> Penyelenggaraan</h4>
        </a>
      </div>
    </div>
    
    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">
            <li class="onhover-dropdown px-0">
            <span class="media user-header">
                <img class="mr-3 rounded-circle img-35" src="{{asset('assets/images/dashboard/user.png')}}" alt="">
                <span class="media-body">
                <span class="f-12 f-w-600">{{ Auth::user()->name }}</span>
                <span class="d-block">{{ Auth::user()->roles->pluck('name')->first() ?? '' }}</span>
            </span>
            <ul class="profile-dropdown onhover-show-div">
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-in"></i>{{ __('Log keluar') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
          </ul>
         </li>
        </ul>
      </div>
     <div class="d-lg-none mobile-toggle pull-right">
         <i data-feather="more-horizontal"></i>
     </div>
  </div>
</div> --}}
