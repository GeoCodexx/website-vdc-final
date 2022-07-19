<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Event extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'EventID' => [
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
            'Event_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null' => false,
            ],
            'Event_description' => [
                'type'       => 'TEXT',
                'null' => false
            ],
            'Event_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '2000',
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
        $this->forge->addKey('EventID', true);
        $this->forge->addForeignKey('UserID', 'User', 'UserID');
        $this->forge->createTable('Event');
    }

    public function down()
    {
        $this->forge->dropTable('Event');
    }
}
