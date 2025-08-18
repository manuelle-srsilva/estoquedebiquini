<?php

namespace Controller;

use Model\Biquine;

class BiquineController
{
    public function getBiquines()
    {
        $biquine = new Biquine();
        $biquines = $biquine->getBiquines();

        if ($biquines) {
            header("Content-Type: application/json", true, 200);
            echo json_encode($biquines);
        } else {
            header("Content-Type: application/json", true, 404);
            echo json_encode(["message" => "Nenhum biquíni encontrado"]);
        }
    }

    public function createBiquine()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->nome) && isset($data->quantidade) && isset($data->preco)) {
            $biquine = new Biquine();
            $biquine->nome = $data->nome;
            $biquine->quantidade = $data->quantidade;
            $biquine->preco = $data->preco;

            if ($biquine->createBiquine()) {
                header("Content-Type: application/json", true, 201);
                echo json_encode(["message" => "Biquíni criado com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Erro ao criar biquíni"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    public function updateBiquine()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->nome) && isset($data->quantidade) && isset($data->preco)) {
            $biquine = new Biquine();
            $biquine->id = $data->id;
            $biquine->nome = $data->nome;
            $biquine->quantidade = $data->quantidade;
            $biquine->preco = $data->preco;

            if ($biquine->updateBiquine()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message" => "Biquíni atualizado com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Erro ao atualizar biquíni"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    public function deleteBiquine()
    {
        $id = $_GET["id"] ?? null;
        
        if ($id) {
            $biquine = new Biquine();
            $biquine->id = $id;

            if ($biquine->deleteBiquine()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message" => "Biquíni excluído com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Erro ao excluir biquíni"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "ID inválido"]);
        }
    }
}
?>

