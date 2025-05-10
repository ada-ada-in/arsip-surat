<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\DisposisiPetunjukServices;

class DisposisiPetunjukController extends ResourceController
{
    protected $disposisiPetunjukServices;

    public function __construct()
    {
        $this->disposisiPetunjukServices = new DisposisiPetunjukServices();
    }

    public function addDisposisiPetunjuk()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data received.'
                ], 400);
            }

            $result = $this->disposisiPetunjukServices->addDisposisiPetunjukServices($data);

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

    public function deleteDisposisiPetunjuk($id)
    {
        try {
            $result = $this->disposisiPetunjukServices->deleteDataDisposisiPetunjukByIdServices($id);

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

    public function getDisposisiPetunjukData()
    {
        try {
            $result = $this->disposisiPetunjukServices->getDisposisiPetunjukDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getDisposisiPetunjukById($id)
    {
        try {
            $result = $this->disposisiPetunjukServices->getDataDisposisiPetunjukByIdServices($id);

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

    public function updateDisposisiPetunjukById($id)
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data provided for update.'
                ], 400);
            }

            $result = $this->disposisiPetunjukServices->updateDataByDisposisiPetunjukIdServices($id, $data);

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