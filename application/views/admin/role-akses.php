<div class="container-fluid">

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <a href="<?= base_url('admin/role'); ?>"><i
                                class="bi bi-arrow-left"></i></a>
                        Akses role <?= $roleId['role']; ?> </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">

                            <?php if( !empty($this->session->flashdata('admin')) ) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Role akses <strong>berhasil</strong> <?= $this->session->flashdata('admin'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>

                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; 
                                    foreach( $menu as $m ) : ?>
                                    <tr>
                                        <th scope="row"> <?= $i++ ?> </th>
                                        <td> <?= $m['menu']; ?> </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    <?= cek_akses($roleId['id'], $m['id']); ?>
                                                    data-role="<?= $roleId['id']; ?>" data-menu="<?= $m['id']; ?>">
                                            </div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit role <?= $roleId['role']; ?> </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <form action="<?= base_url('admin/roleAkses/') . $roleId['id']; ?>" method="post">
                                <input type="hidden" name="idH" value="<?= $roleId['id']; ?>">
                                <div class="form-group">
                                    <label for="role">Nama Role</label>
                                    <input type="text" class="form-control" id="role" name="role"
                                        value="<?= $roleId['role']; ?>" autocomplete="off">
                                    <?= form_error('role', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-outline-primary  btn-block">Edit
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