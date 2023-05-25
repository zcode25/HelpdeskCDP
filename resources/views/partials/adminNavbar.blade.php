<div class="wrapper">
  <nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
      <a class="sidebar-brand" href="/admin/home">
        <span class="align-middle">CDP IT Helpdesk</span>
      </a>

      <ul class="sidebar-nav">

        <li class="sidebar-item {{ Request::is('admin/home*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/home">
            <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('admin/tiket*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/tiket">
            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Tiket</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('admin/laporan*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/laporan">
            <i class="align-middle" data-feather="file"></i> <span class="align-middle">laporan</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('admin/user*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/user">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('admin/departemen*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/departemen">
            <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Departemen</span>
          </a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
      <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
      </a>

      <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
              <i class="align-middle" data-feather="settings"></i>
            </a>

            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
              <span class="text-dark">Selamat datang, {{ auth()->user()->nama }}</span>
              
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Log out</button>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>