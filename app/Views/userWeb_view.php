<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar User</h1>
    </div>

    <?php if (session()->getFlashData('pesan')) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <?= session()->getFlashData('pesan');  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } elseif (session()->getFlashData('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal diproses :</strong>
            <?= session()->getFlashData('error');  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php }  ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">
                Tambah user
            </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Tanggal terdaftar</th>
                            <th>Verifikasi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $u) : ?>
                            <tr>
                                <td><?= $u['id']; ?></td>
                                <td><?= $u['email'];; ?></td>
                                <td><?= $u['created_at']; ?></td>
                                <td>
                                    <?php if ($u['verify'] != 'N') { ?>
                                        <h5><span class="badge badge-success"><i class="bi bi-check-circle fa-sm fa-fw mr-2"> aktif</i></span></h5>
                                    <?php } else { ?>

                                        <h5><span class="badge badge-danger"><i class="bi bi-x-circle fa-sm fa-fw mr-2 text-success-400 "> belum aktif</i></span></h5>
                                    <?php } ?>
                                </td>
                                <td>
                                    <center>
                                        <ul class="navbar-nav ml-auto">
                                            <!-- Nav Item - User Information -->
                                            <li class="nav-item dropdown no-arrow">
                                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                                        <i class="bi bi-gear"></i>
                                                    </span>
                                                </a>
                                                <!-- Dropdown - User Information -->
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                                    <?php if ($u['verify'] != 'N') { ?>
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#verify<?= $u['id']; ?>">
                                                            <i class="bi bi-x-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Batalkan
                                                        </button>
                                                    <?php } else { ?>
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#verify<?= $u['id']; ?>">
                                                            <i class="bi bi-check-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Verifikasi
                                                        </button>
                                                    <?php } ?>
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#exampleModal<?= $u['id']; ?>">
                                                        <i class="bi bi-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Modal Hapus-->
<?php foreach ($user as $u) : ?>
    <div class="modal fade" id="exampleModal<?= $u['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url() . '/userweb/delete/' . $u['id']; ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus user </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus <?= $u['email']; ?> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Verify-->
<?php foreach ($user as $u) : ?>
    <div class="modal fade" id="verify<?= $u['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url() . '/userweb/verify/' . $u['id']; ?>" method="post">
                <input hidden type="text" value="<?= $u['verify']; ?>" class="form-control" name="verify">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi user </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if ($u['verify'] != 'N') { ?>
                            Yakin ingin membatalkan verifikasi <?= $u['email']; ?> ?
                        <?php } else { ?>
                            Yakin ingin mengaktifkan verifikasi <?= $u['email']; ?> ?
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success">yakin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal tambah-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>/userweb/create" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PIN</label>
                        <input type="password" class="form-control" name="pin">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit-->
<?php foreach ($user as $u) : ?>
    <div class="modal fade" id="edit<?= $u['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url(); ?>/userweb/update/<?= $u['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $u['email'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">PIN baru</label>
                            <input type="password" class="form-control" name="pin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi PIN</label>
                            <input type="password" class="form-control" name="pinconfirm">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>