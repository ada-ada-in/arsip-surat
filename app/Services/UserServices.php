<?php
namespace App\Services;

use App\Models\UserModels;

class UserServices {
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModels();
    }

    public function addUserServices(array $data)
    {
        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|is_unique[users.name]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required|in_list[super_admin,admin,user]',
                'default' => 'user'
            ],
            'handphone' => [
                'label' => 'Handphone',
                'rules' => 'required|is_unique[users.handphone]'
            ],
            'is_active' => [
                'label' => 'Is Active',
                'rules' => 'required|in_list[0,1]'
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

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        unset($data['confirm_password']); 
        $this->userModel->insert($data);

        return [
            'status' => true,
            'message' => 'User berhasil ditambahkan'
        ];
    }

    public function deleteUserByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->userModel->find($id);
        if (!$data) {
            return [
                'status' => false,
                'message' => 'User tidak ditemukan'
            ];
        }

        $this->userModel->delete($id);

        return [
            'status' => true,
            'message' => 'User berhasil dihapus'
        ];
    }

    public function getUserDataServices()
    {
        $data = $this->userModel->findAll();

        if (empty($data)) {
            return [
                'status' => true,
                'message' => 'Data user kosong'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }



    public function getUserByIdServices($id)
    {
        if (!$id) {
            return [
                'status' => false,
                'message' => 'ID is required'
            ];
        }

        $data = $this->userModel->find($id);

        if (!$data) {
            return [
                'status' => false,
                'message' => 'User tidak ditemukan'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

public function updateUserByIdServices($id, array $data)
{
    if (!$id) {
        return [
            'status' => false,
            'message' => 'ID is required'
        ];
    }

    $existingData = $this->userModel->find($id);
    if (!$existingData) {
        return [
            'status' => false,
            'message' => 'User tidak ditemukan'
        ];
    }

    $rules = [
        'name' => [
            'label' => 'Name',
            'rules' => 'required|is_unique[users.name,id,' . $id . ']'
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[users.email,id,' . $id . ']'
        ],
        'handphone' => [
            'label' => 'Handphone',
            'rules' => 'required|is_unique[users.handphone,id,' . $id . ']'
        ],
        'role' => [
            'label' => 'Role',
            'rules' => 'required|in_list[super_admin,admin,user]'
        ]
    ];

    if (!empty($data['password'])) {
        $rules['password'] = [
            'label' => 'Password',
            'rules' => 'min_length[6]'
        ];
        $rules['confirm_password'] = [
            'label' => 'Confirm Password',
            'rules' => 'matches[password]'
        ];
    }

    $validation = \Config\Services::validation();
    $validation->setRules($rules);

    if (!$validation->run($data)) {
        return [
            'status' => false,
            'errors' => $validation->getErrors()
        ];
    }

    // Hash password and remove confirm_password
    if (!empty($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        unset($data['confirm_password']);
    }

    $this->userModel->update($id, $data);
    $updatedData = $this->userModel->find($id);

    return [
        'status' => true,
        'data' => $updatedData
    ];
}

}