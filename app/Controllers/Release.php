<?php

namespace App\Controllers;

class Release extends BaseController
{
    
    public function __construct(){
        require_once APPPATH.'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function releases(){
       //$data['pageTitle'] = 'Releases List';
       $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
       $data = [  
        'title'=>'Comunicados',
        'userInfo'=>$userInfo
    ];
        return view('adm/module_release/index', $data);
    }

    public function addRelease(){
        $releaseModel = model('ReleaseModel');
        $validation = service('validation') ;
        $this->validate([
             'release_subject'=>[
                 'rules'=>'required|is_unique[release.Release_subject]',
                 'errors'=>[
                     'required'=>'Release subject is required',
                     'is_unique'=>'This Rlease is already exists',
                 ]
             ],
             'release_description'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Description release is required'
                  ]
             ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data = [
                 'UserID'=>1,
                 'Release_subject'=>$this->request->getPost('release_subject'),
                 'Release_description'=>$this->request->getPost('release_description'),
             ];
             $query = $releaseModel->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'New Release has been saved to database']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Something went wrong']);
             }
        }
    }

    public function getAllReleases(){
        //DB Details
        $dbDetails = array(
            "host"=>$this->db->hostname,
            "user"=>$this->db->username,
            "pass"=>$this->db->password,
            "db"=>$this->db->database,
        );

        //$table = "release";
        $table = <<<EOT
        (
           SELECT 
             a.ReleaseID, 
             a.Release_subject, 
             a.Release_description,
             a.created_at,
             a.updated_at,
             a.deleted_at,
             CONCAT_WS(' ', b.User_name, b.User_lastname_01) AS User_name
           FROM `release` a
           LEFT JOIN user b ON a.UserID = b.UserID
        ) temp
       EOT;
        $primaryKey = "ReleaseID";

        $columns = array(
            array(
                "db"=>"ReleaseID",
                "dt"=>0,
            ),
            array(
                "db"=>"Release_subject",
                "dt"=>1,
            ),
            array(
                "db"=>"Release_description",
                "dt"=>2,
                "formatter"=>function($d, $row){
                    return substr($row['Release_description'], 0, 20).'...';
                }
            ),
            array(
                "db"=>"created_at",
                "dt"=>3,
            ),
            array(
                "db"=>"updated_at",
                "dt"=>4,
            ),
            array(
                "db"=>"User_name",
                "dt"=>5,
            ),
            array(
                "db"=>"ReleaseID",
                "dt"=>6,
                "formatter"=>function($d, $row){
                    return "<div class='btn-group'>
                                  <button class='btn btn-sm btn-primary' data-id='".$row['ReleaseID']."' id='updateReleaseBtn'>Update</button>
                                  <button class='btn btn-sm btn-danger' data-id='".$row['ReleaseID']."' id='deleteReleaseBtn'>Delete</button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            //\SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
            \SSP::complex ( $_GET, $dbDetails, $table, $primaryKey, $columns,null, $whereAll= "deleted_at IS NULL")
        );
    }


    public function getReleaseInfo(){
        $releaseModel = model('ReleaseModel');
        $release_id = $this->request->getPost('release_id');
        //var_dump($release_id);
        // $releaseModel->
        $info = $releaseModel->find($release_id);
        //var_dump($info);
        
        if($info){
            echo json_encode(['code'=>1, 'msg'=>'', 'results'=>$info]);
        }else{
            echo json_encode(['code'=>0, 'msg'=>'No results found', 'results'=>null]);
        }
    }

    public function updateRelease(){
        $releaseModel = model('ReleaseModel');
        $validation = \Config\Services::validation();
        $rid = $this->request->getPost('rid');

        $this->validate([
            'release_subject'=>[
                 'rules'=>'required|is_unique[release.Release_subject,ReleaseID,'.$rid.']',
                 'errors'=>[
                      'required'=>'Release name is required',
                      'is_unique'=>'This Release is already exists'
                 ]
            ],
            'release_description'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Description is required'
                  ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0,'error'=>$errors]);
        }else{
            //Update country
            $data = [
               'Release_subject'=>$this->request->getPost('release_subject'),
               'Release_description'=>$this->request->getPost('release_description'),
            ];
            $query = $releaseModel->update($rid,$data);

            if($query){
                echo json_encode(['code'=>1, 'msg'=>'Release info have been updated successfully']);
            }else{
                echo json_encode(['code'=>0, 'msg'=>'Something went wrong']);
            }
        }
    }


    public function deleteRelease(){
        $releaseModel = model('ReleaseModel');
        $release_id = $this->request->getPost('release_id');
        $query = $releaseModel->delete($release_id);

        if($query){
            echo json_encode(['code'=>1,'msg'=>'Release deleted Successfully']);
        }else{
            echo json_encode(['code'=>0,'msg'=>'Something went wrong']);
        }
    }
    
    /*
    public function listview(){
        
        helper(['form', 'url']);
        $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
        
        $releaseModel = model('ReleaseModel');
        $listRelease = $releaseModel->findall();
        
        $data = [  
            'title'=>'Comunicados',
            'userInfo'=>$userInfo,
            'listItems'=>$listRelease
        ];
        return view('adm/module_release/index', $data);
    }

    public function create(){
        return view('adm/module_release/index');

    }

    public function update(){
        return view('adm/module_release/index');

    }

    public function detail(){
        return view('adm/module_release/index');

    }

    public function delete(){
        

    }
    
    
    /*
    public function __construct(){
        require_once APPPATH.'ThirdParty/ssp.php';
        $this->db = db_connect();
    }
    
    public function index()
    {
        $data['pageTitle'] = 'Comunicados';
        return view('adm/module-release/index', $data);
    }

    public function profile()
    {
        $data['pageTitle'] = 'Profile';
        return view('dashboard/profile', $data);
    }

    public function countries()
    {
        $data['pageTitle'] = 'Lista de Comunicados';
        return view('adm/module-release/index', $data);
    }

    public function addCountry()
    {
        $releaseModel = model('ReleaseModel');
        $validation = \Config\Services::validation();
        $this->validate([
            'Release_subject' => [
                'rules' => 'required|is_unique[release.Release_subject]',
                'errors' => [
                    'required' => 'Asunto es requerido',
                    'is_unique' => 'Este Comunicado ya existe con el mismo nombre.',
                ]
            ],
            'Release_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Por favor rellene la descripcion'
                ]
            ]
            
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            //Insert data into db
            $data = [
                'UserID' => 1,
                'Release_subject' => $this->request->getPost('release_subject'),
                'Release_description' => $this->request->getPost('release_description'),
            ];
            $query = $releaseModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'New release has been saved to database']);
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
        );

        $table = "release";
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
                "db" => "Release_description",
                "dt" => 2,
            ),
            array(
                "db" => "UserID",
                "dt" => 3,
            ),
            array(
                "db" => "ReleaseID",
                "dt" => 4,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                  <button class='btn btn-sm btn-primary' data-id='" . $row['ReleaseID'] . "' id='updateReleaseBtn'>Update</button>
                                  <button class='btn btn-sm btn-danger' data-id='" . $row['ReleaseID'] . "' id='deleteReleaseBtn'>Delete</button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }


    public function getReleaseInfo()
    {
        $releaseModel = model('ReleaseModel');
        $release_id = $this->request->getPost('release_id');
        $info = $releaseModel->find($release_id);
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
        $cid = $this->request->getPost('cid');

        $this->validate([
            'Release_subject' => [
                'rules' => 'required|is_unique[countries.country_name,id,' . $cid . ']',
                'errors' => [
                    'required' => 'Release name is required',
                    'is_unique' => 'This Release is already exists'
                ]
            ],
            'Release_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Description Release is required'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            //Update country
            $data = [
                'Release_subject' => $this->request->getPost('release_subject'),
                'Release_description' => $this->request->getPost('release_description'),
            ];
            $query = $releaseModel->update($cid, $data);

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
*/

}
