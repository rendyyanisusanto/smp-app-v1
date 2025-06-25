<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }
	public function get_data()
	{
		$this->load->view('admin/siswa/index');
	}
}
