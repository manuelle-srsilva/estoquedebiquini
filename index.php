<?php
// IMPORTAÇÃO DE ARQUIVOS
require_once __DIR__ . 
'/config/configuration.php';
require_once __DIR__ . '/vendor/autoload.php';

use Controller\BiquineController;
$biquineController = new BiquineController();


// ARMAZENA O MÉTODO HTTP
$method = $_SERVER['REQUEST_METHOD'];

// VERIFICAR O MÉTODO E EXECUTAR UMA AÇÃO
switch ($method) {
    case 'GET':
        $biquineController->getBiquines();
        break;
    case 'POST':
        $biquineController->createBiquine();
        break;
    case 'PUT':
        $biquineController->updateBiquine();
        break;
    case 'DELETE':
        $biquineController->deleteBiquine();
        break;
    default:
        // FORMATA TEXTO EM JSON
        header("Content-Type: application/json", true, 405);
        echo json_encode(["message" => "Método não permitido"]);
        break;
}

