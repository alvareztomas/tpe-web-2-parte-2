<?php

require_once './Model/ApiModel.php';
require_once './View/ApiView.php';

class ApiController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new ApiModel();
        $this->view = new ApiView();
    }

    function getAnotadores()
    {
        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $sort = $_GET['sort'];
            $order = $_GET['order'];
            $anotadores = $this->model->getAnotadores($sort, $order);
        } else {
            $anotadores = $this->model->getAnotadores();
        }
        $this->view->response($anotadores, 200);
    }

    function getAnotador($params = null)
    {
        $id = $params[':ID'];
        $anotador = $this->model->getAnotador($id);
        if ($anotador) {
            $this->view->response($anotador, 200);
        } else {
            $this->view->response("No existe el jugador con el id={$id}", 404);
        }
    }

    function addAnotador()
    {
        $body = $this->getData();

        // Checkeo si los campos requeridos estan seteados y no se insertaron mas de 5 campos
        if ((count((array)$body) === 5) && !empty($body->nombre) && !empty($body->camiseta) && !empty($body->rol) && !empty($body->equipo) && !empty($body->goles)) {
            try {
                $anotador = $this->model->addAnotador($body->nombre, $body->camiseta, $body->rol, $body->equipo, $body->goles);
                $this->view->response($anotador, 201);
            } catch (\Throwable $th) {
                $this->view->response("Error al insertar el jugador", 400);
            }
        } else {
            $this->view->response("Datos faltantes o incorrectos", 400);
        }
    }

    function deleteAnotador($params = null)
    {
        $id = $params[':ID'];
        $anotador = $this->model->getAnotador($id);
        if ($anotador) {
            $this->model->deleteAnotador($id);
            $this->view->response($anotador, 200);
        } else {
            $this->view->response("No existe el jugador con el id={$id}", 404);
        }
    }

    function updateAnotador($params = null)
    {
        $id = $params[':ID'];
        $body = $this->getData();
        $anotador = $this->model->getAnotador($id);

        if ($anotador) {
            $result = $this->model->updateAnotador($id, $body->nombre, $body->camiseta, $body->rol, $body->equipo, $body->goles);
            if ($result > 0) {
                $this->view->response("Modificacion realizada con exito", 200);
            } else {
                $this->view->response("No se realizo ninguna modificacion", 200);
            }
        } else {
            $this->view->response("No existe el jugador con el id={$id}", 404);
        }
    }

    private function getData()
    {
        return json_decode(file_get_contents("php://input"));
    }
}
