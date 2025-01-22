<?php

namespace App\Controllers;

use App\Models\CrudObrasModel;
use App\Models\CrudArtistaModel; // Agregar este modelo

class CrudObra extends BaseController
{
    public function index(): string
    {
        $modelObras = new CrudObrasModel();
        $modelArtistas = new CrudArtistaModel();

        $data = [
            'datos' => $modelObras->getObrasConArtista(),
            'artistas' => $modelArtistas->findAll(), 
            'totalObras' => $modelObras->countAll()
        ];

        return view('obras', $data);
    }

    public function crear()
    {
        
        $uploadPath = WRITEPATH . 'uploads/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file = $this->request->getFile('image_obra');
        $fileName = null;

        // Verificar si se subió un archivo
        if ($file && $file->isValid() && !$file->hasMoved()) {
            try {
                $fileName = $file->getRandomName();
                $file->move($uploadPath, $fileName);
                
                var_dump($fileName);
                var_dump(file_exists($uploadPath . $fileName));
                
            } catch (\Exception $e) {
                return redirect()->to('/')->with('mensaje', 'Error at upload image: ' . $e->getMessage());
            }
        }

        $datos = [
            "name_obra" => $this->request->getPost('name_obra'), 
            "description_obra" => $this->request->getPost('description_obra'),
            "id_art" => $this->request->getPost('id_art'), 
            "price_obra" => $this->request->getPost('price_obra'),
            "date_creation_obra" => $this->request->getPost('date_creation_obra'),
            "image_obra" => $fileName
        ];

        $model = new CrudObrasModel();
        
        try {
            $model->insertar($datos);
            return redirect()->to('/obras')->with('mensaje', 'Work saved successfully!');
        } catch (\Exception $e) {
            
            if ($fileName && file_exists($uploadPath . $fileName)) {
                unlink($uploadPath . $fileName);
            }
            return redirect()->to('/')->with('mensaje', 'Error at save: ' . $e->getMessage());
        }
    }

    public function actualizar()
    {
        $file = $this->request->getFile('image_obra');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        } else {
            $fileName = $this->request->getPost('existing_image_obra');
        }

        $datos = [
            "name_obra" => $this->request->getPost('name_obra'),
            "description_obra" => $this->request->getPost('description_obra'),
            "description_art" => $this->request->getPost('description_art'),
            "price_obra" => $this->request->getPost('price_obra'),
            "date_creation_obra" => $this->request->getPost('date_creation_obra'),
            "image_obra" => $fileName,
            "id_art" => $this->request->getPost('id_art') 
        ];
        $id_obra = $this->request->getPost('id_obra');

        $model = new CrudObrasModel();
        
        try {
            $model->update($id_obra, $datos);
            return redirect()->to('/obras')->with('mensaje', '¡Work updated successfully!');
        } catch (\Exception $e) {
            return redirect()->to('/obras')->with('mensaje', 'Error: ' . $e->getMessage());
        }
    }

    public function obtenerObra($id_obra): string
    {
        $CrudObra = new CrudObrasModel();
        $CrudArtista = new CrudArtistaModel();

        
        $data = ["id_obra" => $id_obra];
        $respuesta = $CrudObra->obtenerObra($data);

        
        if (!$respuesta) {
            return redirect()->to('/obras')->with('mensaje', 'Work not founded.');
        }

        
        $selectedArtistId = $respuesta['id_art'] ?? null;

        
        $artistas = $CrudArtista->findAll();

        
        $datos = [
            'datos' => $respuesta, 
            'artistas' => $artistas, 
            'selectedArtistId' => $selectedArtistId, 
        ];

        return view('actualizarobras', $datos);
    }



    public function eliminar($id_obra)
    {
        $model = new CrudObrasModel();
        
        try {
            $model->eliminar($id_obra);
            return redirect()->to('/obras')->with('mensaje', 'Work deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->to('/obras')->with('mensaje', 'Error: ' . $e->getMessage());
        }
    }

}
