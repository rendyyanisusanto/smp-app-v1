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
        $filterBy = $this->input->post('filterBy');
        $kelas = $this->input->post('kelas');
        $tanggal = $this->input->post('tanggal');

        $data = $this->Pelanggaran_model->fetchReport($filterBy, $kelas, $tanggal);
        echo json_encode($data);
    }
    public function generateReport()
    {
        $filterBy = $this->input->post('filterBy'); // 'hari', 'minggu', 'bulan'
        $kelas = $this->input->post('kelas'); // ID kelas
        $tanggal = $this->input->post('tanggal'); // Tanggal filter


        // Dapatkan data laporan
        $reportData = $this->Pelanggaran_model->getLaporan($filterBy, $kelas, $tanggal);

        
        echo $reportData;
    }

}
