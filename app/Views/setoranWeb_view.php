<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi Koran</h1>
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
                Tambah data
            </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Koran</th>
                            <th>Bulan</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Dibuat</th>
                            <th>Diperbarui</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($setoran as $s) : ?>
                            <tr>
                                <td><?= $s['id']; ?></td>
                                <td><?= $s['nama_koran'];; ?></td>
                                <td><?= $s['bulan'];; ?></td>
                                <td><?= $s['tanggal'];; ?></td>
                                <td><?= $s['jumlah'];; ?></td>
                                <td><?= $s['created_at']; ?></td>
                                <td><?= $s['updated_at']; ?></td>
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
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#edit<?= $s['id']; ?>">
                                                        <i class="bi bi-pencil fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Edit
                                                    </button>
                                                    <button class="dropdown-item" data-toggle="modal" data-target="#hapus<?= $s['id']; ?>">
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

<!-- Modal tambah-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>/setoranweb/create" method="post">
                    <div class="form-group">
                        <label>Mitra</label>
                        <select class="custom-select" name="nama_mitra">
                            <option selected disabled>--Pilih Mitra--</option>
                            <?php foreach ($koran as $k) : ?>
                                <option value="<?= $k['koran']; ?>"><?= $k['koran']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah">
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

<!-- Modal update-->
<?php foreach ($setoran as $s) : ?>
    <div class="modal fade" id="edit<?= $s['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url("/setoranweb/update/" . $s['id']); ?>" method="post">
                        <div class="form-group">
                            <label>Mitra</label>
                            <select class="custom-select" name="nama_mitra">
                                <option selected hidden><?= $s['nama_koran']; ?></option>
                                <?php foreach ($koran as $k) : ?>
                                    <option value="<?= $k['koran']; ?>"><?= $k['koran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $s['tanggal']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" value="<?= $s['jumlah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pembuat</label>
                            <input class="form-control" value="<?= $s['created_by']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Waktu pembuatan</label>
                            <input class="form-control" value="<?= $s['created_at']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pengedit</label>
                            <input class="form-control" value="<?= $s['updated_by']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Waktu edit</label>
                            <input class="form-control" value="<?= $s['updated_at']; ?>" readonly>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus-->
<?php foreach ($setoran as $s) : ?>
    <div class="modal fade" id="hapus<?= $s['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url() . '/setoranweb/delete/' . $s['id']; ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus transaksi <?= $s['nama_koran']; ?> ?
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