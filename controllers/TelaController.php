<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../views/components/UIComponents.php';

class TelaController extends BaseController {
    private $uiComponents;

    public function __construct() {
        $this->uiComponents = new UIComponents();
    }

    public function produtoDetail($id) {
        $components = $this->uiComponents->getProdutoDetailComponents($id);
        $this->successResponse($components, 'Tela do produto encontrada');
    }
} 