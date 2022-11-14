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
        $anotadores = $this->model->getAnotadores();
        $this->view->response($anotadores, 200);
    }

    function getAnotador($params = null)
    {
        $id = $params[':ID'];
        $anotador = $this->model->getAnotador($id);
        if ($anotador) {
            $this->view->response($anotador, 200);
        } else {
            $this->view->response("No existe el anotador con el id={$id}", 404);
        }
    }

    function addAnotador()
    {
        $body = $this->getData();
        $anotador = $this->model->addAnotador($body->nombre, $body->camiseta, $body->rol, $body->equipo, $body->goles);
        $this->view->response($anotador, 200);
    }

    function deleteAnotador($params = null)
    {
        $id = $params[':ID'];
        $anotador = $this->model->deleteAnotador($id);
        $this->view->response($anotador, 200);
    }

    function updateAnotador($params = null)
    {
        $id = $params[':ID'];
        $body = $this->getData();
        $anotador = $this->model->updateAnotador($id, $body->nombre, $body->camiseta, $body->rol, $body->equipo, $body->goles);
        $this->view->response($anotador, 200);
    }

    private function getData()
    {
        return json_decode(file_get_contents("php://input"));
    }
}
