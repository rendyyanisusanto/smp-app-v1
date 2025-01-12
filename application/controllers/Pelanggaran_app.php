<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran_app extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Pelanggaran_app_model');
    }
	public function index()
	{
		$this->load->view('Pelanggaran_app/component/header');
		$this->load->view('Pelanggaran_app/index');
		$this->load->view('Pelanggaran_app/component/footer');
	}
	public function get_siswa_json() {
		$search = $this->input->get('q'); 
    	$limit = 10;
        $data = $this->Pelanggaran_app_model->get_siswa_limit($search, $limit);
        echo json_encode($data); 
    }

    public function get_guru_json() {
		$search = $this->input->get('q'); 
    	$limit = 10;
        $data = $this->Pelanggaran_app_model->get_guru_limit($search, $limit);
        echo json_encode($data); 
    }

    public function get_tatib_json() {
		$search = $this->input->get('q'); 
    	$limit = 10;
        $data = $this->Pelanggaran_app_model->get_tatib_limit($search, $limit);
        echo json_encode($data); 
    }
    public function simpan_pelanggaran() {
	    $config['upload_path'] = './inc/media/';
	    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Hanya gambar
	    // $config['max_size'] = 2048; // Maksimal ukuran file 2MB sebelum kompresi
	    $config['encrypt_name'] = TRUE; // Nama file akan dienkripsi untuk keamanan

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('bukti')) {
	        // Jika upload gagal
	        $error = $this->upload->display_errors();
	        $this->session->set_flashdata('error', $error);
	        redirect('Pelanggaran_app/index');
	    } else {
	        // Jika upload berhasil
	        $upload_data = $this->upload->data(); // Data file yang diupload

	        // Kompres gambar
	        $this->load->library('image_lib');
	        $config['image_library'] = 'gd2';
	        $config['source_image'] = $upload_data['full_path'];
	        $config['quality'] = '50%'; // Kompresi kualitas gambar
	        $config['maintain_ratio'] = TRUE; // Pertahankan rasio
	        $config['width'] = 1024; // Resize lebar maksimum
	        $config['height'] = 1024; // Resize tinggi maksimum

	        $this->image_lib->initialize($config);

	        if (!$this->image_lib->resize()) {
	            // Jika kompresi gagal
	            $error = $this->image_lib->display_errors();
	            $this->session->set_flashdata('error', $error);
	            redirect('pelanggaran_app/index');
	        }

	        $this->image_lib->clear();

	        // Simpan data pelanggaran ke database
	        $file_name = $upload_data['file_name'];
	        $data = [
	            'siswa_id' => $this->input->post('siswa_id'),
	            'tanggal' => $this->input->post('tanggal'),
	            'bukti' => $file_name,
	            'guru_id' => $this->input->post('guru_id'),
	            'keterangan' => $this->input->post('keterangan'),
	            'tatib_id' => $this->input->post('tatib_id')
	        ];
	        $this->db->insert('pelanggaran', $data);

	        // Set flashdata untuk SweetAlert
	        $this->session->set_flashdata('success', 'Data pelanggaran berhasil disimpan');
	        redirect('Pelanggaran_app/index');
		}
	}
}
