<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\SuratKeluarServices;

class SuratKeluarController extends ResourceController
{
    protected $suratKeluarServices;

    public function __construct()
    {
        $this->suratKeluarServices = new SuratKeluarServices();
    }

    public function addSuratKeluar()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data received.'
                ], 400);
            }

            $result = $this->suratKeluarServices->addSuratKeluarServices($data);

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

    public function deleteSuratKeluar($id)
    {
        try {
            $result = $this->suratKeluarServices->deleteDataSuratKeluarByIdServices($id);

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

    public function getSuratKeluarData()
    {
        try {
            $result = $this->suratKeluarServices->getSuratKeluarDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratKeluarById($id)
    {
        try {
            $result = $this->suratKeluarServices->getDataSuratKeluarByIdServices($id);

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

    public function updateSuratKeluarById($id)
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data provided for update.'
                ], 400);
            }

            $result = $this->suratKeluarServices->updateDataBySuratKeluarIdServices($id, $data);

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