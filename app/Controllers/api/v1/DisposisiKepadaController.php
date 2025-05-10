<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\DisposisiKepadaServices;

class DisposisiKepadaController extends ResourceController
{
    protected $disposisiKepadaServices;

    public function __construct()
    {
        $this->disposisiKepadaServices = new DisposisiKepadaServices();
    }

    public function addDisposisiKepada()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data received.'
                ], 400);
            }

            $result = $this->disposisiKepadaServices->addDisposisiKepadaServices($data);

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

    public function deleteDisposisiKepada($id)
    {
        try {
            $result = $this->disposisiKepadaServices->deleteDataDisposisiKepadaByIdServices($id);

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

    public function getDisposisiKepadaData()
    {
        try {
            $result = $this->disposisiKepadaServices->getDisposisiKepadaDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getDisposisiKepadaById($id)
    {
        try {
            $result = $this->disposisiKepadaServices->getDataDisposisiKepadaByIdServices($id);

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

    public function updateDisposisiKepadaById($id)
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data provided for update.'
                ], 400);
            }

            $result = $this->disposisiKepadaServices->updateDataByDisposisiKepadaIdServices($id, $data);

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