<?php
// application/models/Kelas_model.php
class Kelas_model extends CI_Model {

    // Fungsi untuk mengambil data kelas dengan limit dan pencarian
    public function get_kelas($start, $length, $search) {
        $this->db->like('nama', $search); // Mencari berdasarkan nama kelas
        $this->db->limit($length, $start); // Pagination dengan limit dan offset
        $query = $this->db->get('kelas'); // Mengambil data dari tabel kelas
        return $query->result(); // Mengembalikan hasil dalam bentuk array objek
    }

    // Fungsi untuk menghitung total data kelas (untuk pagination)
    public function get_total_kelas($search) {
        if ($search) {
            $this->db->like('nama', $search); // Mencari berdasarkan nama kelas
        }
        $query = $this->db->get('kelas');
        return $query->num_rows(); // Mengembalikan jumlah total data
    }
	
	public function insert($data)
    {
        return $this->db->insert('kelas', $data);
    }
}
?>
