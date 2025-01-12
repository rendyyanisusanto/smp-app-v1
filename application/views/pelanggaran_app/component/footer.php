
    <!-- Bootstrap JS -->
    <script src="<?= base_url('inc/component/bootstrap.bundle.min.js'); ?>"></script>
    <!-- jQuery -->
    <script src="<?= base_url('inc/component/jquery.min.js'); ?>"></script>
    <!-- Select2 JS -->
    <script src="<?= base_url('inc/component/select2.min.js'); ?>"></script>
    <script src="<?= base_url('inc/component/sweetalert.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            
            $('#siswa_id').select2({
                ajax: {
                    url: '<?= base_url("Pelanggaran_app/get_siswa_json"); ?>', // URL untuk API JSON
                    dataType: 'json',
                    delay: 250, // Delay untuk mengurangi jumlah request
                    data: function(params) {
                        return {
                            q: params.term // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(siswa => ({
                                id: siswa.id,
                                text: siswa.nama // Gabungkan nis dan nama
                            }))
                        };
                    }
                },
                placeholder: "Pilih Siswa",
                allowClear: true,
                minimumInputLength: 1
            });


            $('#guru_id').select2({
                ajax: {
                    url: '<?= base_url("Pelanggaran_app/get_guru_json"); ?>', // URL untuk API JSON
                    dataType: 'json',
                    delay: 250, // Delay untuk mengurangi jumlah request
                    data: function(params) {
                        return {
                            q: params.term // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(guru => ({
                                id: guru.id,
                                text:  guru.nama // Gabungkan nis dan nama
                            }))
                        };
                    }
                },
                placeholder: "Pilih Guru",
                allowClear: true,
                minimumInputLength: 1
            });


            $('#tatib_id').select2({
                ajax: {
                    url: '<?= base_url("Pelanggaran_app/get_tatib_json"); ?>', // URL untuk API JSON
                    dataType: 'json',
                    delay: 250, // Delay untuk mengurangi jumlah request
                    data: function(params) {
                        return {
                            q: params.term // Parameter pencarian
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(tatib => ({
                                id: tatib.id,
                                text: tatib.kode + ' - ' + tatib.nama // Gabungkan nis dan nama
                            }))
                        };
                    }
                },
                placeholder: "Pilih Pelanggaran",
                allowClear: true,
                minimumInputLength: 1
            });

            <?php if ($this->session->flashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= $this->session->flashdata('success') ?>',
                    showConfirmButton: false,
                    timer: 2000
                });
            <?php endif; ?>

            // SweetAlert untuk pesan error
            <?php if ($this->session->flashdata('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?= $this->session->flashdata('error') ?>',
                    showConfirmButton: false,
                    timer: 3000
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
