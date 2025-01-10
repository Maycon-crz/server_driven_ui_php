<?php
require_once 'BaseController.php';
// require_once __DIR__ . '/../views/components/UIComponents.php';
require_once __DIR__ . '/../models/TelaModel.php';

class TelaController extends BaseController {
    // private $uiComponents;

    private $tela;

    public function __construct() {
    //     $this->uiComponents = new UIComponents();

        $this->tela = new TelaModel();
    }

    // public function produtoDetail($id) {
    //     $components = $this->uiComponents->getProdutoDetailComponents($id);
    //     $this->successResponse($components, 'Tela do produto encontrada');
    // }

    public function postController($data) {
        try {
            // if (!isset($data['nome']) || empty($data['nome'])) {
            //     $this->errorResponse('Nome da tela é obrigatório', 400);
            // }
            // $result = $this->tela->postModel($data);
            // if ($result) {
            //     $this->successResponse($result, 'Tela criada com sucesso', 201);
            // } else {
            //     $this->errorResponse('Erro ao criar tela', 400);
            // }

            try {
                $id = $this->tela->postModel($data);
                $this->successResponse(['id' => $id], 'Tela criada com sucesso');
            } catch (Exception $e) {
                $this->errorResponse($e->getMessage(), 500);
            }
        } catch (Exception $e) {
            $this->errorResponse('Erro ao criar tela: '.$e->getMessage(), 400);
        }
    }

    public function index() {
        $this->successResponse('Todas Telas existentes');
    }

    public function getController($id) {
        $this->tela = $this->tela->getById($id);
        if ($this->tela) {
            $this->successResponse($this->tela, 'Tela encontrada');
        } else {
            $this->errorResponse('Tela não encontrada '.$this->tela." - ".$id, 404);
        }
    }
} 