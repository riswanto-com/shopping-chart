<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url(); ?>assets/js/error-message.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery-3.5.1.js"></script>
<script src="<?= base_url(); ?>assets/DataTables/dist/js/jquery.dataTables.min.js"></script>
<!-- Styles -->

<!-- Styles -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/select2/css/select2.min.css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/select2/select2-bootstrap-5-theme.min.css" />
<script src="<?= base_url(); ?>assets/select2/js/select2.full.min.js"></script>
<!-- Scripts -->
<script>
    var urlBase = "<?= base_url(); ?>";
    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    $('.single-select-field').select2({
        theme: "bootstrap-5",
        dropdownParent: $('#tambahFormSelect2'),
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
    $('.single-select-field2').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
</script>
