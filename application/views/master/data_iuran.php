<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <a href="<?= base_url('master/excel'); ?>"
                        class="btn btn-success btn-sm  float-right ml-2 shadow-sm"> <i
                            class="fas fa-file-export fa-sm "></i>
                        Export Excel </a>
                    <div class="form-group float-right mb-3">
                        <form action="<?= base_url('master/data_iuran'); ?>" method="post">
                            <select class="mx-2 shadow-sm form-control-sm btn-info" name="tahunMaster">
                                <?php foreach( $tahunMaster as $tM ) : ?>
                                <?php if( $tM['tahun_db'] == date('Y', time()) ) : ?>
                                <option value="<?= $tM['id']; ?>" selected>
                                    <?php else : ?>
                                <option value="<?= $tM['id']; ?>">
                                    <?php endif; ?>
                                    <?= $tM['tahun_db'] ; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Metode</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tgl Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; 
                                foreach( $dataIuran as $dI ) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td> <?= $dI['name']; ?> </td>
                                    <td> <?= $dI['nominal']; ?> </td>
                                    <td> <?= $dI['bulan']; ?> </td>
                                    <td> <?= $dI['tahun_db']; ?> </td>
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
</div>