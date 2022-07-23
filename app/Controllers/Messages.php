<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Messages extends BaseController
{
    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index(){
        return view('contact/index');
    }

    public function messages()
    {
        $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
        $data = [
            'title' => 'Mensajes',
            'userInfo' => $userInfo
        ];
        return view('adm/module_message/index', $data);
    }

    public function addMessage()
    {
        $eventModel = model('MessageModel');
        $validation = service('validation');
        $this->validate([
            'message_names' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese su nombre!!'
                ]
            ],
            'message_email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Ingrese una descripción!!',
                    'valid_email' => 'Ingrese una cdirección de correo válido!'
                ]
            ],
            'message_subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ingrese el asunto del mensaje!!'
                ]
            ],
            'message_body' => [
                'rules' => 'required|min_length[15]',
                'errors' => [
                    'required' => 'Ingrese el contenido de su mensaje!',
                    'min_length[15]' => 'Ingrese como mínimo 15 caacteres.'
                ]
            ]
        ]);

        if ($validation->run() == FALSE) {
            $errors = $validation->getErrors();
            echo json_encode(['code' => 0, 'error' => $errors]);
        } else {
            
            $data = [
                'Message_names' => $this->request->getPost('message_names'),
                'Message_email' => $this->request->getPost('message_email'),
                'Message_subject' => $this->request->getPost('message_subject'),
                'Message_body' => $this->request->getPost('message_body'),
            ];
            $query = $eventModel->insert($data);
            if ($query) {
                echo json_encode(['code' => 1, 'msg' => 'New Message has been saved to database']);
            } else {
                echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function getAllMessages()
    {
        //DB Details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database,
            'charset' => 'utf8' //se agego esta opcionen el SSP.php archivo
        );

        $table = "message";

        $primaryKey = "MessageID";

        $columns = array(
            array(
                "db" => "MessageID",
                "dt" => 0
            ),
            array(
                "db" => "Message_names",
                "dt" => 1
            ),
            array(
                "db" => "Message_email",
                "dt" => 2
            ),
            array(
                "db" => "Message_subject",
                "dt" => 3
            ),
            array(
                "db" => "Message_body",
                "dt" => 4,
                "formatter" => function ($d, $row) {
                    return substr($d, 0, 10) . '...';
                }
            ),
            array(
                "db" => "created_at",
                "dt" => 5,
                "formatter" => function ($d, $row) {
                    $timestamp = strtotime($row['created_at']); //Convierte string a time
                    $new_date = date("d-m-Y H:i:s", $timestamp); //formatea la fecha y retorna
                    return $new_date;
                }
            ),
            array(
                "db" => "MessageID",
                "dt" => 6,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                                <button class='btn btn-sm btn-secondary' data-id='" . $row['MessageID'] . "' id='previewMessageBtn'>Ver</button>
                                <button class='btn btn-sm btn-danger' data-bs-toggle='tooltip' data-bs-placement='top' title='Marcar como atendido' data-id='" . $row['MessageID'] . "' id='deleteMessageBtn'>Atendido</button>
                             </div>";
                }
            ),
        );

        echo json_encode(
            //\SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
            \SSP::complex($_GET, $dbDetails, $table, $primaryKey, $columns, null, $whereAll = "deleted_at IS NULL")
        );
    }


    public function getMessageInfo()
    {
        $messageModel = model('MessageModel');
        $message_id = $this->request->getPost('message_id');
        $info = $messageModel->find($message_id);

        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }
    }



    public function deleteMessage()
    {
        $msgModel = model('MessageModel');
        $msg_id = $this->request->getPost('message_id');
        $query = $msgModel->delete($msg_id);

        if ($query) {
            echo json_encode(['code' => 1, 'msg' => 'Message deleted Successfully']);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }
}
