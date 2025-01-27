<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController extends BaseController {
    private $produto;

    public function __construct() {
        $this->produto = new Produto();
    }

    public function index() {
        $produtos = $this->produto->getAll();
        $this->successResponse($produtos, 'Lista de produtos');
    }

    public function get($id) {
        $produto = $this->produto->getById($id);
        if ($produto) {
            $this->successResponse($produto, 'Produto encontrado');
        } else {
            $this->errorResponse('Produto não encontrado '.$produto." - ".$id, 404);
        }
    }

    public function post($data) {
        try {
            $id = $this->produto->post($data);
            $this->successResponse(['id' => $id], 'Produto criado com sucesso');
        } catch (Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            if ($this->produto->delete($id)) {
                $this->successResponse(['id' => $id], 'Produto deletado com sucesso');
            } else {
                $this->errorResponse('Produto não encontrado', 404);
            }
        } catch (Exception $e) {
            $this->errorResponse($e->getMessage(), 500);
        }
    }
} 