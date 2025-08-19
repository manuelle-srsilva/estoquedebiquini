<?php

namespace Model;

use PDO;
use Model\Connection;

class Biquine
{
    private $conn;

    public $id;
    public $nome;
    public $quantidade;
    public $preco;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    // Obter todos os biquínis
    public function getBiquines()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obter biquíni por ID
    public function getById($id)
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar novo biquíni
    public function createBiquine()
    {
        $sql = "INSERT INTO produtos (nome, quantidade, preco) VALUES (:nome, :quantidade, :preco)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $this->quantidade, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $this->preco, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Atualizar biquíni
    public function updateBiquine()
    {
        $sql = "UPDATE produtos SET nome = :nome, quantidade = :quantidade, preco = :preco WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $this->quantidade, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $this->preco, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Excluir biquíni
    public function deleteBiquine()
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
