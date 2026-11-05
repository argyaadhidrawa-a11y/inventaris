<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top"
    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="bi bi-box-seam-fill me-2"></i>
            <span>Inventaris</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i class="bi bi-tags-fill me-1"></i> Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}"
                        href="{{ route('items.index') }}">
                        <i class="bi bi-box-fill me-1"></i> Barang
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-white-50">
                        <i class="bi bi-person-circle me-1"></i> Admin
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>