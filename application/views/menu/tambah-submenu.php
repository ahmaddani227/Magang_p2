<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <a href="<?= base_url('menu/subMenu'); ?>"> <i
                                class="bi bi-arrow-left"></i></a> Tambahsubmenu</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">

                            <form action="<?= base_url('menu/addSubmenu'); ?>" method="post">
                                <div class="form-group">
                                    <select class="form-control" id="menu" name="menu">
                                        <option value=""> Pilih menu </option>
                                        <?php foreach( $menu as $m ) : ?>
                                        <option value="<?= $m['id']; ?>"> <?= $m['menu']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="Url">
                                    <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
                                    <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked value="1" id="active"
                                        name="active">
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-group mb-0 mt-2">
                                    <button type="submit" class="btn btn-outline-primary btn-block">Tambah
                                        Submenu</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>