<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('img/ic_calendar.png') }}" alt="{{ Setting::getName('app_name') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('global.app_name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact"
                data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>@php $i = 1; @endphp


                @if (auth()->user()->hak_akses == 'admin')
                @elseif (auth()->user()->hak_akses == 'owner')
                @endif


                <li class="nav-header ml-2">Master Data</li>
                @if (auth()->user()->hak_akses == 'admin')
                    <li class="nav-item menu-is-opening {{ request()->is('admin/kendaraan*') ? 'menu-open' : '' }} ">
                        <a href="" class="nav-link {{ request()->is('admin/kendaraan*') ? 'active' : '' }}">
                            <i class="fas fa-truck nav-icon"></i>
                            <p>Data Kendaraan</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('mobil.index') }}"
                                    class="nav-link {{ request()->routeIs('mobil*') ? 'active' : '' }}">
                                    <i class="fas fa-car nav-icon"></i>
                                    <p>Mobil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jenis-mobil.index') }}"
                                    class="nav-link {{ request()->routeIs('jenis-mobil*') ? 'active' : '' }}">
                                    <i class="fas fa-car nav-icon"></i>
                                    <p>Jenis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supir.index') }}"
                                    class="nav-link {{ request()->routeIs('supir*') ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Supir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link  {{ request()->routeIs('user*') ? 'active' : '' }}">
                            <i class="far fa-user-circle nav-icon"></i>
                            <p>Master User</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('review.index') }}"
                        class="nav-link  {{ request()->routeIs('review*') ? 'active' : '' }}">
                        <i class="far fa-comment-alt nav-icon"></i>
                        <p>Review Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rekening.index') }}"
                        class="nav-link  {{ request()->routeIs('rekening*') ? 'active' : '' }}">
                        <i class="far fa-credit-card nav-icon"></i>
                        <p>Kelola Rekening</p>
                    </a>
                </li>
                @if (auth()->user()->hak_akses == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('kustomer.index') }}"
                            class="nav-link  {{ request()->routeIs('kustomer*') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <p>Kelola Kustomer</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hak_akses == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('lokasi.index') }}"
                            class="nav-link  {{ request()->routeIs('lokasi*') ? 'active' : '' }}">
                            <i class="fas fa-search-location nav-icon"></i>
                            <p>Kelola Lokasi</p>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hak_akses == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('jadwal.index') }}"
                            class="nav-link  {{ request()->routeIs('jadwal*') ? 'active' : '' }}">
                            <i class="fas fa-clock nav-icon"></i>
                            <p>Kelola Jadwal</p>
                        </a>
                    </li>
                    
                @endif
                <li class="nav-item">
                    <a href="{{ route('pesanan.index') }}"
                        class="nav-link  {{ request()->routeIs('pesanan*') ? 'active' : '' }}">
                        <i class="fas fa-inbox nav-icon"></i>
                        <p>Order Masuk</p>
                        @if ($order_masuk_count <= 0)
                            <span class="right badge badge-primary"> {{ $order_masuk_count }}</span>
                        @else
                            <span class="right badge badge-danger"> {{ $order_masuk_count }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}"
                        class="nav-link  {{ request()->routeIs('laporan*') ? 'active' : '' }}">
                        <i class="fas fa-inbox nav-icon"></i>
                        <p>Rekap Laporan</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
