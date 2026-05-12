<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INTEGER',
            'auto_increment' => true,
        ],
        'username' => ['type' => 'TEXT'],
        'email' => ['type' => 'TEXT'],
        'password' => ['type' => 'TEXT'],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('users');
}

    public function down()
    {
        //
    }
}
