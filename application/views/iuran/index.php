<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Data Pembayaran Iuran </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg">

                    <div class="row">
                        <div class="col-lg-6">

                            <!-- sweetalert iuran berhasil-->
                            <div class="iuranB" data-iuran="<?= $this->session->flashdata('iuran'); ?>"></div>

                        </div>
                        <div class="col-lg">
                            <a href="<?= base_url('iuran/bayar'); ?>"
                                class="btn btn-primary btn-sm ml-2 float-right mb-3 shadow-sm"><i
                                    class="fas fa-wallet fa-sm "></i>
                                Bayar
                            </a>
                            <!-- fungsi select option belum bisa dijalankan -->
                            <!-- <div class="form-group float-right mb-3">
                                <form action="<?= base_url('iuran'); ?>" method="post">
                                    <select class="mx-2 shadow-sm form-control-sm btn-info" name="tahunIndex">
                                        <option value="">Tahun</option>
                                        <?php //foreach( $tahunIndex as $tI ) : ?>
                                        <option value="<?= $tI['id']; ?>">
                                            <?= $tI['tahun_db'] ; ?>
                                        </option>
                                        <?php //endforeach; ?>
                                    </select>
                                </form>
                            </div> -->
                            <a href="<?= base_url('iuran/export'); ?>"
                                class="btn btn-success btn-sm  float-right ml-2 shadow-sm"> <i
                                    class="fas fa-file-export fa-sm "></i>
                                Export Excel
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-hover table-bordered table-striped mt-1">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tahun</th>
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
                                <?php if( $dI['status'] !== 'Lunas' ) : ?>
                                <tr class="table-primary">
                                    <?php else: ?>
                                <tr>
                                    <?php endif; ?>
                                    <th scope="row"> <?= $i++ ?> </th>
                                    <td> <?= $dI['tahun_db']; ?> </td>
                                    <td> <?= $dI['bulan']; ?> </td>
                                    <td> Rp. <?= $dI['nominal']; ?> </td>
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
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->