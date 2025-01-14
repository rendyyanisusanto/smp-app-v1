<script>
$(document).ready(function () {
    // Load kelas options from backend
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

    // Handle report generation
    $('#generateReport').on('click', function () {
        const filterBy = $('#filterBy').val();
        const kelas = $('#kelas').val();
        const tanggal = $('#tanggal').val();

        $.ajax({
            url: '<?= base_url('admin/pelanggaran/get_report'); ?>',
            type: 'POST',
            data: { filterBy, kelas, tanggal },
            dataType: 'json',
            success: function (data) {
                let tableRows = '';
                data.forEach(item => {
                    tableRows += `
                        <tr>
                            <td>${item.tanggal}</td>
                            <td>${item.nama_siswa}</td>
                            <td>${item.kelas}</td>
                            <td><a href="${item.bukti}" target="_blank">Lihat</a></td>
                            <td>${item.nama_guru}</td>
                            <td>${item.keterangan}</td>
                            <td>${item.tatib}</td>
                        </tr>
                    `;
                });
                $('#reportTable tbody').html(tableRows);
            }
        });
    });

});
</script>