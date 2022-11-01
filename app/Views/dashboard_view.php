<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Mitra Koran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mitra; ?> mitra</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-journal-bookmark-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user; ?> User</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Seluruh Transaksi Koran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $setoran; ?> transaksi</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-card-checklist fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transaksi Koran Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $month; ?> transaksi</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-card-checklist fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transaksi Koran Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $today; ?> transaksi</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-card-checklist fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

</div>
<!-- /.container-fluid -->