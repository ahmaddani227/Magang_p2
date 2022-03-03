<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> <?= $title; ?> </h1>

    <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-3">Tambah Menu</a>

    <div class="row">
        <div class="col-lg-5">

            <?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>

            <table class="table table-hover">
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
                            <!-- data-toggle="modal" data-target="#modalEditMenu<?= $m['id']; ?>" -->
                            <a href="" class="badge badge-pill badge-success">Edit</a>
                            <a href="" class="badge badge-pill badge-danger">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir modal -->



</div>
<!-- End of Main Content -->