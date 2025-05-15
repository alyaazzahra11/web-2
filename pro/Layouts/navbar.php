<?php
// If you intend to use PHP code in this file, keep this opening tag.
// If not, you can remove this line and consider renaming the file to .html.
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?url=home" class="nav-link">
        <span class="brand-text font-weight-light">Manajemen Dosen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a class="d-block">Alya Az-Zahra</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="?url=dosen" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dosen
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=kegiatan" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kegiatan Akademik
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=kategori" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Kategori Kegiatan
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=prodi" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Prodi
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=penelitian" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Penelitian
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=tim_penelitian" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Tim Penelitian
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=bidang" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Bidang Ilmu
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?url=kegiatan_dosen" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kegiatan Dosen
                            <span class="right badge badge-info">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>