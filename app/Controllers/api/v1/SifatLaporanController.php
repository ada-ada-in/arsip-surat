<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\SifatLaporanServices;

class SifatLaporanController extends ResourceController {

    protected $sifatLaporanServices;

    public function __construct()
    {
        $this->sifatLaporanServices = new SifatLaporanServices();
    }

    public function addSifatLaporan()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'error' => 'No data received.',
                    'debug' => $this->request->getBody()
                ]);
            }

            $result = $this->sifatLaporanServices->addSifatLaporanServices($data);

            if ($result['status'] == false) {
                return $this->fail($result['errors']);
            }

            return $this->respondCreated([
                'data' => $data,
                'message' => $result['message']
            ]);

        } catch (\Exception $e) {
            return $this->fail([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteSifatLaporan($id)
    {
        try {
            $deletedData = $this->sifatLaporanServices->deleteDataSifatLaporanByIdServices($id);

            return $this->respondDeleted([
                'status'  => true,
                'data'    => $deletedData,
                'message' => 'Data deleted successfully'
            ]);

        } catch (\Exception $e) {
            return $this->fail([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getSifatLaporanData()
    {
        try {
            $data = $this->sifatLaporanServices->getSifatLaporanDataServices();

            return $this->respond([
                'data' => $data,
                'message' => 'Data retrieved successfully'
            ], 200);

        } catch (\Exception $e) {
            return $this->fail([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getSifatLaporanById($id)
    {
        try {
            $data = $this->sifatLaporanServices->getDataSifatLaporanByIdServices($id);

            return $this->respond([
                'status'  => true,
                'data'    => $data,
                'message' => 'Data retrieved successfully'
            ], 200);

        } catch (\Exception $e) {
            return $this->fail([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateSifatLaporanById($id)
    {
        try {
            $data = $this->request->getJSON(true);

            if (!$data || empty($data)) {
                return $this->fail([
                    'status'  => false,
                    'message' => 'No data provided for update'
                ], 400);
            }

            $updatedData = $this->sifatLaporanServices->updateDataBySifatLaporanIdServices($id, $data);

            return $this->respondUpdated([
                'status'  => true,
                'data'    => $updatedData,
                'message' => 'Data updated successfully'
            ]);

        } catch (\Exception $e) {
            return $this->fail([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}