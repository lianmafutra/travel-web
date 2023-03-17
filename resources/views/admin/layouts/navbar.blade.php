<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link"> Selamat Datang,  {{ auth()->user()->nama_lengkap }} ( Hak Akses : {{ auth()->user()->hak_akses }} )   ( {{ \Carbon\Carbon::now()->translatedFormat('l, d-F-Y')  }} )</a> 
           
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- <li class="nav-item">
            <a class="nav-link" id="btntheme" role="button">
                <i id="icontheme" class="fas fa-sun"></i>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}" target="_bkank" role="button">
                <i class="fas fa-globe"></i>
            </a>
        </li> --}}
     
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('storage/'.auth()->user()->foto ) }}" class="user-image img-circle elevation-2" alt="User Image">
            </a>

            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">

                {{-- <li class="user-footer">
                  <a href="#" class="btn btn-default">Profile</a>
                  <a href="#" data-toggle="modal" data-target="#modal-logout" data-backdrop="static" data-keyboard="false" class="btn btn-danger float-right">Keluar</a>
              </li> --}}

                <span style="background: rgba(219, 219, 219, 0.384)" class="dropdown-item dropdown-header">
                    <span  class="d-none d-md-inline">{{ Auth::user()->nama_lengkap }}</span></span>
                <div class="dropdown-divider"></div>

                {{-- <span class="dropdown-item dropdown-header">15 Notifications</span> --}}
                <a href="{{ route('profile.index') }}" class="dropdown-item">
                    <i class="fas fa-user-check mr-2"></i>Profile

                </a>

                <a  data-toggle="modal" data-target="#modal-password" data-backdrop="static" data-keyboard="false" href="#" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i>Ubah Password
                </a>

                <div class="dropdown-divider"></div>
                <a  data-toggle="modal" data-target="#modal-logout" data-backdrop="static" data-keyboard="false" style="padding-bottom: 15px" href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt  mr-2"></i> Logout
                </a>

            </div>
        </li>

    </ul>
</nav>
@include('auth.passwords.modal-ubah')
