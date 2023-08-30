<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('upload/default.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">QuizApp</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Quiz Management</li>
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Quiz Management</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.exam') }}"><i class="bx bx-right-arrow-alt"></i>Exams</a>
                </li>
            </ul>
        </li> --}}
        <li>
            <a href="{{ route('all.exam') }}" target="_blank">
                <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
                </div>
                <div class="menu-title">Exams</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.student') }}" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Students</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
