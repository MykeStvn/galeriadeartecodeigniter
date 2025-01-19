<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TObras extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_obra' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name_obra' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => false,
            ],
            'description_obra' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image_obra' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => true,
            ],
            'id_art' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'      => false,
            ],
            'price_obra' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'      => true,
            ],
            'date_creation_obra' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_obra', true);
        $this->forge->addForeignKey('id_art', 't_artistas', 'id_art', 'CASCADE', 'CASCADE');
        $this->forge->createTable('t_obras', true);
    }

    public function down()
    {
        $this->forge->dropTable('t_obras', true);
    }
}
