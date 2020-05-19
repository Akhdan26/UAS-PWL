<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barangk_Model extends CI_Model
{
    public function getBarangk($id = null)
    {
        if ($id === null) {
            return $this->db->get('barang_keluar')->result_array();
        } else {
            return $this->db->get_where('barang_keluar', ['id_barang_keluar' => $id])->row_array();
        }
    }
    public function deleteBarangk($id)
    {
        $this->db->delete('barang_keluar', ['id_barang_keluar' => $id]);
        return $this->db->affected_rows();
    }
    public function createBarangk($data)
    {
        return $this->db->insert('barang_keluar', $data);
    }
    public function updateBarangk($data, $id)
    {
        $this->db->update('barang_keluar', $data, ['id_barang_keluar' => $id]);
        return $this->db->affected_rows();
    }
}

/* End of file Barangk_model.php */
