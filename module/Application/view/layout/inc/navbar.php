<?php $userdetails = $_SESSION['AssignmentSession']['User'][0]; ?>

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
        <span class="navbar_divider d-none d-md-block"></span>
        <a class="nav-item nav-link" href="/tasks"><i class="bi bi-list-check"></i> &nbsp Tasks</a>

        <div class="dropdown ms-auto">
            <div class="dropdown-button align-content-center" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" style="line-height: 0;">
                <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/public/img/usericons/'.$userdetails['UserID'].'/'.$userdetails['UserID'].'profile.png')) { ?>
                    <div class="profile-navbar-icon my-1" style="border: 1px solid var(--secondary-text);">
                        <img src="/img/usericons/<?= $userdetails['UserID'].'/'.$userdetails['UserID'] ?>profile.png" style="height: 100%;">
                    </div>
                <?php } else { ?>
                    <i class="profile-navbar-icon bi bi-person-circle m-0"></i>
                <?php } ?>
            </div>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/account"><i class="bi bi-gear-wide-connected"></i> Account</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout" style="color: var(--logout-link)"><i class="bi bi-door-open-fill"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>