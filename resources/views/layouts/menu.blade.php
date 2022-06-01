<li class="nav-item menu-open">
    <a href="" class="nav-link ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
    @if (session('attendance_session.user_type') == 'company')
    <a href="{{ url('user') }}" class="nav-link  ">
        <i class="far fa-circle nav-icon"></i>
        <p>User</p>
    </a>
    @endif
    @if (session('attendance_session.user_type') == 'user')
    <li class="nav-item">
        <a href="{{ url('attendance') }}" class="nav-link  ">
            <i class="far fa-circle nav-icon"></i>
            <p>Mark Attendance</p>
        </a>
    </li>

    @endif



</li>


<script>

    </script>
