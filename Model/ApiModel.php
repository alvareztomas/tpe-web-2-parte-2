<?php
class ApiModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_jugadores;charset=utf8', 'root', '');
    }

    function getAnotadores($sort = null, $order = null)
    {
        $query = "SELECT * FROM jugadores";
        switch ($sort) {
            case 'goles':
                if ($order == 'asc') {
                    $query .= " ORDER BY goles ASC";
                } else {
                    $query .= " ORDER BY goles DESC";
                }
                break;
            case 'nro_camiseta':
                if ($order == 'asc') {
                    $query .= " ORDER BY nro_camiseta ASC";
                } else {
                    $query .= " ORDER BY nro_camiseta DESC";
                }
                break;
            default:
                $query .= " ORDER BY id";
                break;
        }
        $sentencia = $this->db->prepare($query);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function getAnotador($id)
    {
        $sentencia = $this->db->prepare("SELECT * FROM jugadores WHERE id_jugador=?");
        $sentencia->execute([$id]);
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function addAnotador($nombre, $camiseta, $rol, $equipo, $goles)
    {
        $sentencia = $this->db->prepare("INSERT INTO jugadores(nombre_jugador, nro_camiseta, rol, id_equipo_fk, goles) VALUES(?,?,?,?,?)");
        $sentencia->execute([$nombre, $camiseta, $rol, $equipo, $goles]);
        $anotador = $this->getAnotador($this->db->lastInsertId());
        return $anotador;
    }

    function deleteAnotador($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM jugadores WHERE id_jugador=?");
        $sentencia->execute([$id]);
    }

    function updateAnotador($id, $nombre, $camiseta, $rol, $equipo, $goles)
    {
        $sentencia = $this->db->prepare("UPDATE jugadores SET nombre_jugador=?, nro_camiseta=?, rol=?, id_equipo_fk=?, goles=? WHERE id_jugador=?");
        $sentencia->execute([$nombre, $camiseta, $rol, $equipo, $goles, $id]);
        return $sentencia->rowCount();
    }
}
