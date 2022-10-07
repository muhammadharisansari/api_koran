<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Mitra Koran</div>
                            <div class="row">
                                <div class="col-xl-8 col-md-8">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mitra; ?> mitra</div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <a href="<?= base_url('/laporan/koranexcel'); ?>" type="button" class="btn btn-primary">Cetak Laporan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Transaksi Koran</div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $setoran; ?> transaksi</div> -->

                            <div class="row">
                                <div class="col-xl-8 col-md-8">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $setoran; ?> transaksi</div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#txKoran">Cetak Laporan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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


<!-- Modal Transaksi Koran-->
<div class="modal fade" id="txKoran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Transaksi Koran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('/laporan/setoranexcel'); ?>" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-md-6">
                                <label>Dari :</label>
                                <input type="date" class="form-control" name="dari">
                            </div>
                            <div class="col-md-6 col-md-6">
                                <label>Sampai :</label>
                                <input type="date" class="form-control" name="sampai">
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>