<div class="container-fluid">

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <a href="<?= base_url('iuran'); ?>">
                            Data Pembayaran Iuran</a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-hover table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Metode</th>
                                    <th scope="col">Status Bayar</th>
                                    <th scope="col">Tgl Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; 
                                foreach( $data_iuran as $dI ) : ?>
                                <tr>
                                    <th scope="row"> <?= $i++ ?> </th>
                                    <td> <?= $dI['bulan']; ?> </td>
                                    <td> <?= $dI['nominal']; ?> </td>
                                    <td> <?= $dI['metode_db']; ?> </td>
                                    <td> <?= $dI['status']; ?> </td>
                                    <td> <?= $dI['tgl_bayar']; ?> </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-cash-register"></i> Pembayaran
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <form action="<?= base_url('iuran/bayar'); ?>" method="POST">
                                <div class="form-group mb-1">
                                    <label for="bulan" class="mb-0 mt-1">Bulan</label>
                                    <select class="form-control" id="bulan" name="bulan">
                                        <option value=""> Pilih bulan </option>
                                        <?php foreach( $bulan as $b ) : ?>
                                        <option data-nominal="<?= $b['nominal']; ?>" value="<?= $b['id']; ?>">
                                            <?= $b['bulan']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('bulan', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="tahun" class="mb-0 mt-1">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="">Tahun</option>
                                        <?php foreach( $tahun as $t ) : ?>
                                        <option value="<?= $t['id']; ?>"> <?= $t['tahun_db']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('tahun', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group mb-1">
                                    <label for="nominal" class="mb-0 mt-1">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" readonly>
                                </div>
                                <div class="form-group ">
                                    <label for="metBay" class="mb-0 mt-1">Metode Pembayaran</label>
                                    <select name="metBay" id="metBay" class="form-control">
                                        <option value="">Pilih Metode</option>
                                        <?php foreach( $metBay as $mB ) : ?>
                                        <option value="<?= $mB['id']; ?>"> <?= $mB['metode_db']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('metBay', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block"> Bayar </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR CONTAINER FLUID -->
</div>
<!-- AKHIR MAIN CONTENT -->