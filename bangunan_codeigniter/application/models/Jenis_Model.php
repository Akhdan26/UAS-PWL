<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_Model extends CI_Model
{
    public function getJenis($id = null)
    {
        if ($id === null) {
            return $this->db->get('jenis')->result_array();
        } else {
            return $this->db->get_where('jenis', ['id_jenis' => $id])->row_array();
        }
    }
    public function deleteJenis($id)
    {
        $this->db->delete('jenis', ['id_jenis' => $id]);
        return $this->db->affected_rows();
    }
    public function createJenis($data)
    {
        return $this->db->insert('jenis', $data);
    }
    public function updateJenis($data, $id)
    {
        $this->db->update('jenis', $data, ['id_jenis' => $id]);
        return $this->db->affected_rows();
    }
}

/* End of file Jenis_model.php */
