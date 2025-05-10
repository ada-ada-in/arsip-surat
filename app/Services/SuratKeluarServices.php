<?php
namespace App\Services;

use App\Models\SuratKeluarkModels;

class SuratKeluarServices {
    protected $suratKeluarModel;

    public function __construct()
    {
        $this->suratKeluarModel = new SuratKeluarkModels();
    }

    public function addSuratKeluarServices(array $data)
    {
        $rules = [
            'nomor_surat' => [
                'label' => 'Nomor Surat',
                'rules' => 'required'
            ],
            'tanggal_surat' => [
                'label' => 'Tanggal Surat',
                'rules' => 'required|valid_date'
            ],
            'tujuan' => [
                'label' => 'Tujuan',
                'rules' => 'required'
            ],
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required'
            ],
            'dibuat_oleh' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required'
            ]
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($data)) {
            return [
                'status' => false,
                'errors' => $validation->getErrors()
            ];
        }

        $this->suratKeluarModel->insert($data);

        return [
            'status' => true,
            'message' => 'Surat keluar berhasil ditambahkan'
        ];
    }

    public function deleteDataSuratKeluarByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->suratKeluarModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Surat keluar tidak ditemukan'
            ];
        }

        $this->suratKeluarModel->delete($id);

        return [
            'status' => true,
            'message' => 'Surat keluar berhasil dihapus'
        ];
    }

    public function getSuratKeluarDataServices()
    {
        $data = $this->suratKeluarModel->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data surat keluar kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataSuratKeluarByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->suratKeluarModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Surat keluar tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataBySuratKeluarIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->suratKeluarModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'nomor_surat' => [
                'label' => 'Nomor Surat',
                'rules' => 'required'
            ],
            'tanggal_surat' => [
                'label' => 'Tanggal Surat',
                'rules' => 'required|valid_date'
            ],
            'tujuan' => [
                'label' => 'Tujuan',
                'rules' => 'required'
            ],
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required'
            ],
            'dibuat_oleh' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required'
            ]
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($data)) {
            return [
                'status' => false,
                'errors' => $validation->getErrors()
            ];
        }

        $this->suratKeluarModel->update($id, $data);

        $updatedData = $this->suratKeluarModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}