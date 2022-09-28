<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Setoran Koran</h6>
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
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi bi-pencil fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi bi-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Hapus
                                                    </a>
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