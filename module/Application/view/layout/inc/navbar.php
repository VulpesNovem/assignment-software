<nav class="navbar navbar-dark fixed-top fs-5 navbar-expand-sm navbar_bar">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Navbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="Navbar">
        <a class="nav-item nav-link" href="/"><i class="bi bi-house-fill"></i> &nbsp Dashboard</a>
        <span class="navbar_divider d-none d-md-block"></span>
        <a class="nav-item nav-link" href="/"><i class="bi bi-calendar-event-fill"></i> &nbsp Calendar</a>
        <span class="navbar_divider d-none d-md-block"></span>
        <a class="nav-item nav-link" href="/courses"><i class="bi bi-book-half"></i> &nbsp Courses</a>
        <div class="dropdown ms-auto">
            <div class="dropdown-button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-person-circle"></i></div>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href=""><i class="bi bi-exclamation-lg"></i> Action</a></li>
                <li><a class="dropdown-item" href="/account"><i class="bi bi-gear-wide-connected"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout" style="color: var(--logout-link)"><i class="bi bi-door-open-fill"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>