<?php
namespace App\Services;

use App\Models\DisposisiPetunjukModels;

class DisposisiPetunjukServices {
    protected $disposisiPetunjukModel;

    public function __construct()
    {
        $this->disposisiPetunjukModel = new DisposisiPetunjukModels();
    }

    public function addDisposisiPetunjukServices(array $data)
    {
        $rules = [
            'nama_disposisi_petunjuk' => [
                'label' => 'Nama Petunjuk',
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

        $this->disposisiPetunjukModel->insert([
            'nama_disposisi_petunjuk' => $data['nama_disposisi_petunjuk']
        ]);

        return [
            'status' => true,
            'message' => 'Disposisi petunjuk berhasil ditambahkan'
        ];
    }

    public function deleteDataDisposisiPetunjukByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->disposisiPetunjukModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Disposisi petunjuk tidak ditemukan'
            ];
        }

        $this->disposisiPetunjukModel->delete($id);

        return [
            'status' => true,
            'message' => 'Disposisi petunjuk berhasil dihapus'
        ];
    }

    public function getDisposisiPetunjukDataServices()
    {
        $data = $this->disposisiPetunjukModel->orderBy('created_at', 'DESC')->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data Disposisi Petunjuk Kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataDisposisiPetunjukByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->disposisiPetunjukModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Disposisi petunjuk tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataByDisposisiPetunjukIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->disposisiPetunjukModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'nama_disposisi_petunjuk' => [
                'label' => 'Nama Petunjuk',
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
            'nama_disposisi_petunjuk' => $data['nama_disposisi_petunjuk'] ?? $existingData['nama_disposisi_petunjuk'],
        ];

        $this->disposisiPetunjukModel->update($id, $updateData);

        $updatedData = $this->disposisiPetunjukModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}