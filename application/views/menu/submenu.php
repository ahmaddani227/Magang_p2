<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg">
            <?php if( !empty($this->session->flashdata('menu')) ) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Submenu <strong>berhasil</strong> <?= $this->session->flashdata('menu'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <!-- Page Heading -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> <a
                            href="<?= base_url('menu/addSubmenu') ?>"> <i class="bi bi-plus-lg"></i></a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <div class="table-responsive">
                                <table id="tableSM" class="table table-bordered table-hover" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Menu</th>
                                            <th>Title</th>
                                            <th>Url</th>
                                            <th>Icon</th>
                                            <th>Active</th>
                                            <th>Aksi</th>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="white" fill-opacity="1"
        d="M0,256L40,229.3C80,203,160,149,240,154.7C320,160,400,224,480,261.3C560,299,640,309,720,304C800,299,880,277,960,266.7C1040,256,1120,256,1200,261.3C1280,267,1360,277,1400,282.7L1440,288L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
    </path>
</svg>