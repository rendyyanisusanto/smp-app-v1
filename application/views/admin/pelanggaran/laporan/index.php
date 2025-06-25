
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>
    <div class="card-body">
       <form id="filterForm">
    <div class="row">
        <div class="col-md-4">
        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <select id="kelas" class="form-control">
            <!-- Option kelas akan diisi oleh backend -->
            </select>
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" id="tanggal_mulai" class="form-control">
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" id="tanggal_selesai" class="form-control">
        </div>
        </div>
    </div>

    <button type="button" id="generateReport" class="btn btn-primary">Generate Laporan</button>
    <button type="button" id="exportExcel" class="btn btn-success ml-2">Export Excel</button>
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
        <div class="reportTable"></div>
    </div>
</div>