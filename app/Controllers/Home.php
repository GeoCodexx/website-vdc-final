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
}
