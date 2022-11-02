<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon ">
                    <img src="<?= base_url() ?>/assets/img/logo dataKoranApp.png" alt="" height="37" width="24">
                </div>
                <div class="sidebar-brand-text mx-3">Mitra Koran Web</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard'); ?>">
                    <i class="bi bi-speedometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/userweb">
                    <i class="bi bi-person-badge"></i>
                    <span>User</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/koranweb">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Mitra koran</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/setoranweb">
                    <i class="bi bi-card-checklist"></i>
                    <span> Transaksi Setoran</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/laporan">
                    <i class="bi bi-graph-up"></i>
                    <span> Laporan</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <h4>Pengelola Transaksi Koran</h4>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nama'); ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ubah">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url(); ?>/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Modal ubah-->
                <div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url() . '/dashboard/ubahPW/' . session()->get('id') ?>" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password Baru</label>
                                        <input type="password" class="form-control" name="pwBaru">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" name="pwKonfirm">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-success">Ubah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>