<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Ahmad Dani <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- dataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- sweatalert -->
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/myAlert.js') ?>"></script>

<!-- my javascript -->
<script>
$(document).ready(function() {
    // jquery untuk form edit profile
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // jquery untuk form select pembayaran
    $('#bulan').on('change', function() {
        // ambil data dari elemen option yang dipilih
        const Nominal = $('#bulan option:selected').data('nominal');

        // tampilkan data ke elemen
        $('[name = nominal]').val(Nominal);
    });

    // jquery role akses
    $('.form-check-input').on('click', function() {
        const roleId1 = $(this).data('role');
        const menuId1 = $(this).data('menu');

        $.ajax({
            url: "<?= base_url('admin/ubahAkses'); ?>",
            type: "post",
            data: {
                roleId: roleId1,
                menuId: menuId1
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleAkses/'); ?>" + roleId1;
            }
        });
    });

    // datatable submenu
    $('#tableSM').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [6, 10, 15, -1],
            [6, 10, 15, "All"]
        ],
        "order": [],
        "ajax": {
            "url": "<?= base_url('menu/getData'); ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }]
    });

    // datatable data user
    $('#tableDU').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [6, 10, 15, -1],
            [6, 10, 15, "All"]
        ],
        "order": [],
        "ajax": {
            "url": "<?= base_url('master/getData'); ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0, 5],
            "orderable": false,
        }]
    });

    // datatable data iuran
    $('#tableDI').DataTable({
        "processing": true,
        "serverSide": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [6, 10, 15, -1],
            [6, 10, 15, "All"]
        ],
        "order": [],
        "ajax": {
            "url": "<?= base_url('master/getData2'); ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }]
    });

    // datatable pengajuan iuran
    $('#tablePI').DataTable({
        "processing": true,
        "serverSide": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [6, 10, 15, -1],
            [6, 10, 15, "All"]
        ],
        "order": [],
        "ajax": {
            "url": "<?= base_url('master/getData3'); ?>",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [0, 8],
            "orderable": false,
        }]
    });

});
</script>
</body>

</html>