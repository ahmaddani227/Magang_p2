<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit <a href="<?= base_url('menu/subMenu'); ?>">Submenu</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $subMenuId['id']; ?>">
                        <div class="form-group row">
                            <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                            <div class="col-sm-7">
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
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="title" id="title"
                                    value="<?= $subMenuId['title']; ?>">
                                <?= form_error('title', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-2 col-form-label">Url</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="url" id="url"
                                    value="<?= $subMenuId['url']; ?>">
                                <?= form_error('url', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="icon" id="icon"
                                    value="<?= $subMenuId['icon']; ?>">
                                <?= form_error('icon', '<small class="text-danger pl-2">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-7 offset-sm-2">
                                <button type="submit" class=" btn btn-primary btn-lg btn-block">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
</div>