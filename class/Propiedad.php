<?php

namespace App;


class Propiedad{
    public $id;
    public $titulo;
    public $precio;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $fecha;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this-> id = $args['id'] ?? '';
        $this-> titulo = $args['titulo'] ?? '';
        $this-> precio = $args['precio'] ?? '';
        $this-> descripcion = $args['descripcion'] ?? '';
        $this-> habitaciones = $args['habitaciones'] ?? '';
        $this-> wc = $args['wc'] ?? '';
        $this-> estacionamiento = $args['estacionamiento'] ?? '';
        $this-> fecha = $args['fecha'] ?? '';
        $this-> vendedorId = $args['vendedorId'] ?? '';
        
    }

}