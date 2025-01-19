<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TArtistas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_art' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name_art' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'lastname_art' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description_art' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nationality_art' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'email_art' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'image_art' => [ // Nuevo campo agregado
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Permitir valores nulos si no siempre se sube una imagen
            ],
        ]);

        $this->forge->addKey('id_art', true);
        $this->forge->createTable('t_artistas');
    }

    public function down()
    {
        $this->forge->dropTable('t_artistas');
    }
}
