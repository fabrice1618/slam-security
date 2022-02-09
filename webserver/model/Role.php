<?php
declare(strict_types = 1);

const QUERY_INSERT = "INSERT INTO role (id, libelle) VALUES (NULL, :libelle) ";
const QUERY_SELECT_BY_ID = "SELECT * FROM role WHERE id = :id LIMIT 1";
const QUERY_UPDATE = "UPDATE role SET role = :role, WHERE id = :id";
const QUERY_DELETE = "DELETE FROM role WHERE id = :id ";

class Role extends Model
{
    private int $id;
    private string $libelle;



    public function create(): void
    {
        $stmt1 = $this->pdo->prepare(QUERY_INSERT);
        $stmt1->bindValue(':libelle', $this->libelle);
        if ($stmt1->execute()) {
            $this->id = (int)$this->pdo->lastInsertId();
        }
    }

    

    public function read()
    {
        $stmt1 = $this->pdo->prepare(QUERY_SELECT_BY_ID);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
            $this->id = $this->data["id"];
            $this->libelle = $this->data["libelle"];
        }
    }

    public function update(): bool
    {
        $stmt1 = $this->pdo->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':libelle', $this->libelle);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $stmt1 = $this->pdo->prepare(QUERY_DELETE);
        $stmt1->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            return true;
        }
        return false;
    }

    

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }


    public function checkCredentials(string $libelle): bool
    {
        return ($libelle === $this->libelle);
    }

}

