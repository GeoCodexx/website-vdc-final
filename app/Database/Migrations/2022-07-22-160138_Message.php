<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Message extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'MessageID' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'Message_names' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
            'Message_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'Message_subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'Message_body' => [
                'type'       => 'TEXT',
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
        $this->forge->addKey('MessageID', true);
        $this->forge->createTable('Message');
    }

    public function down()
    {
        $this->forge->dropTable('Message');
    }
}
