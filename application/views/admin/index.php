<!-- Begin Page Content -->
<div class="container-fluid mb-4">

    <!-- swetalert -->
    <div class="allog" data-al="<?= $this->session->flashdata('alfl'); ?>"></div>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> <?= $title; ?> </h1>
    <div class="row">
        <!-- jumlah user -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <a href="<?= base_url('master'); ?>" class="text-primary">Data User</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $jmlUser; ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jumlah menu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="<?= base_url('menu'); ?>" class="text-success">Data Menu</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $jmlMenu; ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jumlah submenu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="<?= base_url('master/data_iuran'); ?>" class="text-info">Data Iuran</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $jmlIuran; ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jumlah pendapatan bulanan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <a href="<?= base_url('master/pengajuan'); ?>" class="text-warning">pengajuan
                                    iuran</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $numP; ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="bg-white shadow mb-4 py-4" style="border-radius: 10px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col-lg-8">
            <div class=" bg-white shadow px-3 pb-1" style="border-radius: 10px;">
                <div class="btn-group float-right mt-2">
                    <select class="form-control" id="selTahun">
                        <?php foreach( $tahun as $t ) : ?>
                        <?php if( $t['tahun_db'] == date('Y', time()) ) : ?>
                        <option value="<?= $t['tahun_db']; ?>" selected>
                            <?php else: ?>
                        <option value="<?= $t['tahun_db']; ?>">
                            <?php endif; ?>
                            <?= $t['tahun_db']; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="" id="divGraph">
                    <!-- chart.js -->
                </div>
            </div>
        </div>
    </div>


    <!-- CHARTS.JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><!-- JQUERY -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
    // CHARTS.JS
    const ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ["Tahun <?=$chartTahun['tahun_db'];?>",
                "Bulan <?=$chartBulan['bulan'];?>"
            ],
            datasets: [{
                label: 'Pendapatan',
                data: [
                    <?= $chartTahun['pendapatan']; ?>, <?= $chartBulan['pendapatan']; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(0, 153, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }
    });

    $.ajax({
        url: "<?= base_url('admin/select2'); ?>",
        type: "post",
        data: {
            tahun: <?= date('Y', time()); ?>
        },
        success: function(bar_graph) {
            $("#divGraph").html(bar_graph);
            $("#graph").chart = new Chart($("#graph"), $("#graph").data("settings"));
        }
    })

    $("#selTahun").change(function() {
        // console.log($(this).val());
        $.ajax({
            url: "<?= base_url('admin/select2'); ?>",
            type: "post",
            data: {
                tahun: $(this).val()
            },
            success: function(bar_graph) {
                $("#divGraph").html(bar_graph);
                $("#graph").chart = new Chart($("#graph"), $("#graph").data(
                    "settings"));
            }
        })
    });
    </script>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->