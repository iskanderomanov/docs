<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs(\App\Utils\RouteNames::HR_DASHBOARD) ? 'active' : '' }}">
                        <a class="nav-link" href="{{route(\App\Utils\RouteNames::HR_DASHBOARD)}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path
                              d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path
                              d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path
                              d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                    </span>
                            <span class="nav-link-title">
                      Home
                    </span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs(\App\Utils\RouteNames::POSITION_INDEX) ? 'active' : '' }}">
                        <a class="nav-link" href="{{route(\App\Utils\RouteNames::POSITION_INDEX)}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24" height="24"
     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
     stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
   <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2"></path>
   <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
   <path d="M8 11h4"></path>
   <path d="M8 15h3"></path>
   <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
   <path d="M18.5 19.5l2.5 2.5"></path>
</svg>
                    </span>
                            <span class="nav-link-title">
                      Должности
                    </span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs(\App\Utils\RouteNames::DEPARTMENT_INDEX) ? 'active' : '' }}">
                        <a class="nav-link" href="{{route(\App\Utils\RouteNames::DEPARTMENT_INDEX)}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24"
     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
     stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
   <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
   <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
   <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
   <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
   <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
</svg>
                    </span>
                            <span class="nav-link-title">
                      Кафедры
                    </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs(\App\Utils\RouteNames::USER_INDEX) ? 'active' : '' }}">
                        <a class="nav-link" href="{{route(\App\Utils\RouteNames::USER_INDEX)}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
   <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
   <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
   <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
</svg>
                    </span>
                            <span class="nav-link-title">
                      Пользователи
                    </span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs(\App\Utils\RouteNames::HR_REPORT_CARDS_INDEX) ? 'active' : '' }}">
                        <a class="nav-link" href="{{route(\App\Utils\RouteNames::HR_REPORT_CARDS_INDEX)}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path
                              d="M9 11l3 3l8 -8"></path><path
                              d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path></svg>
                    </span>
                            <span class="nav-link-title">
                      Табели
                    </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
