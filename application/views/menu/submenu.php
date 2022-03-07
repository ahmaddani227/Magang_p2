<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg">
            <!-- Page Heading -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">

                            <?php if( validation_errors() ) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="" data-toggle="modal" data-target="#tambahSubmenu"
                                        class="btn btn-primary mb-3">Tambah
                                        Submenu</a>
                                </div>
                                <div class="col-sm-5 offset-sm-4">
                                    <form action="" method="post">
                                        <div class="input-group mb-3 float-right">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search...." aria-label="Recipient's username"
                                                aria-describedby="button-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="button-addon2"><i
                                                        class="fas fa-search fa-sm"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Url</th>
                                            <th scope="col">Icon</th>
                                            <th scope="col">Active</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        <?php foreach( $submenu as $sm ) : ?>
                                        <tr>
                                            <th scope="row"> <?= $i; ?> </th>
                                            <td> <?= $sm['menu']; ?> </td>
                                            <td> <?= $sm['title']; ?> </td>
                                            <td> <?= $sm['url']; ?> </td>
                                            <td> <?= $sm['icon']; ?> </td>
                                            <td> <?= $sm['is_active']; ?> </td>
                                            <td>
                                                <a href="<?= base_url('menu/editSubmenu/') . $sm['id']; ?>"
                                                    class="badge  badge-success">Edit</a>
                                                <a href="<?= base_url('menu/hapus/') . $sm['id']; ?>"
                                                    class="badge  badge-danger"
                                                    onclick="return confirm('yakin')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?= $this->pagination->create_links(); ?>

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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahSubmenu" tabindex="-1" aria-labelledby="tambahSubmenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSubmenuLabel">Tambah Submneu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" id="menu" name="menu">
                            <option value=""> Pilih menu </option>
                            <?php foreach( $menu as $m ) : ?>
                            <option value="<?= $m['id']; ?>"> <?= $m['menu']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked value="1" id="active" name="active">
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                    <div class="form-group">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- AKHIR MODAL TAMBAH -->