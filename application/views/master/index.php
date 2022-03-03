<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?= $title; ?> </h6>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-lg">
                            <ul class="list-group ">
                                <?php foreach( $users as $u ) : ?>
                                <li class="list-group-item list-group-item-action table-striped">
                                    <?= $u['name']; ?>
                                    <a href="" data-toggle="modal" data-target="#modalDetailUser<?= $u['id']; ?>"
                                        class="badge badge-light float-right"> detail</a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Modal -->
<?php foreach( $users as $u ) : ?>
<div class="modal fade" id="modalDetailUser<?= $u['id']; ?>" tabindex="-1" aria-labelledby="modalDetailUserLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailUserLabel">Detail user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profile/') . $u['image']; ?>" class="card-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $u['name']; ?> </h5>
                                <div class="card-text"> <?= $u['role']; ?> </div>
                                <div class="card-text"> <?= $u['email']; ?> </div>
                                <p class="card-text"><small class="text-muted"> Bergabung sejak
                                        <?= date('d F Y', $u['date_created']); ?> </small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- AKHIR MODAL -->

</div>
<!-- End of Main Content -->