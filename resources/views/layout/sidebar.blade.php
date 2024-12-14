 <!-- partial:partials/_sidebar.html -->
 @php
    $currentRoute = request()->route()->uri(); 
@endphp


 <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">

            <!-- Dashboard -->
            <li class="nav-item @if($currentRoute == '/') active @endif" >
              <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <!-- Plans -->
            <li class="nav-item @if($currentRoute === 'plans') active @endif">
              <a class="nav-link" href="{{ route('plans.list') }}">
                <i class="mdi mdi-checkbox-marked-outline menu-icon"></i>
                <span class="menu-title">Plans</span>
              </a>
            </li>

             <!--Combo Plans -->
             <li class="nav-item @if($currentRoute === 'combo-plans') active @endif">
              <a class="nav-link" href="{{ route('combo-plans.list') }}">
                <i class="mdi mdi-checkbox-multiple-marked-outline menu-icon"></i>
                <span class="menu-title">Combo Plans</span>
              </a>
            </li>

             <!--Eligibility Criteria -->
             <li class="nav-item @if($currentRoute === 'eligibility-criteria') active @endif">
              <a class="nav-link" href="{{ route('eligibility-criteria.list') }}">
                <i class="mdi mdi-human menu-icon"></i>
                <span class="menu-title">Eligibility Criteria</span>
              </a>
            </li>
           
           
          </ul>
        </nav>