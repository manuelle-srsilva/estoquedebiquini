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

    // Método para obter todos os biquínis
    public function getBiquines()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para criar um novo biquíni
    public function createBiquine()
    {
        $sql = "INSERT INTO produtos (nome, quantidade, preco) VALUES (:nome, :quantidade, :preco)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $this->quantidade, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $this->preco, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para editar um biquíni
    public function updateBiquine()
    {
        $sql = "UPDATE produtos SET nome = :nome, quantidade = :quantidade, preco = :preco WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $this->quantidade, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $this->preco, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir um biquíni
    public function deleteBiquine()
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

