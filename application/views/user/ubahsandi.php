<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 text-center"> <?= $title; ?> </h1>
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <?= $this->session->userdata('app'); ?>

            <form action="<?= base_url('user/ubahSandi'); ?>" method="post">
                <div class="form-group">
                    <label for="sandiLama">Sandi saat ini</label>
                    <input type="password" class="form-control" id="sandiLama" name="sandiLama">
                    <?= form_error('sandiLama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sandiBaru">Sandi baru</label>
                            <input type="password" class="form-control" id="sandiBaru" name="sandiBaru">
                            <?= form_error('sandiBaru', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="konfirmasi">Konfirmasi</label>
                            <input type="password" class="form-control" id="konfirmasi" name="konfirmasi">
                            <?= form_error('konfirmasi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Ubah Sandi</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->