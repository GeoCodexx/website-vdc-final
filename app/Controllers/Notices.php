<?php

namespace App\Controllers;

class Notices extends BaseController
{
    public function index()
    {
       return view('notices/index');
    }
}
