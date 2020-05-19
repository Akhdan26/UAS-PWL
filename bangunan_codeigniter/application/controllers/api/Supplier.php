<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Supplier extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplier_Model', 'Supplier');
    }

    public function index_get()
    {
        $id = $this->get('id_supplier');
        if ($id === null) {
            $Supplier = $this->Supplier->getSupplier();
        } else {
            $Supplier = $this->Supplier->getSupplier($id);
        }
        if ($Supplier) {
            $this->response([
                'status' => true,
                'data' => $Supplier
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'data' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id_supplier');

        if ($id === null) {
            $this->response([
                'status' => false,
                'data' => 'provide an id !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Supplier->deleteSupplier($id) > 0) {
                # ok
                $this->response([
                    'status' => true,
                    'Supplier_id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                //id not founf
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'id_supplier' => $this->post('id_supplier'),
            'nama_supplier' => $this->post('nama_supplier'),
            'no_telp' => $this->post('no_telp'),
            'alamat' => $this->post('alamat')
        ];
        if ($this->Supplier->createSupplier($data) > 0) {
            $this->response([
                'status' => true,
                'data' => 'new Supplier has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'data' => 'failed to create new data !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id_supplier');
        $data = [
            'id_supplier' => $this->put('id_supplier'),
            'nama_supplier' => $this->put('nama_supplier'),
            'no_telp' => $this->put('no_telp'),
            'alamat' => $this->put('alamat')
        ];
        if ($this->Supplier->updateSupplier($data, $id) > 0) {
            $this->response([
                'status' => true,
                'data' => 'new Supplier has been updated'
            ], REST_Controller::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'data' => 'failed to update data !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

/* End of file Supplier.php */
