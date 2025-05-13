<?php
namespace App\Services;

use App\Models\DisposisiKepadaModels;

class DisposisiKepadaServices {
    protected $disposisiKepadaModel;

    public function __construct()
    {
        $this->disposisiKepadaModel = new DisposisiKepadaModels();
    }

    public function addDisposisiKepadaServices(array $data)
    {
        $rules = [
            'nama_disposisi_kepada' => [
                'label' => 'Nama Disposisi',
                'rules' => 'required'
            ],
            'nama_kordinator' => [
                'label' => 'Nama Kordinator',
                'rules' => 'required'
            ],
            'nip' => [
                'label' => 'NIP',
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

        $this->disposisiKepadaModel->insert([
            'nama_disposisi_kepada' => $data['nama_disposisi_kepada'],
            'nama_kordinator' => $data['nama_kordinator'],
            'nip' => $data['nip']
        ]);

        return [
            'status' => true,
            'message' => 'Disposisi kepada berhasil ditambahkan'
        ];
    }

    public function deleteDataDisposisiKepadaByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->disposisiKepadaModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Disposisi kepada tidak ditemukan'
            ];
        }

        $this->disposisiKepadaModel->delete($id);

        return [
            'status' => true,
            'message' => 'Disposisi kepada berhasil dihapus'
        ];
    }

    public function getDisposisiKepadaDataServices()
    {
        $data = $this->disposisiKepadaModel->orderBy('created_at', 'DESC')->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data Disposisi Kepada Kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataDisposisiKepadaByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->disposisiKepadaModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Disposisi kepada tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataByDisposisiKepadaIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->disposisiKepadaModel->find($id);
        if (!$existingData) {
            return [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $rules = [
            'nama_disposisi_kepada' => [
                'label' => 'Nama Disposisi',
                'rules' => 'required'
            ],
            'nama_kordinator' => [
                'label' => 'Nama Kordinator',
                'rules' => 'required'
            ],
            'nip' => [
                'label' => 'NIP',
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
            'nama_disposisi_kepada' => $data['nama_disposisi_kepada'] ?? $existingData['nama_disposisi_kepada'],
            'nama_kordinator' => $data['nama_kordinator'] ?? $existingData['nama_kordinator'],
            'nip' => $data['nip'] ?? $existingData['nip']
        ];

        $this->disposisiKepadaModel->update($id, $updateData);

        $updatedData = $this->disposisiKepadaModel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}