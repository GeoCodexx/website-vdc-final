<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
       //return view('welcome_message');
       return view('home/index');
    }

    public function inicioadmin()
    {
       //return view('welcome_message');
       //return view('layout');
       return view('adm/inicio');
    }

    public function dashboard(){

      $userModel = model('UserModel');
      $loggedUser = session()->get('loggedUser');
      $userInfo = $userModel->find($loggedUser);
      $data = [
         'title'=>'Escritorio',
         'userInfo'=>$userInfo
      ];
      return view('adm/dashboard', $data);
    }

    public function getCountRelease(){
      $db = db_connect();
        //$db->query("<YOUR QUERY HERE>");
            $info= $db->query("select (select count(*) from `release`) as rel, 
            (select count(*) from `event`) as evnt,
            (select count(*) from `notice`) as noti,
            (select count(*) from `message`) as msg")->getRow();

            return $this->response->setJSON([
               'error' => false,
               'message' => $info
           ]);

/*
        if ($info) {
            echo json_encode(['code' => 1, 'msg' => '', 'results' => $info]);
        } else {
            echo json_encode(['code' => 0, 'msg' => 'No results found', 'results' => null]);
        }*/
    }
}
