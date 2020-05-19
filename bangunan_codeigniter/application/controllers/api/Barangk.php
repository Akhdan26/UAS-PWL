<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Barangk extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barangk_Model', 'Barangk');
    }

    public function index_get()
    {
        $id = $this->get('id_barang_keluar');
        if ($id === null) {
            $Barangk = $this->Barangk->getBarangk();
        } else {
            $Barangk = $this->Barangk->getBarangk($id);
        }
        if ($Barangk) {
            $this->response([
                'status' => true,
                'data' => $Barangk
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
        $id = $this->delete('id_barang_keluar');

        if ($id === null) {
            $this->response([
                'status' => false,
                'data' => 'provide an id !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Barangk->deleteBarangk($id) > 0) {
                # ok
                $this->response([
                    'status' => true,
                    'Barangk_id' => $id,
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
            'id_barang_keluar' => $this->post('id_barang_keluar'),
            'user_id' => $this->post('user_id'),
            'barang_id' => $this->post('barang_id'),
            'jumlah_keluar' => $this->post('jumlah_keluar'),
            'tanggal_keluar' => $this->post('tanggal_keluar')
        ];
        if ($this->Barangk->createBarangk($data) > 0) {
            $this->response([
                'status' => true,
                'data' => 'new Barangk has been created'
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
    //     $id = $this->put('id_barang_keluar');
    //     $data = [
    //         'id_barang_keluar' => $this->post('id_barang_keluar'),
    //         'user_id' => $this->post('user_id'),
    //         'barang_id' => $this->post('barang_id'),
    //         'jumlah_keluar' => $this->post('jumlah_keluar'),
    //         'tanggal_keluar' => $this->post('tanggal_keluar')
    //     ];
    //     if ($this->Barangk->updateBarangk($data, $id) > 0) {
    //         $this->response([
    //             'status' => true,
    //             'data' => 'new Barangk has been updated'
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

/* End of file Barangk.php */
