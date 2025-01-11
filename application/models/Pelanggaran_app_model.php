<?php
class Pelanggaran_app_model extends CI_Model {
	public function get_siswa_limit($search ='', $limit = 10) {
        $this->db->select('id, nis, nama');
        $this->db->from('siswa');

        // Filter berdasarkan pencarian (jika ada)
        if (!empty($search)) {
            $this->db->like('nis', $search);
            $this->db->or_like('nama', $search);
        }

        $this->db->limit($limit); // Batasi jumlah data
        $query = $this->db->get();
        return $query->result();
    }

    public function get_guru_limit($search ='', $limit = 10) {
        $this->db->select('id, nama');
        $this->db->from('guru');

        // Filter berdasarkan pencarian (jika ada)
        if (!empty($search)) {
            $this->db->like('nama', $search);
        }

        $this->db->limit($limit); // Batasi jumlah data
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tatib_limit($search ='', $limit = 10) {
        $this->db->select('id, kode, nama');
        $this->db->from('tatib');

        // Filter berdasarkan pencarian (jika ada)
        if (!empty($search)) {
            $this->db->like('kode', $search);
            $this->db->or_like('nama', $search);
        }

        $this->db->limit($limit); // Batasi jumlah data
        $query = $this->db->get();
        return $query->result();
    }
}
?>