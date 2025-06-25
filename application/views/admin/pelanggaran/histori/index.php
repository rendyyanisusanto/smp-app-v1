
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form id="filterForm">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="filterBy">Filter Berdasarkan:</label>
                        <select id="filterBy" class="form-control">
                            <option value="hari">Hari</option>
                            <option value="minggu">Minggu</option>
                            <option value="bulan">Bulan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" class="form-control">
                            <option value="">Semua Kelas</option>
                            <!-- Option kelas akan diisi oleh backend -->
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="tanggalContainer">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" class="form-control">
                    </div>
                </div>
                <button type="button" id="generateReport" class="btn btn-primary">Generate Laporan</button>
            </form>
        </div>
    </div>
</form>
</div>
<div class="card">
<div class="card-header">
    <h3 class="card-title">Hasil Laporan</h3>
</div>
<div class="card-body">
    <table id="reportTable" class="table table-xxs table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bukti</th>
                <th>Guru</th>
                <th>Keterangan</th>
                <th>Tatib</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be appended dynamically -->
        </tbody>
    </table>
</div>
</div>