<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Auth extends BaseController
{
    public function __construct(){
        helper(['url', 'form']);
    }
    
    public function index()
    {

        return view('adm/module_auth/index');
    }

    public function signin()
    {
        $validation = $this->validate([
            'email'=>[
                'rules'=>'required|valid_email|is_not_unique[User.User_email]',
                'errors'=>[
                    'required'=>'Email es requerido',
                    'valid_email'=>'Ingrese una dirección de correo valido',
                    'is_not_unique'=>'El correo no esta registrado en nuestro sistema'
                ]
            ],
            'password'=>[
                'rules'=>'required|min_length[5]',
                'errors'=>[
                    'required'=>'Ingrese una contraseña',
                    'min_length'=>'Su clave tiene menos de 5 caracteres.'
                ]
            ]
        ]);

        if(!$validation){
            return view('adm/module_auth/index', ['validation'=>$this->validator]);
        }else{
            //echo 'Form succesfull validated';
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel= model('UserModel');
            $user_info= $userModel->where('User_email', $email)->first();
            $check_password= Hash::check($password, $user_info['User_password']);

            if (!$check_password) {
                session()->setFlashdata('fail', 'Contraseña incorrecta');
                return redirect()->to('/admin')->withInput();
            }else{
                $user_id = $user_info['UserID'];
                session()->set('loggedUser', $user_id);
                //return redirect()->to('/admin/dashboard');
                return redirect()->to('/admin/dashboard');
            }
            
        }
    }

    public function signout(){
        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            return redirect()->to('/admin?access=out')->with('fail', 'Has cerrado sesión con éxito.');
        }
    }
}
