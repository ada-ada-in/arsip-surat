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
            'dari' => [
                'label' => 'Dari',
                'rules' => 'required'
            ],
            'nomor_agenda' => [
                'label' => 'Nomor Agenda',
                'rules' => 'required'
            ],
            'link_surat' => [
                'label' => 'Link Surat',
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
        ->join('disposisi_kepada', 'disposisi_kepada.id = surat.id_disposisi_kepada', 'left')
        ->join('disposisi_petunjuk', 'disposisi_petunjuk.id = surat.id_disposisi_petunjuk', 'left')
        ->where('is_completed', '0')
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


    public function getAllSuratDataServices()
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


        public function getAllSuratDataUserServices($id)
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
        ->where('surat.id_user', $id)
        ->where('tipe_surat', 'masuk')
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

        public function getAllSuratKeluarDataUserServices($id)
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
        ->where('surat.id_user', $id)
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

    public function countSuratServices(){

        $data = $this->suratmodel->countAllResults();

        if(empty($data)){
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

    public function countSuratMasukServices(){
        
        $data = $this->suratmodel->where('tipe_surat', 'masuk')->countAllResults();

        if(empty($data)){
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

    public function countSuratKeluarServices(){
        
        $data = $this->suratmodel->where('tipe_surat', 'keluar')->countAllResults();

        if(empty($data)){
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

    public function countUserSuratServices(){
        $data = $this->suratmodel
        ->where('is_completed', '1')
        ->where('id_user', session()->get('id'))
        ->countAllResults();

        if(empty($data)){
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
    
    public function countUserSuratMasukServices(){
        
        $data = $this->suratmodel
        ->where('tipe_surat', 'masuk')
        ->where('id_user', session()->get('id'))
        ->countAllResults();

        if(empty($data)){
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

    public function countUserSuratKeluarServices(){
        
        $data = $this->suratmodel
        ->where('tipe_surat', 'keluar')
        ->where('id_user', session()->get('id'))
        ->countAllResults();

        if(empty($data)){
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
    
    public function getSuratArsipDataServices()
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
        ->where('is_completed', '1')
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

    public function getSuratArsipUserDataServices($id)
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
        ->where('is_completed', '1')
        ->where('surat.id_user', $id)
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

    public function getSuratNotificationDataServices()
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
        ->limit(6)
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
        ->where('surat.id', $id)
        ->orderBy('created_at', 'DESC')->first();

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


        $this->suratmodel->update($id, $data);

        $updatedData = $this->suratmodel->find($id);

        if (!$updatedData) {
        return [
            'status' => false,
            'message' => 'Failed to update data.'
        ];
}

        return [
            'status' => true,
            'data' => $updatedData
        ];
    }
}