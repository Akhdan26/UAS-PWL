<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barangm_Model extends CI_Model
{
    public function getBarangm($id = null)
    {
        if ($id === null) {
            return $this->db->get('barang_masuk')->result_array();
        } else {
            return $this->db->get_where('barang_masuk', ['id_barang_masuk' => $id])->row_array();
        }
    }
    public function deleteBarangm($id)
    {
        $this->db->delete('barang_masuk', ['id_barang_masuk' => $id]);
        return $this->db->affected_rows();
    }
    public function createBarangm($data)
    {
        return $this->db->insert('barang_masuk', $data);
    }
    public function updateBarangm($data, $id)
    {
        $this->db->update('barang_masuk', $data, ['id_barang_masuk' => $id]);
        return $this->db->affected_rows();
    }
}

/* End of file Barangm_model.php */
