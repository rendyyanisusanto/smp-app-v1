<link rel="stylesheet" href="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables-bs4/css/dataTables.bootstrap4.min.css">

<script src="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('inc/themes/adminlte/plugins/'); ?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Daftar Kelas</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<button id="btnAddKelas" class="btn btn-app bg-success">
					<i class="fas fa-plus"></i> Tambah Data
				</button>
				<hr>
				<div class="table-responsive">

					<table id="datatables" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Nama Kelas</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Tambah Kelas -->
<div class="modal fade" id="modalAddKelas" tabindex="-1" aria-labelledby="modalAddKelasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddKelasLabel">Tambah Kelas</h5>
      </div>
      <div class="modal-body">
        <form id="formAddKelas">
          <div class="mb-3">
            <label for="idKelas" class="form-label">ID Kelas</label>
            <input type="hidden" class="form-control" id="idKelas" name="id" required>
          </div>
          <div class="mb-3">
            <label for="namaKelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="namaKelas" name="nama" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSaveKelas">Simpan</button>
      </div>
    </div>
  </div>
</div>
