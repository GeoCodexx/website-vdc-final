<?php

namespace App\Controllers;

use CodeIgniter\Config\View;

class Events extends BaseController
{
    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index(){
        
        return View('events/index');
    }

    public function eventos()
    {
        //$data['pageTitle'] = 'Releases List';
        $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
        $data = [
            'title' => 'Eventos',
            'userInfo' => $userInfo
        ];
        return view('adm/module_event/index', $data);
    }

    public function addEvent()
    {
        $eventModel = model('EventModel');
        $validation = service('validation');
        $this->validate([
            'event_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese el Asunto del Evento!!'
                ]
            ],
            'event_description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese una descripción!!'
                ]
            ],
            'event_image' => [
                'rules' => 'uploaded[event_image]|mime_in[event_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[event_image,4096]',
                'errors' => [
                    /*'required' => 'Seleccione la fecha de caducidad!'*/
                    'uploaded[event_image]' => 'Suba una imagen',
                    'mime_in[event_image,image/jpg,image/jpeg,image/gif,image/png]' => 'Seleccione un formato de imagen correcto',
                    'max_size[event_image,4096]' => 'Error, imagen pesa mas de 4096Kb'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            // Grab the file by name given in HTML form
            $file = $this->request->getFile('event_image');
            // Generate a new secure name
            $name = $file->getRandomName();
            // Move the file to the directory
            $file->move('uploads', $name);

            $data = [
                'UserID' => 1,
                'Event_title' => $this->request->getPost('event_title'),
                'Event_description' => $this->request->getPost('event_description'),
                'Event_image' => $name
            ];
            $query = $eventModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'New Event has been saved to database']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function getAllEvents()
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
             a.EventID, 
             a.Event_title, 
             a.Event_description,
             a.Event_image,
             a.created_at,
             a.deleted_at,
             CONCAT_WS(' ', b.User_name, b.User_lastname_01) AS User_name
           FROM `event` a
           LEFT JOIN user b ON a.UserID = b.UserID
        ) temp
       EOT;
        $primaryKey = "EventID";

        $columns = array(
            array(
                "db" => "EventID",
                "dt" => 0,
            ),
            array(
                "db" => "Event_title",
                "dt" => 1,
            ),
            array(
                "db" => "Event_description",
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
                "db" => "Event_image",
                "dt" => 5,
                "formatter" => function ($d, $row) {
                    return "<img class='zoom' src='" . base_url('uploads/' . $d) . "' style='height:50px;width:50px;align:middle;'/>";
                }
            ),
            array(
                "db" => "EventID",
                "dt" => 6,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                <button class='btn btn-sm btn-secondary' data-id='" . $row['EventID'] . "' id='previewEventBtn'>Ver</button>  
                                <button class='btn btn-sm btn-primary' data-id='" . $row['EventID'] . "' id='updateEventBtn'>Editar</button>
                                <button class='btn btn-sm btn-danger' data-id='" . $row['EventID'] . "' id='deleteEventBtn'>Quitar</button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            //\SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
            \SSP::complex($_GET, $dbDetails, $table, $primaryKey, $columns, null, $whereAll = "deleted_at IS NULL")
        );
    }


    public function getEventInfo()
    {
        $eventModel = model('EventModel');
        $event_id = $this->request->getPost('event_id');
        //var_dump($release_id);
        // $releaseModel->
        $info = $eventModel->find($event_id);
        //var_dump($info);

        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }
    }

    public function updateEvent()
    {
        $eventModel = model('EventModel');
        $validation = \Config\Services::validation();
        $eid = $this->request->getPost('eid');

        $this->validate([
            'event_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Título del evento es requerido'
                ]
            ],
            'event_description' => [
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
            if ($this->request->getFile('event_image')) {
                // Grab the file by name given in HTML form
                $file = $this->request->getFile('event_image');
                // Generate a new secure name
                $name = $file->getRandomName();
                // Move the file to the directory
                $file->move('uploads', $name);

                $data = [
                    'Event_title' => $this->request->getPost('event_title'),
                    'Event_description' => $this->request->getPost('event_description'),
                    'Event_image' => $name
                ];
                $query = $eventModel->update($eid, $data);

                if ($query) {
                    echo json_encode(['code' => 1, 'msg' => 'Event info have been updated successfully']);
                } else {
                    echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
                }
            }else{
                $data = [
                    'Event_title' => $this->request->getPost('event_title'),
                    'Event_description' => $this->request->getPost('event_description')
                ];
                $query = $eventModel->update($eid, $data);
    
                if ($query) {
                    echo json_encode(['code' => 1, 'msg' => 'Event info have been updated successfully']);
                } else {
                    echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
                } 
            }
        }
    }


    public function deleteEvent()
    {
        $eventModel = model('EventModel');
        $event_id = $this->request->getPost('event_id');
        $query = $eventModel->delete($event_id);

        if ($query) {
            echo json_encode(['code' => 1, 'msg' => 'Event deleted Successfully']);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    //FETCH EVENTS STATIC VIEW ROUTE '/eventos'
    public function fetchEvents() {
        $eventModel = model('EventModel');
        $evnts = $eventModel->findAll();
        $data = '';

        if ($evnts) {
            foreach ($evnts as $evnt) {
                $data .= '<div class="col">
                <a href="#" id="' . $evnt['EventID'] . '" class="evnt_link">
                    <div class="card h-100 card-border shadow">
                        
                            <img src="uploads/' . $evnt['Event_image'] . '" class="img-fluid card-img-top">
                        
                        <div class="card-body">
                            <h6 class="card-title">' . $evnt['Event_title'] . '</h6>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <small class="text-muted">Publicado: ' . date('d-m-Y', strtotime($evnt['created_at'])) . '</small>
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
    public function getEvnt($id = null) {
        $eventModel = model('EventModel');
        $evnt = $eventModel->find($id);
        //return var_dump($evnt);
        
        return $this->response->setJSON([
            'error' => false,
            'message' => $evnt
        ]);
    }

    //Ultimo Event
    public function getEventLast()
    {
        $db = db_connect();
            $info= $db->query("Select * from `event`
            WHERE created_at  = (
                SELECT MAX(created_at)
                FROM dbescuela.`event`
                LIMIT 1
            )")->getRow();
        
            return $this->response->setJSON([
                'error' => false,
                'message' => $info
            ]);
    }
}
