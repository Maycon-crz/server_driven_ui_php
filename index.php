<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'controllers/ProdutoController.php';
require_once 'controllers/TelaController.php';
require_once 'controllers/AuthenticationController.php';

// Parse URL
$requestUri = str_replace('/fv/server_driven_ui_php/index.php', '', $_SERVER['REQUEST_URI']);
$path = trim($requestUri, '/');
$params = explode('/', $path);

// Get controller and id
$controller = isset($params[0]) ? $params[0] : '';
$id = isset($params[1]) ? $params[1] : null;
$requestMethod = $_SERVER["REQUEST_METHOD"];

// Route the request
try {
    switch($controller) {
        case 'login':
            $controller = new \controllers\AuthenticationController();
            
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => $controller->loginController()
            ]);
        break;
        case 'tela':
            $controller = new TelaController();
            switch($requestMethod) {
                case 'POST':
                    $jsonData = file_get_contents('php://input');
                    $data = json_decode($jsonData, true);// Converte o JSON para um array associativo PHP
                    $controller->postController($data);
                break;
                case 'GET':
                    if ($id) {
                        // $controller->produtoDetail($id);
                        $controller->getController($id);
                    } else {
                        // $controller->index();
                        throw new Exception("ID não fornecido");
                    }
                break;
                default:
                    throw new Exception("Método não permitido");
            }
        break;
        case 'produtos':
            $controller = new ProdutoController();
            switch($requestMethod) {
                case 'POST':
                    $jsonData = file_get_contents('php://input');
                    $data = json_decode($jsonData, true);// Converte o JSON para um array associativo PHP
                    $controller->post($data);
                    break;
                case 'GET':
                    if ($id) {
                        $controller->get($id);
                        // throw new Exception("Método GET con id");
                    } else {
                        $controller->index();
                    }
                    break;
                case 'DELETE':
                    if ($id) {
                        $controller->delete($id);
                    } else {
                        throw new Exception("ID não fornecido");
                    }
                    break;
                default:
                    throw new Exception("Método não permitido");
            }
        break;
        default:
            throw new Exception("Controller não encontrado - ".$controller." - ".$requestUri." - ".$params[0]);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
