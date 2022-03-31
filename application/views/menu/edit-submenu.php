<div class="container-fluid">

    <div class="row">
        <div class="col-lg-7">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <a href="<?= base_url('menu/subMenu'); ?>"><i
                                class="bi bi-arrow-left"></i></a> EditSubmenu
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $subMenuId['id'] ?>">
                                <div class="form-group">
                                    <select class="form-control" id="menu" name="menu">
                                        <option value=""> Pilih menu </option>
                                        <?php foreach( $menu as $m ) : ?>
                                        <?php if( $m['id'] == $subMenuId['menu_id'] ) : ?>
                                        <option value="<?= $m['id'] ?>" selected> <?= $m['menu']; ?></option>
                                        <?php else : ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['menu']; ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('menu', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="<?= $subMenuId['title']; ?>" placeholder="Nama submenu">
                                    <?= form_error('title', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="url" id="url"
                                        value="<?= $subMenuId['url']; ?>" placeholder="Url submenu">
                                    <?= form_error('url', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="icon" id="icon"
                                        value="<?= $subMenuId['icon']; ?>" placeholder="Icon submenu">
                                    <?= form_error('icon', '<small class="text-danger pl-2">', '</small>'); ?>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked value="1" id="active"
                                        name="active">
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-group mb-0 mt-2">
                                    <button type="submit" class="btn btn-outline-primary btn-block">Edit
                                        submenu</button>
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