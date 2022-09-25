<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><strong>Jasa Marga IOT Lab</strong></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Data Inventaris -->
    <li class="nav-item {{ (request()->segment(1) == 'inventory') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('inventory') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Inventory Data</span></a>
    </li>
    <!-- Nav Item - Data Ruangan -->
    <li class="nav-item {{ (request()->segment(1) == 'room') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('room') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Room Data</span></a>
    </li>
    <!-- Nav Item - Data Peminjaman -->
    <li class="nav-item {{ (request()->segment(1) == 'borrowing') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('borrowing') }}">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Borrowing Data</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->