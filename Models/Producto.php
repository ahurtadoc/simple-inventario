<?php


namespace Models;

use Helper\DB;

class Producto
{

    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function listar()
    {
        return $this->db->findAll('productos');
    }

    public function obtener($id)
    {
//        $id = array("ID" => $id);
        $query = $this->db->find('productos', $id);
        return $query[0];
    }

    public function guardar(array $datos)
    {
        $datos['fechaCreacion'] = date('Y-m-d');
        return $this->db->insert('productos', $datos);
    }

    public function actualizar(array $cambios, $id)
    {
//        $id = array("ID" => $id);
        return $this->db->update('productos', $cambios, $id);
    }

    public function eliminar($id)
    {
//        $id = array("ID" => $id);
        return $this->db->delete('productos', $id);
    }


    public function vender($id)
    {
        $stock = $this->db->find('productos',$id,array("stock"));
        $stock = $stock[0]["stock"];
        if ($stock <= 0){
            return 'No hay stock de este producto';
        }else{
            $cambios = array("stock" => $stock-1, "UltimaVenta" => date('Y-m-d H:i:s'));
            if($this->db->update('productos',$cambios,$id)){
                return 'producto vendido ';
            }
        }
    }
    
}