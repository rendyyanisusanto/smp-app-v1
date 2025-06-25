<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelanggaran extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/Pelanggaran_model');
    }
    public function histori()
    {
        $this->load->view('admin/pelanggaran/histori/index');
        $this->load->view('admin/pelanggaran/histori/js');
    }
    public function laporan()
    {
        $this->load->view('admin/pelanggaran/laporan/index');
        $this->load->view('admin/pelanggaran/laporan/js');
    }
    function get_kelas(){
        $kelas  =   $this->db->query("select id, nama from kelas")->result_array();
        echo json_encode($kelas);
    }
    public function get_report()
    {
        $kelas = $this->input->post('kelas');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        $data = $this->Pelanggaran_model->fetchReport($kelas, $tanggal_mulai, $tanggal_selesai);
        echo json_encode($data);
    }

    public function generateReport()
    {
        $kelas = $this->input->post('kelas');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        $this->Pelanggaran_model->getLaporan($kelas, $tanggal_mulai, $tanggal_selesai);
    }
    public function exportExcelLaporan()
    {
        $kelas = $this->input->get('kelas');
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        // Ambil data dengan model
        ob_start();
        $this->Pelanggaran_model->getLaporan($kelas, $tanggal_mulai, $tanggal_selesai);
        $html = ob_get_clean();

        // Set headers untuk file Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_demerit_poin.xls");

        echo $html;
    }

    public function export_excel()
    {
        $kelas = $this->input->get('kelas');
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        $data = $this->Pelanggaran_model->fetchReport($kelas, $tanggal_mulai, $tanggal_selesai);

        // Header agar browser menangkap sebagai file Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_pelanggaran.xls");

        // Output sebagai tabel HTML (akan dibaca Excel)
        echo "<table border='1'>";
        echo "<tr>
            <th>Tanggal</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Bukti</th>
            <th>Guru</th>
            <th>Keterangan</th>
            <th>Tatib</th>
        </tr>";

        foreach ($data as $row) {
            echo "<tr>
                <td>{$row->tanggal}</td>
                <td>{$row->nama_siswa}</td>
                <td>{$row->kelas}</td>
                <td>" . ($row->bukti ? base_url('inc/media/' . $row->bukti) : '-') . "</td>
                <td>{$row->nama_guru}</td>
                <td>{$row->keterangan}</td>
                <td>{$row->tatib}</td>
            </tr>";
        }

        echo "</table>";
    }
    


}
