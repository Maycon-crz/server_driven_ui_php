<?php
require_once __DIR__ . '/../config/Database.php';

class TelaModel {
    private $conn;
    private $table = "telas";

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
        // Primeiro, buscamos os dados básicos da tela
        $query = "SELECT t.*, c.component_key, c.component_value, c.ordem
                  FROM " . $this->table . " t
                  LEFT JOIN componentes c ON t.id = c.tela_id
                  WHERE t.id = :id
                  ORDER BY c.ordem";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($results) {
            // Prepara o resultado final
            $tela = [
                'id' => $results[0]['id'],
                'nome' => $results[0]['nome'],
                'descricao' => $results[0]['descricao'],
                'components' => []
            ];
            
            // Adiciona os componentes
            foreach ($results as $row) {
                if ($row['component_key']) {
                    $tela['components'][] = [
                        'key' => $row['component_key'],
                        'value' => json_decode($row['component_value'], true)
                    ];
                }
            }
            
            return $tela;
        }
        
        return null;
    }

    public function postModel($data) {
        try {
            // Inicia a transação
            $this->conn->beginTransaction();
            
            // 1. Insere a tela
            $query = "INSERT INTO " . $this->table . " (nome, descricao) VALUES (:nome, :descricao)";
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":nome", $data['nome']);
            $stmt->bindParam(":descricao", $data['descricao']);
            
            if (!$stmt->execute()) {
                throw new Exception("Erro ao criar tela");
            }
            
            $telaId = $this->conn->lastInsertId();
            
            // 2. Insere os componentes
            if (isset($data['components']) && is_array($data['components'])) {
                $query = "INSERT INTO componentes (tela_id, ordem, component_key, component_value) 
                         VALUES (:tela_id, :ordem, :component_key, :component_value)";
                $stmt = $this->conn->prepare($query);
                
                foreach ($data['components'] as $index => $component) {
                    $componentValue = json_encode($component['value']);
                    
                    $stmt->bindParam(":tela_id", $telaId);
                    $stmt->bindParam(":ordem", $index);
                    $stmt->bindParam(":component_key", $component['key']);
                    $stmt->bindParam(":component_value", $componentValue);
                    
                    if (!$stmt->execute()) {
                        throw new Exception("Erro ao criar componente");
                    }
                }
            }
            
            // Commit da transação
            $this->conn->commit();
            
            // Retorna o id da tela criada
            return $telaId;
            
        } catch (Exception $e) {
            // Em caso de erro, faz rollback
            $this->conn->rollBack();
            throw $e;
        }
    }
} 