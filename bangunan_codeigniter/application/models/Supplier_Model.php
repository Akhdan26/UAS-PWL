<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_Model extends CI_Model
{
    public function getSupplier($id = null)
    {
        if ($id === null) {
            return $this->db->get('supplier')->result_array();
        } else {
            return $this->db->get_where('supplier', ['id_supplier' => $id])->row_array();
        }
    }
    public function deleteSupplier($id)
    {
        $this->db->delete('supplier', ['id_supplier' => $id]);
        return $this->db->affected_rows();
    }
    public function createSupplier($data)
    {
        return $this->db->insert('supplier', $data);
    }
    public function updateSupplier($data, $id)
    {
        $this->db->update('supplier', $data, ['id_supplier' => $id]);
        return $this->db->affected_rows();
    }
}

/* End of file Supplier_model.php */
