<?php
namespace App\Services;

use App\Models\JenisLaporanModels;


class JenisLaporanServices {
    protected $jenisLaporanModel;

    public function __construct()
    {
        $this->jenisLaporanModel = new JenisLaporanModels();
    }

    public function addJenisLaporanServices(array $data)
    {
        $rules = [
            'nama_jenis_laporan' => [
                'label' => 'Nama Jenis',
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

        $this->jenisLaporanModel->insert([
            'nama_jenis_laporan' => $data['nama_jenis_laporan']
        ]);

        return [
            'status' => true,
            'message' => 'Jenis laporan berhasil ditambahkan'
        ];
    }

    public function deleteDataJenisLaporanByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->jenisLaporanModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Jenis laporan tidak ditemukan'
            ];
        }

        $this->jenisLaporanModel->delete($id);

        return [
            'status' => true,
            'message' => 'Jenis laporan berhasil dihapus'
        ];
    }

    public function getJenisLaporanDataServices()
    {
        $data = $this->jenisLaporanModel->orderBy('created_at', 'DESC')->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data Jenis Laporan Kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataJenisLaporanByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->jenisLaporanModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Jenis laporan tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataByJenisLaporanIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->jenisLaporanModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'nama_jenis_laporan' => [
                'label' => 'Nama Jenis',
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
            'nama_jenis_laporan' => $data['nama_jenis_laporan'] ?? $existingData['nama_jenis'],
        ];

        $this->jenisLaporanModel->update($id, $updateData);

        $updatedData = $this->jenisLaporanModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}
?>