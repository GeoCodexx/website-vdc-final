<?php

namespace App\Controllers;

class Services extends BaseController
{
    
    public function index()
    {
       return view('services/primaria');
    }

    public function inicial()
    {
        return view('services/inicial');
    }
    
    public function primaria()
    {
        echo view('services/primaria');
        //return view('services/primaria');
        //$this->load->view('services/primaria');
    }

}
