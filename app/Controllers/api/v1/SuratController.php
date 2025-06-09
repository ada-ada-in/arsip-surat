<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use App\Services\SuratServices;

class SuratController extends ResourceController
{
    protected $suratServices;

    public function __construct()
    {
        $this->suratServices = new suratServices();
    }

    public function addSurat()
        {
            try {
                if (str_contains($this->request->getHeaderLine('Content-Type'), 'application/json')) {
                    $data = (array) $this->request->getJSON();
                } else {                                               
                    $data = $this->request->getPost();
                }

                if (empty($data)) {
                    return $this->fail(['status' => false, 'message' => 'No data received.'], 400);
                }

                $file = $this->request->getFile('link_surat');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $uploadPath = ROOTPATH . 'public/uploads/surat';
                    if (! is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);

                    $data['link_surat'] = 'uploads/surat/' . $newName;

                    
                }

                $result = $this->suratServices->addSuratServices($data); 

                if (!$result['status']) {
                    return $this->fail($result['errors'], 400);
                }

                return $this->respondCreated([
                    'status'  => true,
                    'message' => $result['message'],
                ]);

            } catch (\Throwable $e) {
                return $this->failServerError($e->getMessage());
            }
        }


    public function deleteSurat($id)
    {
        try {
            $result = $this->suratServices->deleteDataSuratByIdServices($id);

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

    public function getSuratData()
    {
        try {
            $result = $this->suratServices->getSuratDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratMasukData()
    {
        try {
            $result = $this->suratServices->getSuratMasukDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratMasukByUserData($id)
    {
        try {
            $result = $this->suratServices->getAllSuratDataUserServices($id);

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratKeluarByUserData($id)
    {
        try {
            $result = $this->suratServices->getAllSuratKeluarDataUserServices($id);

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function getSuratArsipData()
    {
        try {
            $result = $this->suratServices->getSuratArsipDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    
    }

        public function getSuratArsipUserData($id)
    {
        try {
            $result = $this->suratServices->getSuratArsipUserDataServices($id);

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    
    }


    public function getAllSuratArsipData()
    {
        try {
            $result = $this->suratServices->getAllSuratDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    
    }

    


    public function getSuratNotificationData()
    {
        try {
            $result = $this->suratServices->getSuratNotificationDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    
    }

    public function countSuratMasukArsipData()
    {
        try {
            $result = $this->suratServices->countSuratMasukServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function countSuratKeluarArsipData()
    {
        try {
            $result = $this->suratServices->countSuratKeluarServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }




    public function countUserSuratData()
    {
        try {
            $result = $this->suratServices->countUserSuratServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }



    public function countUserSuratMasukArsipData()
    {
        try {
            $result = $this->suratServices->countUserSuratMasukServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    public function countUserSuratKeluarArsipData()
    {
        try {
            $result = $this->suratServices->countUserSuratKeluarServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }


    

    public function countSuratData()
    {
        try {
            $result = $this->suratServices->countSuratServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }



        public function getSuratKeluarData()
    {
        try {
            $result = $this->suratServices->getSuratKeluarkDataServices();

            return $this->respond([
                'status' => true,
                'data' => $result['data'] ?? [],
                'message' => $result['message'] ?? 'Data retrieved successfully.'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }



    public function getSuratById($id)
    {
        try {
            $result = $this->suratServices->getDataSuratByIdServices($id);

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



       public function updateSuratById($id)
        {
            try {
                if (str_contains($this->request->getHeaderLine('Content-Type'), 'application/json')) {
                    $data = (array) $this->request->getJSON();
                } else {                                               
                    $data = $this->request->getPost();
                }

                if (empty($data)) {
                    return $this->fail(['status' => false, 'message' => 'No data received.'], 400);
                }


                $file = $this->request->getFile('link_surat');
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $uploadPath = ROOTPATH . 'public/uploads/surat';

                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);

                    $data['link_surat'] = 'uploads/surat/' . $newName;
                }

                $result = $this->suratServices->updateDataBySuratIdServices($id, $data);

                if (!$result['status']) {
                    return $this->fail([
                        'status' => false,
                        'message' => $result['message'] ?? 'Gagal mengupdate data.'
                    ], 400);
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