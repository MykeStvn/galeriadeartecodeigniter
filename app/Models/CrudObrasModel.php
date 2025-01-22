<?php
namespace App\Models;
use CodeIgniter\Model;

class CrudObrasModel extends Model
{
    protected $table = 't_obras';
    protected $primaryKey = 'id_obra';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'name_obra',
        'description_obra',
        'image_obra',
        'id_art',
        'price_obra',
        'date_creation_obra'
    ];    

    // Agregar reglas de validación
    protected $validationRules = [
        'name_obra' => 'required|min_length[3]',
        'id_art' => 'required|integer|is_not_unique[t_artistas.id_art]'
    ];

    protected $validationMessages = [
        'name_obra' => [
            'required' => 'Work name is required'
        ],
        'id_art' => [
            'required' => 'Id artist is required',
            'is_not_unique' => 'This artist not exist'
        ]
    ];

    
    public function getObrasConArtista()
    {
        return $this->select('t_obras.*, t_artistas.name_art')
                    ->join('t_artistas', 't_artistas.id_art = t_obras.id_art', 'left')
                    ->orderBy('t_obras.id_obra', 'DESC')
                    ->findAll();
    }

    public function obtenerObra($data){
        $Obras = $this->db->table('t_obras');
        $Obras->where($data);
        
        return $Obras->get()->getResultArray();
    }

    
    public function getObrasPorArtista($id_art)
    {
        return $this->where('id_art', $id_art)->findAll();
    }

    
    public function getObraById($id)
    {
        return $this->select('t_obras.*, t_artistas.name_art')
                    ->join('t_artistas', 't_artistas.id_art = t_obras.id_art', 'left')
                    ->where('t_obras.id_obra', $id)
                    ->first();
    }

    
    public function insertar($datos)
    {
        return $this->insert($datos);
    }

    
    public function actualizar($id, $datos)
    {
        return $this->update($id, $datos);
    }

    
    public function eliminar($id)
    {
        return $this->delete($id);
    }

    public function contarObras(){
        return $this->countAll();
    }
}
