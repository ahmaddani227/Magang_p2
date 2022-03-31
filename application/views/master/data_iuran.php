<div class="container-fluid">

    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?></h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg">
                            <a href="<?= base_url('master/exportExcel'); ?>"
                                class="btn btn-success btn-sm shadow-sm float-left mb-3">
                                <i class="fas fa-file-export fa-sm"></i>
                                Export Excel
                            </a>
                            <!-- fungsi select option tahun belum bisa dijalankan -->
                            <!-- <select class="form-control-sm shadow-sm border border-primary  float-right mr-2 mb-3"
                            name="tahunMaster" id="tahunMaster">
                            <option value="">Data iuran tahun</option>
                            <?php //foreach( $tahunMaster as $tM ) : ?>
                                <option value="<?= $tM['id']; ?>">
                                    <?= $tM['tahun_db'] ; ?>
                                </option>
                                <?php //endforeach; ?>
                            </select> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg">

                            <div class="table-responsive">
                                <table id="tableDI" class="table table-bordered table-hover" style="width: 100%;">
                                    <thead class="thead-light">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="white" fill-opacity="1"
        d="M0,96L40,96C80,96,160,96,240,128C320,160,400,224,480,234.7C560,245,640,203,720,192C800,181,880,203,960,224C1040,245,1120,267,1200,250.7C1280,235,1360,181,1400,154.7L1440,128L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
    </path>
</svg>
</div>