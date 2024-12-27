<?php
require_once __DIR__ . '/../config/Database.php';

class Produto {
    private $conn;
    private $table = "produtos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function post($data) {
        $query = "INSERT INTO " . $this->table . " (nome, descricao, categoria, preco) VALUES (:nome, :descricao, :categoria, :preco)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $data['nome']);
        $stmt->bindParam(":descricao", $data['descricao']);
        $stmt->bindParam(":categoria", $data['categoria']);
        $stmt->bindParam(":preco", $data['preco']);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        
        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
} 