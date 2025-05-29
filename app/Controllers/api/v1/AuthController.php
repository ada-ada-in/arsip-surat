<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\AuthServices;

class AuthController extends ResourceController
{
    protected $authServices;

    public function __construct()
    {
        $this->authServices = new AuthServices();
    }

    public function login()
    {
        try {
            $data = $this->request->getJSON(true);

            if (empty($data)) {
                return $this->fail([
                    'status' => false,
                    'message' => 'No data received.'
                ], 400);
            }

            $result = $this->authServices->loginServices($data);

            if (!$result['status']) {
                return $this->fail([
                    'status' => false,
                    'message' => $result['message']
                ], 401);
            }

            return $this->respond([
                'status' => true,
                'message' => $result['message'],
                'data' => $result['data'],
                'role' => $result['data']['role'] ?? null,
                'id' => $result['data']['id'] ?? null,
                'name' => $result['data']['name'] ?? null

            ], 200);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            $result = $this->authServices->logoutServices();

            return $this->respond([
                'status' => true,
                'message' => $result['message']
            ], 200);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}