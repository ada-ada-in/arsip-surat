<?php
namespace App\Services;

use App\Models\StatusLaporanModels;

class StatusLaporanServices {
    protected $statusLaporanModel;

    public function __construct()
    {
        $this->statusLaporanModel = new StatusLaporanModels();
    }

    public function addStatusLaporanServices(array $data)
    {
        $rules = [
            'nama_status_laporan' => [
                'label' => 'Nama Status',
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

        $this->statusLaporanModel->insert([
            'nama_status_laporan' => $data['nama_status_laporan']
        ]);

        return [
            'status' => true,
            'message' => 'Status laporan berhasil ditambahkan'
        ];
    }

    public function deleteDataStatusLaporanByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->statusLaporanModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Status laporan tidak ditemukan'
            ];
        }

        $this->statusLaporanModel->delete($id);

        return [
            'status' => true,
            'message' => 'Status laporan berhasil dihapus'
        ];
    }

    public function getStatusLaporanDataServices()
    {
        $data = $this->statusLaporanModel->orderBy('created_at', 'DESC')->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data Status Laporan Kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataStatusLaporanByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->statusLaporanModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Status laporan tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataByStatusLaporanIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->statusLaporanModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'nama_status_laporan' => [
                'label' => 'Nama Status',
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
            'nama_status_laporan' => $data['nama_status_laporan'] ?? $existingData['nama_status_laporan'],
        ];

        $this->statusLaporanModel->update($id, $updateData);

        $updatedData = $this->statusLaporanModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}