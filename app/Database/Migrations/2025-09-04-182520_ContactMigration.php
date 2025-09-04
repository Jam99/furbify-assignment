<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ContactMigration extends Migration
{
    public function up()
    {
        $this->forge->addField("id");
        $this->forge->addField([
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
            ],
            'tel' => [
                'type'       => 'VARCHAR',
                'constraint' => '16'
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => false,
                'default'    => new RawSql('CURRENT_TIMESTAMP'),
            ]
        ]);
        $this->forge->createTable("contacts");
    }

    public function down()
    {
        $this->forge->dropTable("contacts");
    }
}
