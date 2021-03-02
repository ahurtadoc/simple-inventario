<?php


namespace Controller;


use Models\Producto;

class InventarioController extends Controller
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function getAll()
    {
        return $this->producto->listar();
    }

    public function get($id)
    {
        return $this->producto->obtener($id);
    }
    
    public function create($params)
    {

        return $this->producto->guardar($params);
    }

    public function update($param, $id)
    {
        return $this->producto->actualizar($param, $id);
    }

    public function delete($params)
    {
        return $this->producto->eliminar($params);
    }

    public function sell($params)
    {
        return $this->producto->vender($params);

    }

}