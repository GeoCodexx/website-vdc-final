<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'NoticeID' => [
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
            'Notice_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'Notice_description' => [
                'type'       => 'VARCHAR',
                'constraint' => '1024',
                'null' => false
            ],
            'Notice_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
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
        $this->forge->addKey('NoticeID', true);
        $this->forge->addForeignKey('UserID', 'User', 'UserID');
        $this->forge->createTable('Notice');
    }

    public function down()
    {
        $this->forge->dropTable('Notice');
    }
}
