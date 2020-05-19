<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Jenis extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_Model', 'Jenis');
    }

    public function index_get()
    {
        $id = $this->get('id_jenis');
        if ($id === null) {
            $Jenis = $this->Jenis->getJenis();
        } else {
            $Jenis = $this->Jenis->getJenis($id);
        }
        if ($Jenis) {
            $this->response([
                'status' => true,
                'data' => $Jenis
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
        $id = $this->delete('id_jenis');

        if ($id === null) {
            $this->response([
                'status' => false,
                'data' => 'provide an id !'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->Jenis->deleteJenis($id) > 0) {
                # ok
                $this->response([
                    'status' => true,
                    'Jenis_id' => $id,
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
            'id_jenis' => $this->post('id_jenis'),
            'nama_jenis' => $this->post('nama_jenis')
        ];
        if ($this->Jenis->createJenis($data) > 0) {
            $this->response([
                'status' => true,
                'data' => 'new Jenis has been created'
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
        $id = $this->put('id_jenis');
        $data = [
            'id_jenis' => $this->put('id_jenis'),
            'nama_jenis' => $this->put('nama_jenis')
        ];
        if ($this->Jenis->updateJenis($data, $id) > 0) {
            $this->response([
                'status' => true,
                'data' => 'new Jenis has been updated'
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

/* End of file Jenis.php */
