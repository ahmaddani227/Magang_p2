<div class="container-fluid">

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <a href="<?= base_url('menu'); ?>"> <i
                                class="bi bi-arrow-left"></i> </a>Edit menu</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="idH" value="<?= $menuId['id']; ?>">
                        <div class="form-group">
                            <label for="menu">Nama menu</label>
                            <input type="text" class="form-control" name="menu" id="menu"
                                value="<?= $menuId['menu']; ?>" autocomplete="off">
                            <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" name="edit" class="btn btn-block btn-outline-primary">Edit menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>