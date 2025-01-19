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
            'artistas' => $modelArtistas->findAll(), // Para el select de artistas
            'totalObras' => $modelObras->countAll()
        ];

        return view('obras', $data);
    }

    public function crear()
    {
        // Crear el directorio de uploads si no existe
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
                // Agregar este debug
                var_dump($fileName);
                var_dump(file_exists($uploadPath . $fileName));
                // exit(); // Descomenta para ver el debug
            } catch (\Exception $e) {
                return redirect()->to('/')->with('mensaje', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }

        $datos = [
            "name_obra" => $this->request->getPost('name_obra'), // Corregido de name_art
            "description_obra" => $this->request->getPost('description_obra'),
            "id_art" => $this->request->getPost('id_art'), // Agregar este campo
            "price_obra" => $this->request->getPost('price_obra'),
            "date_creation_obra" => $this->request->getPost('date_creation_obra'),
            "image_obra" => $fileName
        ];

        $model = new CrudObrasModel();
        
        try {
            $model->insertar($datos);
            return redirect()->to('/obras')->with('mensaje', 'Obra guardado exitosamente!');
        } catch (\Exception $e) {
            // Si hay error al guardar y se subió una imagen, eliminarla
            if ($fileName && file_exists($uploadPath . $fileName)) {
                unlink($uploadPath . $fileName);
            }
            return redirect()->to('/')->with('mensaje', 'Error al guardar: ' . $e->getMessage());
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
            "id_art" => $this->request->getPost('id_art') // Aquí se asigna el artista seleccionado
        ];
        $id_obra = $this->request->getPost('id_obra');

        $model = new CrudObrasModel();
        
        try {
            $model->update($id_obra, $datos);
            return redirect()->to('/obras')->with('mensaje', '¡Registro actualizado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->to('/obras')->with('mensaje', 'Error: ' . $e->getMessage());
        }
    }

    public function obtenerObra($id_obra): string
    {
        $CrudObra = new CrudObrasModel();
        $CrudArtista = new CrudArtistaModel();

        // Obtener datos de la obra
        $data = ["id_obra" => $id_obra];
        $respuesta = $CrudObra->obtenerObra($data);

        // Verifica que la obra exista
        if (!$respuesta) {
            return redirect()->to('/obras')->with('mensaje', 'Obra no encontrada.');
        }

        // Obtener el ID del artista asociado a la obra
        $selectedArtistId = $respuesta['id_art'] ?? null;

        // Obtener la lista de artistas
        $artistas = $CrudArtista->findAll();

        // Pasar datos a la vista
        $datos = [
            'datos' => $respuesta, // Datos de la obra
            'artistas' => $artistas, // Lista de artistas
            'selectedArtistId' => $selectedArtistId, // Artista seleccionado
        ];

        return view('actualizarobras', $datos);
    }



    public function eliminar($id_obra)
    {
        $model = new CrudObrasModel();
        
        try {
            $model->eliminar($id_obra);
            return redirect()->to('/obras')->with('mensaje', '¡Registro eliminado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->to('/obras')->with('mensaje', 'Error: ' . $e->getMessage());
        }
    }

}
