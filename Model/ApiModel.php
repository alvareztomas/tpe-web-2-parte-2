<?php
class ApiModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_jugadores;charset=utf8', 'root', '');
    }

    function getAnotadores()
    {
        $sentencia = $this->db->prepare("SELECT * FROM anotadores");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function getAnotador($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM anotadores WHERE id=?");
        $sentencia->execute([$id]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function addAnotador($nombre, $camiseta, $rol, $equipo, $goles)
    {
        $sentencia = $this->db->prepare("INSERT INTO anotadores(nombre_jugador, nro_camiseta, rol, equipo, goles) VALUES(?,?,?,?,?)");
        $sentencia->execute([$nombre, $camiseta, $rol, $equipo, $goles]);
    }

    function deleteAnotador($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM anotadores WHERE id=?");
        $sentencia->execute([$id]);
    }

    function updateAnotador($id, $nombre, $camiseta, $rol, $equipo, $goles)
    {
        $sentencia = $this->db->prepare("UPDATE anotadores SET nombre=?, camiseta=?, rol=?, equipo=? goles=? WHERE id=?");
        $sentencia->execute([$nombre, $camiseta, $rol, $equipo, $goles, $id]);
    }
}
