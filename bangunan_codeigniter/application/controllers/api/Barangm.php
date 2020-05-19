<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Barangm extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barangm_Model', 'Barangm');
    }

    public function index_get()
    {
        $id = $this->get('id_barang_masuk');
        if ($id === null) {
            $Barangm = $this->Barangm->getBarangm();
        } else {
            $Barangm = $this->Barangm->getBarangm($id);
        }
        if ($Barangm) {
            $this->response([
                'status' => true,
                'data' => $Barangm
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
        $id = $this->delete('id_barang_masuk');

        if ($id === null) {
            $this->response([
                'status' => false,
                'data' => 'provide an id !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Barangm->deleteBarangm($id) > 0) {
                # ok
                $this->response([
                    'status' => true,
                    'Barangm_id' => $id,
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
            'id_barang_masuk' => $this->post('id_barang_masuk'),
            'supplier_id' => $this->post('supplier_id'),
            'user_id' => $this->post('user_id'),
            'barang_id' => $this->post('barang_id'),
            'jumlah_masuk' => $this->post('jumlah_masuk'),
            'tanggal_masuk' => $this->post('tanggal_masuk')
        ];
        if ($this->Barangm->createBarangm($data) > 0) {
            $this->response([
                'status' => true,
                'data' => 'new Barangm has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'data' => 'failed to create new data !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // public function index_put()
    // {
    //     $id = $this->put('id_barang_masuk');
    //     $data = [
    //         'id_barang_masuk' => $this->post('id_barang_masuk'),
    //         'supplier_id' => $this->post('supplier_id'),
    //         'user_id' => $this->post('user_id'),
    //         'barang_id' => $this->post('barang_id'),
    //         'jumlah_masuk' => $this->post('jumlah_masuk'),
    //         'tanggal_masuk' => $this->post('tanggal_masuk')
    //     ];
    //     if ($this->Barangm->updateBarangm($data, $id) > 0) {
    //         $this->response([
    //             'status' => true,
    //             'data' => 'new Barangm has been updated'
    //         ], REST_Controller::HTTP_CREATED);
    //     } else {
    //         //id not found
    //         $this->response([
    //             'status' => false,
    //             'data' => 'failed to update data !'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}

/* End of file Barangm.php */
