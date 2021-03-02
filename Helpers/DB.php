<?php


namespace Helper;

use \PDO;
use \PDOException;

class DB extends PDO
{
    private $tipo_de_base = 'mysql';
    private $host = 'localhost';
    private $nombre_de_base = 'inventario';
    private $usuario = 'root';
    private $contrasena = '';

    public function __construct() {
        //Sobreescribo el método constructor de la clase PDO.
        try{
            parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};host={$this->host}", $this->usuario, $this->contrasena);
        }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
        }
        $this->exec("set names utf8");
    }

    public function insert($tabla,$data)
    {
        $columnas = join(', ',array_keys($data));
        $valores = array_values($data);
        $place_holder = join(', ' ,array_fill(0,count($valores),'?'));

        $query = $this->prepare("INSERT INTO $tabla ($columnas) VALUES ($place_holder)");
        if(!$query->execute($valores)){

            $error = $query->errorInfo();
            return "Error al guardar ${error[2]}";
        }else{
            return "Guardado exitosamente";
        }
    }

    public function find($tabla, $condiciones, $campos = null, $cantidad = 1)
    {
        if($cantidad < 1 ){
            return $this->findAll($tabla,$condiciones,$campos);
        }else{
            if($campos == null){
                $startQuery = "SELECT * FROM $tabla WHERE ";
            }else{
                $campos = join(', ', $campos);
                $startQuery = "SELECT $campos FROM $tabla WHERE ";
            }
            $columnas = join('=? AND ', array_keys($condiciones));
            $valores = array_values($condiciones);
            $query = $this->prepare($startQuery."$columnas=? LIMIT $cantidad");

            if(!$query->execute($valores)){
                $info = json_encode($query);
                $error = $query->errorInfo();
                return "Error en consulta ${error[2]} $info";
            }else{
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }

        }

    }

    public function findAll($tabla, $condiciones=null,$campos=null)
    {
        if($condiciones==null){
            if($campos == null){
                $query=$this->query("SELECT * FROM $tabla");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $campos = join(', ', $campos);
                $query = $this->query("SELECT $campos FROM $tabla");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }

        }else{
            if($campos == null){
                $startQuery = "SELECT * FROM $tabla WHERE ";
            }else{
                $campos = join(', ', $campos);
                $startQuery = "SELECT $campos FROM $tabla WHERE ";
            }
            $columnas = join('=? AND ', array_keys($condiciones));
            $valores = array_values($condiciones);
            $query = $this->prepare($startQuery . "$columnas=? ");

            if(!$query->execute($valores)){
                $error = $query->errorInfo();
                return "Error en consulta ${error[2]}";
            }else{
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }


    }

    public function findDistinct($tabla,$campos,$condiciones=null)
    {
        $campos = join(', ', $campos);
        $startQuery = "SELECT DISTINCT $campos FROM $tabla ";
        if($condiciones==null) {
            $query = $this->query($startQuery);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $columnas = join('=? AND ', array_keys($condiciones));
            $valores = array_values($condiciones);

            $query = $this->prepare($startQuery . "$columnas=? ");

            if(!$query->execute($valores)){
            $error = $query->errorInfo();
            return "Error en consulta ${error[2]}";
            }else{
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }

    }

    public function update($tabla,$cambios,$id)
    {
        $columnas = join('=?,', array_keys($cambios));
        $nuevosValores = array_values($cambios);
//        list($nombreId,$valorId) = each($id);
        $nombreId = key($id);
        $valorId = current($id);
        $query = $this->prepare("UPDATE $tabla SET $columnas=? WHERE $nombreId=?");
        $nuevosValores[] = $valorId ;
        if(!$query->execute($nuevosValores)){
            $error = $query->errorInfo();
            return "Error en consulta ${error[2]}";
        }else{
            return "Registro Actualizado Correctamente";
        }

    }

    public function delete($tabla,$id)
    {
//        list($nombreId,$valorId) = each($id);
        $nombreId = key($id);
        $valorId = current($id);
        $query = $this->prepare("DELETE FROM $tabla WHERE $nombreId = ?");
        if(!$query->execute(array($valorId))){
            $error = $query->errorInfo();
            return "Error al guardar ${error[2]}";
        }else{
            return "Registro eliminado";
        }
    }

}