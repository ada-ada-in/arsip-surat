<?php
namespace App\Services;

use App\Models\SifatLaporanModels;

class SifatLaporanServices {
    protected $sifatLaporanModel;

    public function __construct()
    {
        $this->sifatLaporanModel = new SifatLaporanModels();
    }

    public function addSifatLaporanServices(array $data)
    {
        $rules = [
            'nama_sifat' => [
                'label' => 'Nama Sifat',
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

        $this->sifatLaporanModel->insert([
            'nama_sifat' => $data['nama_sifat']
        ]);

        return [
            'status' => true,
            'message' => 'Sifat laporan berhasil ditambahkan'
        ];
    }

    public function deleteDataSifatLaporanByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->sifatLaporanModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Sifat laporan tidak ditemukan'
            ];
        }

        $this->sifatLaporanModel->delete($id);

        return [
            'status' => true,
            'message' => 'Sifat laporan berhasil dihapus'
        ];
    }

    public function getSifatLaporanDataServices()
    {
        $data = $this->sifatLaporanModel->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data Sifat Laporan Kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataSifatLaporanByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->sifatLaporanModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Sifat laporan tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataBySifatLaporanIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->sifatLaporanModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'nama_sifat' => [
                'label' => 'Nama Sifat',
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

        $updateData = [
            'nama_sifat' => $data['nama_sifat'] ?? $existingData['nama_sifat'],
        ];

        $this->sifatLaporanModel->update($id, $updateData);

        $updatedData = $this->sifatLaporanModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}
?>