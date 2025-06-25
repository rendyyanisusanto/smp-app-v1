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

    $('#generateReport').on('click', function () {
        const kelas = $('#kelas').val();
        const tanggal_mulai = $('#tanggal_mulai').val();
        const tanggal_selesai = $('#tanggal_selesai').val();

        $.ajax({
            url: '<?= base_url('admin/pelanggaran/get_report'); ?>',
            type: 'POST',
            data: { kelas, tanggal_mulai, tanggal_selesai },
            dataType: 'json',
            success: function (data) {
                let tableRows = '';
                data.forEach(item => {
                    tableRows += `
                        <tr>
                            <td>${item.tanggal}</td>
                            <td>${item.nama_siswa}</td>
                            <td>${item.kelas}</td>
                            <td><a href="<?= base_url('inc/media/');?>${item.bukti}" target="_blank">Lihat</a></td>
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

    $('#exportExcel').on('click', function () {
        const kelas = $('#kelas').val();
        const tanggal_mulai = $('#tanggal_mulai').val();
        const tanggal_selesai = $('#tanggal_selesai').val();

        const query = `?kelas=${kelas}&tanggal_mulai=${tanggal_mulai}&tanggal_selesai=${tanggal_selesai}`;
        window.open('<?= base_url('admin/pelanggaran/export_excel'); ?>' + query, '_blank');
    });



});
</script>
