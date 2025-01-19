<?php
namespace App\Models;
use CodeIgniter\Model;

class CrudArtistaModel extends Model
{
    protected $table = 't_artistas';
    protected $primaryKey = 'id_art';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = [
        'name_art',
        'lastname_art',
        'description_art',
        'nationality_art',
        'email_art',
        'image_art',
    ];

    public function listarArtistas()
    {
        return $this->findAll();
    }

    public function insertar($datos){
        $Artistas = $this->db->table('t_artistas');
        $Artistas->insert($datos);

        return $this->db->insertID();
    }

    public function obtenerArtista($data){
        $Artistas = $this->db->table('t_artistas');
        $Artistas->where($data);
        return $Artistas->get()->getResultArray();
    }

    public function eliminar($id_art){
        $Artistas = $this->db->table('t_artistas');
        $Artistas->where('id_art', $id_art);
        return $Artistas->delete();
    }

    public function contarArtistas(){
        return $this->countAll();
    }
}
