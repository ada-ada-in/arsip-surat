<?php
namespace App\Services;

use App\Models\UserModels;

class AuthServices {
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new UserModels();
    }

    public function loginServices(array $data)
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (empty($email) || empty($password)) {
            return [
                'status'  => false,
                'message' => 'Email or password cannot be empty'
            ];
        }

        $user = $this->authModel->where('email', $email)->first();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'User not found'
            ];
        }

        if (password_verify($password, $user['password'])) {
            session()->set([
                'id' => $user['id'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);

            return [
                'status'  => true,
                'message' => 'Login successful',
                'data' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ]
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Email or password incorrect'
            ];
        }
    }

    public function logoutServices()
    {
        session()->destroy();

        return [
            'status' => true,
            'message' => 'Logout successful'
        ];
    }
}