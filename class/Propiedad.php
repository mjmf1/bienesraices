<?php

namespace App;


class Propiedad{

    // Base de datos
    protected static $conn;
    protected static $columnasDB = ['id','titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'fecha', 'vendedorId'];


    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $fecha;
    public $vendedorId;

    //Definir la conexion a la BD
    public static function setDB($database){
        self::$conn = $database;
    }

    public function __construct($args = [])
    {
        $this-> id = $args['id'] ?? '';
        $this-> titulo = $args['titulo'] ?? '';
        $this-> precio = $args['precio'] ?? '';
        $this-> imagen = $args['imagen'] ?? 'imagen.jpg';
        $this-> descripcion = $args['descripcion'] ?? '';
        $this-> habitaciones = $args['habitaciones'] ?? '';
        $this-> wc = $args['wc'] ?? '';
        $this-> estacionamiento = $args['estacionamiento'] ?? '';
        $this-> fecha = date('Y/m/d');
        $this-> vendedorId = $args['vendedorId'] ?? '';
        
    }


    public function guardar(){

        // Sanitizar los datos

        $atributos = $this->sanitizarAtributos();
        // insertar en la base de datos 

      $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, fecha, vendedorId)
      VALUES ('$this->titulo', '$this->precio', '$this->imagen' , '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->fecha', '$this->vendedorId')";

     $resultado = self::$conn->query($query);
     debuguear($resultado);
    }
    // Identificar y unir los atributos de la DB
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$conn->escape_string($value);
        }
        debuguear($sanitizado);
    }
   
}