<?php
declare(strict_types = 1);

const QUERY_INSERT = "INSERT INTO image (id, nom, content) VALUES (NULL, :nom, :content) ";
const QUERY_SELECT_BY_ID = "SELECT * FROM user WHERE id = :id LIMIT 1";
const QUERY_DELETE = "DELETE FROM user WHERE id = :id ";


class Image extends Model{

    private int $id; 
    private string $nom;
    private mixed $content;

    public function create(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_INSERT);
        $stmt1->bindValue(':nom', $this->nom);
        $stmt1->bindValue(':content', $this->content);
        if ($stmt1->execute()) {
            $this->id = (int)$this->pdo->lastInsertId();
        }
    }

}