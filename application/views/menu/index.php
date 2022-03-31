<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="row">
        <div class="col-lg-5">

            <!-- alert -->
            <?php if( !empty($this->session->flashdata('menu')) ) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Menu <strong>berhasil</strong> <?= $this->session->flashdata('menu'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> <a href="" data-toggle="modal"
                            data-target="#exampleModal"> <i class="bi bi-plus-lg"></i></a></h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            <?php foreach( $menu as $m ) : ?>
                            <tr>
                                <th scope="row"> <?= $i; ?> </th>
                                <td> <?= $m['menu']; ?> </td>
                                <td>
                                    <a href="<?= base_url('menu/editMenu/') . $m['id']; ?>"
                                        class="badge badge-pill badge-success">Edit</a>
                                    <a href="<?= base_url('menu/hapusMenu/') . $m['id']; ?>"
                                        class="badge badge-pill badge-danger"
                                        onclick="return confirm('Apakah anda yakin akan menghapus menu ini !');">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah data menu -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('menu'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama menu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir modal -->



</div>
<!-- End of Main Content -->