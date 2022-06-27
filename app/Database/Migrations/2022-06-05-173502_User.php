<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'UserID' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'User_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'User_lastname_01' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'User_lastname_02' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'User_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => false
            ],
            'User_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'User_password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => false
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('UserID', true);
        $this->forge->createTable('User');
    }

    public function down()
    {
        $this->forge->dropTable('User');
    }
}
