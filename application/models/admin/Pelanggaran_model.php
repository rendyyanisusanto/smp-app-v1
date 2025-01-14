<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_model extends CI_Model
{
    public function fetchReport($filterBy, $kelas, $tanggal)
    {
        $this->db->select('pelanggaran.*, siswa.nama as nama_siswa, kelas.nama as kelas, guru.nama as nama_guru, tatib.nama as tatib');
        $this->db->from('pelanggaran');
        $this->db->join('siswa', 'pelanggaran.siswa_id = siswa.id');
        $this->db->join('kelas', 'siswa.kelas_id = kelas.id');
        $this->db->join('guru', 'pelanggaran.guru_id = guru.id');
        $this->db->join('tatib', 'pelanggaran.tatib_id = tatib.id');

        if ($kelas) {
            $this->db->where('kelas.id', $kelas);
        }

        if ($filterBy === 'hari') {
            $this->db->where('DATE(pelanggaran.tanggal)', $tanggal);
        } elseif ($filterBy === 'minggu') {
            $this->db->where('WEEK(pelanggaran.tanggal)', date('W', strtotime($tanggal)));
        } elseif ($filterBy === 'bulan') {
            $this->db->where('MONTH(pelanggaran.tanggal)', date('m', strtotime($tanggal)));
            $this->db->where('YEAR(pelanggaran.tanggal)', date('Y', strtotime($tanggal)));
        }
        $results = $this->db->get()->result();

        // Format tanggal menjadi d-M-Y
        foreach ($results as &$row) {
            $row->tanggal = date('d-M-Y', strtotime($row->tanggal));
        }

        return $results;
    }
    public function getLaporan($filterBy, $kelas, $tanggal)
    {
        $siswa = $this->db->query('SELECT id, nis, kelas_id, nama FROM siswa WHERE kelas_id=' . $kelas)->result_array();
        $kelas = $this->db->query('select nama from kelas where id = '.$kelas)->row_array();
        $result = []; // Variabel untuk menyimpan hasil akhir

        foreach ($siswa as $key => $value) {
            $poin = 0;
            // Query untuk mendapatkan pelanggaran sesuai filter
            $pelanggaranQuery = "
                SELECT id, siswa_id, tanggal, 
                    (SELECT kode FROM tatib WHERE tatib.id = tatib_id) AS kode,
                    (SELECT poin FROM tatib WHERE tatib.id = tatib_id) AS poin 
                FROM pelanggaran 
                WHERE siswa_id = {$value['id']} 
                AND " . (($filterBy === 'minggu') 
                ? "WEEK(pelanggaran.tanggal) = " . date('W', strtotime($tanggal)) 
                : "MONTH(pelanggaran.tanggal) = " . date('m', strtotime($tanggal)));

            $pelanggaran = $this->db->query($pelanggaranQuery)->result_array();

            // Inisialisasi data untuk siswa
            $siswaData = [
                'nama' => $value['nama'],
                'nis' => $value['nis'],
                'kelas_id' => $value['kelas_id'],
                'pelanggaran' => []
            ];

            // Tambahkan pelanggaran ke array
            foreach ($pelanggaran as $p) {
                $poin += $p['poin'];
                $siswaData['pelanggaran'][] = $p['kode'];
            }

            $siswaData['poin'] = $poin;

            // Isi hingga 30 pelanggaran dengan nilai kosong jika belum mencapai 30
            for ($i = count($siswaData['pelanggaran']); $i < 30; $i++) {
                $siswaData['pelanggaran'][] = '-';
            }

            // Masukkan data siswa ke hasil akhir
            $result[] = $siswaData;
        }

        // Proses hasil menjadi HTML
        $html = '<table class="table table-bordered table-xxs table-striped" border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Poin</th>';
        for ($i = 1; $i <= 30; $i++) {
            $html .= "<th>$i</th>";
        }
        $html .= '</tr>';
        $html .= '</thead><tbody>';
        $no=0;
        foreach ($result as $row) {
            $html .= '<tr>';
            $html .= '<td>' . ++$no . '</td>';
            $html .= '<td>' . $row['nama'] . '</td>';
            $html .= '<td>' . $row['nis'] . '</td>';
            $html .= '<td>' . $kelas['nama'] . '</td>';
            $html .= '<td>' . $row['poin'] . '</td>';
            foreach ($row['pelanggaran'] as $kode) {
                $html .= '<td>' . $kode . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        // Return hasil HTML
        echo $html;

    }


}