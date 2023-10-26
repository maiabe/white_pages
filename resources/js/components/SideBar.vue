<template>
    <div class="offcanvas offcanvas-start" id="demo" style="width: 150px; height: 356px; margin-top: 55px"> <!-- Adjust the width as needed -->
        <div class="offcanvas-header">
            <h3 class="offcanvas-title">UHWP</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0 "> <!-- Remove extra margin -->
            <ul class="nav nav-pills flex-column mb-0" id="menu"> <!-- Removed unnecessary classes -->
                <li class="nav-item">
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link text-truncate">
                        <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">People Entries</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Make Approvals</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">Department</span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdown">
                        <li><a class="dropdown-item" href="#">Contacts</a></li>
                        <li><a class="dropdown-item" href="#">Groupings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Administrators</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Announcements</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Helps</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Button to open the offcanvas sidebar -->
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
        Sidebar
    </button>
</template>

