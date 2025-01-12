<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/Kelas_model');
    }
	public function get_data()
	{
		$this->load->view('admin/kelas/index_page/index');
		$this->load->view('admin/kelas/index_page/js');
	}

	public function simpan_data()
    {

        $nama = $this->input->post('nama', true);

        if (!$nama) {
            echo json_encode(['status' => 'error', 'message' => 'ID dan Nama wajib diisi']);
            return;
        }

        $data = [
            'id' => $id,
            'nama' => $nama
        ];

        if ($this->Kelas_model->insert($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
        }
    }
	function datatable(){
		$draw = $this->input->get('draw');
        $start = $this->input->get('start'); // Offset untuk pagination
        $length = $this->input->get('length'); // Jumlah data per halaman
        $search = $this->input->get('search')['value']; // Search query

        // Mengambil data kelas dengan pagination dan pencarian
        $data = $this->Kelas_model->get_kelas($start, $length, $search);

        // Menghitung total data yang sesuai dengan filter
        $totalRecords = $this->Kelas_model->get_total_kelas($search);
        
        $response = [
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords, // Menggunakan total data untuk filtered
            "data" => $data
        ];

        echo json_encode($response); 
	}
}
