<?php

namespace App\Controllers;

class Notices extends BaseController
{
    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index(){
        
        return View('notices/index');
    }

    public function noticias()
    {
        //$data['pageTitle'] = 'Releases List';
        $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
        $data = [
            'title' => 'Noticias',
            'userInfo' => $userInfo
        ];
        return view('adm/module_notice/index', $data);
    }

    public function addNotice()
    {
        $noticeModel = model('NoticeModel');
        $validation = service('validation');
        $this->validate([
            'notice_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese el título de la Noticia!!'
                ]
            ],
            'notice_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese una descripción!!'
                ]
            ],
            'notice_image' => [
                'rules' => 'uploaded[notice_image]|mime_in[notice_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[notice_image,4096]',
                'errors' => [
                    /*'required' => 'Seleccione la fecha de caducidad!'*/
                    'uploaded[notice_image]' => 'Suba una imagen',
                    'mime_in[notice_image,image/jpg,image/jpeg,image/gif,image/png]' => 'Seleccione un formato de imagen correcto',
                    'max_size[notice_image,4096]' => 'Error, imagen pesa mas de 4096Kb'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            // Grab the file by name given in HTML form
            $file = $this->request->getFile('notice_image');
            // Generate a new secure name
            $name = $file->getRandomName();
            // Move the file to the directory
            $file->move('uploads', $name);

            $data = [
                'UserID' => 1,
                'Notice_title' => $this->request->getPost('notice_title'),
                'Notice_description' => $this->request->getPost('notice_description'),
                'Notice_image' => $name
            ];
            $query = $noticeModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'New has been saved to database']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function getAllNotices()
    {
        //DB Details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
            'charset' => 'utf8' //se agego esta opcionen el SSP.php archivo
        );

        //$table = "release";
        $table = <<<EOT
        (
           SELECT 
             a.NoticeID, 
             a.Notice_title, 
             a.Notice_description,
             a.Notice_image,
             a.created_at,
             a.deleted_at,
             CONCAT_WS(' ', b.User_name, b.User_lastname_01) AS User_name
           FROM `notice` a
           LEFT JOIN user b ON a.UserID = b.UserID
        ) temp
       EOT;
        $primaryKey = "NoticeID";

        $columns = array(
            array(
                "db" => "NoticeID",
                "dt" => 0,
            ),
            array(
                "db" => "Notice_title",
                "dt" => 1,
            ),
            array(
                "db" => "Notice_description",
                "dt" => 2,
                "formatter" => function ($d, $row) {
                    return substr($d, 0, 10) . '...';
                }
            ),
            array(
                "db" => "created_at",
                "dt" => 3,
                "formatter" => function ($d, $row) {
                    $timestamp = strtotime($row['created_at']); //Convierte string a time
                    $new_date = date("d-m-Y H:i:s", $timestamp); //formatea la fecha y retorna
                    return $new_date;
                }
            ),
            array(
                "db" => "User_name",
                "dt" => 4,
            ),
            array(
                "db" => "Notice_image",
                "dt" => 5,
                "formatter" => function ($d, $row) {
                    return "<img class='zoom' src='" . base_url('uploads/' . $d) . "' style='height:50px;width:50px;align:middle;'/>";
                }
            ),
            array(
                "db" => "NoticeID",
                "dt" => 6,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                <button class='btn btn-sm btn-secondary' data-id='" . $row['NoticeID'] . "' id='previewNoticeBtn'>Ver</button>  
                                <button class='btn btn-sm btn-primary' data-id='" . $row['NoticeID'] . "' id='updateNoticeBtn'>Editar</button>
                                <button class='btn btn-sm btn-danger' data-id='" . $row['NoticeID'] . "' id='deleteNoticeBtn'>Quitar</button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            //\SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
            \SSP::complex($_GET, $dbDetails, $table, $primaryKey, $columns, null, $whereAll = "deleted_at IS NULL")
        );
    }


    public function getNoticeInfo()
    {
        $noticeModel = model('NoticeModel');
        $notice_id = $this->request->getPost('notice_id');
        //var_dump($release_id);
        // $releaseModel->
        $info = $noticeModel->find($notice_id);
        //var_dump($info);

        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }
    }

    public function updateNotice()
    {
        $eventModel = model('NoticeModel');
        $validation = \Config\Services::validation();
        $nid = $this->request->getPost('nid');

        $this->validate([
            'notice_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Título del evento es requerido'
                ]
            ],
            'notice_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingese una descripción'
                ]
            ]

        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            if ($this->request->getFile('notice_image')) {
                // Grab the file by name given in HTML form
                $file = $this->request->getFile('notice_image');
                // Generate a new secure name
                $name = $file->getRandomName();
                // Move the file to the directory
                $file->move('uploads', $name);

                $data = [
                    'Notice_title' => $this->request->getPost('notice_title'),
                    'Notice_description' => $this->request->getPost('notice_description'),
                    'Notice_image' => $name
                ];
                $query = $eventModel->update($nid, $data);

                if ($query) {
                    echo json_encode(['code' => 1, 'msg' => 'Notice info have been updated successfully']);
                } else {
                    echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
                }
            }else{
                $data = [
                    'Notice_title' => $this->request->getPost('notice_title'),
                    'Notice_description' => $this->request->getPost('notice_description')
                ];
                $query = $eventModel->update($nid, $data);
    
                if ($query) {
                    echo json_encode(['code' => 1, 'msg' => 'Notice info have been updated successfully']);
                } else {
                    echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
                } 
            }
        }
    }

    public function deleteNotice()
    {
        $noticeModel = model('NoticeModel');
        $notice_id = $this->request->getPost('notice_id');
        $query = $noticeModel->delete($notice_id);

        if ($query) {
            echo json_encode(['code' => 1, 'msg' => 'Notice deleted Successfully']);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    //FETCH EVENTS STATIC VIEW ROUTE '/noticeos'
    public function fetchNotices() {
        $noticeModel = model('NoticeModel');
        $notices = $noticeModel->findAll();
        $data = '';

        if ($notices) {
            foreach ($notices as $notice) {
                $data .= '<div class="col">
                <a href="#" id="' . $notice['NoticeID'] . '" class="notice_link">
                    <div class="card h-100 card-border shadow">
                        
                            <img src="uploads/' . $notice['Notice_image'] . '" class="img-fluid card-img-top">
                        
                        <div class="card-body">
                            <h6 class="card-title">' . $notice['Notice_title'] . '</h6>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <small class="text-muted">Publicado: ' . date('d-m-Y', strtotime($notice['created_at'])) . '</small>
                        </div>
                    </div>
                </a>
            </div>';
            }
            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => false,
                'message' => '<div class="text-secondary text-center fw-bold my-5">No posts found in the database!</div>'
            ]);
        }
    }

    // handle fetch post detail ajax request
    public function getNotice($id = null) {
        $noticeModel = model('NoticeModel');
        $notice = $noticeModel->find($id);
        //return var_dump($notice);
        
        return $this->response->setJSON([
            'error' => false,
            'message' => $notice
        ]);
    }

    //Ultimo Notice
    public function getNoticeLast()
    {
        $db = db_connect();
            $info= $db->query("Select * from `notice`
            WHERE created_at  = (
                SELECT MAX(created_at)
                FROM dbescuela.`notice`
                LIMIT 1
            )")->getRow();
        
            return $this->response->setJSON([
                'error' => false,
                'message' => $info
            ]);
    }
}
