<?php
namespace App\Services;

use App\Models\SuratModels;

class SuratServices {
    protected $suratmodel;

    public function __construct()
    {
        $this->suratmodel = new SuratModels();
    }

    public function addSuratServices(array $data)
    {
        $rules = [
            'nomor_surat' => [
                'label' => 'Nomor Surat',
                'rules' => 'required'
            ],
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required'
            ],
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required'
            ],
            'dibuat_oleh' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required'
            ],
            'dari' => [
                'label' => 'Dari',
                'rules' => 'required'
            ],
            'nomor_agenda' => [
                'label' => 'Nomor Agenda',
                'rules' => 'required'
            ],
            'tipe_surat' => [
                'label' => 'Tipe Surat',
                'rules' => 'required|in_list[masuk, keluar]'
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

        $this->suratmodel->insert($data);

        return [
            'status' => true,
            'message' => 'Surat  berhasil ditambahkan'
        ];
    }

    public function deleteDataSuratByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->suratmodel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Surat  tidak ditemukan'
            ];
        }

        $this->suratmodel->delete($id);

        return [
            'status' => true,
            'message' => 'Surat  berhasil dihapus'
        ];
    }

    public function getSuratDataServices()
    {
        $data = $this->suratmodel
        ->select(
            'surat.*, users.name as user_name, 
            users.email as user_email,
            jenis_laporan.nama_jenis_laporan as nama_jenis_laporan, 
            sifat_laporan.nama_sifat_laporan as nama_sifat_laporan, 
            status_laporan.nama_status_laporan as nama_status_laporan, 
            disposisi_kepada.nama_disposisi_kepada as nama_disposisi_kepada, 
            disposisi_petunjuk.nama_disposisi_petunjuk as nama_disposisi_petunjuk')
        ->join('users', 'users.id = surat.id_user')
        ->join('jenis_laporan', 'jenis_laporan.id = surat.id_jenis')
        ->join('sifat_laporan', 'sifat_laporan.id = surat.id_sifat')
        ->join('status_laporan', 'status_laporan.id = surat.id_status')
        ->join('disposisi_kepada', 'disposisi_kepada.id = surat.id_disposisi_kepada')
        ->join('disposisi_petunjuk', 'disposisi_petunjuk.id = surat.id_disposisi_petunjuk')
        ->orderBy('created_at', 'DESC')->findAll();

        if (empty($data)) {
            return [
                'status' => true,   
                'message' => 'Data surat  kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getSuratMasukDataServices()
    {
        $data = $this->suratmodel
        ->select(
            'surat.*, users.name as user_name, 
            users.email as user_email,
            jenis_laporan.nama_jenis_laporan as nama_jenis_laporan, 
            sifat_laporan.nama_sifat_laporan as nama_sifat_laporan, 
            status_laporan.nama_status_laporan as nama_status_laporan, 
            disposisi_kepada.nama_disposisi_kepada as nama_disposisi_kepada, 
            disposisi_petunjuk.nama_disposisi_petunjuk as nama_disposisi_petunjuk')
        ->join('users', 'users.id = surat.id_user')
        ->join('jenis_laporan', 'jenis_laporan.id = surat.id_jenis')
        ->join('sifat_laporan', 'sifat_laporan.id = surat.id_sifat')
        ->join('status_laporan', 'status_laporan.id = surat.id_status')
        ->join('disposisi_kepada', 'disposisi_kepada.id = surat.id_disposisi_kepada', 'left')
        ->join('disposisi_petunjuk', 'disposisi_petunjuk.id = surat.id_disposisi_petunjuk', 'left')
        ->orderBy('created_at', 'DESC')
         ->where('tipe_surat', 'masuk')->findAll();

        if (empty($data)) {
            return [
                'status' => true,   
                'message' => 'Data surat  kosong', 
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

        public function getSuratKeluarkDataServices()
    {
        $data = $this->suratmodel
        ->select(
            'surat.*, users.name as user_name, 
            users.email as user_email,
            jenis_laporan.nama_jenis_laporan as nama_jenis_laporan, 
            sifat_laporan.nama_sifat_laporan as nama_sifat_laporan, 
            status_laporan.nama_status_laporan as nama_status_laporan, 
            disposisi_kepada.nama_disposisi_kepada as nama_disposisi_kepada, 
            disposisi_petunjuk.nama_disposisi_petunjuk as nama_disposisi_petunjuk')
        ->join('users', 'users.id = surat.id_user')
        ->join('jenis_laporan', 'jenis_laporan.id = surat.id_jenis')
        ->join('sifat_laporan', 'sifat_laporan.id = surat.id_sifat')
        ->join('status_laporan', 'status_laporan.id = surat.id_status')
        ->join('disposisi_kepada', 'disposisi_kepada.id = surat.id_disposisi_kepada', 'left')
        ->join('disposisi_petunjuk', 'disposisi_petunjuk.id = surat.id_disposisi_petunjuk', 'left')
        ->where('tipe_surat', 'keluar')
        ->orderBy('created_at', 'DESC')->findAll();

        if (empty($data)) {
            return [
                'status' => true,   
                'message' => 'Data surat  kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function getDataSuratByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->suratmodel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'Surat  tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateDataBySuratIdServices($id, array $data)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $existingData = $this->suratmodel->find($id);
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

        $this->suratmodel->update($id, $data);

        $updatedData = $this->suratmodel->find($id);

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}