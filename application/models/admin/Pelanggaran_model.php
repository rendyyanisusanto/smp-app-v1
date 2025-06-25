<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran_model extends CI_Model
{
    public function fetchReport($kelas = '', $tanggal_mulai = '', $tanggal_selesai = '')
    {
        $this->db->select('pelanggaran.*, siswa.nama as nama_siswa, kelas.nama as kelas, guru.nama as nama_guru, tatib.nama as tatib');
        $this->db->from('pelanggaran');
        $this->db->join('siswa', 'pelanggaran.siswa_id = siswa.id');
        $this->db->join('kelas', 'siswa.kelas_id = kelas.id');
        $this->db->join('guru', 'pelanggaran.guru_id = guru.id');
        $this->db->join('tatib', 'pelanggaran.tatib_id = tatib.id');

        if (!empty($kelas)) {
            $this->db->where('kelas.id', $kelas);
        }

        if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
            $this->db->where('pelanggaran.tanggal >=', date('Y-m-d', strtotime($tanggal_mulai)));
            $this->db->where('pelanggaran.tanggal <=', date('Y-m-d', strtotime($tanggal_selesai)));
        }

        $results = $this->db->get()->result();

        // Format tanggal jadi d-M-Y
        foreach ($results as &$row) {
            $row->tanggal = date('d-M-Y', strtotime($row->tanggal));
        }

        return $results;
    }

    public function getLaporan($kelasId, $tanggal_mulai, $tanggal_selesai)
{
    $siswa = $this->db->query('SELECT id, nis, kelas_id, nama FROM siswa WHERE kelas_id=' . $kelasId)->result_array();
    $kelas = $this->db->query('SELECT nama FROM kelas WHERE id=' . $kelasId)->row_array();
    $result = [];

    foreach ($siswa as $value) {
        $poin = 0;

        $pelanggaran = $this->db->query("
            SELECT id, siswa_id, tanggal,
                (SELECT kode FROM tatib WHERE tatib.id = tatib_id) AS kode,
                (SELECT poin FROM tatib WHERE tatib.id = tatib_id) AS poin
            FROM pelanggaran
            WHERE siswa_id = {$value['id']}
            AND tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'
        ")->result_array();

        $siswaData = [
            'nama' => $value['nama'],
            'nis' => $value['nis'],
            'kelas_id' => $value['kelas_id'],
            'pelanggaran' => []
        ];

        foreach ($pelanggaran as $p) {
            $poin += $p['poin'];
            $siswaData['pelanggaran'][] = $p['kode'];
        }

        $siswaData['poin'] = $poin;
        for ($i = count($siswaData['pelanggaran']); $i < 30; $i++) {
            $siswaData['pelanggaran'][] = '-';
        }

        $result[] = $siswaData;
    }

    // Render HTML
    $html = '<table class="table table-bordered table-xxs table-striped" border="1" cellpadding="5" cellspacing="0">';
    $html .= '<thead><tr>
        <th>No</th><th>Nama</th><th>NIS</th><th>Kelas</th><th>Poin</th>';
    for ($i = 1; $i <= 30; $i++) {
        $html .= "<th>$i</th>";
    }
    $html .= '</tr></thead><tbody>';

    $no = 0;
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
    echo $html;
}



}