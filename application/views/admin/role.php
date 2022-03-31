<div class="container-fluid">

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> <a href="#role" class="pb-2"><i
                                class="bi bi-plus-lg"></i></a> </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">

                            <?php if( !empty($this->session->flashdata('admin')) ) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Role <strong>berhasil</strong> <?= $this->session->flashdata('admin'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>

                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    foreach( $role as $r ) : ?>
                                    <tr>
                                        <th scope="row"> <?= $i++ ?> </th>
                                        <td> <?= $r['role']; ?> </td>
                                        <td>
                                            <a href="<?= base_url('admin/roleAkses/') . $r['id']; ?>"
                                                class="badge badge-warning">Akses</a>
                                            <a href="<?= base_url('admin/roleAkses/') . $r['id']; ?>"
                                                class="badge badge-success">Edit</a>
                                            <a href="<?= base_url('admin/hapusRole/') . $r['id']; ?>"
                                                class="badge badge-danger" onclick="return confirm('yakin')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Tambah Data Role</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <form action="<?= base_url('admin/role'); ?>" method="post">
                                <div class="form-group">
                                    <label for="role">Nama Role</label>
                                    <input type="text" class="form-control" id="role" name="role" autocomplete="off">
                                    <?= form_error('role', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-outline-primary  btn-block">Tambah
                                    Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>