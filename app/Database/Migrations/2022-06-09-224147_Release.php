<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Release extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ReleaseID' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'UserID' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
            ],
            'Release_subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'Release_description' => [
                'type'       => 'VARCHAR',
                'constraint' => '1024',
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
        $this->forge->addKey('ReleaseID', true);
        $this->forge->addForeignKey('UserID', 'User', 'UserID');
        $this->forge->createTable('Release');
    }

    public function down()
    {
        $this->forge->dropTable('Release');
    }
}
