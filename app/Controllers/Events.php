<?php

namespace App\Controllers;

class Events extends BaseController
{
    public function listview()
    {
        $userModel = model('UserModel');
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUser);
        $data = [
            'title' => 'Comunicados',
            'userInfo' => $userInfo
        ];
        return view('adm/module_release/index', $data);
    }

    public function create()
    {
        return view('adm/module_release/index');
    }

    public function update()
    {
        return view('adm/module_release/index');
    }

    public function detail()
    {
        return view('adm/module_release/index');
    }

    public function delete()
    {
    }
}
