<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "processing": true, // Menampilkan loading saat mengambil data
            "serverSide": true, // Server-side processing
            "pageLength": 10, // Menampilkan maksimal 10 data per halaman
            "ajax": {
                "url": "<?= base_url('admin/kelas/datatable'); ?>", // URL untuk Ajax request
                "type": "GET"
            },
            "columns": [
                { "data": null, "defaultContent": "" }, // Kolom No (otomatis terisi dengan urutan)
                { "data": "nama" }, // Nama Kelas
                { 
                    "data": "id", 
                    "render": function(data, type, row) {
						console.log(row)
                        return '<button class="btn btn-warning btn-sm btnEditKelas" data-id="'+row.id+'" data-nama="'+row.nama+'">Edit</button> | <a href="<?= base_url('kelas/delete/'); ?>' + data + '">Delete</a>';
                    }
                } // Kolom Action (Edit dan Delete)
            ],
            "order": [[1, 'asc']],
			"rowCallback": function(row, data, index) {
				// Menambahkan nomor urut pada kolom pertama
				$('td:eq(0)', row).html(index + 1);
			}
        });
		$("#btnAddKelas").click(function () {
			$("#modalAddKelas").modal("show");
			$("#formAddKelas")[0].reset(); // Reset form
		});

		// Simpan data kelas dengan AJAX
		$("#btnSaveKelas").click(function () {
			let formData = $("#formAddKelas").serialize(); // Ambil data dari form
			$.ajax({
				url: "<?= base_url('admin/kelas/simpan_data') ?>", // Ganti dengan URL simpan data Anda
				type: "POST",
				data: formData,
				success: function (response) {
					let result = JSON.parse(response);
					if (result.status == "success") {
						alert("Data berhasil disimpan!");
						$("#modalAddKelas").modal("hide"); // Tutup modal
						$("#datatables").DataTable().ajax.reload(); // Reload DataTable
					} else {
						alert("Gagal menyimpan data: " + result.message);
					}
				},
				error: function (xhr, status, error) {
					alert("Terjadi kesalahan: " + error);
				}
			});
		});
		$("#datatables").on("click", ".btnEditKelas", function () {
			const id = $(this).data("id");
			const nama = $(this).data("nama");

			// Isi form dengan data kelas
			$("#idKelas").val(id); // ID readonly untuk edit
			$("#namaKelas").val(nama);

			// Ubah title modal
			$("#modalAddKelasLabel").text("Edit Kelas");
			$("#modalAddKelas").modal("show");
		});
    });
    </script>
