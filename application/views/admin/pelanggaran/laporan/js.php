<script>
$(document).ready(function () {
    $('#generateReport').on('click', function () {
        const filterBy = $('#filterBy').val();
        const kelas = $('#kelas').val();
        const tanggal = $('#tanggal').val();

        // Kirim data ke server dan render hasilnya ke tabel
        $.ajax({
            url: '<?= base_url("admin/Pelanggaran/generateReport") ?>',
            type: 'POST',
            data: {
                filterBy: filterBy,
                kelas: kelas,
                tanggal: tanggal,
            },
            success: function (result) {
                $('.reportTable').html(result);
            },
            error: function () {
                alert('Terjadi kesalahan saat memuat laporan!');
            }
        });
    });
});
$.ajax({
        url: '<?= base_url('admin/pelanggaran/get_kelas'); ?>', // Endpoint backend untuk mendapatkan kelas
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(kelas => {
                $('#kelas').append(`<option value="${kelas.id}">${kelas.nama}</option>`);
            });
        }
    });

    // Adjust date input based on filter selection
    $('#filterBy').on('change', function () {
        const filterBy = $(this).val();
        let inputHtml = '';

        if (filterBy === 'hari') {
            inputHtml = '<input type="date" id="tanggal" class="form-control">';
        } else if (filterBy === 'minggu') {
            inputHtml = '<input type="week" id="tanggal" class="form-control">';
        } else if (filterBy === 'bulan') {
            inputHtml = '<input type="month" id="tanggal" class="form-control">';
        }

        $('#tanggalContainer').html(`
            <label for="tanggal">Tanggal:</label>
            ${inputHtml}
        `);
    });
</script>