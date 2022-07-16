<?php
if (!isset($_SESSION['username'])) {
    echo '<script>window.location="sign-in";</script>';
}
?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#D8BFD8;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SIPBAR<3</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <!-- dropdown menu header -->
                    <div class="dropdown ms-4 me-5">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/Screenshot 2021-11-08 161254.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?= $_SESSION['username']; ?></strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="setting.php">Settings</a></li>
                            <li><a class="dropdown-item" href="profile">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="proses/logout.php">Sign out</a></li>
                        </ul>
                    </div>
                    <!-- akhir dropdown menu header -->

                </div>
</nav>