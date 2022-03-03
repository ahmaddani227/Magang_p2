<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> </h6>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-lg">

                    <?= $this->session->userdata('app'); ?>

                    <?= form_open_multipart('user/editProfile');?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?= $user['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Legkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">Gambar</div>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>"
                                        class="img-thumbnail">
                                </div>
                                <div class="col-lg-9">
                                    <div class="custom-file mt-1">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg offset-lg-2 ">
                            <button type="submit" class="btn btn-lg btn-block btn-primary">Edit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->