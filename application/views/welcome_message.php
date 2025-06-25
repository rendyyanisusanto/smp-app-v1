<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelanggaran SMP IT Asy-Syadzili</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(45deg, #f39c12, #3498db, #2ecc71, #e74c3c);
            background-size: 400% 400%;
            animation: gradientAnimation 12s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            border-bottom: 0;
            padding: 1rem;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #bdc3c7;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Form Pelanggaran SMP IT Asy-Syadzili</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-pelanggaran" enctype="multipart/form-data">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select2').select2();

            // Contoh data dynamic (replace dengan data dari server)
            const siswaOptions = [
                { id: 1, text: 'Ali' },
                { id: 2, text: 'Budi' },
                { id: 3, text: 'Citra' }
            ];
            const guruOptions = [
                { id: 1, text: 'Pak Rahmat' },
                { id: 2, text: 'Bu Siti' }
            ];
            const tatibOptions = [
                { id: 1, text: 'Tidak Masuk Tanpa Izin' },
                { id: 2, text: 'Berpakaian Tidak Rapi' }
            ];

            // Tambahkan opsi ke Select2
            siswaOptions.forEach(opt => $('#siswa_id').append(new Option(opt.text, opt.id)));
            guruOptions.forEach(opt => $('#guru_id').append(new Option(opt.text, opt.id)));
            tatibOptions.forEach(opt => $('#tatib_id').append(new Option(opt.text, opt.id)));
        });
    </script>
</body>
</html>
