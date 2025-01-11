

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Form Pelanggaran SMP IT Asy-Syadzili</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-pelanggaran" method="POST" action="<?= base_url('Pelanggaran_app/simpan_pelanggaran');?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="siswa_id" class="form-label">Nama Siswa</label>
                                <select class="form-select select2" id="siswa_id" name="siswa_id" style="width: 100%;" required>
                                    <option value="" disabled selected>Pilih Siswa</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="mb-3">
                                <label for="bukti" class="form-label">Bukti Pelanggaran</label>
                                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
                            </div>

                            <div class="mb-3">
                                <label for="guru_id" class="form-label">Nama Guru</label>
                                <select class="form-select select2" id="guru_id" name="guru_id" style="width: 100%;" required>
                                    <option value="" disabled selected>Pilih Guru</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="tatib_id" class="form-label">Jenis Pelanggaran (Tata Tertib)</label>
                                <select class="form-select select2" id="tatib_id" name="tatib_id" style="width: 100%;" required>
                                    <option value="" disabled selected>Pilih Pelanggaran</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            <button type="reset" class="btn btn-secondary w-100 mt-2">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
