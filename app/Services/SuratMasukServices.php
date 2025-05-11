<?php
namespace App\Services;

use App\Models\SuratMasukModels;

class SuratMasukServices {
    protected $suratMasukModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModels();
    }

    public function addSuratMasukServices(array $data)
    {
        $rules = [
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required'
            ],
            'nomor_surat' => [
                'label' => 'Nomor Surat',
                'rules' => 'required'
            ],
            'tanggal_surat' => [
                'label' => 'Tanggal Surat',
                'rules' => 'required|valid_date'
            ],
            'lampiran' => [
                'label' => 'Lampiran',
                'rules' => 'required'
            ],
            'dibuat_oleh' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required'
            ],
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($data)) {
            return [
                'status' => false,
                'errors' => $validation->getErrors()
            ];
        }

        $this->suratMasukModel->insert($data);

        return [
            'status' => true,
            'message' => 'Surat masuk berhasil ditambahkan'
        ];
    }

    public function deleteDataSuratMasukByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->suratMasukModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Surat masuk tidak ditemukan'
            ];
        }

        $this->suratMasukModel->delete($id);

        return [
            'status' => true,
            'message' => 'Surat masuk berhasil dihapus'
        ];
    }

    public function getSuratMasukDataServices()
    {
        $data = $this->suratMasukModel->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data surat masuk kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataSuratMasukByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->suratMasukModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Surat masuk tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataBySuratMasukIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->suratMasukModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required'
            ],
            'nomor_surat' => [
                'label' => 'Nomor Surat',
                'rules' => 'required'
            ],
            'tanggal_surat' => [
                'label' => 'Tanggal Surat',
                'rules' => 'required|valid_date'
            ],
            'lampiran' => [
                'label' => 'Lampiran',
                'rules' => 'required'
            ],
            'dibuat_oleh' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required'
            ],
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($data)) {
            return [
                'status' => false,
                'errors' => $validation->getErrors()
            ];
        }

        $this->suratMasukModel->update($id, $data);

        $updatedData = $this->suratMasukModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}