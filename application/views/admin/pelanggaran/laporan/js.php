<script>
$(document).ready(function () {
    // Load kelas
    $.ajax({
        url: '<?= base_url('admin/pelanggaran/get_kelas'); ?>',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(kelas => {
                $('#kelas').append(`<option value="${kelas.id}">${kelas.nama}</option>`);
            });
        }
    });

    // Generate laporan
    $('#generateReport').on('click', function () {
        const kelas = $('#kelas').val();
        const tanggal_mulai = $('#tanggal_mulai').val();
        const tanggal_selesai = $('#tanggal_selesai').val();

        $.ajax({
            url: '<?= base_url("admin/Pelanggaran/generateReport") ?>',
            type: 'POST',
            data: {
                kelas: kelas,
                tanggal_mulai: tanggal_mulai,
                tanggal_selesai: tanggal_selesai,
            },
            success: function (result) {
                $('.reportTable').html(result);
            },
            error: function () {
                alert('Terjadi kesalahan saat memuat laporan!');
            }
        });
    });

    // Export ke Excel
    $('#exportExcel').on('click', function () {
        const kelas = $('#kelas').val();
        const tanggal_mulai = $('#tanggal_mulai').val();
        const tanggal_selesai = $('#tanggal_selesai').val();
        const query = `?kelas=${kelas}&tanggal_mulai=${tanggal_mulai}&tanggal_selesai=${tanggal_selesai}`;
        window.open('<?= base_url("admin/Pelanggaran/exportExcelLaporan") ?>' + query, '_blank');
    });
});

</script>