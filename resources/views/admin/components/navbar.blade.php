<nav class="navbar navbar-expand-lg navbar-light border-bottom bg-white">
  <div class="container-fluid px-4">
    <button class="btn btn-primary d-lg-none" id="sidebarToggle">
      <i class="bi bi-list"></i>
    </button>

    <div class="d-flex align-items-center ms-lg-0 ms-3">
      <div>
        <h4 class="mb-0" id="pageTitle">Dashboard</h4>
        <small class="text-muted" id="pageSubtitle">Kelola dan pantau dashboard</small>
      </div>
    </div>

    <div class="d-flex align-items-center ms-auto gap-3">
      <div class="input-group search-box d-none d-md-flex">
        <span class="input-group-text bg-white">
          <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control border-start-0" placeholder="Cari...">
      </div>

      <button class="btn btn-light position-relative">
        <i class="bi bi-bell-fill"></i>
        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger top-0">
          12
        </span>
      </button>

      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
          data-bs-toggle="dropdown">
          <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop"
            class="rounded-circle" width="40" height="40" alt="Admin">
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item text-danger"><i
                  class="bi bi-box-arrow-right me-2"></i>Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
