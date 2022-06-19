<style>
    .d-none {
        display: none;
    }
</style>

<aside>
    <div class="slimscroll-menu">
        <!-- close menu -->
        <a href="" class="close-aside"><i class="mdi mdi-close-circle-outline"></i></a>
        <!-- Branding -->
        <div class="side-branding">
            <a href="">
                @if(!empty($profile_pic))
                    @forelse($profile_pic as $profile)

                        <img src="{{ url('/images'). '/' . '34nudqdXO2.png' }}" class="img-responsive"/>
                    @empty
                        <img
                            src="{{ url('/assets/images/avatar.png') }} "
                            class="img-responsive"
                        >
                    @endforelse
                @endif
            </a>
        </div>
        <!-- navigation -->
        <ul class="nav-parent">
            <li class="menu-label">Main</li>


            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="menu-icon mdi mdi-speedometer"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Staff')
                <!-- <li class="nav-item">
                      <a class="nav-link" href="{{ url('admin/schedule') }}">
                        <i class="menu-icon mdi mdi-calendar-text"></i>
                        <span class="menu-title">Scheduling</span>
                      </a>
                  </li> -->
            @endif

            @if(Auth::user()->role == 'Student')

                <!--
                  <li class="nav-item">
                        <a class="nav-link" href="{{ route('enrollment.form') }}">
                          <i class="menu-icon mdi mdi-calendar-text"></i>
                          <span class="menu-title">Registration Form</span>
                        </a>
                  </li> -->

            @endif

            <li class="nav-item">
                <a class="nav-link" style="position: relative;" href="{{ url('notification')}}">
                    <i class="menu-icon mdi mdi-bell-outline"></i>
                    <span class="menu-title">Notification</span>
                    <span class="badge badge-pill badge-danger" id="notification"
                          style="position: absolute; left: 16px;"></span>
                </a>
            </li>

            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Staff')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/student') }}">

                        <i class="menu-icon mdi mdi-account-convert"></i>
                        <span class="menu-title">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/instructor') }}">
                        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                        <span class="menu-title">Instructor</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role == 'Admin'  || Auth::user()->role == 'Staff')

                <li class="menu-label">School</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/fleet') }}">
                        <i class="menu-icon mdi mdi-car-connected"></i>
                        <span class="menu-title">Fleet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/branch') }}">
                        <i class="menu-icon  mdi mdi-access-point-network"></i>
                        <span class="menu-title">Branch</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/invoice') }}">
                        <i class="menu-icon  mdi mdi-file-chart"></i>
                        <span class="menu-title">Invoices</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('communication') }}">
                        <i class="menu-icon  mdi mdi-message-text-outline"></i>
                        <span class="menu-title">Communication</span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/staff') }}">
                        <i class="menu-icon  mdi mdi-account-edit"></i>
                        <span class="menu-title">Staff</span>
                    </a>
                </li>
            @endif
            <li class="menu-label">Account</li>

            @if(Auth::user()->role == 'Admin'  || Auth::user()->role == 'Staff')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/course') }}">
                        <i class="menu-icon mdi mdi-seal"></i>
                        <span class="menu-title">Courses</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/school') }}">
                        <i class="menu-icon mdi mdi-blur-radial"></i>
                        <span class="menu-title">School</span>
                    </a>
                </li>

            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ url('settings') }}">
                    <i class="menu-icon mdi mdi-settings"></i>
                    <span class="menu-title">Setting</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                    <i class="menu-icon mdi mdi-logout"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</aside>
