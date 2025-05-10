<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\UserServices;

class UserController extends ResourceController
{
    protected $userServices;

    public function __construct()
    {
        $this->userServices = new UserServices();
    }

    public function addUser()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data received.'
                ], 400);
            }

            $result = $this->userServices->addUserServices($data);

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

    public function deleteUser($id)
    {
        try {
            $result = $this->userServices->deleteUserByIdServices($id);

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

    public function getUserData()
    {
        try {
            $result = $this->userServices->getUserDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getUserById($id)
    {
        try {
            $result = $this->userServices->getUserByIdServices($id);

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

    public function updateUserById($id)
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data provided for update.'
                ], 400);
            }

            $result = $this->userServices->updateUserByIdServices($id, $data);

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