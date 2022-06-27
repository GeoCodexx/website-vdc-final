<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        //$this->db->table('User')->truncate();
        for ($i=0; $i < 5; $i++) { 
            $data = [
                'User_name'=>'Usuario '.$i,
                'User_lastname_01'=>'Ap_User'.$i,
                'User_lastname_02'=>'Ap_User'.$i,
                'User_phone'=>'0000000'.$i,
                'User_email'=>'user_'.$i.'@gmail.com',
                'User_password'=>'user_'.$i
            ];

            $this->db->table('User')->insert($data);
        }
    }
}
