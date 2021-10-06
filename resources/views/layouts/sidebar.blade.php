<header class="main-nav close_icon">
<style>
.label {
    width: 40px;
    background-color: #eee;
    white-space: nowrap;
    display: inline-block;
    position: relative;
}
.label-text {
    font-size: 13px;
    position: absolute;
    top: 5%;
    left: 0;
    height: 32px;
    line-height: 32px;
    padding: 0 1em;
    transform-origin: top left;
    transform: rotate(-90deg) translateX(-100%);
}
</style>
   <nav class="d-flex">
    <div class="label">
        <p class="label-text txt-primary">Sistem Pengurusan Peperiksaan Atas Talian</p>
    </div>
      <div class="main-navbar">

         <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>

         <div id="mainnav ">
             
            <ul class="nav-menu  shadow-sm shadow-showcase">

                <div class="mt-5 mb-5 text-center px-3">
                    <img class="mb-2" width="80"  src="{{asset('assets/images/jata.png')}}" />
                    <br>
                    <b>
                        KEMENTERIAN PELAJARAN MALAYSIA
                    </b>
                </div>
                
                <li class="dropdown">

                    <a class="nav-link menu-title {{ $page == 'konsol' ? 'active' : ''}}" href="{{ route( 'console.index' ) }}"}}>
                        <i data-feather="grid"></i><span>Konsol</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="nav-link menu-title {{ $page == 'pengurusan-pengguna' ? 'active' : ''}}" href="{{ route( 'console.pengurusan_pengguna' ) }}"}}>
                        <i data-feather="users"></i><span>Kawalan</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="nav-link menu-title {{ $page == 'selenggara-data' ? 'active' : ''}}" href="{{ route( 'console.selenggara_data' ) }}"}}>
                        <i data-feather="database"></i><span>Selenggara Data</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="nav-link menu-title {{ $page == 'jejak-audit' ? 'active' : ''}}" href="{{ route( 'console.jejak_audit' ) }}"}}>
                        <i data-feather="file"></i><span>Jejak Audit</span>
                    </a>
                </li>

            </ul>
         </div>
         <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </div>
   </nav>
</header>
