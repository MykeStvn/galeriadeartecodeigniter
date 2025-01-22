<?php

namespace App\Controllers;

// llamada al modelo//
use App\Models\CrudArtistaModel;

class CrudArtista extends BaseController
{
    public function index(): string
    {

        $crudArtista = new CrudArtistaModel();
        $datos = $crudArtista->listarArtistas();
        $totalArtistas = $crudArtista->contarArtistas(); 
        

        $mensaje = session('mensaje');
        $data = [
            "datos" => $datos,
            "totalArtistas" => $totalArtistas, 
            "mensaje" => $mensaje
        ];
        return view('listado', $data);

    }

    public function crear()
    {
        
        $uploadPath = WRITEPATH . 'uploads/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file = $this->request->getFile('image_art');
        $fileName = null;

        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            try {
                $fileName = $file->getRandomName();
                $file->move($uploadPath, $fileName);
                
                var_dump($fileName);
                var_dump(file_exists($uploadPath . $fileName));
                
            } catch (\Exception $e) {
                return redirect()->to('/')->with('mensaje', 'Error at upload the image: ' . $e->getMessage());
            }
        }

        $datos = [
            "name_art" => $this->request->getPost('name_art'),
            "lastname_art" => $this->request->getPost('lastname_art'),
            "description_art" => $this->request->getPost('description_art'),
            "nationality_art" => $this->request->getPost('nationality_art'),
            "email_art" => $this->request->getPost('email_art'),
            "image_art" => $fileName
        ];

        $model = new CrudArtistaModel();
        
        try {
            $model->insertar($datos);
            return redirect()->to('/')->with('mensaje', 'Artist saved successfully!');
        } catch (\Exception $e) {
            // Si hay error al guardar y se subió una imagen, eliminarla
            if ($fileName && file_exists($uploadPath . $fileName)) {
                unlink($uploadPath . $fileName);
            }
            return redirect()->to('/')->with('mensaje', 'Error at save: ' . $e->getMessage());
        }
    }

    public function actualizar()
    {
        $file = $this->request->getFile('image_art');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $fileName);
        } else {
            $fileName = $this->request->getPost('existing_image_art');
        }

        $datos = [
            "name_art" => $this->request->getPost('name_art'),
            "lastname_art" => $this->request->getPost('lastname_art'),
            "description_art" => $this->request->getPost('description_art'),
            "nationality_art" => $this->request->getPost('nationality_art'),
            "email_art" => $this->request->getPost('email_art'),
            "image_art" => $fileName
        ];
        $id_art = $this->request->getPost('id_art');

        $model = new CrudArtistaModel();
        
        try {
            $model->update($id_art, $datos);
            return redirect()->to('/')->with('mensaje', 'Artist updated successfully!');
        } catch (\Exception $e) {
            return redirect()->to('/')->with('mensaje', 'Error: ' . $e->getMessage());
        }
    }

    public function obtenerArtista($id_art): string{
        $data = ["id_art" => $id_art];
        $CrudArtista = new CrudArtistaModel();
        $respuesta = $CrudArtista->obtenerArtista($data);

        $datos = ["datos" => $respuesta];
        return view('actualizar', $datos);
    }

    public function eliminar($id_art)
    {
        $model = new CrudArtistaModel();
        
        try {
            $model->eliminar($id_art);
            return redirect()->to('/')->with('mensaje', '¡Artist deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->to('/')->with('mensaje', 'Error: ' . $e->getMessage());
        }
    }

}
