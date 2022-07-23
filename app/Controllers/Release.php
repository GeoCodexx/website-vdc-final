<?php

namespace App\Controllers;

class Release extends BaseController
{

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function releases()
    {
        //$data['pageTitle'] = 'Releases List';
        $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
        $data = [
            'title' => 'Comunicados',
            'userInfo' => $userInfo
        ];
        return view('adm/module_release/index', $data);
    }

    public function addRelease()
    {
        $releaseModel = model('ReleaseModel');
        $validation = service('validation');
        $this->validate([
            'release_subject' => [
                'rules' => 'required|is_unique[release.Release_subject]',
                'errors' => [
                    'required' => 'Ingrese el asunto del Comunicado!!',
                    'is_unique' => 'This Rlease is already exists',
                ]
            ],
            'release_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese el contenido del Comunicado!!'
                ]
            ],
            'release_published_from' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione la fecha de publicación!'
                ]
            ],
            'release_published_to' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione la fecha de caducidad!'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            //$rp_from = $this->request->getPost('release_published_from').''
            //var_dump($this->request->getPost('release_published_from'));
            //Insert data into db
            /* $userModel = model('UserModel');
            $loggedUser = session()->get('loggedUser');
            $userInfo = $userModel->find($loggedUser);*/
            $date_from = date("Y-m-d H:i:s", strtotime($this->request->getPost('release_published_from') . ' 00:00:00'));
            $date_to = date("Y-m-d H:i:s", strtotime($this->request->getPost('release_published_to') . ' 23:59:59'));

            $data = [
                'UserID' => 1,
                'Release_subject' => $this->request->getPost('release_subject'),
                'Release_description' => $this->request->getPost('release_description'),
                'Release_published_from' => $date_from,
                'Release_published_to' => $date_to
            ];
            $query = $releaseModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'New Release has been saved to database']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function getAllReleases()
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
             a.ReleaseID, 
             a.Release_subject, 
             a.Release_published_from,
             a.Release_published_to,
             a.deleted_at,
             CONCAT_WS(' ', b.User_name, b.User_lastname_01) AS User_name
           FROM `release` a
           LEFT JOIN user b ON a.UserID = b.UserID
        ) temp
       EOT;
        $primaryKey = "ReleaseID";

        $columns = array(
            array(
                "db" => "ReleaseID",
                "dt" => 0,
            ),
            array(
                "db" => "Release_subject",
                "dt" => 1,
            ),
            array(
                "db" => "Release_published_from",
                "dt" => 2,
                "formatter" => function($d, $row){
                    $timestamp = strtotime($row['Release_published_from']);//Convierte string a time
                    $new_date = date("d-m-Y H:i:s", $timestamp); //formatea la fecha y retorna
                    return $new_date;
                }
            ),
            array(
                "db" => "Release_published_to",
                "dt" => 3,
                "formatter" => function($d, $row){
                    $timestamp = strtotime($row['Release_published_to']);
                    $new_date = date("d-m-Y H:i:s", $timestamp);
                    return $new_date;
                }
            ),
            array(
                "db" => "User_name",
                "dt" => 4,
            ),
            array(
                "db" => "ReleaseID",
                "dt" => 5,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                <button class='btn btn-sm btn-secondary' data-id='" . $row['ReleaseID'] . "' id='previewReleaseBtn'>Ver</button>  
                                <button class='btn btn-sm btn-primary' data-id='" . $row['ReleaseID'] . "' id='updateReleaseBtn'>Editar</button>
                                <button class='btn btn-sm btn-danger' data-id='" . $row['ReleaseID'] . "' id='deleteReleaseBtn'>Quitar</button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            //\SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
            \SSP::complex($_GET, $dbDetails, $table, $primaryKey, $columns, null, $whereAll = "deleted_at IS NULL"));
    }


    public function getReleaseInfo()
    {
        $releaseModel = model('ReleaseModel');
        $release_id = $this->request->getPost('release_id');
        //var_dump($release_id);
        // $releaseModel->
        $info = $releaseModel->find($release_id);
        //var_dump($info);

        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }
    }

    public function updateRelease()
    {
        $releaseModel = model('ReleaseModel');
        $validation = \Config\Services::validation();
        $rid = $this->request->getPost('rid');

        $this->validate([
            'release_subject' => [
                'rules' => 'required|is_unique[release.Release_subject,ReleaseID,' . $rid . ']',
                'errors' => [
                    'required' => 'Release subject is required',
                    'is_unique' => 'This subject is already exists'
                ]
            ],
            'release_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Content is required'
                ]
            ],
            'release_published_from' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date published is required'
                ]
            ],
            'release_published_to' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date caducated is required'
                ]
            ]


        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            //Update country
            $date_from = date("Y-m-d H:i:s", strtotime($this->request->getPost('release_published_from') . ' 00:00:00'));
            $date_to = date("Y-m-d H:i:s", strtotime($this->request->getPost('release_published_to') . ' 23:59:59'));
            
            $data = [
                'Release_subject' => $this->request->getPost('release_subject'),
                'Release_description' => $this->request->getPost('release_description'),
                'Release_published_from' => $date_from,
                'Release_published_to' => $date_to
            ];
            $query = $releaseModel->update($rid, $data);

            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'Release info have been updated successfully']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }


    public function deleteRelease()
    {
        $releaseModel = model('ReleaseModel');
        $release_id = $this->request->getPost('release_id');
        $query = $releaseModel->delete($release_id);

        if ($query) {
            echo json_encode(['code' => 1, 'msg' => 'Release deleted Successfully']);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    //Obtener el Release que se va mostrar al cargar Home del sitio web
    public function getReleaseLast()
    {
        //$releaseModel = model('ReleaseModel');
        $db = db_connect();
        //$db->query("<YOUR QUERY HERE>");
            $info= $db->query("Select * from `release`
            WHERE created_at  = (
                SELECT MAX(created_at)
                FROM dbescuela.`release`
            )")->getResult();


        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }
    }
   
}
