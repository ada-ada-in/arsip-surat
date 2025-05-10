<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\SuratMasukServices;

class SuratMasukController extends ResourceController
{
    protected $suratMasukServices;

    public function __construct()
    {
        $this->suratMasukServices = new SuratMasukServices();
    }

    public function addSuratMasuk()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data received.'
                ], 400);
            }

            $result = $this->suratMasukServices->addSuratMasukServices($data);

            if (!$result['status']) {
                return $this->fail($result['errors'], 400);
            }

            return $this->respondCreated([
                'status' => true,
                'message' => $result['message']
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function deleteSuratMasuk($id)
    {
        try {
            $result = $this->suratMasukServices->deleteDataSuratMasukByIdServices($id);

            if (!$result['status']) {
                return $this->fail($result['message'], 404);
            }

            return $this->respondDeleted([
                'status' => true,
                'message' => $result['message']
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratMasukData()
    {
        try {
            $result = $this->suratMasukServices->getSuratMasukDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratMasukById($id)
    {
        try {
            $result = $this->suratMasukServices->getDataSuratMasukByIdServices($id);

            if (!$result['status']) {
                return $this->fail($result['message'], 404);
            }

            return $this->respond([
                'status' => true,
                'data' => $result['data'],
                'message' => 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function updateSuratMasukById($id)
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data provided for update.'
                ], 400);
            }

            $result = $this->suratMasukServices->updateDataBySuratMasukIdServices($id, $data);

            if (!$result['status']) {
                return $this->fail($result['errors'], 400);
            }

            return $this->respondUpdated([
                'status' => true,
                'data' => $result['data'],
                'message' => 'Data updated successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}